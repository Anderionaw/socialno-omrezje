<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Session;
use Config;

use App\Imports\PostmailsImport;
use Maatwebsite\Excel\Facades\Excel;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Auth;

class ImporterController extends Controller
{
    
    public function index( Request $request ) {
		
        return view( 'admin.importers.index' );   
         
    }

    public function importPostmails( Request $request ) {
        
        if( $request->hasFile( 'att_postmailfile' ) ) {

            Excel::import(new PostmailsImport, $request->file('att_postmailfile')->store('temp'));

            $mct_text = 'Pošte iz excel datoteke so bile uspešno dodane!';
            return redirect()->back()->with( [ 'success'=> $mct_text ] );
            
        } else {
        
            $mct_text = 'Prosimo pripnite pravilno Excelovo datoteko!';
            return redirect()->back()->with( [ 'error'=> $mct_text ] );
       
        } 

    }

}
