<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Prijateljstvo;
use App\Models\Postmail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Config;
use Auth;

class PrijateljstvoController extends Controller {

    public function __construct() {

        $this->middleware('auth');
        
    }



    public function dodajPrijatelja(Request $request){

        $id1 = $request->id1;//Naslovnik
        $id2 = $request->id2;//Pošiljatelj prošnje

        $prijateljstvo_ze = Prijateljstvo::where('id_uporabnika1', "=", $id1)->where('id_uporabnika2', "=", $id2)->get();
        $prijateljstvo_ze2 = Prijateljstvo::where('id_uporabnika1', "=", $id2)->where('id_uporabnika2', "=", $id1)->get();
        
        if(!(count($prijateljstvo_ze) || count($prijateljstvo_ze2))){
            $prijateljstvo = Prijateljstvo::create([
                'id_uporabnika1' => $request->id1,
                'id_uporabnika2' => $request->id2,
                'sprejeto' => false
            ]);
        }
        
        die('ok');
    }

    public static function izpisiProsnje($id){
        $prosnje = Prijateljstvo::where("id_uporabnika1", "=", Auth::user()->id)->where("sprejeto", "=", false)->get();
        return $prosnje;

    }


    public static function jeProsnja($id1, $id2){
        $prosnja = Prijateljstvo::where("id_uporabnika1", "=", $id1)->where("id_uporabnika2", "=", $id2)->where("sprejeto", "=", 0)->get();
        return (count($prosnja) > 0);
    }


    public static function zePrijatelja($id1, $id2){

        $prosnja1 = Prijateljstvo::where("id_uporabnika1", "=", $id1)->where("id_uporabnika2", "=", $id2)->where("sprejeto", "=", true)->get();
        $prosnja2 = Prijateljstvo::where("id_uporabnika1", "=", $id2)->where("id_uporabnika2", "=", $id1)->where("sprejeto", "=", true)->get();

        return ((count($prosnja1) > 0 ) || (count($prosnja2) > 0));
    
    }

    public function sprejmiPrijatelja(Request $request){

        $id1 = $request->id1;
        $id2 = $request->id2;

        $prijateljstvo = Prijateljstvo::where("id_uporabnika1", "=", $id1)->where("id_uporabnika2", "=", $id2)->get()->first();
        $update = $prijateljstvo->update([
            'sprejeto' => true
        ]);

        return response()->json(["uspelo" => true]);
    }

    public function zavrniPrijatelja(Request $request){

        $id1 = $request->id1;
        $id2 = $request->id2;

        $prijateljstvo = Prijateljstvo::where("id_uporabnika1", "=", $id1)->where("id_uporabnika2", "=", $id2)->get()->first();
        $prijateljstvo->delete();

        return response()->json(["uspelo" => true]);
    }

    public static function odstraniPrijatelja(Request $request){

        $id1 = $request->id1;
        $id2 = $request->id2;

        $prijateljstvo = Prijateljstvo::where("id_uporabnika1", "=", $id1)->where("id_uporabnika2", "=", $id2)->get()->first();
        if(!isset($prijateljstvo)){
            $prijateljstvo = Prijateljstvo::where("id_uporabnika1", "=", $id2)->where("id_uporabnika2", "=", $id1)->get()->first();
        }
        $prijateljstvo->delete();

        return response()->json(["uspelo" => true]);
    }

    public static function izpisiPrijatelje($id){
        $prijatelji = collect();
        $prijateljstva = Prijateljstvo::where("id_uporabnika1", "=" , $id)->where("sprejeto", true)->get();
        
        foreach($prijateljstva as $key=>$prijatelj){
            $prijatelji->push($prijatelj->user2);
        }

        $prijateljstva2 = Prijateljstvo::where("id_uporabnika2", "=" , $id)->where("sprejeto", true)->get();
        foreach($prijateljstva2 as $key=>$prijatelj){
            $prijatelji->push($prijatelj->user1);
        }
        return $prijatelji;
    }
}