<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{

    public function submitEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'username' => 'required|string',
        ]);

        try {
            $path = 'https://api-psblue.agatedev.net/api/submit-email';
            $response = Http::post($path, $validated);
            Log::info('External API called', [
                'endpoint' => $path,
                'payload' => $validated,
                'status' => $response->status(),
                'response' => $response->json(),
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'External API failed.',
                    'response' => $response->body(),
                ], $response->status());
            }

            $data = $response->json()['data'] ?? $response->json();
        } catch (\Exception $e) {
            Log::error('External API call failed', ['message' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage(),
            ], 500);
        }

        session([
            'api_token' => $data['api_token'] ?? null,
            'username'  => $data['username'] ?? null,
            'email'     => $data['email'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Login success',
            'data' => $data,
        ]);
    }

    public function updateProgress(Request $request)
    {
        try {
            $token = session('api_token');
            $path = 'https://api-psblue.agatedev.net/api/update-progress';

            $validated = $request->validate([
                'mission'   => 'required|string',
                'completed' => 'required|boolean',
            ]);

            $response = Http::withHeaders([
                'X-Api-Token' => $token
            ])->post($path, [
                'mission'   => $validated['mission'],
                'completed' => $validated['completed'],
            ]);
            Log::info('External API called', [
                'endpoint' => $path,
                'payload' => $validated,
                'status' => $response->status(),
                'response' => $response->json(),
            ]);
        } catch (\Exception $e) {
            Log::error('External API call failed', ['message' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage(),
            ], 500);
        }
        return $response;
    }

    public function checkProgress()
    {
        $token = session('api_token');
        $path = 'https://api-psblue.agatedev.net/api/mission-progress';

        try {
            $response = Http::withHeaders([
                'X-Api-Token' => $token,
            ])->get($path);

            Log::info('External API called', [
                'endpoint' => $path,
                'status' => $response->status(),
                'response' => $response->json(),
            ]);

            return response()->json(
                $response->json(),
                $response->status()
            );
        } catch (\Exception $e) {
            Log::error('External API call failed', ['message' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage(),
                'token' => $token
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['api_token', 'username', 'email']);
        $request->session()->regenerate();
        Log::info('External API called', [
            'response' => response()->json(),
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }




    public function uploadImage(Request $request)
    {
        $token = session('api_token');
        $path = 'https://api-psblue.agatedev.net/api/upload-image';
        $file = $request->file('image');

        $response = Http::withHeaders([
            'X-Api-Token' => $token,
        ])->attach(
            'image',
            file_get_contents($file),
            $file->getClientOriginalName()
        )->post($path);

        return $response->json();
    }
}
