<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

use App\Models\Loan as Loan;
use App\Models\User as User;

use Auth;


use DB;
use Carbon\Carbon;

class LoanController extends Controller
{
    // Show all loans open
    public function indexOpen(){
        $userId = Auth::user()->id;
        if(User::where('id', $userId)->exists()){
            $loans = User::find($userId)->where('payedOn', NULL)->sortBy('createdAt');
            if(count($loans) == 0){
                    return response()->json([
                        'Message' => "No loans found"
                    ]);
                }
        }
        $loans = $loans->values()->all();
        return $loans;
    }

    // Show all loans
    public function indexAll(){
        $userId = Auth::user()->id;
        if(User::where('id', $userId)->exists()){
            $loans = User::find($userId)->myLoans->sortBy('createdAt');
            if(count($loans) == 0){
                    return response()->json([
                        'Message' => "No loans found"
                    ]);
                }
        }
        return $loans;
    }

    // Show payed loans
    public function indexPayed(){
        $userId = Auth::user()->id;
        if(User::where('id', $userId)->exists()){
            $loans = User::find($userId)->myLoans->where('payedOn', '!=', NULL)->sortBy('createdAt');
            if(count($loans) == 0){
                    return response()->json([
                        'Message' => "No loans found"
                    ]);
                }
        }
        return $loans;
    }

    // Show loan by id
    public function showLoan($id){
        // error_log($id);
        if(Loan::where('id', $id)->exists()){
            $loan = Loan::where('id', $id)->get();
            return $loan;
        }else{
            return response()->json(["No loan found with given id"],404);
        }
        
    }

    // add new loan
    public function storeLoan(Request $request, Loan $loan){
        $loan->firstName = $request->input('firstName');
        $loan->lastName = $request->input('lastName');
        $loan->amount = $request->input('amount');
        $loan->title = $request->input('title');
        $loan->reason = $request->input('reason');
        $loan->phoneNumber = $request->input('phoneNumber');
        $loan->createdAt = Carbon::now("Europe/Amsterdam");
        $loan->user_id = Auth::user()->id;

        try{
            $loan->save();
            return response()->json([
                "message" => "Loan added succesfully"
            ]);
        }catch(Exception $e){
            return response()->json([
                "message" => "Adding loan failed"
            ]);
        }
    }

    //  pay loan 
    public function updateLoan($id){
        if(Loan::where('id', $id)->exists()){
            $loan = Loan::where('id', $id)->first();
            $payTime = Carbon::now("Europe/Amsterdam");
            try{
                DB::table('loans')
                    ->where('id', $loan->id)
                    ->update([
                        'payedOn' => $payTime
                    ]);
                return response()->json([
                    "message" => "Loan Payed"
                ]);
            }catch(Exception $e){
                return response()->json([
                    "message" => "Failed to Pay"
                ]);
            }
        }else{
            return response()->json([
                "message" => "Failed to find loan with given id"
            ]);
        }
    }
}
