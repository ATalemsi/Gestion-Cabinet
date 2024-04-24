<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoicePayment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['rendez_vouses_id', 'amount', 'payment_status'];

    public function rendezVous()
    {
        return $this->belongsTo(RendezVous::class, 'rendez_vouses_id');
    }
}
