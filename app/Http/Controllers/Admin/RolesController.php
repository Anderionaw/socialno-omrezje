<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Config;
use Auth;

class RolesController extends Controller {
    
    public function __construct() {

        $this->middleware('auth');
        
    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function index(Request $request) {

        $pst_per_page = Config::get('mct-app.app_pst_per_page');
        
        $roles = Role::orderBy('name', 'ASC');
        $permissions = Permission::orderBy('name', 'ASC')->pluck('name','id');

        if ($request->has('search')) {
            $roles = $roles->where(function ($query) use ($request) {
            $query->where('name', 'like',  '%' . $request->input('search') . '%' );
            });
        }
        
        $input = $request->all(); 
        
        if( isset( $input['page'] ) && !empty( $input['page'] ) ) {
            $roles = $roles->paginate($pst_per_page, ['*'], 'page', $request->input('page'));
        } else {
            $roles = $roles->paginate($pst_per_page);   
        }

        return view('admin.roles.index', compact(
            'roles',
            'permissions'
        ));

    }
   
    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function create() {

        return redirect()->route('admin.roles.index');

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request) {

        if (auth()->user()->cannot('manage_roles')) {
            abort(404);
        }

        $this->validate( $request, [
			'role' => 'required|unique:roles,name'
        ]);
		
		$role = Role::create([
            'name'     => $request->role
        ]);

        $role->syncPermissions($request->permissions);

        if ( $role ) {
            $mct_ajax_response = __('Uporabniški nivo') . ' ' . $role->name . ' ' . __('je bil uspešno dodan!');
            $mct_response = ['success' => __('Uporabniški nivo') . ' ' . $role->name . ' ' . __('je bil uspešno dodan!')];
        } else {
            $mct_ajax_response = __('Uporabniški nivo') . ' ' .  __('ni mogoče dodati!');
            $mct_response = ['error' => __('Uporabniški nivo') . ' ' .  __('ni mogoče dodati!')];
        }

        if ( $request->ajax() ) {
            return response()->json(['ajax_text' => $mct_ajax_response]);
            die('ok');
        }
		
        return redirect()->back()->with($mct_response);

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function edit($id, Request $request) {

        if (auth()->user()->cannot('manage_roles')) {
            abort(404);
        }

        $role  = Role::where('id', $id)->first();

        if($role) {
            
            $role_permission = $role->permissions()
                                    ->pluck('id')
                                    ->toArray();

            $permissions = Permission::orderBy('name', 'ASC')->pluck('name','id');

            return view('admin.roles.edit', compact('role', 'role_permission', 'permissions'));

        } else {

            $mct_response = ['error' => __('Uporabniški nivo') . ' ' .  __('ne obstaja!')];
            return redirect()->route('admin.roles.index')->with($mct_response);
        
        }

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function update($id, Request $request) {

        if (auth()->user()->cannot('manage_roles')) {
            abort(404);
        }
        
        $role = Role::findOrFail($id);

        $this->validate( $request, [
            'role'     => 'required|unique:roles,name,' . $id
        ]);

        $update = $role->update([
            'name' => $request->role
        ]);
        $role->syncPermissions($request->permissions);

        if ($update) {
            $mct_ajax_response = __('Uporabniški nivo') . ' ' . $role->name . ' ' . __('je bil uspešno urejen!');
            $mct_response = ['success' => __('Uporabniški nivo') . ' ' . $role->name . ' ' . __('je bil uspešno urejen!')];
        } else {
            $mct_ajax_response =  __('Uporabniški nivo') . ' ' .  __('ni mogoče urediti!');
            $mct_response = ['error' => __('Uporabniški nivo') . ' ' .  __('ni mogoče urediti!')];
        }

        if ( $request->ajax() ) {
            return response()->json(['ajax_text' => $mct_ajax_response]);
            die('ok');
        }
		
        return redirect()->route('admin.roles.index')->with($mct_response);

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function delete($id) {

        if (auth()->user()->cannot('manage_roles')) {
            abort(404);
        }

        $role   = Role::find($id);

        if($role) {
            $role->delete();
            $role->permissions()->delete();
            $mct_response = ['success' => __('Uporabniški nivo') . ' ' . $role->name . ' ' . __('je bil uspešno odstranjen!')];
        } else {
            $mct_response = ['error' => __('Uporabniški nivo') . ' ' . $role->name . ' ' . __('ni mogoče odstraniti!')];
        }

        return redirect()->route('admin.roles.index')->with($mct_response);

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

}