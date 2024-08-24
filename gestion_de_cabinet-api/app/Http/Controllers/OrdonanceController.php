<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOrdonanceRequest;
use PDOException;
use App\Models\Ordonance;

class OrdonanceController extends Controller
{
    public function createOrdonance(StoreOrdonanceRequest $request)
    {
        try {
            $ordonance = Ordonance::create([
                'client_id' => $request->client_id,
                'medications' => json_encode($request->medications),
                'description' => $request->description,
            ]);

            return response()->json(['message' => 'Ordonance created successfully', 'ordonance' => $ordonance], 201);
        } catch (\PDOException $e) {
            \Log::error('PDOException occurred while creating ordonance: ' . $e->getMessage(), [
                'client_id' => $request->client_id,
                'medications' => $request->medications,
                'description' => $request->description,
            ]);
            return response()->json(['message' => 'Database error occurred', 'error' => $e->getMessage()], 500);
        } catch (\Exception $e) {

            \Log::error('Exception occurred while creating ordonance: ' . $e->getMessage(), [
                'client_id' => $request->client_id,
                'medications' => $request->medications,
                'description' => $request->description,
            ]);
            return response()->json(['message' => 'Failed to create ordonance', 'error' => $e->getMessage()], 500);
        }
    }

    public function fetchAllOrdonnances(Request $request)
    {
        try {
            $query = Ordonance::query()
                ->join('clients', 'ordonances.client_id', '=', 'clients.id');

            if ($request->has('cin') && $request->cin) {
                $query->where('clients.cin', 'like', '%' . $request->cin . '%');
            }

            $ordonnances = $query->select(
                'clients.*',
                'ordonances.*'
            )->get();

            return response()->json(['ordonnances' => $ordonnances], 200);
        } catch (\Exception $e) {
            \Log::error('Exception occurred while fetching ordonnances: ' . $e->getMessage(), [
                'cin' => $request->cin,
            ]);
            return response()->json(['message' => 'Failed to fetch ordonnances', 'error' => $e->getMessage()], 500);
        }
    }
    public function fetchOrdonanceById($id)
    {
        try {

            $ordonance = Ordonance::query()
                ->join('clients', 'ordonances.client_id', '=', 'clients.id')
                ->where('ordonances.id', $id)
                ->select('ordonances.*', 'clients.*')
                ->first();

            if (!$ordonance) {
                return response()->json(['message' => 'Ordonance not found'], 404);
            }

            return response()->json(['ordonance' => $ordonance], 200);
        } catch (\Exception $e) {
            \Log::error('Exception occurred while fetching ordonance by ID: ' . $e->getMessage(), [
                'id' => $id,
            ]);
            return response()->json(['message' => 'Failed to fetch ordonance', 'error' => $e->getMessage()], 500);
        }
    }
    public function deleteOrdonances($ordonanceId)
    {
        try {
            $orodonace = Ordonance::findOrFail($ordonanceId);
            $orodonace->delete();
            return response()->json(['message' => ' ordonance deleted successfully']);
        } catch (PDOException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
