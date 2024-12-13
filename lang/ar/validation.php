<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | تحتوي الأسطر التالية على رسائل الخطأ الافتراضية المستخدمة من قبل
    | فئة التحقق من الصحة. تحتوي بعض هذه القواعد على إصدارات متعددة
    | مثل قواعد الحجم. لا تتردد في تعديل كل واحدة من هذه الرسائل.
    |
    */

    'accepted' => 'يجب قبول :attribute.',
    'accepted_if' => 'يجب قبول :attribute عندما تكون :other تساوي :value.',
    'active_url' => 'الحقل :attribute يجب أن يكون عنوان URL صالحاً.',
    'after' => 'يجب أن يكون :attribute تاريخاً بعد :date.',
    'after_or_equal' => 'يجب أن يكون :attribute تاريخاً بعد أو يساوي :date.',
    'alpha' => 'يجب أن يحتوي :attribute على حروف فقط.',
    'alpha_dash' => 'يجب أن يحتوي :attribute على حروف، أرقام، شرطات وشرطات سفلية فقط.',
    'alpha_num' => 'يجب أن يحتوي :attribute على حروف وأرقام فقط.',
    'array' => 'يجب أن يكون :attribute مصفوفة.',
    'ascii' => 'يجب أن يحتوي :attribute على حروف وأرقام ورموز أحادية البايت فقط.',
    'before' => 'يجب أن يكون :attribute تاريخاً قبل :date.',
    'before_or_equal' => 'يجب أن يكون :attribute تاريخاً قبل أو يساوي :date.',
    'between' => [
        'array' => 'يجب أن يحتوي :attribute على ما بين :min و :max عناصر.',
        'file' => 'يجب أن يكون :attribute بين :min و :max كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute بين :min و :max.',
        'string' => 'يجب أن يحتوي :attribute بين :min و :max حروف.',
    ],
    'boolean' => 'يجب أن يكون :attribute صحيحاً أو خاطئاً.',
    'can' => ':attribute يحتوي على قيمة غير مسموح بها.',
    'confirmed' => 'تأكيد :attribute غير متطابق.',
    'contains' => ':attribute يفتقد قيمة مطلوبة.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => ':attribute ليس تاريخاً صالحاً.',
    'date_equals' => 'يجب أن يكون :attribute تاريخاً يساوي :date.',
    'date_format' => 'يجب أن يتطابق :attribute مع الصيغة :format.',
    'decimal' => 'يجب أن يحتوي :attribute على :decimal منازل عشرية.',
    'declined' => 'يجب رفض :attribute.',
    'declined_if' => 'يجب رفض :attribute عندما تكون :other تساوي :value.',
    'different' => 'يجب أن يكون :attribute و :other مختلفين.',
    'digits' => 'يجب أن يحتوي :attribute على :digits رقم.',
    'digits_between' => 'يجب أن يكون :attribute بين :min و :max رقم.',
    'dimensions' => ':attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => ':attribute يحتوي على قيمة مكررة.',
    'doesnt_end_with' => 'لا يجب أن ينتهي :attribute بأحد القيم التالية: :values.',
    'doesnt_start_with' => 'لا يجب أن يبدأ :attribute بأحد القيم التالية: :values.',
    'email' => 'يجب أن يكون :attribute بريداً إلكترونياً صالحاً.',
    'ends_with' => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values.',
    'enum' => ':attribute المحدد غير صالح.',
    'exists' => ':attribute المحدد غير صالح.',
    'file' => 'يجب أن يكون :attribute ملفاً.',
    'filled' => 'يجب أن يحتوي :attribute على قيمة.',
    'gt' => [
        'array' => 'يجب أن يحتوي :attribute على أكثر من :value عناصر.',
        'file' => 'يجب أن يكون :attribute أكبر من :value كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute أكبر من :value.',
        'string' => 'يجب أن يحتوي :attribute على أكثر من :value حروف.',
    ],
    'gte' => [
        'array' => 'يجب أن يحتوي :attribute على :value عناصر أو أكثر.',
        'file' => 'يجب أن يكون :attribute أكبر من أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute أكبر من أو يساوي :value.',
        'string' => 'يجب أن يحتوي :attribute على :value حروف أو أكثر.',
    ],
    'hex_color' => 'يجب أن يكون :attribute لوناً سداسياً صالحاً.',
    'image' => 'يجب أن يكون :attribute صورة.',
    'in' => ':attribute غير صالح.',
    'in_array' => 'يجب أن يكون :attribute موجوداً في :other.',
    'integer' => 'يجب أن يكون :attribute عدداً صحيحاً.',
    'ip' => 'يجب أن يكون :attribute عنوان IP صالحاً.',
    'ipv4' => 'يجب أن يكون :attribute عنوان IPv4 صالحاً.',
    'ipv6' => 'يجب أن يكون :attribute عنوان IPv6 صالحاً.',
    'json' => 'يجب أن يكون :attribute سلسلة JSON صالحة.',
    'list' => 'يجب أن يكون :attribute قائمة.',
    'lowercase' => 'يجب أن يكون :attribute بأحرف صغيرة.',
    'lt' => [
        'array' => 'يجب أن يحتوي :attribute على أقل من :value عناصر.',
        'file' => 'يجب أن يكون :attribute أقل من :value كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute أقل من :value.',
        'string' => 'يجب أن يحتوي :attribute على أقل من :value حروف.',
    ],
    'lte' => [
        'array' => 'يجب ألا يحتوي :attribute على أكثر من :value عناصر.',
        'file' => 'يجب أن يكون :attribute أقل من أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute أقل من أو يساوي :value.',
        'string' => 'يجب أن يحتوي :attribute على :value حروف أو أقل.',
    ],
    'mac_address' => 'يجب أن يكون :attribute عنوان MAC صالحاً.',
    'max' => [
        'array' => 'يجب ألا يحتوي :attribute على أكثر من :max عناصر.',
        'file' => 'يجب ألا يكون :attribute أكبر من :max كيلوبايت.',
        'numeric' => 'يجب ألا يكون :attribute أكبر من :max.',
        'string' => 'يجب ألا يحتوي :attribute على أكثر من :max حروف.',
    ],
    'max_digits' => 'يجب ألا يحتوي :attribute على أكثر من :max أرقام.',
    'mimes' => 'يجب أن يكون :attribute ملفاً من نوع: :values.',
    'mimetypes' => 'يجب أن يكون :attribute ملفاً من نوع: :values.',
    'min' => [
        'array' => 'يجب أن يحتوي :attribute على الأقل :min عناصر.',
        'file' => 'يجب ألا يقل :attribute عن :min كيلوبايت.',
        'numeric' => 'يجب ألا يقل :attribute عن :min.',
        'string' => 'يجب ألا يقل :attribute عن :min حروف.',
    ],
    'min_digits' => 'يجب أن يحتوي :attribute على الأقل :min أرقام.',
    'missing' => 'يجب أن يكون :attribute مفقوداً.',
    'missing_if' => 'يجب أن يكون :attribute مفقوداً عندما تكون :other تساوي :value.',
    'missing_unless' => 'يجب أن يكون :attribute مفقوداً إلا إذا كانت :other تساوي :value.',
    'missing_with' => 'يجب أن يكون :attribute مفقوداً عند وجود :values.',
    'missing_with_all' => 'يجب أن يكون :attribute مفقوداً عند وجود :values جميعاً.',
    'multiple_of' => 'يجب أن يكون :attribute مضاعفاً لـ :value.',
    'not_in' => ':attribute المحدد غير صالح.',
    'not_regex' => 'صيغة :attribute غير صالحة.',
    'numeric' => 'يجب أن يكون :attribute عدداً.',
    'password' => [
        'letters' => 'يجب أن يحتوي :attribute على حرف واحد على الأقل.',
        'mixed' => 'يجب أن يحتوي :attribute على حرف كبير واحد على الأقل وحرف صغير واحد على الأقل.',
        'numbers' => 'يجب أن يحتوي :attribute على رقم واحد على الأقل.',
        'symbols' => 'يجب أن يحتوي :attribute على رمز واحد على الأقل.',
        'uncompromised' => ':attribute تم اختراقه في تسريب بيانات. يرجى اختيار :attribute آخر.',
    ],
    'present' => 'يجب أن يكون :attribute موجوداً.',
    'present_if' => 'يجب أن يكون :attribute موجوداً عندما تكون :other تساوي :value.',
    'present_unless' => 'يجب أن يكون الحقل :attribute موجودًا إلا إذا كانت :other تساوي :values.',
    'prohibited' => 'الحقل :attribute محظور.',
    'prohibited_if' => 'الحقل :attribute محظور عندما تكون :other تساوي :value.',
    'prohibited_unless' => 'الحقل :attribute محظور إلا إذا كانت :other تساوي :values.',
    'prohibits' => 'الحقل :attribute يمنع :other من التواجد.',
    'regex' => 'صيغة :attribute غير صالحة.',
    'required' => 'الحقل :attribute مطلوب.',
    'required_array_keys' => 'الحقل :attribute يجب أن يحتوي على مدخلات لـ: :values.',
    'required_if' => 'الحقل :attribute مطلوب عندما تكون :other تساوي :value.',
    'required_if_accepted' => 'الحقل :attribute مطلوب عند قبول :other.',
    'required_unless' => 'الحقل :attribute مطلوب إلا إذا كانت :other تساوي :values.',
    'required_with' => 'الحقل :attribute مطلوب عند وجود :values.',
    'required_with_all' => 'الحقل :attribute مطلوب عند وجود :values جميعاً.',
    'required_without' => 'الحقل :attribute مطلوب عند عدم وجود :values.',
    'required_without_all' => 'الحقل :attribute مطلوب عند عدم وجود أي من :values.',
    'same' => 'يجب أن يتطابق :attribute مع :other.',
    'size' => [
        'array' => 'يجب أن يحتوي :attribute على :size عنصر.',
        'file' => 'يجب أن يكون :attribute :size كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute :size.',
        'string' => 'يجب أن يحتوي :attribute على :size حروف.',
    ],
    'starts_with' => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values.',
    'string' => 'يجب أن يكون :attribute نصاً.',
    'timezone' => 'يجب أن يكون :attribute نطاقاً زمنياً صالحاً.',
    'unique' => 'قيمة :attribute موجودة مسبقاً.',
    'uploaded' => 'فشل في تحميل :attribute.',
    'uppercase' => 'يجب أن يكون :attribute بأحرف كبيرة.',
    'url' => 'يجب أن يكون :attribute عنوان URL صالحاً.',
    'ulid' => 'يجب أن يكون :attribute ULID صالحاً.',
    'uuid' => 'يجب أن يكون :attribute UUID صالحاً.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | هنا يمكنك تحديد رسائل التحقق المخصصة للسمات باستخدام
    | اصطلاح "attribute.rule" لتسمية الأسطر. يتيح لك ذلك
    | تحديد رسالة لغة مخصصة لقاعدة سمة معينة.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'رسالة مخصصة',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | تُستخدم الأسطر التالية لتبديل العنصر النائب للسمة بشيء
    | أكثر ودية للقارئ مثل "البريد الإلكتروني" بدلاً من
    | "email". يساعد هذا على جعل الرسالة أكثر وضوحاً.
    |
    */

    'attributes' => [],
];
