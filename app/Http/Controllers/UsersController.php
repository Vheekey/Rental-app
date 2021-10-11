<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * List Users
     *
     * @return void
     */
    public function index()
    {
        $users = User::paginate(20);

        return view('users', compact('users'));
    }

    /**
     * Get User details
     *
     * @param User $user
     * @return void
     */
    
    public function details(User $user)
    {
        return view('users-view', compact('user'));
    }
}
