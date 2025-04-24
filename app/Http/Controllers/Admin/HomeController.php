<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Objava;
use App\Models\Prijateljstvo;
use App\Http\Controllers\Controller;
use Auth;


class HomeController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function index() {

        $prijateljstva = Prijateljstvo::with(['user1', 'user2'])
			->where('id_uporabnika1', Auth::id())->where("sprejeto", true)
			->orWhere('id_uporabnika2', Auth::id())->where("sprejeto", true)
			->get();
					
	
		$prijatelji = array();
		foreach($prijateljstva as $key=>$prijateljstvo) {
			if($prijateljstvo->id_uporabnika1 == Auth::id()){
				array_push($prijatelji, $prijateljstvo->user2);
			}else{
				array_push($prijatelji, $prijateljstvo->user1);
			}
		}

        $objave = collect();

        foreach($prijatelji as $key=>$prijatelj){
            $objave_temp = Objava::where("id_uporabnika", "=", $prijatelj->id)->get();
            if(count($objave_temp) > 0){
                $objave = $objave->merge($objave_temp);
            }
        }

        $objave = $objave->sortByDesc('created_at');
        
        $home_text = 'Feed';
        

        return view('admin.home.index', compact(
            'home_text',
            'objave'
        ));
        
    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function clearCache() {
        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        \Artisan::call('view:clear');
        \Artisan::call('route:clear');
        return view('clear-cache');
    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

}