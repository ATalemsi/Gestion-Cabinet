<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom', 'prenom', 'email', 'telephone', 'antecedents', 'donnees_biographiques',
        'histoire_maladie', 'entretiens', 'diagnostic', 'traitement', 'evolution',
        'imagerie', 'bilan',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }
}
