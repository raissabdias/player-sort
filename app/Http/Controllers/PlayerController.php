<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\PlayerLevel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PlayerController extends Controller
{
    /**
     * Display the list of players
     */
    public function index(Request $request): View
    {
        $players = DB::table('players')
            ->join('player_levels', 'players.level_id', '=', 'player_levels.id')
            ->select('players.id', 'players.name', 'player_levels.name as level', 'players.is_goalkeeper')
            ->orderBy('players.id')
            ->get();

        return view('player.index', ['players' => $players]);
    }

    /**
     * New player view
     */
    public function create(Request $request): View
    {
        $player_levels = PlayerLevel::all();

        return view('player.create', ['levels' => $player_levels]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'level_id' => ['required', 'integer'],
            'is_goalkeeper' => ['boolean']
        ]);

        Player::create([
            'name' => $request->name,
            'level_id' => $request->level_id,
            'is_goalkeeper' => $request->is_goalkeeper ?: 0
        ]);

        return redirect(route('player'));
    }
}
