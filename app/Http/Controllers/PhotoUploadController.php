<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PhotoUploadController extends Controller
{

    public function index(){
        $images = Photo::all();
        return view('welcome',compact('images'));
    }//end method
    public function photoUpload(Request $request){
        $image = $request->file('image');
        $imageName = rand().'.'.$image->getClientOriginalName();
        $image->move('upload/', $imageName);
        $imagePath = ('upload/' . $imageName);
         $qrcode = QrCode::size(80)->generate('http://192.168.1.100:8000/'.$imagePath);
         $photo = new Photo();
         $photo->image = $imagePath;
         $photo->code =  $qrcode;
         $photo->save();
         return redirect()->back();
    }//end method
}
