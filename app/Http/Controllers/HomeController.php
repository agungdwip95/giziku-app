<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $total_admin = User::where('role', 'admin')->count();
        $total_ortu = User::where('role', 'ortu')->count();

        return view('dashboard', [
            'section' => 'home',
            'total_admin' => $total_admin,
            'total_ortu' => $total_ortu,
        ]);

        // return $user = Auth::user()->nama;
    }

}