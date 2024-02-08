<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\Admin;
use App\Models\Recruiter;
use App\Models\Organization;
use App\Models\Feedback;
use App\Models\ContactUs;
use App\Models\UpdateQuery;
use App\Models\SpecialRequest;
use App\Notifications\TicketAcknowledgement;
use Auth;
use Mail;
use App\Mail\ReplyToUser;

class TicketsController extends Controller {
	
	public function ticketsList() {
		$ticketsList = Ticket::orderByDesc('id')->get();
		return view('tickets/tickets_list', [ 'ticketsList' => $ticketsList ]);
	}

	public function viewTicket($id) {
		$ticket = Ticket::find($id);
		$ticketId = $ticket->id;
		$ticketMessages = TicketMessage::where('ticket_id', $ticketId)->get();
		$superAdmin = Admin::where('role_id', 1)->get();
		$recruiter = Recruiter::find($ticket->recruiter_id);
		$organization = Organization::find($recruiter->organization_id);
		return view('tickets/view_ticket', [
			'ticket' => $ticket,
			'ticketMessages' => $ticketMessages,
			'superAdmin' => $superAdmin,
			'recruiter' => $recruiter,
			'organizationLogo' => $organization->logo
		]);
	}

	public function replyOnTicket(Request $request) {
		$request->validate([
			'message_text' => 'required',
		], [
			'message_text.required' => 'Message is required',
		]);
		$fileName = "";
		if($request->file('attachment_file')) {
			$attachment_file = $request->file('attachment_file');
			// $destinationPath = config('adminlte.website_url').'ticket_images';
			$destinationPath = $_SERVER['DOCUMENT_ROOT'].'/'.config('adminlte.ticket_images_path');
			// $destinationPath = $_SERVER["DOCUMENT_ROOT"].'/which-vocation/website/Amrik-which-vocation-web/public/ticket_images';
			$fileName = uniqid().'.'.$attachment_file->extension();
			$attachment_file->move($destinationPath, $fileName);
		}

		$reply = new TicketMessage;
		$reply->message_text = $request->message_text;
		$reply->ticket_id = $request->ticket_id;
		$reply->attachment_file = $fileName;
		$reply->admin_id = Auth::id();
		$reply->sent_by = 'admin';
		if($reply->save()) {
			$ticketMessage = TicketMessage::where(['ticket_id' => $reply->ticket_id, 'sent_by' => 'recruiter' ])->latest('created_at')->first();
			$recruiter = Recruiter::find($ticketMessage->recruiter_id);
			$admin = Admin::find($reply->admin_id);
			$senderName = $admin->first_name ? $admin->first_name.' '.$admin->last_name : $admin->email;
			$receiverName = $recruiter->first_name ? $recruiter->first_name.' '.$recruiter->last_name : $recruiter->email;
			$ticketLinkSender = config('adminlte.admin_url').'admin_panel/tickets/view/'.$reply->ticket_id;
			$ticketLinkReceiver = config('adminlte.website_url').'recruiter/contact-admin/edit/'.$reply->ticket_id;
			$userType = $reply->sent_by == 'admin' ? 'sender' : 'receiver';
			$messageText = $reply->message_text;
			$file = config('adminlte.website_url').'ticket_images/'.$reply->attachment_file;
			$messageSender = config('adminlte.ticket_acknowledgement_message_sender');
			$messageReceiver = config('adminlte.ticket_acknowledgement_message_receiver');
			$link = $userType == 'sender' ? $ticketLinkSender : $ticketLinkReceiver;
			$admin->notify(new TicketAcknowledgement($messageText, $messageSender, $ticketLinkSender));
			$recruiter->notify(new TicketAcknowledgement($messageText, $messageReceiver, $ticketLinkReceiver));
			// Mail::to($admin->email)->cc(['ashish_kumar@rvtechnologies.com', 'pawanjeet@rvtechnologies.com'])->send(new TicketAcknowledgement( $senderName, $messageText, $ticketLinkSender, 'sender'/* , $attachedFile */ ));
			// Mail::to($recruiter->email)->send(new TicketAcknowledgement( $receiverName, $messageText, $ticketLinkReceiver, 'receiver'/* , $attachedFile */ ));
			$ticket = Ticket::find($reply->ticket_id);
			$ticketId = $ticket->id;
			$ticketMessages = TicketMessage::where('ticket_id', $ticketId)->get();
			return back()->with([
				'ticket' => $ticket,
				'ticketMessages' => $ticketMessages
			]);
		}
		else {
			return back()->with('error', 'Something went wrong!');
		}
	}

