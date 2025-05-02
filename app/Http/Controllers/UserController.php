<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = User::where('id', '!=', 1);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        $users = $query
            ->withCount([
                'todos',
                'todos as completed_todos_count' => function ($query) {
                    $query->where('is_complete', true); // ✅ FIXED HERE
                }
            ])
            ->orderBy('name')
            ->paginate(10);

        return view('user.index', compact('users'));
    }

    // Membuat user menjadi admin
    public function makeadmin(User $user)
    {
        if ($user->id == 1) {
            abort(403);
        }

        $user->timestamps = false;
        $user->is_admin = true;
        $user->save();

        return back()->with('success', 'User made admin successfully!');
    }

    // Menghapus status admin dari user
    public function removeadmin(User $user)
    {
        if ($user->id == 1) {
            abort(403);
        }

        $user->timestamps = false;
        $user->is_admin = false;
        $user->save();

        return back()->with('success', 'User admin rights removed!');
    }

    // Menghapus user
    public function destroy(User $user)
    {
        if ($user->id == 1) {
            abort(403);
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully!');
    }
}
