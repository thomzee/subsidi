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
    'accepted' => 'Field :attribute harus diterima.',
    'active_url' => 'Field :attribute bukan URL yang valid.',
    'after' => 'Field :attribute harus tanggal setelah :date.',
    'alpha' => 'Field :attribute hanya boleh berisi huruf.',
    'alpha_dash' => 'Field :attribute hanya boleh berisi huruf, angka, dan strip.',
    'alpha_num' => 'Field :attribute hanya boleh berisi huruf dan angka.',
    'array' => 'Field :attribute harus berupa sebuah array.',
    'before' => 'Field :attribute harus tanggal sebelum :date.',
    'between' => [
        'numeric' => 'Field :attribute harus antara :min dan :max.',
        'file' => 'Field :attribute harus antara :min dan :max kilobytes.',
        'string' => 'Field :attribute harus antara :min dan :max karakter.',
        'array' => 'Field :attribute harus antara :min dan :max item.',
    ],

    'boolean' => 'Field :attribute harus berupa true atau false',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'date' => 'Field :attribute bukan tanggal yang valid.',
    'date_format' => 'Field :attribute tidak cocok dengan format :format.',
    'different' => 'Field :attribute dan :other harus berbeda.',
    'digits' => 'Field :attribute harus berupa angka :digits.',
    'digits_between' => 'Field :attribute harus antara angka :min dan :max.',
    'email' => 'Field :attribute harus berupa alamat surel yang valid.',
    'exists' => 'Field :attribute yang dipilih tidak valid.',
    'filled' => 'Field :attribute wajib diisi.',
    'image' => 'Field :attribute harus berupa gambar.',
    'in' => 'Field :attribute tidak sesuai format.',
    'integer' => 'Field :attribute harus merupakan bilangan bulat.',
    'ip' => 'Field :attribute harus berupa alamat IP yang valid.',
    'json' => 'The :attribute must be a valid JSON string.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'ends_with' => 'The :attribute must end with one of the following: :values',
    'file' => 'The :attribute must be a file.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'in_array' => 'The :attribute field does not exist in :other.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'mimetypes' => 'The :attribute must be a file of type: :values.',

    'max' => [
        'numeric' => 'Field :attribute seharusnya tidak lebih dari :max.',
        'file' => 'Field :attribute seharusnya tidak lebih dari :max kilobytes.',
        'string' => 'Field :attribute seharusnya tidak lebih dari :max karakter.',
        'array' => 'Field :attribute seharusnya tidak lebih dari :max item.',
    ],
    'phone' => 'Nomor handphone harus sesuai format',
    'mimes' => 'Field :attribute harus dokumen berjenis : :values.',
    'min' => [
        'numeric' => 'Field :attribute harus minimal :min.',
        'file' => 'Field :attribute harus minimal :min kilobytes.',
        'string' => 'Field :attribute harus minimal :min karakter.',
        'array' => 'Field :attribute harus minimal :min item.',
    ],
    'not_in' => 'Field :attribute yang dipilih tidak valid.',
    'numeric' => 'Field :attribute harus berupa angka.',
    'regex' => 'Format isian :attribute tidak valid.',
    'required' => 'Field :attribute wajib diisi.',
    'required_if' => 'Field :attribute wajib diisi bila :other adalah :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'Field :attribute wajib diisi bila terdapat :values.',
    'required_with_all' => 'Field :attribute wajib diisi bila terdapat :values.',
    'required_without' => 'Field :attribute wajib diisi bila tidak terdapat :values.',
    'required_without_all' => 'Field :attribute wajib diisi bila tidak terdapat ada :values.',
    'same' => 'Field :attribute dan :other harus sama.',
    'size' => [
        'numeric' => 'Field :attribute harus berukuran :size.',
        'file' => 'Field :attribute harus berukuran :size kilobyte.',
        'string' => 'Field :attribute harus berukuran :size karakter.',
        'array' => 'Field :attribute harus mengandung :size item.',
    ],

    'password' => 'Password salah.',
    'present' => 'The :attribute harus ada.',
    'starts_with' => ':attribute harus dimulai dengan kata : :values',
    'string' => 'The :attribute wajib berupa string.',
    'timezone' => 'The :attribute wajib valid dengan timezone.',
    'unique' => ':attribute sudah terdaftar.',
    'uploaded' => 'The :attribute gagal ter-upload.',
    'url' => ':attribute wajib URL.',
    'uuid' => ':attribute wajib format UUID.',

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

    'custom' => [
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

    'attributes' => [],

];
