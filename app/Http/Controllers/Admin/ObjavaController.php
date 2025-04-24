<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Objava;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Komentar;
use App\Models\Vsecki;
use Config;
use Auth;

class ObjavaController extends Controller {

    public function __construct() {

        $this->middleware('auth');
        
    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */
    
    public function show($id, Request $request) {

        $objave = Objava::findOrFail($id);

        if($objave) { 
            
            return view('admin.objave.show', compact( 
                'objave'
            ));

        } else {

            $mct_response = ['error' => __('') . ' ' .  __('ne obstaja!')];
            return redirect('admin.objave')->with($mct_response);
        
        }

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function create() {

        return view('admin.objave.create');

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request) {

        $this->validate( $request, [
            'vsebina' => 'required'
        ]);


        $objava = Objava::create([
            'id_uporabnika' => Auth::user()->id,
            'vsebina' => $request->vsebina
        ]);

        //DODAJ SLIKO

        if ($objava) {

            if($request->hasFile('featured_image')) {

                $imagePath = '';
                $ext = $request->file('featured_image')->extension();
                $imageName = 'objava-' . $objava->id . '.' . $ext;
                $imagePath = $request->file('featured_image')->storeAs('public/objave', $imageName);
                $objava->slika = $imageName;
                $objava->save();

            }

        }

        if ($objava) {
            $mct_ajax_response = __('Objava') . ' ' . __('je bil uspešno dodana!');
            $mct_response = ['success' => __('Objava') . ' ' .  __('je bil uspešno dodana!')];
        } else {
            $mct_ajax_response = __('Objave') . ' ' .  __('ni mogoče dodati!');
            $mct_response = ['error' => __('Objave') . ' ' .  __('ni mogoče dodati!')];
        }

        if ( $request->ajax() ) {
            return response()->json(['ajax_text' => $mct_ajax_response]);
            die('ok');
        }
		
        return redirect()->back()->with($mct_response);
    }


    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function delete($id) {

        $objava = Objava::findOrFail($id);
        if($objava->id_uporabnika == Auth::user()->id){

            if($objava) {

                $komentarji = Komentar::where("id_objave", "=", $objava->id)->get();

                if(count($komentarji)){
                    foreach($komentarji as $key => $komentar){
                        $komentar->delete();
                    }
                }

                $vsecki = Vsecki::where("id_objave", "=", $objava->id)->get();

                if(count($vsecki)){
                    foreach($vsecki as $key => $vsecek){
                        $vsecek->delete();
                    }
                }

                $objavaImage = 'public/objave/' . $objava->slika;
                if (Storage::exists($objavaImage)) {
                    Storage::delete($objavaImage);
                }


                $objava->delete();
                $mct_response = ['success' => __('Objava') . ' ' .  __('je bil uspešno odstranjena!')];
            } else {
                $mct_response = ['error' => __('Izbrane objave ni mogoče odstraniti!')];
            }

            return redirect()->back()->with($mct_response);
        }

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */


    public function vseckaj(Request $request){

        $objava = Objava::findOrFail($request->id);

        $vsecek = Vsecki::where('id_objave', "=", $request->id)->where('id_uporabnika', "=", Auth::user()->id)->take(1)->get();

        if($objava){

            if(count($vsecek) < 1){

                $vsecek = Vsecki::create([
                    'id_objave' => $objava->id,
                    'id_uporabnika' => Auth::user()->id
                ]);
            }else{
                $vsecek[0]->delete();
            }
            
        }

        return response()->json(['vsecki' => count(Vsecki::where('id_objave', "=", $request->id)->get())]);
        die('ok');

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

}