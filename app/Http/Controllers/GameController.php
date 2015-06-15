<?php

namespace App\Http\Controllers;

use Mail;
use App\Player;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class GameController extends Controller
{
   
    public function getIndex($id=FALSE,$name="",$score=0)
    {
        
        $top = Player::orderBy('score','desc')->get();
        // check if there are atleast 3 players
        if(sizeof($top)>=3){
            $mole1 = Player::sum('mole1');
            $mole2 = Player::sum('mole2');
            $mole3 = Player::sum('mole3');
            $mole4 = Player::sum('mole4');
            $mole5 = Player::sum('mole5');
            $mole6 = Player::sum('mole6');
            $mole7 = Player::sum('mole7');
            $mole8 = Player::sum('mole8');
            $mole9 = Player::sum('mole9');
            $moles = array($mole1,$mole2,$mole3,$mole4,$mole5,$mole6,$mole7,$mole8,$mole9);
            $moless = array($mole1,$mole2,$mole3,$mole4,$mole5,$mole6,$mole7,$mole8,$mole9);
            rsort($moless);
            $key1 = array_search($moless[0], $moles);
            $key2 = array_search($moless[1], $moles);
            $key3 = array_search($moless[2], $moles);
            $mole31 = $top[0]['mole1']+$top[1]['mole1']+$top[2]['mole1'];
            $mole32 = $top[0]['mole2']+$top[1]['mole2']+$top[2]['mole2'];
            $mole33 = $top[0]['mole3']+$top[1]['mole3']+$top[2]['mole3'];
            $mole34 = $top[0]['mole4']+$top[1]['mole4']+$top[2]['mole4'];
            $mole35 = $top[0]['mole5']+$top[1]['mole5']+$top[2]['mole5'];
            $mole36 = $top[0]['mole6']+$top[1]['mole6']+$top[2]['mole6'];
            $mole37 = $top[0]['mole7']+$top[1]['mole7']+$top[2]['mole7'];
            $mole38 = $top[0]['mole8']+$top[1]['mole8']+$top[2]['mole8'];
            $mole39 = $top[0]['mole9']+$top[1]['mole9']+$top[2]['mole9'];
            $moles = array($mole31,$mole32,$mole33,$mole34,$mole35,$mole36,$mole37,$mole38,$mole39);
            $max = array_keys($moles, max($moles))[0];
        }
        else{
            $top = array(array('name'=>"",'score'=>"",'date'=>"",'mole'=>""),array('name'=>"",'score'=>"",'date'=>"",'mole'=>""),array('name'=>"",'score'=>"",'date'=>"",'mole'=>""));
            $key1 = 0;
            $key2 = 0;
            $key3 = 0;
            $max = 0;
        }
        return view('game',['top'=>$top,'post'=>$id,'name'=>$name,'score'=>$score,'mole1'=>$key1,'mole2'=>$key2,'mole3'=>$key3,'max'=>$max]);
    }
    public function postIndex(Request $request)
    {
        // save player
        $name =  $request->input('name');
        $score = $request->input('score');
        $player = new Player;
        $player->name = $request->input('name');
        $player->score = $request->input('score');
        $player->mole = $request->input('mole');
        $player->mole1 = $request->input('mole1');
        $player->mole2 = $request->input('mole2');
        $player->mole3 = $request->input('mole3');
        $player->mole4 = $request->input('mole4');
        $player->mole5 = $request->input('mole5');
        $player->mole6 = $request->input('mole6');
        $player->mole7 = $request->input('mole7');
        $player->mole8 = $request->input('mole8');
        $player->mole9 = $request->input('mole9');
        $player->save();
        return $this->getIndex(TRUE,$name,$score);
    }
    public function postEmail(Request $request)
    {
        $email =  $request->input('email');
        Mail::send('email', ['name' => $request->input('name'),'score'=> $request->input('score')], function($message)
        {
            $message->to( "devdharpatel@gmail.com", 'User')->subject('Your Whack-a-mole Score!');
        });
    }
}