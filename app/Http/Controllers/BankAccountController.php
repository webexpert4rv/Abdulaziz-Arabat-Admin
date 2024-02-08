<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\BankAccount;

class BankAccountController extends Controller
{
     
    public function index()
    {
        $getData=BankAccount::orderBy('id','DESC')->get();
        return view('bankAccount.index',compact('getData'));
    }

     
    public function create()
    {
         return view('bankAccount.add');
    }

     
    public function store(Request $request)
    {

         BankAccount::create($request->all());
         return redirect()->route('bank-account.index')->with('success','Bank account created successfully');
    }

    
    public function show($id)
    {
        $product=BankAccount::find($id);
        return view('bankAccount.view',compact('product'));
    }

     
    public function edit($id)
    {
        $data=BankAccount::find($id);
        return view('bankAccount.edit',compact('data'));
    }

     
    public function update(Request $request, $id)
    {
        $data['vendor_name']=$request->vendor_name;
        $data['bank_name']=$request->bank_name;
        $data['account_number']=$request->account_number;
        $data['iban_no']=$request->iban_no;
        BankAccount::where('id',$id)->update($data);
        return redirect()->route('bank-account.index')->with('success','bank account updated successfully');
    }

     
    public function destroy($id)
    {
       BankAccount::where('id',$id)->delete();
       return 1;
    }

    
    public function updateBankAccountStatus(Request $request)
    {
       BankAccount::where('id',$request->id)->update(['status'=>$request->status]);
       return 1;
    }
}
