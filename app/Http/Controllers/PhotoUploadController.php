<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PhotoUploadController extends Controller
{

    public function index(){
        if(Auth::check()){
            $images = Photo::all();
            return view('welcome',compact('images'));
        } else{
            return redirect('/login');
        }

    }//end method
    public function photoUpload(Request $request){
        $image = $request->file('image');
        $imageName = rand().'.'.$image->getClientOriginalName();
        $image->move('upload/', $imageName);
        $imagePath = ('upload/' . $imageName);

        //generate qr code
         $qrcode = QrCode::size(80)->generate('http://192.168.1.100:8000/'.$imagePath);

         $photo = new Photo();
         $photo->image = $imagePath;
         $photo->code =  $qrcode;
         $photo->save();
         return redirect()->back()->with('sms','Successfully created.');
    }//end method


    //delete image
    public function delete($id){
        $photo = Photo::find($id);
        if(File::exists( $photo->image)){
            unlink($photo->image);
        }
        $photo->delete();
        return back()->with('sms','Successfully deleted.');
    }//end method

}
