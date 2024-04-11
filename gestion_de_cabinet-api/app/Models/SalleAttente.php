<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalleAttente extends Model
{
    use HasFactory;
    protected $fillable = ['rendez_vous_id', 'heure_arrivee','heure_controle'];

    public function rendezvous()
    {
        return $this->belongsTo(RendezVous::class);
    }
}
