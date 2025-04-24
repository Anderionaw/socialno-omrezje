<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Config;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Auth;

class ActivityController extends Controller
{
    
    public function __construct() {

        $this->middleware('auth');

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function index(Request $request) {

        $pst_per_page = Config::get('mct-app.app_pst_per_page');

        $activities = Activity::orderBy('created_at', 'DESC');

        if ( $request->has('search') ) {
            $activities = $activities->where( function ( $query ) use ( $request ) {
                $query->where( 'description', 'like',  '%' . $request->input('search') . '%'  )
                      ->orWhere( 'subject_type', 'like',  '%' . $request->input('search') . '%' )
                      ->orWhere( 'event', 'like',  '%' . $request->input('search') . '%' )
                      ->orWhereHas('causer', function ( $query ) use ( $request ) {
                        $query->where('name', 'like', '%' . $request->input('search') . '%' );
                      });
            });
        }
        
        $input = $request->all(); 
        
        if( isset( $input['page'] ) && !empty( $input['page'] ) ) {
            $activities = $activities->paginate( $pst_per_page, ['*'], 'page', $request->input( 'page' ) );
        } else {
            $activities = $activities->paginate( $pst_per_page );   
        }
        
        return view('admin.activities.index', compact('activities'));

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function show($id, Request $request) {

        $activity = Activity::findOrFail($id);

        if($activity) {

            return view('admin.activities.show', compact( 
                'activity'
            ));

        } else {

            $mct_response = ['error' => __('Dnevnik dogajanja') . ' ' .  __('ne obstaja!')];
            return redirect('admin.activities')->with($mct_response);
        
        }

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

}
