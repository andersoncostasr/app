<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        // $users = User::where('tenant_id', auth()->user()->tenant->id)->get();
        $users = User::all();
        return view('users.index', compact('users'));
    }
}
