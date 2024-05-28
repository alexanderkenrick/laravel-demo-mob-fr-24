<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class MemberController extends Controller
{
    public function index()
    {
        // Eloguent Lazy Load (Default)
        $jurusans = Jurusan::all();

        // DB Facade
        //$members = DB::table('members')
        //    ->select('members.id', 'members.name', 'members.phone', 'members.jurusan_id', 'jurusans.name as jurusan')
        //    ->join('jurusans','members.jurusan_id','=','jurusan_id')
        //    ->get();

//
//        $members = Member::all();

//         Eloquent Eager Loading with Pivot
        $members = Member::with('jurusan')->get();

        return view('members', compact('members', 'jurusans'));
    }

    public function add(Request $request)
    {
        $validator = $request->validate([
            'name' => ['required'],
            'phone' => ['required', 'unique:members,phone', 'max:12'],
            'jurusan' => ['required', 'numeric']
        ]);

        if (!$validator) {
            return redirect('/members')->withErrors($validator)->withInput();
        }

        $name = $request->input('name');

        if($request->hasFile('image')){
            $imageName = $request->file('image')->getClientOriginalName();
            $path = "assets/images/". $name ."/";
            File::makeDirectory(public_path($path), 0777, true, true);
            $path = "assets/images/". $name ."/". $imageName . ".jpg";
            $image = $request->file('image');
            $image = ImageManager::gd()->read($image);
            $image->encode(new JpegEncoder(95));
            $image->toJpeg()->save(public_path($path));
//            $path = $request->file('image')->store('public/images');

        }

        $member = new Member;
        $member->name = $name;
        $member->phone = $request->input('phone');
        $member->image_path = $path;
        $member->jurusan_id = $request->input('jurusan');

        $member->save();
        return Redirect::route('members.index')->with('status', 'member-saved');
    }
}
