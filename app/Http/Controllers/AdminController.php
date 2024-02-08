<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Job;
use App\Models\EmailTemplate;
use App\Models\Transaction;
use App\Models\TransporterWallet;
use App\Models\UserRefund;
use App\Models\Page;
use App\Models\Banner;
use App\Models\ContactUs;
use App\Models\Reviews;
use App\Models\Testimonial;
use App\Models\Booking;
use Auth;
use Hash;
use Session; 
use Config; 
class AdminController extends Controller
{


	public function dashboard(Request $request) {

		$totalUsers				=	User::where('role_id',Config::get('variables.User'))->count();

		$totalTransporters		=	User::where('role_id',Config::get('variables.Transporter'))->count();

		$totalAdmin		    	=	Admin::count();

		$totalJob		    	=	Job::count();

		$totalBooking		    =	Booking::count();

		$totalEmailTemplates	=	EmailTemplate::count();

		$transporterWallets 	=	TransporterWallet::count();

		$totalRefunds       	=	UserRefund::count();

		$websitePages        	=	Page::where('device_type','web')->count();

		$mobilePages        	=	Page::where('device_type','mobile')->count();
		 
		$totalBanner       		=	Banner::count();

		$totalContactUs    		=	ContactUs::count();

		$totalReviews        	=	Reviews::count();

		$totalTestimonials    	=   Testimonial::count();

		$totalPayments			=	Transaction::count();

		$totalSale				=	Transaction::count();
 
 

		$totalAmount = array();
		for($i = 1; $i<=12; $i++){

			$transaction_amount = Transaction::select('amount')
			->whereYear('created_at', date('Y'))
			->whereMonth('created_at', '=', $i)
			->sum('amount');
			array_push($totalAmount,$transaction_amount);
		}

		$totaldriverAmount = array();
		for($i = 1; $i<=12; $i++){

			$transaction_driver_amount = TransporterWallet::select('amount')
			->whereYear('created_at', date('Y'))
			->whereMonth('created_at', '=', $i)
			->sum(\DB::raw('amount + admin_commission'));
			array_push($totaldriverAmount,$transaction_driver_amount);
		}

		return view('dashboard',compact('totalUsers','totalTransporters','totalAdmin','totalJob','totalBooking','totalEmailTemplates','transporterWallets','totalRefunds','websitePages','mobilePages','totalBanner','totalContactUs','totalReviews','totalTestimonials','totaldriverAmount','totalAmount','totalSale','totalPayments'));
	}



	/**
	 * This function is used to Show Admin Profile
	*/
	public function adminProfile(Request $request) {
		$userDetails = Admin::findOrFail(Auth::id());
		return view('admin_profile')->with('userDetails', $userDetails );
	}

	/**
	 * This function is used to Update Admin Profile
	*/
	public function updateProfile(Request $request) {
		
		$validatedData = $request->validate([
			'name' => 'required',
		], [
			'name.required' => 'Name is required',
		]);
		$updateProfile = Admin::where('id', $request->id)->update(['name' => $request->name]);
		if($updateProfile) {
			return back()->with('success', 'Profile Updated Successfully!');
		}
		else {
			return back()->with('error', 'Something went wrong! Please try again later.');
		}
	}

	public function checkPassword(Request $request) {
		$passwordType = $request['password_type'];
		$admin = Admin::find(Auth::id());
		if($passwordType == 'old') {
			if(Hash::check($request->password, $admin->password) == false) {
				return true;
			}
			else if(Hash::check($request->password, $admin->password) == true) {
				return false;
			}
		}
		else if($passwordType == 'new') {
			if(Hash::check($request->password, $admin->password) == false) {
				return false;
			}
			else {
				return true;
			}
		} 
	}

	/**
	 * This function is used to Change Admin Password
	*/
	public function changePassword(Request $request) {
		$changePassword = Admin::where('id', Auth::id())->update(['password' => Hash::make($request->password)]);
		if($changePassword) {
			return back()->with('success', 'Password Updated Successfully!');
		}
		else {
			return back()->with('error', 'Something went wrong! Please try again later.');
		}
	}

	public function setSession(Request $request){
		Session::put('timezone', $request->timezone);
		return Session::get('timezone');
	}
	public function logout(){
		Auth::logout();
		return redirect('/login');
	}

}
