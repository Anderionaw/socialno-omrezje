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

    'accepted'             => 'Polje :attribute mora biti potrjeno.',
    'active_url'           => 'Polje :attribute is not a valid URL.',
    'after'                => 'Polje :attribute must be a date after :date.',
    'alpha'                => 'Polje :attribute may only contain letters.',
    'alpha_dash'           => 'Polje :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'Polje :attribute may only contain letters and numbers.',
    'array'                => 'Polje :attribute must be an array.',
    'before'               => 'Polje :attribute must be a date before :date.',
    'between'              => [
        'numeric' => 'Polje :attribute must be between :min and :max.',
        'file'    => 'Polje :attribute must be between :min and :max kilobytes.',
        'string'  => 'Polje :attribute must be between :min and :max characters.',
        'array'   => 'Polje :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'Polje :attribute field must be true or false.',
    'confirmed'            => 'Polje :attribute se ne ujema.',
    'date'                 => 'Polje :attribute is not a valid date.',
    'date_format'          => 'Polje :attribute does not match the format :format.',
    'different'            => 'Polje :attribute and :other must be different.',
    'digits'               => 'Polje :attribute must be :digits digits.',
    'digits_between'       => 'Polje :attribute mora biti med :min in :max znakov.',
    'email'                => 'Polje :attribute mora biti pravilen email naslov.',
    'exists'               => 'Polje selected :attribute is invalid.',
    'filled'               => 'Polje :attribute field is required.',
    'image'                => 'Polje :attribute must be an image.',
    'in'                   => 'Polje selected :attribute is invalid.',
    'integer'              => 'Polje :attribute must be an integer.',
    'ip'                   => 'Polje :attribute must be a valid IP address.',
    'json'                 => 'Polje :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'Polje :attribute ne sme biti večje kot :max.',
        'file'    => 'Polje :attribute ne sme biti večje kot :max kilobajtov.',
        'string'  => 'Polje :attribute ne sme vsebovati več kot :max znakov.',
        'array'   => 'Polje :attribute ne sme vsebovati več kot :max predmetov.',
    ],
    'mimes'                => 'Tip polja :attribute mora biti v rangu: :values.',
    'min'                  => [
        'numeric' => 'Polje :attribute mora biti večje kot :min.',
        'file'    => 'Polje :attribute mora biti minimalno velikosti :min kilobajtov.',
        'string'  => 'Polje :attribute mora vsebovati najmanj :min znakov.',
        'array'   => 'Polje :attribute mora vsebovati najmanj :min predmetov.',
    ],
    'not_in'               => 'Izbrano polje :attribute je napačno.',
    'numeric'              => 'Polje :attribute mora biti število.',
    'regex'                => 'Polje :attribute je napačno.',
    'required'             => 'Polje :attribute je obvezno.',
    'required_if'          => 'Polje :attribute je obvezno razen kadar je :other enak :value.',
    'required_unless'      => 'Polje :attribute je obvezno razen kadar je :other prisoten v :values.',
    'required_with'        => 'Polje :attribute je obvezno kadar so :values prisotna.',
    'required_with_all'    => 'Polje :attribute je obvezno kadar so vsa :values prisotna.',
    'required_without'     => 'Polje :attribute je obvezno kadar :values niso prisotna.',
    'required_without_all' => 'Polje :attribute je obvezno kadar nobeno od :values ni prisotno.',
    'same'                 => 'Polji :attribute in :other se morata ujemati.',
    'size'                 => [
        'numeric' => 'Polje :attribute mora biti :size.',
        'file'    => 'Polje :attribute mora biti :size kilobajtov.',
        'string'  => 'Polje :attribute mora biti :size znakov.',
        'array'   => 'Polje :attribute mora vsebovati :size znakov.',
    ],
    'string'               => 'Polje :attribute mora biti besedni niz.',
    'timezone'             => 'Polje :attribute mora biti pravo območje.',
    'unique'               => 'Polje :attribute je že zasedeno.',
    'url'                  => 'Polje :attribute je napačno.',

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

    'attributes' => [
        
        'name' => 'Ime',
        'surname' => 'Priimek',
		'email' => 'Email',
		'username' => 'Uporabniško ime',
		'password' => 'Geslo',
		'password_confirmation' => 'Potrditev gesla',
		'role_id' => 'Skupina',
		'slug' => 'Slug',
		'level' => 'Level',
        'title' => 'Naziv',
        'short_title' => 'Kratek naziv',
        'address' => 'Naslov',
        'zip' => 'Poštna številka',
        'city' => 'Pošta',
        'tax_number' => 'Davčna številka',
        'invoice_number' => 'Številka računa',
        'invoice_date' => 'Datum računa',
        'description' => 'Opis',
        'quantity' => 'Količina',
        'ammount' => 'Znesek',
        'role' => 'Uporabniški nivo',
        'permission' => 'Pravica',
        'gender' => 'Spol',
        'app_status_tag' => 'Oznaka',
        'status' => 'Status',
        'entry_number' => 'Evidenčna številka',
        'postmail_id' => 'Pošta',
        'sku' => 'Evidenčna številka',
        'birth_date' => 'Rojstni datum',
        'gender_id' => 'Spol',
        'code' => 'Šifra',
        'zone_id' => 'Območje',
        'society_id' => 'Društvo',
        'label' => 'Oznaka',
        'date' => 'Datum',
        'applicant_id' => 'Prijavitelj',
        'brand' => 'Znamka',
        'commission_id' => 'Komisija',
        'vat_number' => 'Davčna številka',
        'emso' => 'EMŠO',
        'commission_name' => 'Oznaka',
        'program_date' => 'Datum',
        'year_id' => 'Šolsko leto',







        //'' => '',



    ],

];
