<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\SalleAttente;
use App\Rules\AfterNowWithTime;
use App\Rules\CustomDateFormat;
use App\Rules\UniqueDateControl;
use App\Rules\UniqueDateHeure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PDOException;

class SecretaryController extends Controller
{
    public function index(Request $request)
    {
        $query = RendezVous::query();
        if ($request->has('cin')) {
            $query->where('cin', 'like', '%' . $request->input('cin') . '%');
        } else {

            $query->get();
        }

        $rendez_vous = $query->get();

        return response()->json(['rendez_vous' => $rendez_vous]);
    }

    public function getRendezVous()
    {
        $rendezvous= RendezVous::all();

        return response()->json(['rendez_vous' => $rendezvous]);

    }
    public function addRendezVous(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required|string',
                'prenom' => 'nullable|string',
                'cin' => 'nullable|string',
                'date_heure' => ['required', new CustomDateFormat, new UniqueDateControl,new AfterNowWithTime()], // Ensure the date_heure is after or equal to current date and time
                'mutuelles' => 'nullable|string',
                'statut' => 'nullable|in:nouveau,pris en charge,terminé,reporté',
                'type_patient' => 'required|in:nouveau,ancien,contrôle',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }

        try {
            // Create a new rendezvous
            $rendezvous = new RendezVous();
            $rendezvous->nom = $request->nom;
            $rendezvous->prenom = $request->prenom;
            $rendezvous->cin = $request->cin;
            $rendezvous->date_heure = $request->date_heure;
            $rendezvous->mutuelles = $request->mutuelles;
            $rendezvous->statut = $request->statut ?? 'nouveau';
            $rendezvous->type_patient = $request->type_patient;
            $rendezvous->save();

            // Return the newly created rendezvous
            return response()->json(['rendezvous' => $rendezvous]);
        } catch (PDOException $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }
    public function editRendezVous($id)
    {
        $rendez_vous = RendezVous::findOrFail($id);

        if (!$rendez_vous) {
            return response()->json(['message' => 'RendezVous not found'], 404);
        }

        return response()->json(['rendez_vous' => $rendez_vous], 200);
    }

    public function updateRendezVous(Request $request, $rendezvousId)
    {
        try {
            $request->validate([
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'cin' => 'required|string|unique:rendez_vouses,cin,' . $rendezvousId,
                'date_heure' => ['required', new CustomDateFormat, new UniqueDateControl,new AfterNowWithTime()],
                'mutuelles' => 'required|string',
                'statut' => 'required|in:nouveau,pris en charge,terminé,reporté',
                'type_patient' => 'required|in:nouveau,ancien,contrôle',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        try {
            // Find the rendezvous by ID
            $rendezvous = RendezVous::findOrFail($rendezvousId);

            // Update the rendezvous details
            $rendezvous->nom = $request->nom;
            $rendezvous->prenom = $request->prenom;
            $rendezvous->cin = $request->cin;
            $rendezvous->date_heure = $request->date_heure;
            $rendezvous->mutuelles = $request->mutuelles;
            $rendezvous->statut = $request->statut ?? 'nouveau';
            $rendezvous->type_patient = $request->type_patient;
            $rendezvous->save();

            // Return the updated rendezvous
            return response()->json(['rendezvous' => $rendezvous]);
        } catch (PDOException $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }

    public function softDelete($rendezId)
    {
        $rendez_vous = RendezVous::find($rendezId);

        if (!$rendez_vous) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        $rendez_vous->delete();

        return response()->json(['message' => 'Client soft deleted successfully']);
    }


    public function getSalleAttente(Request $request)
    {
        $query = SalleAttente::query()->join('rendez_vouses', 'salle_attentes.rendez_vouses_id', '=', 'rendez_vouses.id');

        if ($request->has('cin')) {
            $query->where('rendez_vouses.cin', 'like', '%' . $request->input('cin') . '%');
        }

        $salleAttente = $query->select( 'rendez_vouses.*','salle_attentes.*')->get();

        return response()->json(['salle_attente' => $salleAttente]);
    }

    public function addToWaitingRoom(Request $request)
    {
        try {
            $request->validate([
                'rendez_vouses_id' => 'required|exists:rendez_vouses,id',
                'heure_arrivee' => 'required|date_format:H:i',
                'heure_controle' => 'required|date_format:H:i'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }

        try {

            $waitingRoomEntry = new SalleAttente();
            $waitingRoomEntry->rendez_vouses_id = $request->rendez_vouses_id;
            $waitingRoomEntry->heure_arrivee = $request->heure_arrivee;
            $waitingRoomEntry->heure_controle = $request->heure_controle;
            $waitingRoomEntry->save();

            return response()->json(['enter dans la salle attente' => $waitingRoomEntry]);
        } catch (PDOException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function editSalleAttente($id)
    {
        $salle_attente = SalleAttente::findOrFail($id);

        if (!$salle_attente) {
            return response()->json(['message' => 'Salle_attente Patient  not found'], 404);
        }

        return response()->json(['salle_attente' => $salle_attente], 200);
    }

    public function updateWaitingRoomEntry(Request $request, $entryId)
    {
        try {
            $request->validate([
                'rendez_vouses_id' => 'required|exists:rendez_vouses,id,' .$entryId,
                'heure_arrivee' => 'required|date_format:H:i',
                'heure_controle' => 'nullable|date_format:H:i',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
        try {

            $waitingRoomEntry = SalleAttente::findOrFail($entryId);

            $waitingRoomEntry->rendez_vouses_id = $request->rendez_vouses_id;
            $waitingRoomEntry->heure_arrivee = $request->heure_arrivee;
            $waitingRoomEntry->heure_controle = $request->heure_controle;
            $waitingRoomEntry->save();


            return response()->json(['waiting_room_entry' => $waitingRoomEntry]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function removeWaitingRoomEntry($entryId)
    {
        try {
            SalleAttente::findOrFail($entryId)->delete();
            return response()->json(['message' => 'Waiting room entry removed successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
