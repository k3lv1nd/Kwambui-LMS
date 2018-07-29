<?php

namespace App\Http\Controllers;

use App\Loan;
use App\LoanRepository;
use Illuminate\Http\Request;

use Auth;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $loanrepository;




    public function __construct(LoanRepository $loanrepository)
    {

        $this->loanrepository = $loanrepository;

    }



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
        return $this->loanrepository->LoanRequest($request);
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


    public function getemployeeLoans()
    {

      $userId = Auth::user()->id;

    $data=$this->loanrepository->getemployeeLoans($userId);

    return response()->json($data);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
    public function ApproverGetLoansRequests()
    {
         return $this->loanrepository->GetLoansForApproval();
    }
    public function DepartmentLoanApproval(Request $request){
        return $this->loanrepository->DepartmentLoanApproval($request->all());
    }
    public function DepartmentLoanRejection(Request $request){
        return $this->loanrepository->DepartmentLoanRejection($request->all());
    }
}
