<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $players = Player::all();

        return view('dashboard', ['players' => $players]);
    }
}
