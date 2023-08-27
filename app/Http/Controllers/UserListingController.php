<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserListingController extends Controller
{
    public function index()
    {
        return inertia('User/Index');
    }
}
