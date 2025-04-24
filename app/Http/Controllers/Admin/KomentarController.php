<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Komentar;
use App\Models\Postmail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Config;
use Auth;

class KomentarController extends Controller {

    public function __construct() {

        $this->middleware('auth');
        
    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    /*public function index(Request $request) {

        
        $pst_per_page = Config::get('mct-app.app_pst_per_page');
         
        $komentarji = Komentar::orderBy('created_at', 'ASC');

        $input = $request->all(); 
        
        if( isset( $input['page'] ) && !empty( $input['page'] ) ) {
            $komentarji = $komentarji->paginate($pst_per_page, ['*'], 'page', $request->input('page'))->withQueryString();
        } else {
            $komentarji = $komentarji->paginate($pst_per_page)->withQueryString();   
        }
        

        return view('admin.komentarji.index', compact(
            'komentarji',
        ));

    }*/

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */
    
    public function show($id, Request $request) {


        $komentarji = Komentar::findOrFail($id);

        if($komentarji) { 
            
            return view('admin.komentarji.show', compact( 
                'komentarji'
            ));

        } else {

            $mct_response = ['error' => __('Donator') . ' ' .  __('ne obstaja!')];
            return redirect('admin.komentarji')->with($mct_response);
        
        }

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function create(Request $request, $id) {

        $komentarji = ["id" => $id];

        return view('admin.komentarji.create', compact('komentarji'));

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request) {

        $this->validate( $request, [
            'vsebina' => 'required'
        ]);

        $komentar = Komentar::create([
            'id_uporabnika' => Auth::user()->id,
            'id_objave' => $request->id_objave,
            'vsebina' => $request->vsebina
        ]);

        if ($komentar) {
            $mct_ajax_response = __('Komentar') . ' ' . __('je bil uspešno dodan!');
            $mct_response = ['success' => __('Komentar') . ' ' . __('je bil uspešno dodan!')];
        } else {
            $mct_ajax_response = __('Komentarja') . ' ' .  __('ni mogoče dodati!');
            $mct_response = ['error' => __('Komentarja') . ' ' .  __('ni mogoče dodati!')];
        }

        if ( $request->ajax() ) {
            return response()->json(['ajax_text' => $mct_ajax_response]);
            die('ok');
        }
		
        return redirect()->back()->with($mct_response);

    }
    
    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function edit($id, Request $request) {

        $komentarji = Komentar::where('id', $id)->first();

        if($komentarji) {


            return view('admin.komentarji.edit', compact(
                'komentarji'
            ));

        } else {

            $mct_response = ['error' => __('Akcija') . ' ' .  __('ne obstaja!')];
            return redirect()->route('admin.komentarji.index')->with($mct_response);
        
        }

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function update($id, Request $request) {

        
        $komentar = Komentar::findOrFail($id);

        $this->validate( $request, [
            'vsebina' => 'required'
        ]);

        $update = $donor->update([
            'vsebina' => $request->vsebina,
        ]);

        if ($update) {
            $mct_ajax_response = __('Komentar') . ' ' . __('je bil uspešno urejen!');
            $mct_response = ['success' => __('Komentar') . ' ' . __('je bil uspešno urejen!')];
        } else {
            $mct_ajax_response =  __('Komentarja') . ' ' .  __('ni mogoče urediti!');
            $mct_response = ['error' => __('Komentarja') . ' ' .  __('ni mogoče urediti!')];
        }

        if ( $request->ajax() ) {
            return response()->json(['ajax_text' => $mct_ajax_response]);
            die('ok');
        }
		
        return redirect()->route('admin.donors.index')->with($mct_response);

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function delete($id) {

        $komentarji = Komentar::findOrFail($id);

        if($komentarji) {
            $komentarji->delete();
            $mct_response = ['success' => __('Komentar') . ' ' . __('je bil uspešno odstranjen!')];
        } else {
            $mct_response = ['error' => __('Izbranega komentrja ni mogoče odstraniti!')];
        }

        return redirect()->back()->with($mct_response);

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

}