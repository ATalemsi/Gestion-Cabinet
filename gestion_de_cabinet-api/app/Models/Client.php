<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nom', 'prenom', 'cin', 'telephone', 'antecedents', 'donnees_biographiques',
        'histoire_maladie', 'entretiens', 'diagnostic', 'traitement', 'evolution',
        'imagerie', 'bilan',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
