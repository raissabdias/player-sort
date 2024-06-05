<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DrawController extends Controller
{
    public function index(Request $request)
    {
        $draws = DB::table('draws')
            ->orderBy('draws.id', 'desc')
            ->get()
            ->toArray();

        # Get teams
        foreach ($draws as $key => $draw) {
            # Format created_at
            $draws[$key]->created_at = $draw->created_at ? date("d/m/y H:i", strtotime($draw->created_at)) : null;

            $teams = DB::table('teams')
                ->where('draw_id', '=', $draw->id)
                ->get()
                ->toArray();
               
            # Get players
            foreach ($teams as $team) {
                $players = DB::table('team_players')
                    ->join('players', 'players.id', '=', 'team_players.player_id')
                    ->join('player_levels', 'players.level_id', '=', 'player_levels.id')
                    ->where('team_id', '=', $team->id)
                    ->select('players.id', 'players.name', 'player_levels.name as level', 'players.is_goalkeeper')
                    ->orderBy('players.is_goalkeeper', 'desc')
                    ->get()
                    ->toArray();

                $draws[$key]->teams[] = $players;
            }

        }

        return view('draw.index', ['draws' => $draws]);
    }

    public function create(Request $request)
    {
        $players = Player::all()->sortBy('name');
        
        return view('draw.create', ['players' => $players]);
    }

    public function store(Request $request)
    {
        $error = false;

        $players = $request->players;
        $player_per_team = $request->player_per_team;

        $rule1 = $this->validatePlayersQuantity(count($players), $player_per_team);
        if (!$rule1['valid']) {
            $error = $rule1['error'];
            goto end;
        }

        $rule2 = $this->validateGoalkeepersQuantity($players, $player_per_team);
        if (!$rule2['valid']) {
            $error = $rule2['error'];
            goto end;
        }
        
        $draw = $this->sortTeams($players, $player_per_team);
        $draw_id = $this->saveDraw($draw);

        end:
        if ($error) {
            return Redirect::back()
                ->withErrors(['message' => $error])
                ->withInput($request->all());
        }

        return Redirect::to('/')
            ->with('success', true)
            ->with('draw_id', $draw_id);
    }

    /**
     * Each team must have at least 2 players
     * @return boolean
     */
    private function validatePlayersQuantity(int $players, int $quantity)
    {
        $minimum_quantity = $quantity * 2;

        if ($players >= $minimum_quantity)
            return [
                'valid' => true,
                'error' => null
            ];

        return [
            'valid' => false,
            'error' => 'Quantidade mínima de ' . $minimum_quantity .' jogadores não foi atingida.'
        ];
    }

    /**
     * There must be a goalkeeper for each team
     */
    private function validateGoalkeepersQuantity(array $players, int $quantity)
    {
        $goalkeepers_quantity = DB::table('players')
            ->where('is_goalkeeper', '=', 1)
            ->whereIn('id', $players)
            ->count();

        $teams = count($players) / $quantity;

        if ((int) ceil($teams) === $goalkeepers_quantity) {
            return [
                'valid' => true,
                'error' => null
            ];
        }

        return [
            'valid' => false,
            'error' => 'São necessários ' . ceil($teams) . ' goleiros para sortear os times.'
        ];
    }

    /**
     * Sort teams
     */
    private function sortTeams(array $players_id, int $quantity)
    {
        $teams_quantity = ceil(count($players_id) / $quantity);

        # All players selected, except goalkeepers
        $players = DB::table('players')
            ->where('is_goalkeeper', '=', 0)
            ->whereIn('id', $players_id)
            ->orderBy('level_id')
            ->get()
            ->toArray();
    
        # All goalkeepers selected
        $goalkeepers = DB::table('players')
            ->where('is_goalkeeper', '=', 1)
            ->whereIn('id', $players_id)
            ->get()
            ->toArray();

        $teams = [];
        for ($i = 1; $i <= $teams_quantity; $i++) {
            $team = array_splice($players, 0, ($quantity - 1));
            $goalkeepers = array_splice($goalkeepers, 0, 1);

            $teams[] = array_merge($team, $goalkeepers);
        }

        return $teams;
        /*
        dd($teams);

        # Group by player level
        $level_groups = [];
        foreach ($players as $player) {
            $level_groups[$player->level_id][] = $player;
        }

        $valores = $pesos = [];
        foreach ($level_groups as $peso => $group) {
            $pesos[] = count($group);
            $valores[] = count($group) * $peso;
        }

        # Média ponderada
        $media = array_sum($valores) / array_sum($pesos);
        $media = round($media);

        $teams = [];

        dd($level_groups);
        */
    }

    /**
     * Persist draw and teams
     * @return int
     */
    private function saveDraw($teams)
    {
        $draw_id = DB::table('draws')->insertGetId([
            'players_per_team' => count($teams[0]),
            'created_at' => date("Y-m-d H:i:s")
        ]);

        foreach ($teams as $team) {
            $team_id = DB::table('teams')->insertGetId([
                'draw_id' => $draw_id
            ]);

            foreach ($team as $player) {
                DB::table('team_players')->insert([
                    'player_id' => $player->id,
                    'team_id' => $team_id
                ]);
            }
        }

        return $draw_id;
    }
}
