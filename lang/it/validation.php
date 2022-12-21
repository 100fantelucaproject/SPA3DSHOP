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

    'accepted' => 'Il :attribute deve essere accettato.',
    'accepted_if' => 'Il :attribute deve essere accettato quando :other è :value.',
    'active_url' => 'Il :attribute non è un valido URL.',
    'after' => 'Il :attribute deve essere una data dopo :date.',
    'after_or_equal' => 'Il :attribute deve essere una data dopo o uguale a :date.',
    'alpha' => 'Il :attribute deve solo contenere lettere.',
    'alpha_dash' => 'Il :attribute deve solo contenere lettere, numeri, trattini e underscore.',
    'alpha_num' => 'Il :attribute deve solo contenere lettere e numeri.',
    'array' => 'Il :attribute deve essere un array.',
    'before' => 'Il :attribute deve essere una data prima  date.',
    'before_or_equal' => 'Il :attribute deve essere una data prima o ugule di :date.',
    'between' => [
        'array' => 'Il :attribute deve essere tra :min e :max valori.',
        'file' => 'Il :attribute deve essere tra :min e :max kilobytes.',
        'numeric' => 'Il :attribute deve essere tra :min e :max.',
        'string' => 'Il :attribute deve essere tra :min e :max caratteri.',
    ],
    'boolean' => 'Il :attribute campo deve essere vero falso.',
    'confirmed' => 'Il :attribute di conferma non corrisponde.',
    'current_password' => 'La password non è corretta.',
    'date' => 'Il :attribute non è una data valida.',
    'date_equals' => 'Il :attribute deve essere una data uguale a :date.',
    'date_format' => 'Il :attribute non combacia con il formato :format.',
    'declined' => 'Il :attribute deve essere rifiutato.',
    'declined_if' => 'Il :attribute deve essere rifiutato quando :other è :value.',
    'different' => 'Il :attribute e :other deve essere differente.',
    'digits' => 'Il :attribute deve essere :digits digits.',
    'digits_between' => 'Il :attribute deve essere tra :min e :max digits.',
    'dimensions' => 'Il :attribute ha una dimensione di immagine non valida.',
    'distinct' => 'Il :attribute campo ha un valore duplicato.',
    'doesnt_end_with' => 'Il :attribute non dovrebbe finire con uno dei following: :values.',
    'doesnt_start_with' => 'Il :attribute non dovrebbe iniziare  con uno dei following: :values.',
    'email' => 'Il :attribute deve essere un indirizzo email valido.',
    'ends_with' => 'Il :attribute deve finire con uno dei following: :values.',
    'enum' => 'Il selezionato :attribute non è valido.',
    'exists' => 'Il selezionato :attribute non è valido.',
    'file' => 'Il :attribute deve essere un file.',
    'filled' => 'Il :attribute campo deve avere un valore.',
    'gt' => [
        'array' => 'Il :attribute deve avere più di :value valori.',
        'file' => 'Il :attribute deve essere più grande di :value kilobytes.',
        'numeric' => 'Il :attribute deve essere più grande di :value.',
        'string' => 'Il :attribute deve essere più grande di :value caratteri.',
    ],
    'gte' => [
        'array' => 'Il :attribute must have :value items o più.',
        'file' => 'Il :attribute deve essere più grande o uguale di :value kilobytes.',
        'numeric' => 'Il :attribute deve essere più grande o uguale di :value.',
        'string' => 'Il :attribute deve essere più grande o uguale di :value caratteri.',
    ],
    'image' => 'Il :attribute deve essere un\'immagine.',
    'in' => 'Il selezionato :attribute non è valida.',
    'in_array' => 'Il :attribute non esiste in :other.',
    'integer' => 'Il :attribute deve essere un intero.',
    'ip' => 'Il :attribute deve essere un valido indirizzo IP.',
    'ipv4' => 'Il :attribute deve essere un valido indirizzo IPv4.',
    'ipv6' => 'Il :attribute deve essere un valido indirizzo IPv6.',
    'json' => 'Il :attribute deve essere un valido indirizzo IP JSON stringa.',
    'lt' => [
        'array' => 'Il :attribute deve avere meno :value valori.',
        'file' => 'Il :attribute deve essere meno di :value kilobytes.',
        'numeric' => 'Il :attribute deve essere meno di :value.',
        'string' => 'Il :attribute deve essere meno di :value caratteri.',
    ],
    'lte' => [
        'array' => 'Il :attribute must not have more than :value valroi.',
        'file' => 'Il :attribute deve essere meno o uguale di :value kilobytes.',
        'numeric' => 'Il :attribute deve essere meno o uguale di :value.',
        'string' => 'Il :attribute deve essere meno o uguale di :value caratteri.',
    ],
    'mac_address' => 'Il :attribute deve essere un indirizzo mac valido.',
    'max' => [
        'array' => 'Il :attribute non deve avere più di :max valori.',
        'file' => 'Il :attribute non deve essere più grande di :max kilobytes.',
        'numeric' => 'Il :attribute non deve essere più grande di :max.',
        'string' => 'Il :attribute non deve essere più grande di :max caratteri.',
    ],
    'max_digits' => 'Il :attributenon deve avere più di :max digits.',
    'mimes' => 'Il :attribute deve essere un file di tipo type: :values.',
    'mimetypes' => 'Il :attribute deve essere un file di tipo type: :values.',
    'min' => [
        'array' => 'Il :attribute deve avere almeno :min valori.',
        'file' => 'Il :attribute deve essere almeno :min kilobytes.',
        'numeric' => 'Il :attribute deve essere almeno :min.',
        'string' => 'Il :attribute deve essere almeno :min caratteri.',
    ],
    'min_digits' => 'Il :attribute deve avere almeno :min digits.',
    'multiple_of' => 'Il :attribute deve essere un multiplo di :value.',
    'not_in' => 'Il seleziuonato :attribute non è valido.',
    'not_regex' => 'Il :attribute formato non è valido.',
    'numeric' => 'Il :attribute deve essere un numero.',
    'password' => [
        'letters' => 'Il :attribute deve contenere almeno una lettera.',
        'mixed' => 'Il :attribute deve contenere almeno una lettera uppercase e una lettera lowercase.',
        'numbers' => 'Il :attribute deve contenere almeno un numero.',
        'symbols' => 'Il :attribute deve contenere almeno un simbolo.',
        'uncompromised' => 'Il dato :attribute è stato compromesso. Per favore provui con :attribute.',
    ],
    'present' => 'Il :attribute deve essere presente.',
    'prohibited' => 'Il :attribute è proibito.',
    'prohibited_if' => 'Il :attribute èproibityo quando :other è :value.',
    'prohibited_unless' => 'Il :attribute è proibito a meno che :other sia in :values.',
    'prohibits' => 'Il :attribute è proibito :other dall\'essere presente.',
    'regex' => 'Il :attribute è invalido.',
    'required' => 'Il :attribute è richiesto.',
    'required_array_keys' => 'Il :attribute deve contenere valori for: :values.',
    'required_if' => 'Il :attribute è richiesto quando :other è :value.',
    'required_if_accepted' => 'Il :attribute è richiesto quando :other è accepted.',
    'required_unless' => 'Il :attribute è richiesto unless :other è all\'interno :values.',
    'required_with' => 'Il :attribute è richiesto quando :values è present.',
    'required_with_all' => 'Il :attribute è richiesto quando :values sono present.',
    'required_without' => 'Il :attribute è richiesto quando :values non è present.',
    'required_without_all' => 'Il :attribute è richiesto quando none of :values sono present.',
    'same' => 'Il :attribute e :other deve coincidere.',
    'size' => [
        'array' => 'Il :attribute deve contenere :size valori.',
        'file' => 'Il :attribute deve essere :size kilobytes.',
        'numeric' => 'Il :attribute deve essere :size.',
        'string' => 'Il :attribute deve essere :size caratteri.',
    ],
    'starts_with' => 'Il :attribute deve iniziare con uno dei seguenti following: :values.',
    'string' => 'Il :attribute deve essere una stringa.',
    'timezone' => 'Il :attribute deve essere una timezone valida.',
    'unique' => 'Il :attribute è stata appena presa.',
    'uploaded' => 'Il :attribute fallimento nel cariacamento.',
    'url' => 'Il :attribute deve essere un valido URL.',
    'uuid' => 'Il :attribute deve essere un valido UUID.',

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
