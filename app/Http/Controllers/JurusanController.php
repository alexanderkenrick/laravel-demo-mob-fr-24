<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class JurusanController extends Controller
{
    public function index()
    {

          // DB Facade
        // $jurusans = DB::table('jurusans')
        //    ->select('*')
        //    ->get();

        $jurusans = Jurusan::all();

        // $jurusans = Jurusan::all();
        
        return view('jurusan', compact('jurusans'));
    }

    public function add(Request $request)
    {
        $validator = $request->validate([
            'name' => ['required']
        ]);

        if (!$validator) {
            return redirect('/jurusan')->withErrors($validator)->withInput();
        }

        $jurusan = new Jurusan;
        $jurusan->name = $request->input('name');
        $jurusan->save();

        return Redirect::route('jurusan.index')->with('status', 'jurusan-saved');
    }
}
