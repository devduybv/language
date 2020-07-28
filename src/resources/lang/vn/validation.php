<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
     */

    'accepted'             => ':attribute phải được chấp nhận.',
    'active_url'           => ':attribute không phải là một URL hợp lệ.',
    'after'                => ':attribute phải là một ngày sau :date.',
    'after_or_equal'       => ':attribute phải là một ngày sau hoặc bằng :date.',
    'alpha'                => ':attribute chỉ có thể chứa chữ cái.',
    'alpha_dash'           => ':attribute chỉ có thẻ chứa bao gồm chữ cái, số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num'            => ':attribute chỉ có thể chứa số và chữ cái.',
    'array'                => ':attribute phải là một mảng.',
    'before'               => ':attribute phải là một ngày trước :date.',
    'before_or_equal'      => ':attribute phải là một ngày sau hoặc bằng :date.',
    'between'              => [
        'numeric' => ':attribute phải là giá trị giữa từ :min đến :max.',
        'file'    => ':attribute phải là giá trị giữa từ :min đến :max kilobytes.',
        'string'  => ':attribute phải là giá trị giữa từ :min đến :max ký tự.',
        'array'   => ':attribute phải có giá trị giữa từ :min đến :max items.',
    ],
    'boolean'              => ':attribute trường này phải mang hai giá trị true hoặc failse.',
    'confirmed'            => ':attribute xác nhận không trùng khớp.',
    'date'                 => ':attribute không phải là ngày hợp lệ.',
    'date_equals'          => ':attribute phải là một ngày bằng :date.',
    'date_format'          => ':attribute không đúng với định dạng :format.',
    'different'            => ':attribute vầ :other phải khác nhau.',
    'digits'               => ':attribute phải là chữ số :digits .',
    'digits_between'       => ':attribute phải là chữ số giữa :min và :max.',
    'dimensions'           => ':attribute has invalid image dimensions.',
    'distinct'             => ':attribute có giá trị trùng lặp.',
    'email'                => ':attribute phải là địa chỉ e-mail hợp lệ.',
    'ends_with'            => ':attribute phải kết thúc bằng một trong các giá trị sau : :values',
    'exists'               => 'Giá trị được chọn :attribute không hợp lệ.',
    'file'                 => ':attribute phải là một tệp tin.',
    'filled'               => ':attribute phải có một giá trị.',
    'gt'                   => [
        'numeric' => ':attribute phải lớn hơn :value.',
        'file'    => ':attribute phải lớn hơn :value kilobytes.',
        'string'  => ':attribute phải lớn hơn :value ký tự.',
        'array'   => ':attribute phải có nhiều hơn :value items.',
    ],
    'gte'                  => [
        'numeric' => ':attribute phải lớn hơn hoặc bằng :value.',
        'file'    => ':attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'string'  => ':attribute phải lớn hơn hoặc bằng :value ký tự.',
        'array'   => ':attribute phải có :value items hoặc hơn.',
    ],
    'image'                => ':attribute phải là hình ảnh.',
    'in'                   => 'Giá trị được chọn :attribute không hợp lệ.',
    'in_array'             => ':attribute field không tồn tại trong :other.',
    'integer'              => ':attribute phải là số nguyên.',
    'ip'                   => ':attribute phải là một địa chỉ IP hợp lệ.',
    'ipv4'                 => ':attribute phải là một địa chỉ IPv4 hợp lệ.',
    'ipv6'                 => ':attribute phải là một địa chỉ IPv6 hợp lệ.',
    'json'                 => ':attribute phải là một chuỗi JSON.',
    'lt'                   => [
        'numeric' => ':attribute phải nhỏ hơn :value.',
        'file'    => ':attribute phải nhỏ hơn :value kilobytes.',
        'string'  => ':attribute phải nhỏ hơn :value kí tự.',
        'array'   => ':attribute phải nhỏ hơn :value items.',
    ],
    'lte'                  => [
        'numeric' => ':attribute phải nhỏ hơn hoặc bằng :value.',
        'file'    => ':attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
        'string'  => ':attribute phải nhỏ hơn hoặc bằng :value kí tự.',
        'array'   => ':attribute không được lớn hơn :value items.',
    ],
    'max'                  => [
        'numeric' => ':attribute có thể không lớn hơn :max.',
        'file'    => ':attribute có thể không lớn hơn :max kilobytes.',
        'string'  => ':attribute có thể không lớn hơn :max kí tự.',
        'array'   => ':attribute có thể không lớn hơn :max items.',
    ],
    'mimes'                => ':attribute phải là một tệp tin dạng: :values.',
    'mimetypes'            => ':attribute phải là một tệp tin dạng: :values.',
    'min'                  => [
        'numeric' => ':attribute ít nhất bằng :min.',
        'file'    => ':attribute ít nhất bằng :min kilobytes.',
        'string'  => ':attribute ít nhất bằng :min kí tự.',
        'array'   => ':attribute phải có ít nhất :min items.',
    ],
    'not_in'               => 'giá trị được chọn :attribute không hợp lệ.',
    'not_regex'            => ':attribute định dạng không hợp lệ.',
    'numeric'              => ':attribute phải là số.',
    'password'             => 'mật khẩu không chính xác.',
    'present'              => ':attribute phải có ở hiện tại.',
    'regex'                => ':attribute định dạng không hợp lệ.',
    'required'             => 'yêu cầu trường :attribute.',
    'required_if'          => 'yêu cầu trường :attribute khi :other là :value.',
    'required_unless'      => 'yêu cầu trường :attribute trừ khi :other ở trong :values.',
    'required_with'        => 'yêu cầu trường :attribute khi có :values.',
    'required_with_all'    => 'yêu cầu trường :attribute khi có :values.',
    'required_without'     => 'yêu cầu trường :attribute khi không có :values.',
    'required_without_all' => 'yêu cầu trường :attribute khi không có một trong những giá trị :values tồn tại.',
    'same'                 => ':attribute và :other phải giống nhau.',
    'size'                 => [
        'numeric' => ':attribute cần phải :size.',
        'file'    => ':attribute cần phải :size kilobytes.',
        'string'  => ':attribute cần phải :size kí tự.',
        'array'   => ':attribute phải chứa :size items.',
    ],
    'starts_with'          => ':attribute phải bắt đầu bằng một trong các kí tự: :values',
    'string'               => ':attribute phải là chuỗi.',
    'timezone'             => ':attribute phải là một khu vực hợp lệ.',
    'unique'               => ':attribute đã được sử dụng.',
    'uploaded'             => ':attribute tải lên không thành công.',
    'url'                  => ':attribute định dạng không hợp lệ.',
    'uuid'                 => ':attribute phải là giá trị UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
     */

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
     */

    'attributes'           => [],

];
