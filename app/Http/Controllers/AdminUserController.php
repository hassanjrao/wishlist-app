<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::latest()
        ->whereHas('roles',function($q){
            $q->where('name','user');
        })
        ->with(['wishLists','incomeCertificates'])
        ->get();


        return view('admin.users.index',compact('users'));
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
        $user=User::findorfail($id);


        // hard delete
        $user->wishLists()->forceDelete();
        $user->incomeCertificates()->forceDelete();
        $user->forceDelete();

        return redirect()->back()->withToastSuccess('User deleted successfully');
    }


    public function approve($id)
    {
        $user=User::findorfail($id);
        $user->update([
            'is_approved'=>1
        ]);

        return redirect()->back()->withToastSuccess('User approved successfully');
    }

    public function wishLists($id)
    {
        $user=User::findorfail($id);

        $wishLists=$user->wishLists;

        return view('admin.wishLists.index',compact('wishLists','user'));
    }
}