	public function closeTicket(Request $request) {
		$closeTicket = Ticket::where('id', $request->id)->update([ 'status' => 'close' ]);
		if($closeTicket) {
			$ticketsList = Ticket::all();
			$res['success'] = 1;
			$res['data'] = $ticketsList;
			return json_encode($res);
		}
		else {
			$res['success'] = 0;
			return json_encode($res);
		}
	}

	public function openTicket(Request $request) {
		$openTicket = Ticket::where('id', $request->id)->update([ 'status' => 'open' ]);
		if($openTicket) {
			$ticketsList = Ticket::all();
			$res['success'] = 1;
			$res['data'] = $ticketsList;
			return json_encode($res);
		}
		else {
			$res['success'] = 0;
			return json_encode($res);
		}
	}

	public function feedbacksList(Request $request) {
		if(Auth::user()->can('view_feedback')) {
			$feedbacksList = Feedback::orderByDesc('id')->get();
			return view('feedbacks/feedbacks_list', [ 'feedbacksList' => $feedbacksList ]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	public function viewFeedback($id) {
		if(Auth::user()->can('view_feedback')) {
			$feedback = Feedback::find($id);
			return view('feedbacks/view_feedback', [ 'feedback' => $feedback ]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	public function contactUsMessagesList(Request $request) {
		$contactUsMessagesList = ContactUs::orderByDesc('id')->get();
		//dd($contactUsMessagesList); 
		return view('contact_us/contact_us_list', ['contactUsMessagesList' => $contactUsMessagesList]);
	}



	public function viewContactUsMessage($id) {
		$contactUsMessage = ContactUs::find($id);
		return view('contact_us/view_contact_us_message', [ 'contactUsMessage' => $contactUsMessage ]);
		
	}

	public function updateStatus(Request $request){
		$contactUsMessage = ContactUs::find($request->id);
		$contactUsMessage->status = $request->status;
		if($contactUsMessage->save()){

			return response()->json([
			    'status' => true,
			    'message' => 'Status Updated successfully!',
			]);

		}else{

			return response()->json([
			    'status' => false,
			    'message' => 'Something went wrong!',
			]);

		}
	}

	public function filter(Request $request){

		if($request->reset){
			$contactUsMessagesList = ContactUs::get();
		}else{
			$contactUsMessagesList = ContactUs::where('status',$request->status)->get();
		}

		$result_view = view('contact_us.partial',['contactUsMessagesList'=>$contactUsMessagesList])->render();
        return json_encode(['html'=> $result_view,'status'=>true]);
		
	}


	public function reply($id){
		$contact_us = ContactUs::find($id);
		return view('contact_us.reply')->with(['contact_us'=>$contact_us]);
	}

	public function SendReply(Request $request){
		try{

			$subject = "RE:".$request->subject;
			$data['msg']= $request->message;
			$data['signature']= $request->signature;
			$contact_us = ContactUs::find($request->id);
			$data['username']=$contact_us->name;
			
			Mail::send('emails.reply_to_user', $data, function ($message) use($subject,$contact_us){
		    $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
		    $message->subject($subject );
		    $message->to($contact_us->email);
		});
			return redirect()->back()->with('success','Reply has been sent successfully!');
		}catch(\Exception $e){
			return redirect()->back()->with('error',$e->getMessage());
		}
	}

	public function specialRrequestlist(Request $request) {

		$specialRequests = SpecialRequest::orderByDesc('id')->get();



		return view('contact_us/special_request_list', compact('specialRequests'));
	}

public function updateInformationList(Request $request) {
		$updateinformationlist = UpdateQuery::orderByDesc('id')->get();
		//dd($contactUsMessagesList); 
		return view('update-info/update_info_list', ['updateinformationlist' => $updateinformationlist]);
	}


public function viewupdateInformationMessage($id) {
		$updateInformationMessage = UpdateQuery::find($id);
		return view('update-info/view_update_info_message', [ 'updateInformationMessage' => $updateInformationMessage ]);
		
	}

public function reply1($id){
		$update_information = UpdateQuery::find($id);
		return view('update-info.reply1')->with(['update_information'=>$update_information]);
	}

public function SendReply1(Request $request){
		try{ 

			$subject = "RE:".$request->subject;
			$data['msg']= $request->message;
			$data['signature']= $request->signature;
			$contact_us = UpdateQuery::find($request->id);
			//dd($contact_us);
			$data['username']=$contact_us->name;
			
			Mail::send('emails.reply_to_user', $data, function ($message) use($subject,$contact_us){
		    $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
		    $message->subject($subject );
		    $message->to($contact_us->old_email);
		});
			return redirect()->back()->with('success','Reply has been sent successfully!');
		}catch(\Exception $e){
			return redirect()->back()->with('error',$e->getMessage());
		}
	}



}
