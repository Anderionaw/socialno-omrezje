<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\Postmail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Config;
use Auth;

class DonorController extends Controller {

    public function __construct() {

        $this->middleware('auth');
        
    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function index(Request $request) {

        if (auth()->user()->cannot('view_donors')) {
            abort(404);
        }

        $pst_per_page = Config::get('mct-app.app_pst_per_page');
         
        $donors = Donor::orderBy('surname', 'ASC')->orderBy('name', 'ASC');
        $donor_statuses = mctGetDonorStatuses();

        $search = $request->input('search');
        $donor_status = $request->input('donor_status');

        if ($search || $donor_status) {

            $donors = $donors->select('donors.*')
            ->leftJoin('postmails', 'donors.postmail_id', '=', 'postmails.id')
            ->when($search, function ($query) use ($search) {
                return  $query->where(function ($query) use ($search) {
                    $query->where('donors.name', 'like',  '%' . $search . '%')
                        ->orWhere('donors.surname', 'like', '%' . $search . '%')
                        ->orWhereRaw("CONCAT(donors.name, ' ', donors.surname) like '%" . $search . "%'")
                        ->orWhereRaw("CONCAT(donors.surname, ' ', donors.name) like '%" . $search . "%'")
                        ->orWhere('donors.code', 'like', '%' . $search . '%')
                        ->orWhere('donors.address', 'like', '%' . $search . '%')
                        ->orWhere('postmails.zip', 'like', '%' . $search . '%')
                        ->orWhere('postmails.name', 'like', '%' . $search . '%')
                        ->orWhereRaw("CONCAT(postmails.zip, ' ', postmails.name) like '%" . $search . "%'")
                        ->orWhereRaw("CONCAT(postmails.name, ' ', postmails.zip) like '%" . $search . "%'");
                });        
            })
            ->when($donor_status, function ($query) use ($donor_status) {
                if ($donor_status == 'inactive') {
                    return $query->where('donors.active', 0);
                } else {
                    return $query->where('donors.' . $donor_status, 1);
                }             
            });

        }
        
        $input = $request->all(); 
        
        if( isset( $input['page'] ) && !empty( $input['page'] ) ) {
            $donors = $donors->paginate($pst_per_page, ['*'], 'page', $request->input('page'))->withQueryString();
        } else {
            $donors = $donors->paginate($pst_per_page)->withQueryString();   
        }
        
        if ( $request->ajax() ) {
            $html = view('admin.donors.index', ['donors' => $donors])->render();
            return \Response::json(['html' => $html]);
        }

        activity()
			->event('view all')
			->log('view Donors');

        return view('admin.donors.index', compact(
            'donors',
            'donor_statuses'
        ));

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */
    
    public function show($id, Request $request) {

        if (auth()->user()->cannot('view_donors')) {
            abort(404);
        }

        $donor = Donor::findOrFail($id);

        if($donor) { 

            activity()
                ->performedOn($donor)
                ->event('view')
                ->log('view Donor');
            
            return view('admin.donors.show', compact( 
                'donor'
            ));

        } else {

            $mct_response = ['error' => __('Donator') . ' ' .  __('ne obstaja!')];
            return redirect('admin.donors')->with($mct_response);
        
        }

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function create() {

        if (auth()->user()->cannot('manage_donors')) {
            abort(404);
        }

        $postmails = Postmail::orderBy('name', 'ASC')->where('active', 1)->get();

        activity()
			->event('view create form')
			->log('view create form Donor');

        return view('admin.donors.create', compact( 
            'postmails'
        ));

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request) {

        if (auth()->user()->cannot('manage_donors')) {
            abort(404);
        }

        $this->validate( $request, [
			// 'code' => 'required|unique:donors,code',
            // 'name' => 'required',
            // 'surname' => 'required',
            // 'address' => 'required',
            // 'postmail_id' => 'required'
        ]);

        if ( isset($request->active) && $request->active == 'on'  ) {
            $request->active = 1;
        } else {
            $request->active = 0;
        }

        if ( isset($request->regular) && $request->regular == 'on'  ) {
            $request->regular = 1;
        } else {
            $request->regular = 0;
        }

        if ( isset($request->online) && $request->online == 'on'  ) {
            $request->online = 1;
        } else {
            $request->online = 0;
        }

        if ( isset($request->permanent_deletion) && $request->permanent_deletion == 'on'  ) {
            $request->permanent_deletion = 1;
        } else {
            $request->permanent_deletion = 0;
        }

        //$ext = $request->file('featured_image')->extension();
        //dd($request);

        $donor = Donor::create([
            'active' => $request->active,
            'regular' => $request->regular,
            'online' => $request->online,
            'permanent_deletion' => $request->permanent_deletion,
            'code' => $request->code,
            'name' => $request->name,
            'surname' => $request->surname,
            'address' => $request->address,
            'postmail_id' => $request->postmail_id,
            'phone' => $request->phone,
            'email' => $request->email,
            'description' => $request->description
        ]);

        if ($donor) {

            $imagePath = '';
            if($request->hasFile('featured_image')) {

                $ext = $request->file('featured_image')->extension();
                $imagePath = $request->file('featured_image')->storeAs('donors/', 'donor-' . $donor->id . '.' . $ext);
                $donor->featured_image = $imagePath;
                $donor->save();

            }

        }

        if ($donor) {
            $mct_ajax_response = __('Donator') . ' ' . $donor->name . ' ' . $donor->surname . ' ' . __('je bil uspešno dodan!');
            $mct_response = ['success' => __('Donator') . ' ' . $donor->name . ' ' . $donor->surname . ' ' . __('je bil uspešno dodan!')];
        } else {
            $mct_ajax_response = __('Donatorja') . ' ' .  __('ni mogoče dodati!');
            $mct_response = ['error' => __('Donatorja') . ' ' .  __('ni mogoče dodati!')];
        }

        if ( $request->ajax() ) {
            return response()->json(['ajax_text' => $mct_ajax_response]);
            die('ok');
        }
		
        return redirect()->back()->with($mct_response);

    }
    
    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function edit($id, Request $request) {

        if (auth()->user()->cannot('manage_donors')) {
            abort(404);
        }

        $donor = Donor::where('id', $id)->first();
        $postmails = Postmail::orderBy('name', 'ASC')->where('active', 1)->get();

        if($donor) {

            activity()
				->performedOn($donor)
				->event('view edit form')
				->log('view edit form Donor');

            return view('admin.donors.edit', compact(
                'donor',
                'postmails'
            ));

        } else {

            $mct_response = ['error' => __('Akcija') . ' ' .  __('ne obstaja!')];
            return redirect()->route('admin.donors.index')->with($mct_response);
        
        }

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function update($id, Request $request) {

        if (auth()->user()->cannot('manage_donors')) {
            abort(404);
        }
        
        $donor = Donor::findOrFail($id);

        $this->validate( $request, [
            'code' => 'required|unique:donors,code,' . $id,
            'name' => 'required',
            'surname' => 'required',
            'address' => 'required',
            'postmail_id' => 'required'
        ]);

        if ( isset($request->active) && $request->active == 'on'  ) {
            $request->active = 1;
        } else {
            $request->active = 0;
        }

        if ( isset($request->regular) && $request->regular == 'on'  ) {
            $request->regular = 1;
        } else {
            $request->regular = 0;
        }

        if ( isset($request->online) && $request->online == 'on'  ) {
            $request->online = 1;
        } else {
            $request->online = 0;
        }

        if ( isset($request->permanent_deletion) && $request->permanent_deletion == 'on'  ) {
            $request->permanent_deletion = 1;
        } else {
            $request->permanent_deletion = 0;
        }

        $update = $donor->update([
            'active' => $request->active,
            'regular' => $request->regular,
            'online' => $request->online,
            'permanent_deletion' => $request->permanent_deletion,
            'code' => $request->code,
            'name' => $request->name,
            'surname' => $request->surname,
            'address' => $request->address,
            'postmail_id' => $request->postmail_id,
            'phone' => $request->phone,
            'email' => $request->email,
            'description' => $request->description
        ]);

        if ($update) {
            $mct_ajax_response = __('Donator') . ' ' . $donor->name . ' ' . $donor->surname . ' ' . __('je bil uspešno urejen!');
            $mct_response = ['success' => __('Donator') . ' ' . $donor->name . ' ' . $donor->surname . ' ' . __('je bil uspešno urejen!')];
        } else {
            $mct_ajax_response =  __('Donatorja') . ' ' .  __('ni mogoče urediti!');
            $mct_response = ['error' => __('Donatorja') . ' ' .  __('ni mogoče urediti!')];
        }

        if ( $request->ajax() ) {
            return response()->json(['ajax_text' => $mct_ajax_response]);
            die('ok');
        }
		
        return redirect()->route('admin.donors.index')->with($mct_response);

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function delete($id) {

        if (auth()->user()->cannot('manage_donors')) {
            abort(404);
        }

        $donor = Donor::find($id);

        if($donor) {
            $donor->delete();
            $mct_response = ['success' => __('Donator') . ' ' . $donor->name . ' ' . $donor->surname . ' ' . __('je bil uspešno odstranjen!')];
        } else {
            $mct_response = ['error' => __('Izbranega donatorja ni mogoče odstraniti!')];
        }

        return redirect()->back()->with($mct_response);

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

}