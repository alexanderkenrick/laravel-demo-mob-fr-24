<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        $jurusans = Jurusan::all();
        return view('members', compact('members', 'jurusans'));
    }

    public function add(Request $request){
        $validator = $request->validate([
           'name' => ['required'],
           'phone' => ['required', 'unique:members,phone', 'numeric', 'min:12', 'max:12'],
           'jurusan' => ['required', 'numeric']
        ]);

        if(!$validator){
            return redirect('/members')->withErrors($validator)->withInput();
        }

        $member = new Member;
        $member->name = $request->input('name');
        $member->phone = $request->input('phone');
        $member->jurusan_id = $request->input('jurusan');
        $member->save();
        return Redirect::route('members.index')->with('status', 'member-saved');

    }
}
