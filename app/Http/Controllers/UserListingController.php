<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserListingController extends Controller
{
    public function index()
    {
        return inertia(
            'User/Index',
            ['listings' => Auth::user()->listings]
        );
    }
}
