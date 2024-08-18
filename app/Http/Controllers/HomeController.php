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
        ->orderBy('created_at', 'desc')
        ->get();


        return view('home', compact('wishLists', 'month', 'age'));
    }
}
