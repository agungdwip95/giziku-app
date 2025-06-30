<?php

namespace App\Http\Controllers\api;

use App\Models\Balita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class BalitaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $balitas = Balita::where('user_id', Auth::id())->with('pengukuranGizis')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'List of balita',
            'data' => $balitas
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $balita = Balita::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Balita created successfully',
            'data' => $balita
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $balita = Balita::where('user_id', Auth::id())->with('pengukuranGizis')->find($id);

        if (!$balita) {
            return response()->json([
                'status' => 'error',
                'message' => 'Balita not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Balita details',
            'data' => $balita
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $balita = Balita::where('user_id', Auth::id())->find($id);

        if (!$balita) {
            return response()->json([
                'status' => 'error',
                'message' => 'Balita not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $balita->update([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Balita updated successfully',
            'data' => $balita
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $balita = Balita::where('user_id', Auth::id())->find($id);

        if (!$balita) {
            return response()->json([
                'status' => 'error',
                'message' => 'Balita not found'
            ], 404);
        }

        $balita->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Balita deleted successfully'
        ], 200);
    }
}
