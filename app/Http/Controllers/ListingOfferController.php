<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingOfferController extends Controller
{
    public function store(Listing $listing, Request $request)
    {
        $this->authorize('view', $listing);
        
        $listing->offers()->save(
            Offer::make(
                $request->validate([
                    'solution' => 'required|string',
                ])
            )->solver()->associate($request->user())
        );

        return redirect()->back()->with(
            'success',
            'Offer was made!'
        );
    }
}
