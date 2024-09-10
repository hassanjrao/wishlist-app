<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\UserIncomeCertificate;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = auth()->user();
        $states=State::all();
        return view('user.profile.index', compact('user','states'));
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
        //
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|min:6',
            'income' => 'required|numeric',
            'state' => 'required|exists:states,id',
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'income' => $request->income,
            'state_id' => $request->state,
        ]);

        if ($request->password) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        if ($request->hasFile('tax_return_certificate')) {

            UserIncomeCertificate::create([
                'user_id' => $user->id,
                'path' => $request->file('tax_return_certificate')->store('income_certificates'),
            ]);

            $user->update([
                'has_tax_return' => 1,
                'is_verified_low_income' => 0,
            ]);
        }

        return redirect()->route('user.profile.index')->withToastSuccess('Profile updated successfully.');
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
