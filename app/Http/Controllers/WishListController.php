<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.wishlist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'wishLists' => 'required|array',
            'wishLists.*.name' => 'required',
            'wishLists.*.image' => 'nullable',
            'wishLists.*.dob' => 'required',
            'wishLists.*.wishListLink' => 'required',
            'wishLists.*.about' => 'required',
            'removedWishLists' => 'nullable|array',
        ]);

        if ($request->removedWishLists) {
            foreach ($request->removedWishLists as $wishListId) {
                WishList::find($wishListId)->delete();
            }
        }

        $wishListObj = new WishList();


        foreach ($request->wishLists as $wishList) {

            $age = $wishListObj->calculateAge($wishList['dob']);


            if (isset($wishList['id'])) {
                $wishListDb = WishList::find($wishList['id']);
                if (!$wishListDb) {
                    WishList::create([
                        'user_id' => auth()->id(),
                        'name' => $wishList['name'],
                        'date_of_birth' => $wishList['dob'],
                        'wish_list_link' => $wishList['wishListLink'],
                        'about' => $wishList['about'],
                        'image_path' => isset($wishList['image']) ? $wishList['image']->store('childrens') : null,
                        'birth_certificate_path' => isset($wishList['birth_certificate']) ? $wishList['birth_certificate']->store('birth_certificates') : null,
                        'age' => $age,
                        'gender' => $wishList['gender']
                    ]);
                } else {
                    $wishListDb->update([
                        'name' => $wishList['name'],
                        'date_of_birth' => $wishList['dob'],
                        'wish_list_link' => $wishList['wishListLink'],
                        'about' => $wishList['about'],
                        'age' => $age,
                        'gender' => $wishList['gender']
                    ]);

                    if (isset($wishList['image'])) {
                        $wishListDb->update([
                            'image_path' => $wishList['image']->store('childrens'),
                        ]);
                    }

                    if (isset($wishList['birth_certificate'])) {
                        $wishListDb->update([
                            'birth_certificate_path' => $wishList['birth_certificate']->store('birth_certificates'),
                        ]);
                    }
                }
            } else {
                WishList::create([
                    'user_id' => auth()->id(),
                    'name' => $wishList['name'],
                    'date_of_birth' => $wishList['dob'],
                    'wish_list_link' => $wishList['wishListLink'],
                    'about' => $wishList['about'],
                    'image_path' => isset($wishList['image']) ? $wishList['image']->store('childrens') : null,
                    'birth_certificate_path' => isset($wishList['birth_certificate']) ? $wishList['birth_certificate']->store('birth_certificates') : null,
                    'age' => $age,
                    'gender' => $wishList['gender']
                ]);
            }
        }


        return response()->json([
            'message' => 'WishList added successfully.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getWishList(Request $request)
    {
        $wishList = WishList::where('user_id', auth()->id())->latest()->get();

        $wishLists = $wishList->map(function ($wishList) {
            return [
                'id' => $wishList->id,
                'name' => $wishList->name,
                'dob' => $wishList->date_of_birth,
                'wishListLink' => $wishList->wish_list_link,
                'about' => $wishList->about,
                'image_url' => $wishList->image_url,
                'birth_certificate_url' => $wishList->birth_certificate_url,
                'gender' => ucfirst($wishList->gender),
            ];
        });

        return response()->json([
            'data' => $wishLists,
        ]);
    }
}
