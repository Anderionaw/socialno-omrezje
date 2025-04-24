<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Postmail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Config;
use Auth;

class PostmailController extends Controller {

    public function __construct() {

        $this->middleware('auth');
        
    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function index(Request $request) {

        $pst_per_page = Config::get('mct-app.app_pst_per_page');
         
        $postmails = Postmail::orderBy('name', 'ASC');

        if ($request->has('search')) {
            $postmails = $postmails->where(function ($query) use ($request) {
            $query->where('zip', 'like',  '%' . $request->input('search') . '%' )
            ->orWhere('name', 'like',  '%' . $request->input('search') . '%');
            });
        }
        
        $input = $request->all(); 
        
        if( isset($input['is_active_yes']) && !isset($input['is_active_no'])) {
            $postmails = $postmails->where('active', '=',  1);
        }
        
        if( isset( $input['page'] ) && !empty( $input['page'] ) ) {
            $postmails = $postmails->paginate($pst_per_page, ['*'], 'page', $request->input('page'));
        } else {
            $postmails = $postmails->paginate($pst_per_page);   
        }
        
        if ( $request->ajax() ) {
            $html = view('admin.postmails.index', ['postmails' => $postmails])->render();
            return \Response::json(['html' => $html]);
        }

        return view('admin.postmails.index', compact('postmails'));

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */
    
    public function create() {

        return redirect()->route('admin.postmails.index');

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request) {

        if (auth()->user()->cannot('manage_postmails')) {
            abort(404);
        }

        $this->validate( $request, [
			'zip' => 'required|digits_between:4,4|numeric|unique:postmails,zip',
            'title' => 'required'
        ]);

        if ( isset($request->active) && $request->active == 'on'  ) {
            $request->active = 1;
        } else {
            $request->active = 0;
        }

        $postmail = Postmail::create([
            'active' => $request->active,
            'zip' => $request->zip,
            'name' => $request->title
        ]);

        if ($postmail) {
            $mct_ajax_response = __('Pošta') . ' ' . $postmail->name . ' ' . __('je bila uspešno dodana!');
            $mct_response = ['success' => __('Pošta') . ' ' . $postmail->name . ' ' . __('je bila uspešno dodana!')];
        } else {
            $mct_ajax_response = __('Pošte') . ' ' .  __('ni mogoče dodati!');
            $mct_response = ['error' => __('Pošte') . ' ' .  __('ni mogoče dodati!')];
        }

        if ( $request->ajax() ) {
            return response()->json(['ajax_text' => $mct_ajax_response]);
            die('ok');
        }
		
        return redirect()->back()->with($mct_response);

    }
    
    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function edit($id, Request $request) {

        if (auth()->user()->cannot('manage_postmails')) {
            abort(404);
        }

        $postmail = Postmail::where('id', $id)->first();

        if($postmail) {

            return view('admin.postmails.edit', compact('postmail'));

        } else {

            $mct_response = ['error' => __('Pošta') . ' ' .  __('ne obstaja!')];
            return redirect()->route('admin.postmails.index')->with($mct_response);
        
        }

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function update($id, Request $request) {

        if (auth()->user()->cannot('manage_postmails')) {
            abort(404);
        }
        
        $postmail = Postmail::findOrFail($id);

        $this->validate( $request, [
            'zip' => 'required|digits_between:4,4|numeric|unique:postmails,zip,' . $id,
            'title' => 'required'
        ]);

        if ( isset($request->active) && $request->active == 'on'  ) {
            $request->active = 1;
        } else {
            $request->active = 0;
        }

        $update = $postmail->update([
            'active' => $request->active,
            'zip' => $request->zip,
            'name' => $request->title
        ]);

        if ($update) {
            $mct_ajax_response = __('Pošta') . ' ' . $postmail->name . ' ' . __('je bila uspešno urejena!');
            $mct_response = ['success' => __('Pošta') . ' ' . $postmail->name . ' ' . __('je bila uspešno urejena!')];
        } else {
            $mct_ajax_response =  __('Pošte') . ' ' .  __('ni mogoče urediti!');
            $mct_response = ['error' => __('Pošte') . ' ' .  __('ni mogoče urediti!')];
        }

        if ( $request->ajax() ) {
            return response()->json(['ajax_text' => $mct_ajax_response]);
            die('ok');
        }
		
        return redirect()->route('admin.postmails.index')->with($mct_response);

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function delete($id) {

        if (auth()->user()->cannot('manage_postmails')) {
            abort(404);
        }

        $postmail = Postmail::find($id);

        if($postmail) {
            $postmail->delete();
            $mct_response = ['success' => __('Pošta') . ' ' . $postmail->name . ' ' . __('je bila uspešno odstranjena!')];
        } else {
            $mct_response = ['error' => __('Pošte') . ' ' . $postmail->name . ' ' . __('ni mogoče odstraniti!')];
        }

        return redirect()->route('admin.postmails.index')->with($mct_response);

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

}