<?php

namespace App\Http\Controllers\api;

use App\Models\EdukasiGizi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class EdukasiGiziController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the edukasi gizi resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->query('per_page', 10);
            $page = $request->query('page', 1);
            $kategori = $request->query('kategori');

            $query = EdukasiGizi::query();

            if ($kategori) {
                $query->where('kategori', $kategori);
            }

            $edukasiGizi = $query->orderBy('created_at', 'desc')
                                ->paginate($perPage, ['*'], 'page', $page);

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully retrieved edukasi gizi list',
                'data' => $edukasiGizi->items(),
                'pagination' => [
                    'current_page' => $edukasiGizi->currentPage(),
                    'total_pages' => $edukasiGizi->lastPage(),
                    'total_items' => $edukasiGizi->total(),
                    'per_page' => $edukasiGizi->perPage(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve edukasi gizi list: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified edukasi gizi resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $edukasiGizi = EdukasiGizi::findOrFail($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully retrieved edukasi gizi detail',
                'data' => $edukasiGizi
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Edukasi gizi not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve edukasi gizi detail: ' . $e->getMessage()
            ], 500);
        }
    }
}
