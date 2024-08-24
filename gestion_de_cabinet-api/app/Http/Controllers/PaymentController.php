<?php

namespace App\Http\Controllers;

use App\Models\InvoicePayment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use PDOException;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = InvoicePayment::query()->join('rendez_vouses', 'invoice_payments.rendez_vouses_id', '=', 'rendez_vouses.id');

        if ($request->has('cin')) {
            $query->where('rendez_vouses.cin', 'like', '%' . $request->input('cin') . '%');
        }
        $payments = $query->select('rendez_vouses.*', 'invoice_payments.*')->get();

        return response()->json(['payments' => $payments]);
    }
    public function create(Request $request)
    {
        try {
            $request->validate([
                'amount' => 'required|numeric|min:0',
                'payment_status' => 'required|in:pending,paid',
                'rendez_vouses_id' => 'required|exists:rendez_vouses,id',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
        try {
            // Create a new invoice or payment record
            $invoiceOrPayment = new InvoicePayment();
            $invoiceOrPayment->amount = $request->amount;
            $invoiceOrPayment->payment_status = $request->payment_status;
            $invoiceOrPayment->rendez_vouses_id = $request->rendez_vouses_id;
            $invoiceOrPayment->save();

            return response()->json(['message' => 'Invoice/payment updated successfully', 'data' => $invoiceOrPayment]);
        } catch (PDOException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function edit($id)
    {
        $payment = InvoicePayment::findOrFail($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        return response()->json(['payment' => $payment], 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'amount' => 'required|numeric|min:0',
                'payment_status' => 'required|in:pending,paid',
                // Do not validate 'rendez_vouses_id' if it's not present in the request
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }

        try {
            $invoiceOrPayment = InvoicePayment::findOrFail($id);

            // Update fields only if they are present in the request
            $invoiceOrPayment->amount = $request->amount;
            $invoiceOrPayment->payment_status = $request->payment_status;

            // Only update 'rendez_vouses_id' if it's present in the request
            if ($request->has('rendez_vouses_id')) {
                $invoiceOrPayment->rendez_vouses_id = $request->rendez_vouses_id;
            }

            $invoiceOrPayment->save();

            return response()->json([
                'message' => 'Invoice/payment updated successfully',
                'data' => $invoiceOrPayment
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deletePayment($id)
    {
        try {
            $invoicePayment = InvoicePayment::findOrFail($id);
            $invoicePayment->delete();
            return response()->json(['message' => 'Payment entry removed successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'InvoicePayment not found'], 404);
        } catch (PDOException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
