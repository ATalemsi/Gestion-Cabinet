<?php

namespace App\Rules;

use App\Models\RendezVous;
use Illuminate\Contracts\Validation\Rule;

class UniqueDateHeure implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if a record with the same date_heure exists
        return !RendezVous::where('date_heure', $value)->exists();
    }

    public function message()
    {
        return 'la  date et heure est déja exist.';
    }
}
