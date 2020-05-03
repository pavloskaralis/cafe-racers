<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\GameProgress;
use App\Game;

class ApiController extends Controller{
    public function getAllGames() {
        $games = Game::get()->toJson(JSON_PRETTY_PRINT);
        return response($games, 200);
    }
  
    public function createGame(Request $request) {
    $game = new Game; 

    $game->player1 = $request->player1;
    $game->player2 = $request->player2;
    $game->api_text = $request->api_text;
    $game->p1_text = $request->p1_text;
    $game->p2_text = $request->p2_text;
    $game->time = $request->time;
    $game->end = $request->end;
    $game->tracking = $request->tracking;
    $game->p1_again = $request->p1_again;
    $game->p2_again = $request->p2_again;


    $game->save();

    return response()->json([
        "message" => "game created",
        "id" => $game->id,
    ]);
    }

    public function getGame($id) {
        if (Game::where('id', $id)->exists()) {
            $game = Game::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($game, 200);
        } else {
            return response()->json([
                "message" => "game not found"
            ], 404);
        }    
    }

    public function updateGame(Request $request, $id) {
        if (Game::where('id', $id)->exists()) {

            $test = $request;
            $game = Game::find($id);
            $game->player1 = is_null($request->player1) ? $game->player1 : $request->player1;
            $game->player2 = is_null($request->player2) ? $game->player2 : $request->player2;
            $game->api_text = is_null($request->api_text) ? $game->api_text : $request->api_text;
            $game->p1_text = is_null($request->p1_text) ? $game->p1_text : $request->p1_text;
            $game->p2_text = is_null($request->p2_text) ? $game->p2_text : $request->p2_text;
            $game->time = is_null($request->time) ? $game->time : $request->time;
            $game->end = is_null($request->end) ? $game->end : $request->end;
            $game->tracking = is_null($request->tracking) ? $game->tracking : $request->tracking;
            $game->p1_again = is_null($request->p1_again) ? $game->p1_again : $request->p1_again;
            $game->p2_again = is_null($request->p2_again) ? $game->p2_again : $request->p2_again;

            $game->save();
            
            // event(new GameProgress($id));

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "game not found"
            ], 404);
        }
    }

    public function deleteGame ($id) {
        if(Game::where('id', $id)->exists()) {
            $game = Game::find($id);
            $game->delete();
    
            return response()->json([
              "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
              "message" => "game not found"
            ], 404);
        }
    }
}
