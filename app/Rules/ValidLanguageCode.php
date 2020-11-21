<?php

namespace App\Rules;

use Exception;
use Illuminate\Contracts\Validation\Rule;
use WhiteCube\Lingua\Service;

class ValidLanguageCode implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            Service::createFromW3C($value);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is not a valid BCP47 language code.';
    }
}
