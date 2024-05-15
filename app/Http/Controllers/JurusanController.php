<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $members = Jurusan::all();
        return view('members.index', compact('members'));
    }
}
