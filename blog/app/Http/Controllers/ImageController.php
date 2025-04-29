<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    //
    function upload(Request $request){
        $file = $request->file('file');
        $fileName = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);
    
        // Step 2: Prepare the path
        $fullPath = 'uploads/' . $fileName;

        $pathArray=explode('/',$fullPath);

        $imagePath=$pathArray[1];

        $img=new Image();
        $img->path=$imagePath;
        if($img->save()){
            return redirect('list');
        }else{
            return "Failed";
        }
    }

    function list(){
        $images=Image::all();
        return view('display1',['images'=>$images]);
    }

}
