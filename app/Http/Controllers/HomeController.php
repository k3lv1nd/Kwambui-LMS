<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Http\Request;
use App\User;
use App\User_role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
//use App\Http\Controllers\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $user;
    //User model injected
    public function __construct(User $user)
    {
//        $this->middleware('auth');

        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()){
            return redirect('/login');
        }
        $user= User::where('id',Auth::user()->id)->first();

        return view('home' );
    }

    //get user role
    public function getLoggedInUserRole ()
    {
        $userid=Auth::user()->id;
        $role=User::with('roles')->where('id',$userid)->first();
        if(count($role->roles)<1){
            return response()->json(['message'=>'You have Not been Assigned Any Role, Contact Admin!']);
        }else{
            return $role->roles[0]['name'];
        }

    }
    //get user details: remember to combine  with getLoggedIn user/ Should be a single query to get all user details
    public function getCurrentUserDetails ()
    {
        return $user = User::where('id',Auth::user()->id)->first();
    }


    //add User
    public function postUser (Request $request)
    {
        $user = $this->user ;
        $user->name = $request->get('name');
        $user->email= $request->get('email');
        $user->password =Hash::make($request->get('password'));
        $user->department_id = $request->get('department');
        $user->save();

        $user_role = new User_role();
        $user_role->user_id = $user->id;
        $user_role->role_id=$request->get('role');
        if ($user_role->save()){
            $notification=[
                'status'=>'success',
                'message'=>'User Successfully Added!'
            ];
        }else{
            $notification=[
                'status'=>'error',
                'message'=>'Internal System Error! User not Added!'
            ];
            return response()->json($notification);
        }
        //user added mail notification
        $title = 'Loan management system login credentials';
        $content = 'Dear '.$request->get('name').' You have been added to the loan management system. Proceed to log into the
                    system using the following credentials: Email Adress:'.$request->get('email').' Password:'.$request->get('password'). 'Click the following link to log in';
        $link = 'http://kwambuilms.dev.ml/';


        $this->usermail= $request->get('email');

        Mail::send( 'mail.send',['title' => $title, 'content' => $content,'link'=>$link], function ($message)
        {

            $message->from('kwambui@cytonn.com', 'kelvin k. wambui');

            $message->to($this->usermail);

        });

        return response()->json($notification);
    }



    //get all users
    public function getAll()
    {
//        return User::with(['roles'])->get();
        return User::all()->map( function ($user) {

            return [
                'name' =>  $user->name,
                'email' => $user->email,
                'date' => Carbon::parse($user->created_at)->toFormattedDateString(),
                'role' => count($user->roles)>0 ?$user->roles[0]['name']:'No Set'
            ];
        });
    }


}
