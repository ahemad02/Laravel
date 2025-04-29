<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Usercontroller extends Controller
{
    function admin($name){
        return view('admin',['name'=>$name]);
    }

    function users(){
        return DB::select('select * from users');
    }

    function queries(){
        return DB::table('usesrs')->get();
    }

    function login(Request $request){
        $request->session()->put('user', $request->input('user'));
        return redirect('profile');
    }

    function upload(Request $request){
        $file = $request->file('file');
        $fileName = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);
    
        // Step 2: Prepare the path
        $fullPath = 'uploads/' . $fileName;
    
        // Step 3: Explode (split) to get just the filename (if needed)
        $fileNameArray = explode('/', $fullPath);
        $onlyFileName = $fileNameArray[1]; // This is like '123456_filename.jpg'
    
        // Step 4: Return to a view and pass the file name
        return view('display', ['path' => $onlyFileName]);
    }

}
