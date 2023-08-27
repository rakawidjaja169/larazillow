<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class UserListingImageController extends Controller
{
    public function create(Listing $listing)
    {
        return inertia(
            'User/ListingImage/Create',
            ['listing' => $listing]
        );
    }

    public function store(Listing $listing, Request $request)
    {
        dd('Works!');
    }
}
