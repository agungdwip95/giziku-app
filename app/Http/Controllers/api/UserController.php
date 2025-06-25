<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only(['logout', 'changePassword', 'resetPassword', 'profile', 'updateProfile']);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users,email',
            'no_hp' => 'required|string|max:20|unique:users,no_hp',
            'password' => 'required|string|min:6',
            'alamat' => 'nullable|string|max:255',
            'role' => 'required|in:admin,ortu',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'password' => Hash::make($request->password),
                'alamat' => $request->alamat,
                'role' => $request->role,
            ]);

            $token = JWTAuth::fromUser($user);

            return response()->json([
                'success' => true,
                'message' => 'User registered successfully',
                'data' => [
                    'user' => $user->only(['id', 'nama', 'email', 'no_hp', 'alamat', 'role']),
                    'token' => $token
                ]
            ], 201);
        } catch (\Exception $e) {
            Log::error('Registration Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to register user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials'
                ], 401);
            }

            $user = JWTAuth::user();

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => $user->only(['id', 'nama', 'email', 'no_hp', 'alamat', 'role']),
                    'token' => $token
                ]
            ]);
        } catch (JWTException $e) {
            Log::error('Login Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Could not create token: ' . $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $token = JWTAuth::getToken();
            if (!$token) {
                Log::warning('Token not found in request');
                return response()->json([
                    'success' => false,
                    'message' => 'Token not found in request'
                ], 401);
            }

            JWTAuth::invalidate($token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $e) {
            Log::error('Logout JWT Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to logout: ' . $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            Log::error('Unexpected Logout Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Unexpected error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'new_password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $jwtToken = JWTAuth::getToken();
            if (!$jwtToken) {
                Log::warning('JWT Token not found in request');
                return response()->json([
                    'success' => false,
                    'message' => 'JWT Token not found in request'
                ], 401);
            }

            $admin = JWTAuth::user();
            if ($admin->role !== 'admin') {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized: Only admins can reset passwords'
                ], 403);
            }

            $targetUser = User::where('id', $request->user_id)
                             ->where('role', 'ortu')
                             ->first();

            if (!$targetUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found or not an Ortu'
                ], 404);
            }

            $targetUser->update([
                'password' => Hash::make($request->new_password),
            ]);

            Log::info('Password reset for user: ' . $targetUser->email . ' by admin: ' . $admin->email);

            return response()->json([
                'success' => true,
                'message' => 'Password reset successfully for user ID ' . $request->user_id
            ], 200);
        } catch (JWTException $e) {
            Log::error('Reset Password JWT Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to process reset: ' . $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            Log::error('Unexpected Reset Password Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Unexpected error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|different:current_password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = JWTAuth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect'
            ], 401);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully'
        ], 200);
    }

    public function verifyToken(Request $request)
    {
        try {
            $token = JWTAuth::getToken();
            if (!$token) {
                Log::warning('Token not found in request');
                return response()->json([
                    'success' => false,
                    'message' => 'Token not provided'
                ], 401);
            }

            $user = JWTAuth::authenticate($token);
            if (!$user) {
                Log::warning('Invalid or expired token');
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired token'
                ], 401);
            }

            Log::info('Token verified for user: ' . $user->email);
            return response()->json([
                'success' => true,
                'message' => 'Token is valid',
                'data' => [
                    'user' => $user->only(['id', 'nama', 'email', 'no_hp', 'alamat', 'role'])
                ]
            ], 200);
        } catch (JWTException $e) {
            Log::error('Token Verification Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Token verification failed: ' . $e->getMessage()
            ], 401);
        } catch (\Exception $e) {
            Log::error('Unexpected Token Verification Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Unexpected error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function profile(Request $request)
    {
        try {
            $user = JWTAuth::user();

            return response()->json([
                'success' => true,
                'data' => [
                    'nama' => $user->nama,
                    'email' => $user->email,
                    'no_hp' => $user->no_hp,
                    'alamat' => $user->alamat,
                    'role' => $user->role,
                ]
            ], 200);
        } catch (\Exception $e) {
            Log::error('Profile Retrieval Error: ', [
                'user_id' => $user->id ?? null,
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve profile: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = JWTAuth::user();

            $validator = Validator::make($request->all(), [
                'nama' => 'sometimes|string|max:100',
                'no_hp' => 'sometimes|string|max:20|unique:users,no_hp,' . $user->id,
                'alamat' => 'sometimes|nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $oldValues = [
                'nama' => $user->nama,
                'no_hp' => $user->no_hp,
                'alamat' => $user->alamat,
            ];

            $updates = $request->only([
                'nama',
                'no_hp',
                'alamat',
            ]);
            $user->update($updates);

            $newValues = $request->only(array_keys($updates));
            if ($oldValues !== $newValues) {
                Log::info('Profile Updated', [
                    'user_id' => $user->id,
                    'old_values' => $oldValues,
                    'new_values' => $newValues
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'data' => [
                    'nama' => $user->nama,
                    'email' => $user->email,
                    'no_hp' => $user->no_hp,
                    'alamat' => $user->alamat,
                    'role' => $user->role,
                ]
            ], 200);
        } catch (\Exception $e) {
            Log::error('Profile Update Error: ', [
                'user_id' => $user->id ?? null,
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile: ' . $e->getMessage()
            ], 500);
        }
    }
}