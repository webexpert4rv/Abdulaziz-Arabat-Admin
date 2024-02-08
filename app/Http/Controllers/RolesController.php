<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Admin;
use Auth;

class RolesController extends Controller {
	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function rolesList(Request $request) {
		//if(Auth::user()->can('view_role')) {
			// $roles = Role::orderBy('name')->where('id', '!=', 1)->get();
			$roles = Role::orderBy('name')->where('id','!=',1)->where('role_type','admins')->get();
			return view('roles/roles_list', ['roles' => $roles]);
		// }
		// else {
		// 	return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		// }
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function viewRole($id) {
		//if(Auth::user()->can('view_role')) {
			$role = Role::find($id);
			$permissions = \DB::table('permission_role')->where('role_id', $role->id)->get();
			return view('roles/view_role', [
				'role' => $role,
				'permissions' => $permissions,
			]);
		// }
		// else {
		// 	return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		// }
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function addRole(Request $request) {
		//if(Auth::user()->can('add_role')) {
			return view('roles/add_role');
		// }
		// else {
		// 	return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		// }
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function saveRole(Request $request) {
		$nameToLowercase = strtolower($request->role_name);
		$roleTag = $name = str_replace(' ', '_', $nameToLowercase);
		$role = Role::where("tag", $roleTag)->get();
		if(count($role) <= 0) {
			$role = new Role;
			$role->name = $request->role_name;
			$role->tag = $roleTag;
			$role->role_type = 'admins';
			$role->status = '1';
			if($role->save()) {
				$roles = Role::where('id', '!=', '1')->get();
				return redirect()->route('roles_list', ['roles' => $roles])->with('success', 'Role Added successfully!');
			}
			else {
				return redirect()->back()->with('error', 'Something went wrong!');
			}
		}
		else {
			$roles = Role::where('id', '!=', '1')->get();
			return redirect()->route('roles_list', ['roles' => $roles])->with('error', 'The Role already exists! Please edit the Role if you want to make any changes.');
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function editRole($id) {
		if(Auth::user()->can('edit_role')) {
			$role 		= Role::find($id);
			return view('roles/edit_role', [
				'role' 	=> $role
			]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Update Role
	*/
	public function updateRole(Request $request) {
		$updateRole 	= Role::where('id', $request->id)->update([
			'name' 		=> $request->name
		]);
		if($updateRole) {
			$roles 		= Role::orderByDesc('id')->get();
			return redirect()->route('roles_list', ['roles' => $roles])->with('success', 'Role Updated successfully!');
		}

	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function getRolePermissions(Request $request) {
		$rolePermissions 	= \DB::table('permission_role')->where('role_id', $request->role_id)->get();
	
		return json_encode($rolePermissions);
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function rolePermissions(Request $request) {
		//if(Auth::user()->can('add_permissions')) {
			// $roles = Role::orderBy('name')->whereIn('tag', ['super_admin','admin'])->get();
			// $roles = Role::orderBy('name')->where('tag','!=', 'super_admin')->get();
			$roles 								= 	Role::orderBy('name')->where('role_type', 'admins')->where('id','!=',1)->get();

			if($roles->isNotEmpty()) {
				$adminsPermissions   			= 	Permission::where('module_slug', 'manage_admins')->get();
				$appUsersPermissions 			= 	Permission::where('module_slug', 'manage_user')->get();
				$transporterPermissions			=	Permission::where('module_slug', 'manage_transporter')->get();
				$driversPermissions				=	Permission::where('module_slug', 'manage_driver')->get();
				$jobsPermissions				=	Permission::where('module_slug', 'manage_jobs')->get();
				$jobsBookedPermissions			=	Permission::where('module_slug', 'manage_job_booked')->get();
				$emailPermissions				=	Permission::where('module_slug', 'manage_email')->get();
				$paymentPermissions				=	Permission::where('module_slug', 'manage_payment')->get();
				$webisteContentPermissions		=	Permission::where('module_slug', 'manage_website_content')->get();
				$mobileContentPermissions		=	Permission::where('module_slug', 'manage_mobile_content')->get();
				$bannerPermissions				=	Permission::where('module_slug', 'manage_banner')->get();
				$feedbackPermissions			=	Permission::where('module_slug','manage_feedback')->get();
				$reviewsPermissions				=	Permission::where('module_slug', 'manage_reviews')->get();
				$testimonialsPermissions		=	Permission::where('module_slug', 'manage_testimonials')->get();
				$RepostsPermissions				=	Permission::where('module_slug', 'manage_reports')->get();
				$miscPermissions				=	Permission::where('module_slug', 'manage_misc')->get();
				$tranporterWalletsPermissions	=	Permission::where('module_slug', 'manage_transporter_wallets')->get();
				$userRefundsPermissions			=	Permission::where('module_slug', 'manage_user_refunds')->get();
				$accessControlPermissions		=	Permission::where('module_slug', 'manage_permission')->get();
				$recycleBinPermissions			=	Permission::where('module_slug', 'manage_recycle_bin')->get();
				$rolesPermissions				=	Permission::where('module_slug', 'manage_roles')->get();
				$blogPermissions				=	Permission::where('module_slug', 'manage_blog')->get();
				
				

				return view('roles/role_permissions', [
					'roles' => $roles,
					'adminsPermissions' 			=> 	$adminsPermissions,
					'appUsersPermissions'			=>	$appUsersPermissions,
					'transporterPermissions'		=>	$transporterPermissions,
					'driversPermissions'			=>	$driversPermissions,
					'jobsPermissions'				=>  $jobsPermissions,
					'emailPermissions'				=>  $emailPermissions,
					'paymentPermissions'			=>  $paymentPermissions,
					'webisteContentPermissions' 	=>  $webisteContentPermissions,
					'mobileContentPermissions' 		=>  $mobileContentPermissions,
					'bannerPermissions'				=>	$bannerPermissions,
					'feedbackPermissions'			=>	$feedbackPermissions,
					'reviewsPermissions'			=>	$reviewsPermissions,
					'testimonialsPermissions'		=>	$testimonialsPermissions,
					'RepostsPermissions'			=>	$RepostsPermissions,
					'miscPermissions'				=>	$miscPermissions,
					'jobsBookedPermissions'			=>	$jobsBookedPermissions,
					'tranporterWalletsPermissions'	=>	$tranporterWalletsPermissions,
					'userRefundsPermissions'		=>	$userRefundsPermissions,
					'accessControlPermissions'		=>	$accessControlPermissions,
					'recycleBinPermissions'			=>	$recycleBinPermissions,
					'rolesPermissions'				=>	$rolesPermissions,
					'blogPermissions'				=>	$blogPermissions,
					
				]);
			}
			else {
				return redirect()->route('add_role')->with('warning', 'No Roles Found! Please add a Role first.');
			}
		// }
		// else {
		// 	return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		// }
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function saveRolePermissions(Request $request) {
		$role 				=  Role::find($request->role_id);
		
		$updatePermissions 	=  $role->permissions()->sync($request->permissions);
		if($updatePermissions) {
			$roles = Role::where('id', '!=', 1)->get();
			return back()->with('success', 'Role Permissions Added successfully!');
		}
		else {
			return redirect()->back()->with('error', 'Something went wrong!');
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function deleteRole(Request $request) {
		$admin 		= Admin::where('role_id', $request->id)->first();
		if($admin != null) {
			$res['success'] = 0;
			$res['message'] = "You cannot delete this record as it's being used.";
			return json_encode($res);
		}
		else {
			$role = Role::where('id', $request->id)->first();
			$role->permissionRoles()->delete();
			$role->admins()->delete();
			$deleteRole = $role->delete();
			if($deleteRole) {
				$res['success'] = 1;
				return json_encode($res);
			}
			else {
				$res['success'] = 0;
				$res['message'] = "Something went wrong! Please try again.";
				return json_encode($res);
			}
		}
	}

public function deleteRolePermanantly(Request $request) {
		$admin 				= Admin::where('role_id', $request->id)->first();
		if($admin != null) {
			$res['success'] = 0;
			$res['message'] = "You cannot delete this record as it's being used.";
			return json_encode($res);
		}
		else {
			$role = Role::where('id', $request->id)->first();
			$role->permissionRoles()->forceDelete();
			$role->admins()->forceDelete();
			$deleteRole 	= $role->forceDelete();
			if($deleteRole) {
				$res['success'] = 1;
				return json_encode($res);
			}
			else {
				$res['success'] = 0;
				$res['message'] = "Something went wrong! Please try again.";
				return json_encode($res);
			}
		}
	}


	public function getAllPermissions(Request $request) {
		$permissions = Permission::orderBy('name')->get();
		for ($i=0; $i < count($permissions); $i++) { 
			echo $permissions[$i]->id.' : '.$permissions[$i]->slug."<br>";
			echo "\n";
		}
	}

	public function getUserPermissions(Request $request) {
		$user 			= $request->user();
		$permissions 	= $user->role->permissions;
		for ($i=0; $i < count($permissions); $i++) { 
			echo $permissions[$i]->id.' : '.$permissions[$i]->slug."<br>";
			echo "\n";
		}
	}
}
