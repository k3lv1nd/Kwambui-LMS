<?php

namespace App;

use App\Loan;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use DB;



class LoanRepository {

     private $userId;

    public function LoanRequest ($request)
    {

        Loan::create(array(
            'user_id'=>$request->user_id,
            'amount' => $request->amount,
            'loan_intrest' => $request->loan_intrest,
            'type' => $request->type,
            'duration' => $request->duration,
            'status' => $request->status,

        ));

        $approver=DB::table('users')
            ->join('user_role','users.id','=','user_role.user_id')
            ->where(['users.department_id'=>$request->user_department_id,'user_role.role_id'=>2])
            ->select('users.*','user_role.role_id')
            ->take(1)->get()->toArray();


        $name=$approver[0]->name;
        $email=$approver[0]->email;

        if (!empty($email)&&!empty($name)){


            $title = 'Loan Approval Request';
            $content = 'Dear '.$name.', '.$request->username.'  has requested a loan that requires your approval. Pleae Log in 
             to the loan management system via the link below to review the loan request';
            $link = 'http://kwambuilms.dev.ml/';


            $this->usermail= $email;

            Mail::send( 'mail.approvernotification',['title' => $title, 'content' => $content,'link'=>$link], function ($message)
            {

                $message->from('kwambui@cytonn.com', 'kelvin k. wambui');

                $message->to($this->usermail);

            });
           // return response()->json($notification);

        }








    }


    public function getemployeeLoans ($id)
    {
        return Loan::where('user_id',$id)->get();

    }




}