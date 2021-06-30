<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

use App\Models\Loan as Loan;

use DB;
use Carbon\Carbon;

class LoanController extends Controller
{
    // Show all loans open
    public function indexOpen(){
        $loans = Loan::where('payedOn', NULL)->get();
        if(count($loans) == 0){
            return response()->json([
                'Message' => "No loans found"
            ], 404);
        }
        return $loans;
    }

    // Show all loans
    public function indexAll(){
        $loans = Loan::all();
        error_log($loans);
        if(count($loans) == 0){
            return response()->json([
                'Message' => "No loans found"
            ], 404);
        }
        return $loans;
    }

    // Show payed loans
    public function indexPayed(){
        $loans = Loan::where('payedOn', '!=', NULL)->get();
        if(count($loans) == 0){
            return response()->json([
                'Message' => "No payed loans found"
            ], 404);
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

        try{
            $loan->save();
            return response()->json(["Added loan succesfully"],200);
        }catch(Exception $e){
            return response()->json(["Failed to add loan", $e],400);
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
                return response()->json(["Loan payed"], 200);
            }catch(Exception $e){
                return response()->json(["Failed to pay", $e], 400);
            }
        }else{
            return response()->json(["Failed to find loan with given id"], 400);
        }
    }
}
