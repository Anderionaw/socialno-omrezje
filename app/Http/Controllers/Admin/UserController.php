<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Models\Vsecki;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Config;
use Auth;

class UserController extends Controller {
    
    public function __construct() {

        $this->middleware('auth');

    }

   
    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function getProfile($id, Request $request) {

        $user  = User::findOrFail($id);

        if( $user->id == Auth::user()->id && $user) {

            return view('admin.users.profile', compact('user'));

        } else {

            $mct_response = ['error' => __('Uporabnik') . ' ' .  __('ne obstaja!')];
            return redirect()->route('admin.home');
            
        }

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function updateProfile($id, Request $request) {

        $user = User::findOrFail($id);

        $this->validate( $request, [
			'name'     => 'required|string ',
            'email'    => 'required|email|unique:users,email,' . $id,
        ]);

        if(isset($request->password)) {
            $this->validate( $request, [
                'password' => 'required|confirmed'
            ]);
        }

        $update = $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if(isset($request->password)){
            $update = $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        $imagePath = '';
        if($request->hasFile('slika')) {

            $ext = $request->file('slika')->extension();
            $imagePath = $request->file('slika')->storeAs('public/users', 'user-' . $user->id . '.' . $ext);
            $imagePath = substr($imagePath, 7);
            $user->slika = $imagePath;
            $user->save();

        }

        if ($update) {
            $mct_ajax_response = __('Profil') . ' ' . $user->name . ' ' . __('je bil uspešno urejen!');
            $mct_response = ['success' =>  __('Profil') . ' ' . $user->name . ' ' . __('je bil uspešno urejen!')];
        } else {
            $mct_ajax_response = __('Profila') . ' ' .  __('ni mogoče urediti!');
            $mct_response = ['error' => __('Profila') . ' ' .  __('ni mogoče urediti!')];
        }

        if ( $request->ajax() ) {
            return response()->json(['ajax_text' => $mct_ajax_response]);
            die('ok');
        }
		
        return redirect()->back()->with($mct_response);

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function viewProfile($id) {
        
        $user = User::findOrFail($id);
        
        return view('admin.users.view', compact(
            'user'
        ));

    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public static function prestejVsecke($id){

        $counter = 0;

        $user = User::find($id);
        $objave = $user->objave;
        foreach($objave as $key=>$objava){
            $vsecek = Vsecki::where("id_objave", "=", $objava->id)->get();
            if(count($vsecek) > 0){
                $counter += count($vsecek);
            }
        }
        return $counter;

    }

    public function search() {
        return view('admin.users.search');
    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------- */

    public function isciUporabnike(Request $request){


        $users = collect();

        $search = $request->input('search');

        if ($search && $search != '') {

            $users = User::select('users.*')
            ->when($search, function ($query) use ($search) {
                return  $query->where(function ($query) use ($search) {
                    $query->where('users.name', 'like',  '%' . $search . '%')
                        ->orWhere('users.email', 'like', '%' . $search . '%');
                });        
            });

        }

        $users = $users->get();

        return view('admin.users.search', compact(
            'users'
        ));

    } 

}