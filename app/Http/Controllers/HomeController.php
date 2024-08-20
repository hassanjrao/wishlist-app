<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request->validate([
            'month' => 'nullable|numeric',
            'age' => 'nullable|numeric',
        ]);

        // if month is null, then it will return the current month
        $month = $request->month ?? date('m');

        $age = $request->age;

        $wishLists = WishList::when($month, function ($query) use ($month) {
            return $query->whereMonth('date_of_birth', $month);
        })->when($age, function ($query) use ($age) {
            return $query->where('age', $age);
        })
        ->whereHas('user', function ($query) {
            $query->where('is_approved', 1);
        })
        ->orderBy('date_of_birth', 'asc')
        ->get();


        return view('home', compact('wishLists', 'month', 'age'));
    }

    public function wishlists(Request $request)
    {
        $request->validate([
            'month' => 'nullable',
            'age' => 'nullable|numeric',
        ]);

        // if month is null, then it will return the current month
        $month = $request->month ?? date('m');

        $age = $request->age;

        $wishLists = WishList::when($month && $month!='all', function ($query) use ($month) {
            return $query->whereMonth('date_of_birth', $month);
        })->when($age, function ($query) use ($age) {
            return $query->where('age', $age);
        })
        ->whereHas('user', function ($query) {
            $query->where('is_approved', 1)
            ->whereHas('latestIncomeCertificate', function ($query) {
                // created_at should not older than 1 year
                $query->where('created_at', '>=', now()->subYear());
            });
        })
        ->orderBy('date_of_birth', 'asc')
        ->paginate(20)
        ->withQueryString();


        return view('wishlists', compact('wishLists', 'month', 'age'));
    }

}
