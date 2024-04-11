<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;
    protected $fillable = ['nom','prenom','cin','date_heure', 'mutuelles', 'statut', 'type_patient'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
