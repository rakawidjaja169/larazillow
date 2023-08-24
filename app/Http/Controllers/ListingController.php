<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return inertia(
            'Listing/Index',
            [
                'listings' => Listing::all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Listing::create(
            $request->validate([
                'products' => 'required|string',
                'quantity' => 'required|integer|min:0|max:20',
                'description' => 'required|string',
                'address' => 'required|string',
                'price' => 'required|integer|min:1|max:500000',
            ])
        );

        return redirect()->route('listing.index')
            ->with('success', 'Listing created successfully!');
    }

    
    /**
     * Display a listing.
     *
     * @param Listing $listing The listing to display.
     * @return mixed The rendered inertia page.
     */
    public function show(Listing $listing)
    {
        return inertia(
            'Listing/Show',
            [
                'listing' => $listing
            ]
        );
    }

    /**
     * Edit the listing.
     *
     * @param Listing $listing The listing to be edited.
     * @return mixed Returns the result of the `inertia` function.
     */
    public function edit(Listing $listing)
    {
        return inertia(
            'Listing/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    
    /**
     * Updates a listing with the given request data.
     *
     * @param Request $request the HTTP request object
     * @param Listing $listing the listing to be updated
     * @return RedirectResponse the redirect response
     * @throws Some_Exception_Class if the validation fails
     */
    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate([
                'products' => 'required|string',
                'quantity' => 'required|integer|min:0|max:20',
                'description' => 'required|string',
                'address' => 'required|string',
                'price' => 'required|integer|min:1|max:500000',
            ])
        );

        return redirect()->route('listing.index')
            ->with('success', 'Listing edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->back()
            ->with('success', 'Listing deleted successfully!');
    }
}
