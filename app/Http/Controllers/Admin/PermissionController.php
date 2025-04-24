<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Config;
use Auth;

class PermissionController extends Controller {
    
    public function __construct() {

        $this->middleware('auth');

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function index(Request $request) {

        $pst_per_page = Config::get('mct-app.app_pst_per_page');
         
        $permissions = Permission::orderBy('name', 'ASC');
        $roles = Role::orderBy('name', 'ASC')->get();

        if ($request->has('search')) {
            $permissions = $permissions->where(function ($query) use ($request) {
            $query->where('name', 'like',  '%' . $request->input('search') . '%' );
            });
        }
        
        $input = $request->all(); 
        
        if( isset( $input['page'] ) && !empty( $input['page'] ) ) {
            $permissions = $permissions->paginate($pst_per_page, ['*'], 'page', $request->input('page'));
        } else {
            $permissions = $permissions->paginate($pst_per_page);   
        }

        return view('admin.permissions.index', compact(
            'permissions',
            'roles'
        ));

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function create() {

        return redirect()->route('admin.permissions.index');

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request) {

        if (auth()->user()->cannot('manage_permissions')) {
            abort(404);
        }

        $this->validate( $request, [
			'permission' => 'required|unique:permissions,name'
        ]);

        $permission = Permission::create(['name' => $request->permission]);
        $permission->syncRoles($request->roles);

        if ($permission) {
            $mct_ajax_response = __('Pravica') . ' ' . $permission->name . ' ' . __('je bila uspešno dodana!');
            $mct_response = ['success' => __('Pravica') . ' ' . $permission->name . ' ' . __('je bila uspešno dodana!')];
        } else {
            $mct_ajax_response = __('Pravice') . ' ' .  __('ni mogoče dodati!');
            $mct_response = ['error' => __('Pravice') . ' ' .  __('ni mogoče dodati!')];
        }

        if ( $request->ajax() ) {
            return response()->json(['ajax_text' => $mct_ajax_response]);
            die('ok');
        }
		
        return redirect()->back()->with($mct_response);

    }
    
    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function edit($id, Request $request) {

        if (auth()->user()->cannot('manage_permissions')) {
            abort(404);
        }

        $permission  = Permission::where('id', $id)->first();

        if($permission) {
            
            $permission_role = $permission->roles()
                                    ->pluck('id')
                                    ->toArray();

            $roles = Role::pluck('name','id');

            return view('admin.permissions.edit', compact('permission', 'permission_role', 'roles'));

        } else {

            $mct_response = ['error' => __('Pravica') . ' ' .  __('ne obstaja!')];
            return redirect()->route('admin.permissions.index')->with($mct_response);
        
        }

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function update($id, Request $request) {

        if (auth()->user()->cannot('manage_permissions')) {
            abort(404);
        }
        
        $permission = Permission::findOrFail($id);

        $this->validate( $request, [
            'permission'     => 'required|unique:permissions,name,' . $id
        ]);

        $update = $permission->update([
            'name' => $request->permission
        ]);
        $permission->syncRoles($request->roles);

        if ($update) {
            $mct_ajax_response = __('Pravica') . ' ' . $permission->name . ' ' . __('je bila uspešno urejena!');
            $mct_response = ['success' => __('Pravica') . ' ' . $permission->name . ' ' . __('je bila uspešno urejena!')];
        } else {
            $mct_ajax_response =  __('Pravice') . ' ' .  __('ni mogoče urediti!');
            $mct_response = ['error' => __('Pravice') . ' ' .  __('ni mogoče urediti!')];
        }

        if ( $request->ajax() ) {
            return response()->json(['ajax_text' => $mct_ajax_response]);
            die('ok');
        }
		
        return redirect()->route('admin.permissions.index')->with($mct_response);

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function delete($id) {

        if (auth()->user()->cannot('manage_permissions')) {
            abort(404);
        }

        $permission   = Permission::find($id);

        if($permission) {
            $permission->delete();
            $permission->roles()->delete();
            $mct_response = ['success' => __('Pravica') . ' ' . $permission->name . ' ' . __('je bila uspešno odstranjena!')];
        } else {
            $mct_response = ['error' => __('Pravice') . ' ' . $permission->name . ' ' . __('ni mogoče odstraniti!')];
        }

        return redirect()->route('admin.permissions.index')->with($mct_response);

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function getPermissionBadgeByRole(Request $request) {

        $badges = '';

        if ($request->id) {
            $role = Role::find($request->id);
            $permissions =  $role->permissions()->pluck('name','id');
            foreach ( $permissions as $key => $permission ) {
                $badges .= '<span class="badge badge-dark m-1">' . $permission . '</span>';
            }
        }

        if($role->name == 'Super Admin'){
            $badges = __('Super Admin ima določene vse pravice!');
        }

        return $badges;

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

}