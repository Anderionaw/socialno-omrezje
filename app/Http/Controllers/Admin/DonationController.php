<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Config;
use Auth;

class DonationController extends Controller {

    public function __construct() {

        $this->middleware('auth');
        
    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function index(Request $request) {

        if (auth()->user()->cannot('view_donations')) {
            abort(404);
        }

        $pst_per_page = Config::get('mct-app.app_pst_per_page');
         
        $donations = Donation::orderBy('date', 'DESC')->orderBy('id', 'DESC');

        $search = $request->input('search');

        if ($search) {

            $donations = $donations->select('donations.*')
            ->when($search, function ($query) use ($search) {
                return  $query->where(function ($query) use ($search) {
                    $query->where('donations.code', 'like',  '%' . $search . '%')
                        ->orWhere('donations.title', 'like', '%' . $search . '%')
                        ->orWhere('donations.reference', 'like', '%' . $search . '%');
                });        
            });

        }
        
        $input = $request->all(); 
        
        if( isset( $input['page'] ) && !empty( $input['page'] ) ) {
            $donations = $donations->paginate($pst_per_page, ['*'], 'page', $request->input('page'))->withQueryString();
        } else {
            $donations = $donations->paginate($pst_per_page)->withQueryString();   
        }
        
        if ( $request->ajax() ) {
            $html = view('admin.donations.index', ['donations' => $donations])->render();
            return \Response::json(['html' => $html]);
        }

        activity()
			->event('view all')
			->log('view Donations');

        return view('admin.donations.index', compact(
            'donations'
        ));

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */
    
    public function show($id, Request $request) {

        if (auth()->user()->cannot('view_donations')) {
            abort(404);
        }

        $donation = Donation::findOrFail($id);

        if($donation) { 

            activity()
                ->performedOn($donation)
                ->event('view')
                ->log('view Donation');
            
            return view('admin.donations.show', compact( 
                'donation'
            ));

        } else {

            $mct_response = ['error' => __('Akcija') . ' ' .  __('ne obstaja!')];
            return redirect('admin.donations')->with($mct_response);
        
        }

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function create() {

        if (auth()->user()->cannot('manage_donations')) {
            abort(404);
        }

        activity()
			->event('view create form')
			->log('view create form Donation');

        return view('admin.donations.create');

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request) {

        if (auth()->user()->cannot('manage_donations')) {
            abort(404);
        }

        $this->validate( $request, [
			'code' => 'required',
            'title' => 'required',
            'date' => 'required',
            'reference' => 'required'
        ]);

        $donation = Donation::create([
            'code' => $request->code,
            'title' => $request->title,
            'date' => $request->date,
            'reference' => $request->reference,
            'description' => $request->description
        ]);

        if ($donation) {
            $mct_ajax_response = __('Akcija') . ' ' . $donation->title . ' ' . __('je bila uspešno dodana!');
            $mct_response = ['success' => __('Akcija') . ' ' . $donation->title . ' ' . __('je bila uspešno dodana!')];
        } else {
            $mct_ajax_response = __('Akcije') . ' ' .  __('ni mogoče dodati!');
            $mct_response = ['error' => __('Akcije') . ' ' .  __('ni mogoče dodati!')];
        }

        if ( $request->ajax() ) {
            return response()->json(['ajax_text' => $mct_ajax_response]);
            die('ok');
        }
		
        return redirect()->back()->with($mct_response);

    }
    
    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function edit($id, Request $request) {

        if (auth()->user()->cannot('manage_donations')) {
            abort(404);
        }

        $donation = Donation::where('id', $id)->first();

        if($donation) {

            activity()
				->performedOn($donation)
				->event('view edit form')
				->log('view edit form Donation');

            return view('admin.donations.edit', compact(
                'donation'
            ));

        } else {

            $mct_response = ['error' => __('Akcija') . ' ' .  __('ne obstaja!')];
            return redirect()->route('admin.donations.index')->with($mct_response);
        
        }

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function update($id, Request $request) {

        if (auth()->user()->cannot('manage_donations')) {
            abort(404);
        }
        
        $donation = Donation::findOrFail($id);

        $this->validate( $request, [
            'code' => 'required',
            'title' => 'required',
            'date' => 'required',
            'reference' => 'required'
        ]);

        $update = $donation->update([
            'code' => $request->code,
            'title' => $request->title,
            'date' => $request->date,
            'reference' => $request->reference,
            'description' => $request->description
        ]);

        if ($update) {
            $mct_ajax_response = __('Akcija') . ' ' . $donation->title . ' ' . __('je bila uspešno urejena!');
            $mct_response = ['success' => __('Akcija') . ' ' . $donation->title . ' ' . __('je bila uspešno urejena!')];
        } else {
            $mct_ajax_response =  __('Akcije') . ' ' .  __('ni mogoče urediti!');
            $mct_response = ['error' => __('Akcije') . ' ' .  __('ni mogoče urediti!')];
        }

        if ( $request->ajax() ) {
            return response()->json(['ajax_text' => $mct_ajax_response]);
            die('ok');
        }
		
        return redirect()->route('admin.donations.index')->with($mct_response);

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function delete($id) {

        if (auth()->user()->cannot('manage_donations')) {
            abort(404);
        }

        $donation = Donation::find($id);

        if($donation) {
            if ($donation->donation_donations()->exists()) {
                $mct_response = ['error' => __('Akcije') . ' ' . $donation->title . ' ' . __('ni mogoče odstraniti saj je dodeljena zapisom v bazi!')];
            } else {
                $donation->delete();
                $mct_response = ['success' => __('Akcija') . ' ' . $donation->title . ' ' . __('je bila uspešno odstranjena!')];
            }
        } else {
            $mct_response = ['error' => __('Izbrane akcije ni mogoče odstraniti!')];
        }

        return redirect()->back()->with($mct_response);

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

}