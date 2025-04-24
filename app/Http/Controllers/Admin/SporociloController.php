<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Sporocilo;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Config;
use Auth;

class SporociloController extends Controller {

    public function __construct() {

        $this->middleware('auth');
        
    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */
    
    public function show($id, Request $request) {


        $sporocila = Sporocilo::where(function ($query) use ($id) {
            $query->where('id_uporabnika1', $id)
                  ->where('id_uporabnika2', Auth::user()->id);
        })->orWhere(function ($query) use ($id) {
            $query->where('id_uporabnika1', Auth::user()->id)
                  ->where('id_uporabnika2', $id);
        })->orderBy('created_at', 'asc')->get();

        $user = User::find($id);

        return view('admin.sporocila.show', compact( 
            'sporocila',
            'user'
        ));

    }


    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request) {

        $this->validate( $request, [
			'vsebina' => 'required',
        ]);

        $sporocilo = Sporocilo::create([
            'id_uporabnika1' => Auth::user()->id,
            'id_uporabnika2' => $request->id_naslovnika,
            'vsebina' => $request->vsebina
        ]);
		
        return redirect()->back();

    }
    
    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

}