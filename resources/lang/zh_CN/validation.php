<?php

/**
 * validation.php
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

return [
    'iban'                           => '这不是有效的 IBAN。',
    'zero_or_more'                   => '此数值不能为负数',
    'date_or_time'                   => '必须是有效的日期或时间(ISO 8601)。',
    'source_equals_destination'      => '来源帐户与目标帐户相同。',
    'unique_account_number_for_user' => '看起来此帐户号码已在使用中。',
    'unique_iban_for_user'           => '看起来此IBAN已在使用中。',
    'deleted_user'                   => '基于安全限制，你无法使用此电子邮件注册。',
    'rule_trigger_value'             => '此值不能用于所选择的触发器。',
    'rule_action_value'              => '此值不能用于所选择的动作。',
    'file_already_attached'          => '上传的档案 ":name" 已附加到该物件上。',
    'file_attached'                  => '文件成功上传 ":name".',
    'must_exist'                     => '栏位 :attribute 的 ID 不存在于资料库。',
    'all_accounts_equal'             => '此栏位中的所有帐户必须相等。',
    'group_title_mandatory'          => '在有超过一笔交易时，必须有分组标题。',
    'transaction_types_equal'        => '所有拆分的类型必须相同。',
    'invalid_transaction_type'       => '无效交易类型。',
    'invalid_selection'              => '您的选择无效。',
    'belongs_user'                   => '此值对此栏位无效。',
    'at_least_one_transaction'       => '至少需要一个交易。',
    'at_least_one_repetition'        => '至少需要一次重复。',
    'require_repeat_until'           => '仅需重复次数或结束日期 (repeat_until) 即可，不需两者均备。',
    'require_currency_info'          => '无货币资讯，此栏位内容无效。',
    'require_currency_amount'        => 'The content of this field is invalid without foreign amount information.',
    'equal_description'              => '交易描述不应等同全域描述。',
    'file_invalid_mime'              => '档案 ":name" 的类型为 ":mime"，系不被允许上载的类型。',
    'file_too_large'                 => '档案 ":name" 过大。',
    'belongs_to_user'                => ':attribute 的值是未知的。',
    'accepted'                       => ':attribute 必须被接受。',
    'bic'                            => '这不是有效的 BIC。',
    'at_least_one_trigger'           => '规则必须至少有一个触发器。',
    'at_least_one_action'            => '规则必须至少有一个动作。',
    'base64'                         => '这不是有效的 base64 编码资料。',
    'model_id_invalid'               => '指定的 ID 对于此模型似乎无效。',
    'more'                           => ':attribute 必须大于零。',
    'less'                           => ':attribute 必须小于 10,000,000。',
    'active_url'                     => ':attribute 不是有效的URL。',
    'after'                          => ':attribute 必须是一个在 :date 之后的日期。',
    'alpha'                          => ':attribute 只能包含字母。',
    'alpha_dash'                     => ':attribute 只能包含字母、数字和破折号。',
    'alpha_num'                      => ':attribute 只允许包含数字和字母。',
    'array'                          => ':attribute 必须是一个阵列。',
    'unique_for_user'                => '包括 :attribute 的纪录已存在。',
    'before'                         => ':attribute 必须是一个在 :date 之前的日期。',
    'unique_object_for_user'         => '这个名称已被使用。',
    'unique_account_for_user'        => '这个帐户名称已被使用。',
    'between.numeric'                => ':attribute 必须介于 :min 和 :max 之间。',
    'between.file'                   => ':attribute 必须介于 :min kB 到 :max kB之间。',
    'between.string'                 => ':attribute 必须介于 :min 到 :max 字元之间。',
    'between.array'                  => ':attribute 必须介于 :min 到 :max 项目之间。',
    'boolean'                        => ':attribute 栏位必须为 true 或 false。',
    'confirmed'                      => ':attribute 的确认并不相符。',
    'date'                           => ':attribute 不是一个有效的日期。',
    'date_format'                    => ':attribute 不符合 :format 格式。',
    'different'                      => ':attribute 和 :other 不能相同。',
    'digits'                         => ':attribute 必须是 :digits 位数字。',
    'digits_between'                 => ':attribute 必须介于 :min 和 :max 位数字之间。',
    'email'                          => ':attribute 必须是一个有效的电子邮件地址。',
    'filled'                         => ':attribute 栏位是必填的。',
    'exists'                         => '所选的 :attribute 无效。',
    'image'                          => ':attribute 必须是图片。',
    'in'                             => '所选的 :attribute 无效。',
    'integer'                        => ':attribute 必须是整数。',
    'ip'                             => ':attribute 必须是一个有效的 IP 位址。',
    'json'                           => ':attribute 必须是一个有效的 JSON 字串。',
    'max.numeric'                    => ':attribute 不能大于 :max。',
    'max.file'                       => ':attribute 不能大于 :max kB。',
    'max.string'                     => ':attribute 不能大于 :max 字元。',
    'max.array'                      => ':attribute 不能多于 :max 个项目。',
    'mimes'                          => ':attribute 的档案类型必须是 :values 。',
    'min.numeric'                    => ':attribute 至少需要 :min。',
    'lte.numeric'                    => ':attribute 必须小于或等于 :value。',
    'min.file'                       => ':attribute 必须至少为 :min kB。',
    'min.string'                     => ':attribute 最少需要有 :min 个字元。',
    'min.array'                      => ':attribute 至少需要有 :min 项目。',
    'not_in'                         => '所选的 :attribute 无效。',
    'numeric'                        => ':attribute 必须是数字。',
    'numeric_native'                 => '本地金额必须是数字。',
    'numeric_destination'            => '目标金额必须是数字。',
    'numeric_source'                 => '来源金额必须是数字。',
    'regex'                          => ':attribute 格式无效。',
    'required'                       => ':attribute 栏位是必填的。',
    'required_if'                    => ':attribute 栏位在 :other 是 :value 时是必填的。',
    'required_unless'                => '除非 :other 是 :values，否则 :attribute 是必填的。',
    'required_with'                  => '当 :values​​ 存在时， :attribute 是必填的。',
    'required_with_all'              => '当 :values​​ 存在时， :attribute 是必填的。',
    'required_without'               => '当 :values​​ 不存在时， :attribute 是必填的。',
    'required_without_all'           => '当没有任何 :values​​ 存在时， :attribute 为必填。',
    'same'                           => ':attribute 和 :other 必须相符。',
    'size.numeric'                   => ':attribute 必须是 :size。',
    'amount_min_over_max'            => '最小金额不能大于最大金额。',
    'size.file'                      => ':attribute 必须为 :size kB。',
    'size.string'                    => ':attribute 必须为 :size 个字元。',
    'size.array'                     => ':attribute 必须包含 :size 个项目。',
    'unique'                         => ':attribute 已被使用。',
    'string'                         => ':attribute 必须是字串。',
    'url'                            => ':attribute 格式无效。',
    'timezone'                       => ':attribute 必须是有效的区域。',
    '2fa_code'                    => ':attribute 栏位是无效的。',
    'dimensions'                  => ':attribute 具有无效图片尺寸。',
    'distinct'                    => ':attribute 栏位有重复值。',
    'file'                        => ':attribute 必须是档案。',
    'in_array'                    => ':attribute 栏位不存在于 :other。',
    'present'                     => ':attribute 栏位必须存在。',
    'amount_zero'                 => '总金额不能为零。',
    'current_target_amount'       => 'The current amount must be less than the target amount.',
    'unique_piggy_bank_for_user'  => '存钱罐的名称必须是独一无二的。',
    'secure_password'             => '这不是一个安全的密码，请重试一次。如需更多讯息，请访问 https://bit.ly/FF3-password-security',
    'valid_recurrence_rep_type'   => '对定期重复交易是无效的重复类型。',
    'valid_recurrence_rep_moment' => '对此重复类型是无效的重复时刻。',
    'invalid_account_info'        => '无效的帐户资讯。',
    'attributes'                     => [
        'email'                   => '电子邮件地址',
        'description'             => '描述',
        'amount'                  => '金额',
        'name'                    => '名称',
        'piggy_bank_id'           => '存钱罐 ID',
        'targetamount'            => '目标金额',
        'opening_balance_date'    => 'opening balance date',
        'opening_balance'         => 'opening balance',
        'match'                   => '符合',
        'amount_min'              => '最小金额',
        'amount_max'              => '最大金额',
        'title'                   => '标题',
        'tag'                     => '标签',
        'transaction_description' => '交易描述',
        'rule-action-value.1'     => '规则动作值 #1',
        'rule-action-value.2'     => '规则动作值 #2',
        'rule-action-value.3'     => '规则动作值 #3',
        'rule-action-value.4'     => '规则动作值 #4',
        'rule-action-value.5'     => '规则动作值 #5',
        'rule-action.1'           => '规则动作 #1',
        'rule-action.2'           => '规则动作 #2',
        'rule-action.3'           => '规则动作 #3',
        'rule-action.4'           => '规则动作 #4',
        'rule-action.5'           => '规则动作 #5',
        'rule-trigger-value.1'    => '规则触发器值 #1',
        'rule-trigger-value.2'    => '规则触发器值 #2',
        'rule-trigger-value.3'    => '规则触发器值 #3',
        'rule-trigger-value.4'    => '规则触发器值 #4',
        'rule-trigger-value.5'    => '规则触发器值 #5',
        'rule-trigger.1'          => '规则触发器 #1',
        'rule-trigger.2'          => '规则触发器 #2',
        'rule-trigger.3'          => '规则触发器 #3',
        'rule-trigger.4'          => '规则触发器 #4',
        'rule-trigger.5'          => '规则触发器 #5',
    ],

    // validation of accounts:
    'withdrawal_source_need_data'    => '需要一个有效的来源账户ID和/或来源账户名称才能继续。',
    'withdrawal_source_bad_data'     => '搜索 ID":id"或名称":name"时找不到有效的来源帐户。',
    'withdrawal_dest_need_data'      => '需要一个有效的目标账户ID和/或目标账户名称才能继续。',
    'withdrawal_dest_bad_data'       => 'Could not find a valid destination account when searching for ID ":id" or name ":name".',

    'deposit_source_need_data' => '需要一个有效的来源账户ID和/或来源账户名称才能继续。',
    'deposit_source_bad_data'  => '搜索 ID":id"或名称":name"时找不到有效的来源帐户。',
    'deposit_dest_need_data'   => '需要一个有效的目标账户ID和/或目标账户名称才能继续。',
    'deposit_dest_bad_data'    => '搜索 ID":id"或名称":name"时找不到有效的目标帐户。',

    'transfer_source_need_data' => '需要一个有效的来源账户ID和/或来源账户名称才能继续。',
    'transfer_source_bad_data'  => '搜索 ID":id"或名称":name"时找不到有效的来源帐户。',
    'transfer_dest_need_data'   => '需要一个有效的目标账户ID和/或目标账户名称才能继续。',
    'transfer_dest_bad_data'    => '搜索 ID":id"或名称":name"时找不到有效的目标帐户。',
    'need_id_in_edit'           => 'Each split must have transaction_journal_id (either valid ID or 0).',

    'ob_source_need_data' => 'Need to get a valid source account ID and/or valid source account name to continue.',
    'ob_dest_need_data'   => 'Need to get a valid destination account ID and/or valid destination account name to continue.',
    'ob_dest_bad_data'    => 'Could not find a valid destination account when searching for ID ":id" or name ":name".',

    'generic_invalid_source' => 'You can\'t use this account as the source account.',
    'generic_invalid_destination' => 'You can\'t use this account as the destination account.',
];
