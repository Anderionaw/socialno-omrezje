<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ShranjenaObjava;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\User;
use Config;
use Auth;

class ShranjenaObjavaController extends Controller {

    public function __construct() {

        $this->middleware('auth');
        
    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public static function shraniObjavo(Request $request){
        $shranjena_objava = ShranjenaObjava::where('id_uporabnika', Auth::user()->id)->where('id_objave', $request->id)->first();
        if(!isset($shranjena_objava)){
            $shranjena_objava = ShranjenaObjava::create([
                'id_uporabnika' => Auth::user()->id,
                'id_objave' => $request->id
            ]);
        }else{
            $shranjena_objava->delete();
        }
    }

   public static function vrniShranjeneObjave(){

        $shranjene_objave = ShranjenaObjava::where("id_uporabnika", Auth::user()->id)->orderBy("created_at", "DESC")->get();
        return view('admin.shranjeneobjave.shranjene', compact(
            'shranjene_objave'
        ));

   }
}