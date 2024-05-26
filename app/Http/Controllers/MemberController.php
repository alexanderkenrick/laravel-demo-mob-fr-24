<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
        //$members = Member::all();

        // Eloquent Eager Loading with Pivot
        $members = Member::with('jurusan')->get();

        return view('members', compact('members', 'jurusans'));
    }

    public function add(Request $request)
    {
        $validator = $request->validate([
            'name' => ['required'],
            'phone' => ['required', 'unique:members,phone', 'min:12', 'max:12'],
            'jurusan' => ['required', 'numeric']
        ]);

        if (!$validator) {
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
