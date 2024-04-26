<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientDocument;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use PDOException;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $query = Client::query();
        if ($request->has('cin')) {
            $query->where('cin', 'like', '%' . $request->input('cin') . '%');
        } else {

            $query->get();
        }

        $clients = $query->get();

        return response()->json(['clients' => $clients]);
    }
    public function createClient(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required|string',
                'prenom' => 'nullable|string',
                'cin' => 'nullable|string|unique:clients,cin',
                'telephone' => 'nullable|string',
                'antecedents' => 'nullable|string',
                'donnees_biographiques' => 'nullable|string',
                'histoire_maladie' => 'nullable|string',
                'entretiens' => 'nullable|string',
                'diagnostic' => 'nullable|string',
                'traitement' => 'nullable|string',
                'evolution' => 'nullable|string',
                'imagerie' => 'nullable|string',
                'bilan' => 'nullable|string',
            ]);

            // Create a new client record
            $client = new Client();
            $client->nom = $request->nom;
            $client->prenom = $request->prenom;
            $client->cin = $request->cin;
            $client->telephone = $request->telephone;
            $client->antecedents = $request->antecedents;
            $client->donnees_biographiques = $request->donnees_biographiques;
            $client->histoire_maladie = $request->histoire_maladie;
            $client->entretiens = $request->entretiens;
            $client->diagnostic = $request->diagnostic;
            $client->traitement = $request->traitement;
            $client->evolution = $request->evolution;
            $client->imagerie = $request->imagerie;
            $client->bilan = $request->bilan;
            $client->save();

            // Return the newly created client
            return response()->json(['message' => 'client created successfully', 'data' => $client],201);
        } catch (\PDOException $e) {
            // Log the exception
            \Log::error($e);
            // Return an error response
            return response()->json(['error' => 'Database error occurred.'], 500);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function editClient($id)
    {
        $client = Client::findOrFail($id);

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        return response()->json(['clients' => $client], 200);
    }

    public function updateClient(Request $request, $clientId)
    {
        try {
            $request->validate([
                'nom' => 'required|string',
                'prenom' => 'nullable|string',
                'cin' => 'nullable|string|unique:clients,cin',
                'telephone' => 'nullable|string',
                'antecedents' => 'nullable|string',
                'donnees_biographiques' => 'nullable|string',
                'histoire_maladie' => 'nullable|string',
                'entretiens' => 'nullable|string',
                'diagnostic' => 'nullable|string',
                'traitement' => 'nullable|string',
                'evolution' => 'nullable|string',
                'imagerie' => 'nullable|string',
                'bilan' => 'nullable|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }


        $client = Client::findOrFail($clientId);

        $client->nom = $request->nom;
        $client->prenom = $request->prenom;
        $client->cin = $request->cin;
        $client->telephone = $request->telephone;
        $client->antecedents = $request->antecedents;
        $client->donnees_biographiques = $request->donnees_biographiques;
        $client->histoire_maladie = $request->histoire_maladie;
        $client->entretiens = $request->entretiens;
        $client->diagnostic = $request->diagnostic;
        $client->traitement = $request->traitement;
        $client->evolution = $request->evolution;
        $client->imagerie = $request->imagerie;
        $client->bilan = $request->bilan;
        $client->save();

        return response()->json(['client' => $client]);
    }

    public function softDelete($patientId)
    {
        $client = Client::find($patientId);

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        $client->delete();

        return response()->json(['message' => 'Client soft deleted successfully']);
    }
    public function uploadDocument(Request $request, $clientId)
    {
        try {
            $request->validate([
                'document' => 'required|file|max:2048',
                'nom_document' => 'required|string',

            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }

        try {

           $client = Client::findOrFail($clientId);
            $clientDocument = new ClientDocument();
            $clientDocument->client_id = $client->id;
            $clientDocument->nom_document = $request->nom_document;
        if ($request->hasFile('document')) {
            $clientDocument->storedocument($request->file('document'));
        }
            $clientDocument->save();
            return response()->json(['document upload succesuflly' => $clientDocument]);
        } catch (PDOException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getDocumentsPatient($clientId)
    {
        try {
            // Assuming you're using Laravel's Eloquent ORM
            $documents = ClientDocument::where('client_id', $clientId)->get();

            // Return the documents as JSON response
            return response()->json(['documents' => $documents]);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function deleteDocument($documentId)
    {
        try {
            $document = ClientDocument::findOrFail($documentId);
            $document->delete();
            return response()->json(['message' => ' document deleted successfully']);
        } catch (PDOException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
