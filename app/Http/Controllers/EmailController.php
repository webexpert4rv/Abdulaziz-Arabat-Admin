<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Config;
use App\Models\EmailTemplate;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $email_templates=EmailTemplate::get();
       return view('email.index',compact('email_templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $users= User::where('role_id',Config::get('variables.User'))->get();
       return view('email.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $data['user_id']    =   implode(',',$request->user_id);
        //dd($data);
        EmailTemplate::create($data);
        return redirect()->route('emails.index')->with('success','Email Template created successfuly');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $email_template=EmailTemplate::where('id',$id)->first();
        $users=User::whereIn('id',explode(',',$email_template->user_id))->get();
        return view('email.view',compact('email_template','users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $users= User::where('role_id',Config::get('variables.User'))->get();
        $email_template=EmailTemplate::find($id);

        return view('email.edit',compact('users','email_template'));
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
        $data=$request->except(['_method','_token']);
        $data['user_id']    =   implode(',',$request->user_id);
        //dd($data);
        EmailTemplate::where('id',$id)->update($data);
        return redirect()->route('emails.index')->with('success','Email Template updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EmailTemplate::where('id',$id)->delete();
        return 1;
    }
    public function sendEmailUsers(Request $request){

        $email_template=EmailTemplate::where('id',$request->id)->first();

 
        $getUsers=User::whereIn('id',explode(',',$email_template->user_id))->get();


        foreach ($getUsers as $key => $user) {

            echo $user->email;


                    $emailData['name']    =   $user->name;
                    $emailData['email']    =  $user->email;                    
                    $emailData['subject']  =  $email_template->subject;
                    $emailData['body']    =   $email_template->description;                   
                    $view                 =   'emails.email_template';
                    $data =  sendMail($view,$emailData);  
             
        }

             return 1;
    }
}
