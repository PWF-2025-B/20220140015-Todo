<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Tambahkan baris ini

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Mengambil semua data User
        return view('user.index', compact('users'));
    }
}
