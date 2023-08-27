<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserListingController extends Controller
{
    /**
     * Constructor method for the class.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }
    
    /**
     * Retrieves the index of the user.
     *
     * @return Some_Return_Value
     */
    public function index(Request $request)
    {
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];

        return inertia(
            'User/Index',
            ['filters' => $filters,
             'listings' => Auth::user()
                ->listings()
                ->filter($filters)
                ->withCount('images')
                ->paginate(6)
                ->withQueryString()
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
        // $this->authorize('create', Listing::class);

        return inertia('User/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->listings()->create(
            $request->validate([
                'products' => 'required|string',
                'quantity' => 'required|integer|min:0|max:20',
                'description' => 'required|string',
                'address' => 'required|string',
                'price' => 'required|integer|min:1|max:500000',
            ])
        );

        return redirect()->route('user.listing.index')
            ->with('success', 'Listing created successfully!');
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
            'User/Edit',
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

        return redirect()->route('user.listing.index')
            ->with('success', 'Listing edited successfully!');
    }

    /**
     * Deletes a Listing.
     *
     * @param Listing $listing The Listing to be deleted.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the Listing does not exist.
     * @return \Illuminate\Http\RedirectResponse Redirects the user back to the previous page with a success message.
     */
    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail();

        return redirect()->back()
            ->with('success', 'Listing was deleted!');
    }

    public function restore(Listing $listing)
    {
        $listing->restore();

        return redirect()->back()->with('success', 'Listing was restored!');
    }
}
