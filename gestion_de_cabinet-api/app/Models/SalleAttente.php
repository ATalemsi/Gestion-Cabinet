<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalleAttente extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['rendez_vouses_id', 'heure_arrivee','heure_controle'];

    public function rendezvous()
    {
        return $this->belongsTo(RendezVous::class);
    }
}
