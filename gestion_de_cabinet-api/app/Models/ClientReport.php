<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientReport extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['type', 'content', 'client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
