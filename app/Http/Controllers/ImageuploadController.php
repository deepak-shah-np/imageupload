<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageuploadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     *
     * This function works as update and create
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request,$id){

        request()->validate([
            'photo' => 'required',
        ]);
        $user = User::find($id);
        $photo = $request->file('photo');
        $extension = $photo->getClientOriginalExtension();
        $filenamee = $photo->getClientOriginalName().'.'.$extension;
        Storage::disk('public')->put($filenamee,  File::get($photo));
        $user->photo = $filenamee;
        $user->save();

        return redirect('home');
    }


    public function delete($id){
        // find the user
        $user = User::find($id);
        // get the photo name
        $photoname = $user->photo;
        // remove the photo from upload directory
        Storage::disk('public')->delete($photoname);

        // make the photo field as null in user table
        $user->photo = null;
        //ssave it
        $user->save();
        return redirect('home')->withSuccess('Donw');
    }
}
