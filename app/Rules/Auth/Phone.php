<?php

namespace App\Rules\Auth;

use Illuminate\Contracts\Validation\Rule;

class Phone implements Rule
{

    /**
     * @param string $attribute
     * @param mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return preg_match('/^\d{12}$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Телефон номер неправильный';//trans('validation.phone_error');
    }
}
