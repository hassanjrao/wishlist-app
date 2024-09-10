<?php

namespace App\Http\Controllers;

use App\Models\State;
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
            'state' => 'nullable',
            'gender'=>'nullable',
            'verfied_check'=>'nullable'
        ]);


        // if month is null, then it will return the current month
        $month = $request->month ?? 'all';
        $age = $request->age;
        $state = $request->state;
        $gender=$request->gender ?? 'all';
        $verfied_check=$request->verfied_check && $request->verfied_check=='on' ? true : false;


        $wishLists = WishList::when($month && $month!='all', function ($query) use ($month) {
            return $query->whereMonth('date_of_birth', $month);
        })->when($age, function ($query) use ($age) {
            return $query->where('age', $age);
        })
        ->when($gender && $gender!='all', function ($query) use ($gender) {

            return $query->where('gender', $gender);
        })
        ->when($verfied_check, function ($query) use ($verfied_check) {
            return $query->whereHas('user', function ($query) use ($verfied_check) {
                $query->where('is_verified_low_income', 1);
            });
        })
        ->whereHas('user', function ($query) use ($state) {
            // $query->where('is_approved', 1)
            $query->when($state && $state!='all', function ($query) use ($state) {
                $query->where('state_id', $state);
            });
            // ->whereHas('latestIncomeCertificate', function ($query) {
                // created_at should not older than 1 year
                // $query->where('created_at', '>=', now()->subYear());
            // });
        })
        ->with(['user','user.state'])
        ->orderBy('date_of_birth', 'asc')
        ->paginate(20)
        ->withQueryString();

        $states=State::all();
        $genders=WishList::genders();

        return view('wishlists', compact('wishLists', 'month', 'age','states','gender','genders','state','verfied_check'));
    }

    public function privacyPolicy()
    {
        return view('privacy-policy');
    }

}
