<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RendezVous extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['nom','prenom','cin','date_heure', 'mutuelles', 'statut', 'type_patient'];


    public function salleAttente()
    {
        return $this->hasOne(SalleAttente::class);
    }
    public function invoicePayments()
    {
        return $this->hasMany(InvoicePayment::class);
    }
}
