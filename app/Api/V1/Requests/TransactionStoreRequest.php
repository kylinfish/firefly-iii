<?php

/**
 * TransactionStoreRequest.php
 * Copyright (c) 2019 thegrumpydictator@gmail.com
 *
 * This file is part of Firefly III (https://github.com/firefly-iii).
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace FireflyIII\Api\V1\Requests;

use FireflyIII\Rules\BelongsUser;
use FireflyIII\Rules\IsBoolean;
use FireflyIII\Rules\IsDateOrTime;
use FireflyIII\Support\NullArrayObject;
use FireflyIII\Validation\TransactionValidation;
use Illuminate\Validation\Validator;


/**
 * Class TransactionStoreRequest
 */
class TransactionStoreRequest extends Request
{
    use TransactionValidation;

    /**
     * Authorize logged in users.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Only allow authenticated users
        return auth()->check();
    }

    /**
     * Get all data. Is pretty complex because of all the ??-statements.
     *
     * @return array
     */
    public function getAll(): array
    {
        $data = [
            'group_title'  => $this->string('group_title'),
            'transactions' => $this->getTransactionData(),
        ];

        return $data;
    }

    /**
     * The rules that the incoming request must be matched against.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            // basic fields for group:
            'group_title'                          => 'between:1,1000',

            // transaction rules (in array for splits):
            'transactions.*.type'                  => 'required|in:withdrawal,deposit,transfer,opening-balance,reconciliation',
            'transactions.*.date'                  => ['required', new IsDateOrTime],
            'transactions.*.order'                 => 'numeric|min:0',

            // currency info
            'transactions.*.currency_id'           => 'numeric|exists:transaction_currencies,id',
            'transactions.*.currency_code'         => 'min:3|max:3|exists:transaction_currencies,code',
            'transactions.*.foreign_currency_id'   => 'numeric|exists:transaction_currencies,id',
            'transactions.*.foreign_currency_code' => 'min:3|max:3|exists:transaction_currencies,code',

            // amount
            'transactions.*.amount'                => 'required|numeric|more:0',
            'transactions.*.foreign_amount'        => 'numeric|more:0',

            // description
            'transactions.*.description'           => 'nullable|between:1,1000',

            // source of transaction
            'transactions.*.source_id'             => ['numeric', 'nullable', new BelongsUser],
            'transactions.*.source_name'           => 'between:1,255|nullable',

            // destination of transaction
            'transactions.*.destination_id'        => ['numeric', 'nullable', new BelongsUser],
            'transactions.*.destination_name'      => 'between:1,255|nullable',

            // budget, category, bill and piggy
            'transactions.*.budget_id'             => ['mustExist:budgets,id', new BelongsUser],
            'transactions.*.budget_name'           => ['between:1,255', 'nullable', new BelongsUser],
            'transactions.*.category_id'           => ['mustExist:categories,id', new BelongsUser],
            'transactions.*.category_name'         => 'between:1,255|nullable',
            'transactions.*.bill_id'               => ['numeric', 'nullable', 'mustExist:bills,id', new BelongsUser],
            'transactions.*.bill_name'             => ['between:1,255', 'nullable', new BelongsUser],
            'transactions.*.piggy_bank_id'         => ['numeric', 'nullable', 'mustExist:piggy_banks,id', new BelongsUser],
            'transactions.*.piggy_bank_name'       => ['between:1,255', 'nullable', new BelongsUser],

            // other interesting fields
            'transactions.*.reconciled'            => [new IsBoolean],
            'transactions.*.notes'                 => 'min:1,max:50000|nullable',
            'transactions.*.tags'                  => 'between:0,255',

            // meta info fields
            'transactions.*.internal_reference'    => 'min:1,max:255|nullable',
            'transactions.*.external_id'           => 'min:1,max:255|nullable',
            'transactions.*.recurrence_id'         => 'min:1,max:255|nullable',
            'transactions.*.bunq_payment_id'       => 'min:1,max:255|nullable',

            // SEPA fields:
            'transactions.*.sepa_cc'               => 'min:1,max:255|nullable',
            'transactions.*.sepa_ct_op'            => 'min:1,max:255|nullable',
            'transactions.*.sepa_ct_id'            => 'min:1,max:255|nullable',
            'transactions.*.sepa_db'               => 'min:1,max:255|nullable',
            'transactions.*.sepa_country'          => 'min:1,max:255|nullable',
            'transactions.*.sepa_ep'               => 'min:1,max:255|nullable',
            'transactions.*.sepa_ci'               => 'min:1,max:255|nullable',
            'transactions.*.sepa_batch_id'         => 'min:1,max:255|nullable',

            // dates
            'transactions.*.interest_date'         => 'date|nullable',
            'transactions.*.book_date'             => 'date|nullable',
            'transactions.*.process_date'          => 'date|nullable',
            'transactions.*.due_date'              => 'date|nullable',
            'transactions.*.payment_date'          => 'date|nullable',
            'transactions.*.invoice_date'          => 'date|nullable',
        ];

        return $rules;


    }

    /**
     * Configure the validator instance.
     *
     * @param Validator $validator
     *
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(
            function (Validator $validator) {
                // must submit at least one transaction.
                $this->validateOneTransaction($validator);

                // all journals must have a description
                $this->validateDescriptions($validator);

                // all transaction types must be equal:
                $this->validateTransactionTypes($validator);

                // validate foreign currency info
                $this->validateForeignCurrencyInformation($validator);

                // validate all account info
                $this->validateAccountInformation($validator);

                // validate source/destination is equal, depending on the transaction journal type.
                $this->validateEqualAccounts($validator);

                // the group must have a description if > 1 journal.
                $this->validateGroupDescription($validator);

            }
        );
    }

    /**
     * Get transaction data.
     *
     * @return array
     */
    private function getTransactionData(): array
    {
        $return = [];
        /**
         * @var int   $index
         * @var array $transaction
         */
        foreach ($this->get('transactions') as $index => $transaction) {
            $object   = new NullArrayObject($transaction);
            $return[] = [
                'type'  => $this->stringFromValue($object['type']),
                'date'  => $this->dateFromValue($object['date']),
                'order' => $this->integerFromValue((string)$object['order']),

                'currency_id'           => $this->integerFromValue($object['currency_id']),
                'currency_code'         => $this->stringFromValue($object['currency_code']),

                // foreign currency info:
                'foreign_currency_id'   => $this->integerFromValue((string)$object['foreign_currency_id']),
                'foreign_currency_code' => $this->stringFromValue($object['foreign_currency_code']),

                // amount and foreign amount. Cannot be 0.
                'amount'                => $this->stringFromValue((string)$object['amount']),
                'foreign_amount'        => $this->stringFromValue((string)$object['foreign_amount']),

                // description.
                'description'           => $this->stringFromValue($object['description']),

                // source of transaction. If everything is null, assume cash account.
                'source_id'             => $this->integerFromValue((string)$object['source_id']),
                'source_name'           => $this->stringFromValue($object['source_name']),

                // destination of transaction. If everything is null, assume cash account.
                'destination_id'        => $this->integerFromValue((string)$object['destination_id']),
                'destination_name'      => $this->stringFromValue($object['destination_name']),

                // budget info
                'budget_id'             => $this->integerFromValue((string)$object['budget_id']),
                'budget_name'           => $this->stringFromValue($object['budget_name']),

                // category info
                'category_id'           => $this->integerFromValue((string)$object['category_id']),
                'category_name'         => $this->stringFromValue($object['category_name']),

                // journal bill reference. Optional. Will only work for withdrawals
                'bill_id'               => $this->integerFromValue((string)$object['bill_id']),
                'bill_name'             => $this->stringFromValue($object['bill_name']),

                // piggy bank reference. Optional. Will only work for transfers
                'piggy_bank_id'         => $this->integerFromValue((string)$object['piggy_bank_id']),
                'piggy_bank_name'       => $this->stringFromValue($object['piggy_bank_name']),

                // some other interesting properties
                'reconciled'            => $this->convertBoolean((string)$object['reconciled']),
                'notes'                 => $this->nlStringFromValue($object['notes']),
                'tags'                  => $this->arrayFromValue($object['tags']),

                // all custom fields:
                'internal_reference'    => $this->stringFromValue($object['internal_reference']),
                'external_id'           => $this->stringFromValue($object['external_id']),
                'original_source'       => sprintf('ff3-v%s|api-v%s', config('firefly.version'), config('firefly.api_version')),
                'recurrence_id'         => $this->integerFromValue($object['recurrence_id']),
                'bunq_payment_id'       => $this->stringFromValue($object['bunq_payment_id']),

                'sepa_cc'       => $this->stringFromValue($object['sepa_cc']),
                'sepa_ct_op'    => $this->stringFromValue($object['sepa_ct_op']),
                'sepa_ct_id'    => $this->stringFromValue($object['sepa_ct_id']),
                'sepa_db'       => $this->stringFromValue($object['sepa_db']),
                'sepa_country'  => $this->stringFromValue($object['sepa_country']),
                'sepa_ep'       => $this->stringFromValue($object['sepa_ep']),
                'sepa_ci'       => $this->stringFromValue($object['sepa_ci']),
                'sepa_batch_id' => $this->stringFromValue($object['sepa_batch_id']),


                // custom date fields. Must be Carbon objects. Presence is optional.
                'interest_date' => $this->dateFromValue($object['interest_date']),
                'book_date'     => $this->dateFromValue($object['book_date']),
                'process_date'  => $this->dateFromValue($object['process_date']),
                'due_date'      => $this->dateFromValue($object['due_date']),
                'payment_date'  => $this->dateFromValue($object['payment_date']),
                'invoice_date'  => $this->dateFromValue($object['invoice_date']),

            ];
        }

        return $return;
    }
}
