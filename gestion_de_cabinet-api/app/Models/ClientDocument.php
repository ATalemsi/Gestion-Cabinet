<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientDocument extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['client_id', 'nom_document', 'document'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function storedocument($document)
    {
        // Define the storage path and filename for the image
        $path = $document->store('document_patient', 'public');

        // Store the image path in the 'image' attribute of the itinerary
        $this->document = $path;

        // Save the changes to the itinerary
        $this->save();
    }
}
