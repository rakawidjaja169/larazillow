<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    /**
     * Constructs a new instance of the class.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'products', 'quantity', 'priceFrom', 'priceTo'
        ]);

        return inertia(
            'Listing/Index',
            [
                'filters' => $filters,
                'listings' => Listing::mostRecent()
                    ->filter($filters)
                    ->paginate(10)
                    ->withQueryString()
            ]
        );
    }
    
    /**
     * Display a listing.
     *
     * @param Listing $listing The listing to display.
     * @return mixed The rendered inertia page.
     */
    public function show(Listing $listing)
    {
        // if (Auth::user()->cannot('view', $listing)) {
        //     abort(403);
        // }
        // $this->authorize('view', $listing);
        $listing->load(['images']);
        
        return inertia(
            'Listing/Show',
            [
                'listing' => $listing
            ]
        );
    }
}
