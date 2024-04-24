<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AfterNowWithTime implements Rule
{
    public function passes($attribute, $value)
    {
        // Convert the provided value to a DateTime object
        $dateTime = \DateTime::createFromFormat('Y-m-d\TH:i', $value);

        // Get the current date and time
        $now = now();

        // Compare the provided date and time with the current date and time
        return $dateTime >= $now;
    }

    public function message()
    {
        return 'Le champ :attribute doit être une date et une heure après ou égale à la date et l\'heure actuelles.';
    }
}
