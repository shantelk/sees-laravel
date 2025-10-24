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

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'External API failed.',
                    'response' => $response->body(),
                ], $response->status());
            }

            $data = $response->json()['data'] ?? $response->json();
        } catch (\Exception $e) {
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

            return response()->json(
                $response->json(),
                $response->status()
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function checkProgress()
    {
        $token = session('api_token');
        $path = 'https://api-psblue.agatedev.net/api/mission-progress';

        try {
            $response = Http::withHeaders([
                'X-Api-Token' => $token,
            ])->get($path);

            return response()->json(
                $response->json(),
                $response->status()
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage(),
                'token' => $token
            ], 500);
        }
    }

    public function uploadImage(Request $request)
    {
        $token = session('api_token');
        $path = 'https://api-psblue.agatedev.net/api/upload-image';

        try {
            $request->validate([
                'image' => 'required|file|mimes:jpeg,jpg,png,pdf|max:51200', // 50MB
            ]);

            $file = $request->file('image');

            $response = Http::withHeaders([
                'X-Api-Token' => $token,
            ])->attach(
                'image',
                fopen($request->file('image')->getRealPath(), 'r'),
                $request->file('image')->getClientOriginalName()
            )->post($path);

            if ($response->status() === 401) {
                $request->session()->forget('api_token');
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }

            return response()->json($response->json(), $response->status());
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid file or format.',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['api_token', 'username', 'email']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Successfully logout.'
        ]);
    }
}
