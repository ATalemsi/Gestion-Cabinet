<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientReport;
use App\Models\Report;
use App\Models\SalleAttente;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use PDOException;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%' );
        } else {

            $query->get();
        }
        $secretaries = $query->where('role','=','secretary')->get();

        return response()->json(['secretaries' => $secretaries]);
    }
    public function getToday()
    {
        try{
            $currentDate = Carbon::now()->toDateString();

            $salleAttenteMembers = SalleAttente::whereHas('rendezvous', function ($query) use ($currentDate) {
                $query->whereDate('date_heure', $currentDate);
            })->get();
            return response()->json(['salleAttenteMembers' => $salleAttenteMembers]);
        }catch (PDOException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }
    public function getRapport(Request $request)
    {
        $query = ClientReport::query()->join('clients', 'client_reports.client_id', '=', 'clients.id');

        if ($request->has('cin')) {
            $query->where('clients.cin', 'like', '%' . $request->input('cin') . '%');
        }

        $reports = $query->select( 'clients.*','client_reports.*')->get();

        return response()->json(['rapports' => $reports]);
    }
    public function addManualReport(Request $request)
    {
        try {
            $request->validate([
                'client_id' => 'required|exists:clients,id',
                'type' => 'required|in:medical_report,medical_certificate,ordonnances',
                'content_report' => 'required',
            ]);

            $clientReport = new ClientReport();
            $clientReport->client_id = $request->client_id;
            $clientReport->content_report = $request->content_report;
            $clientReport->type = $request->type;

            $clientReport->save();

            return response()->json(['message' => 'Report added successfully', 'report' => $clientReport]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (PDOException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function editRapport( $rapportId)
    {
        $rapport = ClientReport::findOrFail($rapportId);

        if (!$rapport) {
            return response()->json(['message' => 'Rapport Patient  not found'], 404);
        }

        return response()->json(['rapport' => $rapport], 200);
    }

    public function updateRapport($rapportId,Request $request)
    {
        try {
            $request->validate([
                'type' => 'required|in:medical_report,medical_certificate,ordonnances',
                'content_report' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
        try {

            $rapport = ClientReport::findOrFail($rapportId);
            $rapport->type = $request->type;
            $rapport->content_report = $request->content_report;
            $rapport->save();
            return response()->json(['message' => 'rapport updated successfully', 'rapport' => $rapport]);
        } catch (PDOException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function deleteRapport($rapportId)
    {
        try {
            $rapport = ClientReport::findOrFail($rapportId);
            $rapport->delete();
            return response()->json(['message' => 'Secretary deleted successfully']);
        } catch (PDOException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function printReport($reportId)
    {
        // Find the report by ID
        $report = ClientReport::findOrFail($reportId);

        // Assuming your report is HTML content
        $htmlContent = $report->content;

        // Use the PDF facade to generate PDF from HTML content
        $pdf = PDF::loadHTML($htmlContent);

        // Set paper size and orientation if needed
         $pdf->setPaper('A4', 'portrait');

        // Stream the PDF directly to the browser
        return $pdf->stream();
    }
    public function addSecretary(Request $request)
    {
        try {
          $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
           ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }

     try {
        $secretary = new User();
        $secretary->nom = $request->nom;
        $secretary->prenom = $request->prenom;
        $secretary->email = $request->email;
        $secretary->password = bcrypt($request->password);
        $secretary->save();

        return response()->json(['message' => 'Secretary added successfully', 'secretary' => $secretary]);
     } catch (PDOException $e) {
         return response()->json(['error' => $e->getMessage()], 500);
     }
    }
    public function editSecretary( $secretaryId)
    {
        $secretary = User::findOrFail($secretaryId);

        if (!$secretary) {
            return response()->json(['message' => 'Secretaire Patient  not found'], 404);
        }

        return response()->json(['secretaire' => $secretary], 200);
    }


    public function updateSecretary(Request $request, $secretaryId)
    {
        try {
            $request->validate([
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $secretaryId,
                'password' => 'nullable|min:8'

            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }

      try {

        // Find the secretary by ID
        $secretary = User::findOrFail($secretaryId);
        if ($request->password){
         $secretary->password = bcrypt($request->password);
        }
        $secretary->nom = $request->nom;
        $secretary->prenom = $request->prenom;
        $secretary->email = $request->email;
        $secretary->save();

        return response()->json(['message' => 'Secretary updated successfully', 'secretary' => $secretary]);
      } catch (PDOException $e) {
          return response()->json(['error' => $e->getMessage()], 500);
      }
    }

    public function deleteSecretary($secretaryId)
    {
      try {
        $secretary = User::findOrFail($secretaryId);
        $secretary->delete();
      return response()->json(['message' => 'Secretary deleted successfully']);
        } catch (PDOException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function clientInfo($clientId)
    {
        try {
            $client= Client::findOrFail($clientId);
            return response()->json(['client' => $client]);
        } catch (PDOException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
