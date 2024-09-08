<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserIncomeCertificate;
use App\Models\WishList;
use Illuminate\Http\Request;

class UserRegisterController extends Controller
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
        //
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
            'id' => 'nullable|exists:users',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'password' => 'required|min:6',
            'income' => 'required|numeric',
            'state' => 'required|exists:states,id',
            'income_certificate' => 'nullable|file|max:10240',
        ], [
            'income_certificate.nullable' => 'The income certificate is required.',
            'income_certificate.file' => 'The income certificate must be a file.',
            'income_certificate.max' => 'The income certificate should not be greater than 10 MB.',
        ]);

        $user = User::updateOrCreate([
            'id' => $request->id,
        ], [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'income' => $request->income,
            'state_id' => $request->state,
        ]);

        if ($request->income_certificate) {
            UserIncomeCertificate::create([
                'user_id' => $user->id,
                'path' =>  $request->file('income_certificate')->store('income_certificates'),
            ]);
        }

        $user->assignRole('user');

        return response()->json([
            'message' => 'User registered successfully.',
            'data' => [
                'user' => $user,
            ]
        ]);
    }

    public function addWishlist(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'wishLists' => 'required|array',
            'wishLists.*.name' => 'required',
            'wishLists.*.image' => 'nullable',
            'wishLists.*.dob' => 'required',
            // 'wishLists.*.birth_certificate' => 'required',
            'wishLists.*.wishListLink' => 'required',
            'wishLists.*.about' => 'required',
            'wishLists.*.gender' => 'required',

        ]);

        foreach ($request->wishLists as $wishList) {

            $wishListObj = new WishList();

            $age = $wishListObj->calculateAge($wishList['dob']);

            WishList::create([
                'user_id' => $request->user_id,
                'name' => $wishList['name'],
                'date_of_birth' => $wishList['dob'],
                'wish_list_link' => $wishList['wishListLink'],
                'about' => $wishList['about'],
                'image_path' => isset($wishList['image']) ? $wishList['image']->store('childrens') : null,
                // 'birth_certificate_path'=>$wishList['birth_certificate']->store('birth_certificates'),
                'age' => $age,
                'gender' => strtolower($wishList['gender'])
            ]);
        }

        $user = User::find($request->user_id);

        // make the user login

        auth()->login($user);

        return response()->json([
            'message' => "WishList added successfully. We will review and approve it soon. \n\n You can check the status in your profile.",
            'data' => [
                'user' => $user,
            ]
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
}
