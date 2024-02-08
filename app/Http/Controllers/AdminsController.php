<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use Auth;
use Illuminate\Support\Facades\Validator;
use Hash;
use DB;

class AdminsController extends Controller {
	
	/**
	 * This function is used to Check if the email exists in the table
	*/
	public function checkEmail() {
		$tableName = $_GET['table_name'];
		if(isset($_GET['id'])) {
			$emailExists = DB::table($tableName)->where('email', $_GET['email'])->where('id', '!=', $_GET['id'])->get();
			if ($emailExists->isNotEmpty()) {
				return true;
			}
			else {
				return false;
			}
			exit;
		}
		else {
			$emailExists = DB::table($tableName)->where('email', $_GET['email'])->get();
			if ($emailExists->isNotEmpty()) {
				return true;
			}
			else {
				return false;
			}
			exit;
		}
	}
	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make($data, [
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:recruiters'],
			'role' => ['required']
		]);
	}
	/**
	 * This function is used to Show Admins Listing
	*/
	public function adminsList(Request $request) {
			$user=Auth::guard('admin')->user();
			$adminsList = Admin::with('role')->orderBy('id','desc')->where('role_id','!=',1)->get();
			return view('admins/admins_list', ['adminsList' => $adminsList,'admin_user'=>$user]);
		
	}

	// filter
	public function filter(Request $request){
	$date_range = $request->date_range;

	if($request->reset){
	  $adminsList = $adminsList = Admin::where('role_id', '!=', 1)->where('id', '!=', Auth::id())->orderBy('email')->get();
	}else{
	  $adminsList = Admin::where('role_id', '!=', 1)->where('id', '!=', Auth::id())->orderBy('email')->where('created_at','>=',date('Y-m-d',strtotime($date_range[0])))->where('created_at','<=',date('Y-m-d',strtotime($date_range[1])))->get();
	}

	// test
	$result_view = view('admins.partial',['adminsList'=>$adminsList])->render();
	    return json_encode(['html'=> $result_view,'status'=>true]);
	}
	// filter

	/**
	 * This function is used to Show Admins Listing
	*/
	public function addAdmin(Request $request) {
		
			$roles = Role::orderBy('name')->where('id','!=',1)->where('role_type', 'admins')->get();
			
			return view('admins/add_admin', ['roles' => $roles]);
		
	}

	/**
	 * This function is used to Show Admins Listing
	*/
	public function saveAdmin(Request $request) {
		// return $request;
		$admin = new Admin;
		$admin->full_name = $request->name;
		$admin->email = $request->email;
		$admin->role_id = $request->role_id;
		$admin->password = Hash::make($request->password);
		if($admin->save()) {
			return redirect()->route('admins_list', ['admin' => $admin])->with('success', 'Admin Creaed Successfully!');
		}
		else {
			return redirect()->back()->with('error', 'Something went wrong!');
		}
		return view('admins/add_admin');
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function viewAdmin($id) {
		
			$viewAdmin = Admin::where('id', $id)->get();
			$deletedAdmins = Admin::onlyTrashed()->get();
			if($viewAdmin->isNotEmpty()) {
				return view('admins/view_admin', ['viewAdmin' => $viewAdmin]);
			}
			else {
				return view('admins/view_admin', ['viewAdmin' => $deletedAdmins]);
			}
		
	}

	/**
	 * This function is used to Show Admins Listing
	*/
	public function editAdmin($id) {
		
			// $roles = Role::orderBy('name')->where('id', '!=', 1)->get();
			$roles = Role::orderBy('name')->where('role_type', 'admins')->get();
			$admin = Admin::find($id);
			return view('admins/edit_admin', ['roles' => $roles, 'admin' => $admin]);
		
	}

	/**
	 * This function is used to Show Admins Listing
	*/
	public function updateAdmin(Request $request) {
		$validatedData = $request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'role_id' => 'required',
		], [
			'name.required' => 'Name is required',
			'email.required' => 'Email is required',
			'email.email' => 'Email is not valid',
			'role_id.required' => 'Role is required',
		]);
		
		$admin=Admin::find($request->id);
		$password= $request->password!=null?bcrypt($request->password):$admin->password; 
		$updateAdmin = Admin::where('id', $request->id)->update([
			'full_name' => $request->name,
			'email' => $request->email,
			'role_id' => $request->role_id,
			'password'=>$password,
		]);
		
		if($updateAdmin) {
			$adminsList = Admin::where('role_id', '!=', 1)->get();
			return redirect()->route('admins_list', ['adminsList' => $adminsList])->with('success', "Admin Updated Successfully!");
		}
		else {
			return back()->with('error', "Something went wrong! Please try again.");
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function deleteAdmin(Request $request) {
		$deleteAdmin = Admin::where('id', $request->id)->delete();
		if($deleteAdmin) {
			$res['success'] = 1;
			return json_encode($res);
		}
		else {
			$res['success'] = 0;
			return json_encode($res);
		}
	}

	public function deleteAdminPermanantly(Request $request){
		$deleteAdmin = Admin::where('id', $request->id)->forceDelete();
		if($deleteAdmin) {
			$res['success'] = 1;
			return json_encode($res);
		}
		else {
			$res['success'] = 0;
			return json_encode($res);
		}
	}

	public function updateAdminStatus(Request $request){
		Admin::where('id',$request->id)->update(['status'=>$request->status]);
		return 1;
	}
	

}
