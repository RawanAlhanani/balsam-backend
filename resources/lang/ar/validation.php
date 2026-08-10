<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used
    | by the validator class. Some of these rules have multiple versions
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted' => 'يجب قبول :attribute.',
    'accepted_if' => 'يجب قبول :attribute عندما يكون :other هو :value.',
    'active_url' => ':attribute ليس رابطًا صحيحًا.',
    'after' => 'يجب أن يكون :attribute تاريخًا بعد :date.',
    'after_or_equal' => 'يجب أن يكون :attribute تاريخًا بعد أو يساوي :date.',
    'alpha' => 'يجب أن يحتوي :attribute على أحرف فقط.',
    'alpha_dash' => 'يجب أن يحتوي :attribute على أحرف وأرقام وشرطات فقط.',
    'alpha_num' => 'يجب أن يحتوي :attribute على أحرف وأرقام فقط.',
    'array' => 'يجب أن يكون :attribute قائمة (array).',
    'before' => 'يجب أن يكون :attribute تاريخًا قبل :date.',
    'before_or_equal' => 'يجب أن يكون :attribute تاريخًا قبل أو يساوي :date.',
    'between' => [
        'array' => 'يجب أن يحتوي :attribute على ما بين :min و :max عنصرًا.',
        'file' => 'يجب أن يكون حجم :attribute بين :min و :max كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'string' => 'يجب أن يكون طول :attribute بين :min و :max حرفًا.',
    ],
    'boolean' => 'يجب أن تكون قيمة :attribute صحيحة أو خاطئة.',
    'confirmed' => 'تأكيد :attribute غير متطابق.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => ':attribute ليس تاريخًا صحيحًا.',
    'date_equals' => 'يجب أن يكون :attribute تاريخًا مساويًا لـ :date.',
    'date_format' => ':attribute لا يطابق الصيغة :format.',
    'different' => 'يجب أن يكون :attribute و :other مختلفين.',
    'digits' => 'يجب أن يتكون :attribute من :digits أرقام.',
    'digits_between' => 'يجب أن يتكون :attribute من عدد أرقام بين :min و :max.',
    'dimensions' => 'أبعاد صورة :attribute غير صحيحة.',
    'distinct' => 'يحتوي حقل :attribute على قيمة مكررة.',
    'email' => 'يجب أن يكون :attribute بريدًا إلكترونيًا صحيحًا.',
    'ends_with' => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values.',
    'exists' => ':attribute المحدد غير موجود.',
    'file' => 'يجب أن يكون :attribute ملفًا.',
    'filled' => 'حقل :attribute مطلوب.',
    'gt' => [
        'array' => 'يجب أن يحتوي :attribute على أكثر من :value عنصر.',
        'file' => 'يجب أن يكون حجم :attribute أكبر من :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :value.',
        'string' => 'يجب أن يكون طول :attribute أكبر من :value حرفًا.',
    ],
    'gte' => [
        'array' => 'يجب أن يحتوي :attribute على :value عنصر أو أكثر.',
        'file' => 'يجب أن يكون حجم :attribute أكبر من أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من أو تساوي :value.',
        'string' => 'يجب أن يكون طول :attribute أكبر من أو يساوي :value حرفًا.',
    ],
    'image' => 'يجب أن يكون :attribute صورة.',
    'in' => ':attribute المحدد غير صحيح.',
    'in_array' => 'حقل :attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون :attribute رقمًا صحيحًا.',
    'ip' => 'يجب أن يكون :attribute عنوان IP صحيحًا.',
    'ipv4' => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
    'ipv6' => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
    'json' => 'يجب أن يكون :attribute نص JSON صحيحًا.',
    'lt' => [
        'array' => 'يجب أن يحتوي :attribute على أقل من :value عنصر.',
        'file' => 'يجب أن يكون حجم :attribute أقل من :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أقل من :value.',
        'string' => 'يجب أن يكون طول :attribute أقل من :value حرفًا.',
    ],
    'lte' => [
        'array' => 'يجب ألا يحتوي :attribute على أكثر من :value عنصر.',
        'file' => 'يجب أن يكون حجم :attribute أقل من أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أقل من أو تساوي :value.',
        'string' => 'يجب أن يكون طول :attribute أقل من أو يساوي :value حرفًا.',
    ],
    'max' => [
        'array' => 'يجب ألا يحتوي :attribute على أكثر من :max عنصر.',
        'file' => 'يجب ألا يتجاوز حجم :attribute :max كيلوبايت.',
        'numeric' => 'يجب ألا تكون قيمة :attribute أكبر من :max.',
        'string' => 'يجب ألا يتجاوز طول :attribute :max حرفًا.',
    ],
    'mimes' => 'يجب أن يكون :attribute ملفًا من نوع: :values.',
    'mimetypes' => 'يجب أن يكون :attribute ملفًا من نوع: :values.',
    'min' => [
        'array' => 'يجب أن يحتوي :attribute على :min عنصر على الأقل.',
        'file' => 'يجب ألا يقل حجم :attribute عن :min كيلوبايت.',
        'numeric' => 'يجب ألا تقل قيمة :attribute عن :min.',
        'string' => 'يجب ألا يقل طول :attribute عن :min حرفًا.',
    ],
    'multiple_of' => 'يجب أن يكون :attribute من مضاعفات :value.',
    'not_in' => ':attribute المحدد غير صحيح.',
    'not_regex' => 'صيغة :attribute غير صحيحة.',
    'numeric' => 'يجب أن تكون قيمة :attribute رقمًا.',
    'password' => 'كلمة المرور غير صحيحة.',
    'present' => 'يجب أن يكون حقل :attribute موجودًا.',
    'regex' => 'صيغة :attribute غير صحيحة.',
    'required' => 'حقل :attribute مطلوب.',
    'required_if' => 'حقل :attribute مطلوب عندما يكون :other هو :value.',
    'required_unless' => 'حقل :attribute مطلوب إلا إذا كان :other ضمن :values.',
    'required_with' => 'حقل :attribute مطلوب عند وجود :values.',
    'required_with_all' => 'حقل :attribute مطلوب عند وجود :values.',
    'required_without' => 'حقل :attribute مطلوب عند عدم وجود :values.',
    'required_without_all' => 'حقل :attribute مطلوب عند عدم وجود أي من :values.',
    'same' => 'يجب أن يتطابق :attribute مع :other.',
    'size' => [
        'array' => 'يجب أن يحتوي :attribute على :size عنصر.',
        'file' => 'يجب أن يكون حجم :attribute :size كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute :size.',
        'string' => 'يجب أن يكون طول :attribute :size حرفًا.',
    ],
    'starts_with' => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values.',
    'string' => 'يجب أن يكون :attribute نصًا.',
    'timezone' => 'يجب أن يكون :attribute منطقة زمنية صحيحة.',
    'unique' => ':attribute مستخدم من قبل.',
    'uploaded' => 'فشل رفع :attribute.',
    'url' => 'صيغة :attribute غير صحيحة.',
    'uuid' => 'يجب أن يكون :attribute معرف UUID صحيحًا.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | Arabic labels for the field names used across the app's forms, so
    | messages read as "حقل البريد الإلكتروني مطلوب." instead of falling
    | back to the raw French/English column name.
    |
    */

    'attributes' => [
        'login' => 'اسم الدخول',
        'mdp' => 'كلمة المرور',
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'role' => 'الصلاحية',
        'nom_tuteur' => 'الاسم الشخصي لولي الأمر',
        'prenom_tuteur' => 'الاسم العائلي لولي الأمر',
        'email_tuteur' => 'البريد الإلكتروني لولي الأمر',
        'nom_utilisateur' => 'اسم المستخدم',
        'mot_de_pass' => 'كلمة المرور',
        'telephon' => 'رقم الهاتف',
        'telephone' => 'رقم الهاتف',
        'whatsapp' => 'رقم الواتساب',
        'region_id' => 'المنطقة',
        'adresse' => 'العنوان',
        'CIN' => 'رقم البطاقة الوطنية',
        'cin' => 'رقم البطاقة الوطنية',
        'sexeEnfant' => 'جنس الطفل',
        'statut' => 'حالة الطفل',
        'parole' => 'القدرة على الكلام',
        'avs' => 'المرافق',
        'etude' => 'الدراسة',
        'type_Tuteur' => 'العلاقة بالطفل',
        'formation' => 'التكوين في التوحد',
        'nom_enfant' => 'الاسم الشخصي للطفل',
        'prenom_enfant' => 'الاسم العائلي للطفل',
        'date_naissance' => 'تاريخ الازدياد',
        'photo' => 'الصورة',
        'professional_field' => 'المجال المهني',
        'interests' => 'الاهتمامات',
        'refresh_token' => 'رمز التحديث',
        'prenom' => 'الاسم الشخصي',
        'nom' => 'الاسم العائلي',
        'specialite' => 'التخصص',
        'etablissement' => 'المؤسسة',
        'date_debut' => 'تاريخ البداية',
        'date_fin' => 'تاريخ النهاية',
        'cv' => 'السيرة الذاتية',
        'niveau_etude' => 'المستوى الدراسي',
        'titre' => 'العنوان',
        'type_activite_id' => 'نوع النشاط',
        'date_activite' => 'تاريخ النشاط',
        'description' => 'الوصف',
        'description_json' => 'الوصف',
        'image_activite' => 'صورة النشاط',
        'image_info' => 'صورة الخبر',
        'nomPartenaire' => 'اسم الشريك',
        'imagePartenaire' => 'صورة الشريك',
        'image' => 'الصورة',
        'type' => 'النوع',
        'nomActivite' => 'اسم نوع النشاط',
        'nom_region' => 'اسم المنطقة',
        'date' => 'التاريخ',
        'location' => 'المكان',
        'activity_type' => 'نوع النشاط',
        'beneficiaries' => 'المستفيدون',
        'moderator' => 'المسير',
        'presentation_title' => 'عنوان العرض',
        'start_time' => 'وقت البداية',
        'end_time' => 'وقت النهاية',
        'summary' => 'الملخص',
        'attendees' => 'الحاضرون',
        'absentees' => 'الغائبون',
        'agenda' => 'جدول الأعمال',
        'discussions' => 'المناقشات',
        'decisions' => 'القرارات',
        'next_meeting_date' => 'تاريخ الاجتماع القادم',
        'category' => 'الفئة',
        'amount' => 'المبلغ',
        'tuteur_id' => 'ولي الأمر',
        'enfant_id' => 'الطفل',
        'phone' => 'الهاتف',
        'facebook_url' => 'رابط فيسبوك',
        'instagram_url' => 'رابط انستغرام',
        'subject' => 'الموضوع',
        'message' => 'الرسالة',
    ],

];
