<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller {
    public function index() {
        $users = User::paginate(15);
        $total = User::count();

        return view('admin.users.index', compact('users', 'total'));
    }

    public function show(User $user) {
        return view('admin.users.show', compact('user'));
    }
}
