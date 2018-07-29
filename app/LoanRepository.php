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
           return response()->json(['status'=>'success','message'=>'Loan Request Successsfully sent!']);

        }else{
            return response()->json(['status'=>'error','message'=>'System Error!,Contact Admin!']);
        }








    }


    public function getemployeeLoans ($id)
    {
        return Loan::where('user_id',$id)->get();

    }

    public function GetLoansForApproval(){
        $approver_department_id=Auth::user()->department_id;
        $users_with_loans_request= User::with('loans')
            ->where(['department_id'=>$approver_department_id])
            ->whereHas('loans',function($loan){
                $loan->where('status','0');
            })
            ->get();

        if (count($users_with_loans_request)>0){
            return response()->json($users_with_loans_request);
        }else{
            return response()->json(['message'=>'There are no Loans Requests Available']);
        }
    }

    public function DepartmentLoanApproval($data){
        $loan_id=$data['id'];
        //for departmental approval update status to ABD
        //ABD=Approved By Department
        $hr_approver=User::where('department_id','2')->whereHas('roles',function($role){
            $role->where('name','approver');
        })->first();

        $update= Loan::where('id',$loan_id)->update(['status'=>'ABD']);
        if($update){

            if (!empty($hr_approver->email)&&!empty($hr_approver->name)){
                $name=$hr_approver->name;
                $email=$hr_approver->email;
                $title = 'Loan Approval Request';
                $content = 'Dear '.$name.', There is a loan that requires your approval. Pleae Log in 
             to the loan management system via the link below to review the loan request';
                $link = 'http://kwambuilms.dev.ml/';


                $this->usermail= $email;

                Mail::send( 'mail.approvernotification',['title' => $title, 'content' => $content,'link'=>$link], function ($message)
                {

                    $message->from('kwambui@cytonn.com', 'kelvin k. wambui');

                    $message->to($this->usermail);

                });
                return response()->json(['status'=>'success','message'=>'Loan Successfully Approved At Department Level']);
            }
        }else{
            return response()->json(['status'=>'error','message'=>'System Error, At Departmental Approval Level']);
        }
    }

    public function DepartmentLoanRejection($data){
        $loan_id=$data['id'];

        $update= Loan::where('id',$loan_id)->update(['status'=>'DBD']);
        if($update)
        {
            return responnse()->json(['status'=>'success','message'=>'Loan Successfully Rejected At Department Level']);
        }
        else{
            return responnse()->json(['status'=>'error','message'=>'System Error, At Departmental Approval Level']);
        }
    }




}