<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Http\Request;
use App\User;
use App\User_role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $user;

    public function __construct(User $user)
    {
        //$this->middleware('auth');

        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function postUser (request $request)
    {

        $user = $this->user ;
        $user->name = $request->get('name');
        $user->email= $request->get('email');
        $user->password =Hash::make($request->get('password'));
        //$user->department = $request->get('department');
        $user->save();

        $user_role = new User_role();
        $user_role->user_id = $user->id;
        $user_role->role_id=$request->get('role');
        $user_role->save ();

        $title = 'Loan management system login credentials';
        $content = 'Dear '.$request->get('name').' You have been added to the loan management system';

       $this->usermail= $request->get('email');

        Mail::send( 'mail.send',['title' => $title, 'content' => $content], function ($message)
        {

            $message->from('kwambui@cytonn.com', 'kelvin k. wambui');

            $message->to($this->usermail);

        });

        return response()->json(['message' => 'Request completed']);

        //return response()->json($user, 201);


    }

    public function getAll()
    {

        return User::all()->map( function ($user) {
            return [
                'name' =>  $user->name,
                'email' => $user->email,
                'date' => Carbon::parse($user->created_at)->toFormattedDateString(),
                'role' => count($user->roles) ? $user->roles->last()->first()->name : null
            ];
        });
    }
}
