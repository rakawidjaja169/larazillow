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
    public function index()
    {
        return inertia(
            'User/Index',
            ['listings' => Auth::user()->listings]
        );
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
}
