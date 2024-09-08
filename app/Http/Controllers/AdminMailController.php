<?php

namespace App\Http\Controllers;

use App\Mail\AdminEmail;
use App\Mail\AdminEmailMail;
use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminMailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails=Email::latest()->with(['users'])->get();

        return view('admin.emails.index',compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::latest()->get();
        return view('admin.emails.create',compact('users'));
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
            'users'=>'required|array',
            'users.*'=>'required|exists:users,id',
            'subject'=>'required|string',
            'body'=>'required|string',
        ]);


        $email=Email::create([
            'subject'=>$request->subject,
            'body'=>$request->body,
        ]);

        $email->users()->attach($request->users);

        $users=User::whereIn('id',$request->users)->get();

        foreach ($users as $user){
            Mail::to($user->email)
            ->queue(new AdminEmailMail($email));
        }

        return redirect()->route('admin.emails.index')->with('success','Email(s) will be sent in background in a few minutes');
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
