<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DrawController extends Controller
{
    public function create(Request $request)
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

        end:
        if ($error) {
            return Redirect::back()
                ->withErrors(['message' => $error])
                ->withInput($request->all());
        }

        return Redirect::back()
            ->with('success', true);
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
}
