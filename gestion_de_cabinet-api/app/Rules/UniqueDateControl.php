<?php

namespace App\Rules;

use App\Models\RendezVous;
use App\Models\SalleAttente;
use Illuminate\Contracts\Validation\Rule;

class UniqueDateControl implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if a record with the same date_heure exists
        return !SalleAttente::where('heure_controle', $value)->exists();
    }

    public function message()
    {
        return 'la  date et heure est déja exist.';
    }
}
