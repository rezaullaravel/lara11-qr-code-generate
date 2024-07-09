<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PhotoUploadController extends Controller
{

    public function index()
    {
        $images = Photo::all();
        return view('welcome', compact('images'));
    } //end method
    public function photoUpload(Request $request)
    {
        $image = $request->file('image');
        $randomString = Str::random(60);
        $urlSafeEncodedString = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($randomString));
        $parameterName = "FitnessExamId";
        $imageName = $parameterName . "=" . urlencode($urlSafeEncodedString) . $image->getClientOriginalName();

        $image->move('rty/', $imageName);
        $imagePath = ('rty/' . $imageName);

        //generate qr code
        $qrcode = QrCode::format('png')->size(500)->gradient(138, 54, 77, 91, 49, 63, 'horizontal')->merge(public_path('images/logo.jpg'), 0.2, 0.2)->style("round")->eye('circle')->eyeColor(2, 207, 16, 68)->eyeColor(1, 207, 16, 68)->eyeColor(0, 207, 16, 68)->generate(config('app.url') . '/' . $imagePath);
        Storage::disk('public')->put($imageName, $qrcode);
        $photo = new Photo();
        $photo->image = $imagePath;
        $photo->code = $imageName;
        $photo->save();
        return redirect()->back()->with('sms', 'Successfully created.');
    } //end method

    //delete image
    public function delete($id)
    {
        $photo = Photo::find($id);
        if (File::exists($photo->image) && Storage::disk('public')->exists($photo->code)) {
            unlink($photo->image);
            Storage::disk('public')->delete($photo->code);
        }
        $photo->delete();
        return back()->with('sms', 'Successfully deleted.');
    } //end method

    //download image
    public function download($id)
    {
        $photo = Photo::find($id);
        return Storage::disk('public')->download($photo->code);
    }

}
