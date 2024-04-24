<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use PDOException;
use Validator;

class RegisterController extends BaseController
{
    public function login(Request $request): JsonResponse
    {
        try {
            // Validate the request data
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            // Attempt to authenticate the user
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // Authentication successful, generate a token
                $user = Auth::user();
                $token = $user->createToken('MyApp')->plainTextToken;

                // Return the response with success message, token, and user information
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'token' => $token,
                    'user' => $user,
                    'role' => $user->role,
                ]);
            } else {

                return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
            }
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (PDOException $e) {
            return response()->json(['error' => 'Something went wrong with login' ,$e->getMessage()], 500);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            Auth::logout();
            return response()->json(['success' => true, 'message' => 'Logout successful']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
