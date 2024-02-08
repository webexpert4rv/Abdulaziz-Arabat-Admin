<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {

		\DB::table('permission_role')->delete();
		\DB::table('permissions')->delete();
		\DB::table('permissions')->insert([
			
			[
				'name' 			=> 'View',
				'slug' 			=> 'view_user',
				'module_name' 	=> 'View',
				'module_slug' 	=> 'manage_user',
				'description' 	=> 'Users',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Edit',
				'slug' 			=> 'edit_user',
				'module_name' 	=> 'Edit',
				'module_slug' 	=> 'manage_user',
				'description' 	=> 'Users',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Delete',
				'slug' 			=> 'delete_user',
				'module_name' 	=> 'Delete',
				'module_slug' 	=> 'manage_user',
				'description' 	=> 'Users',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Add',
				'slug' 			=> 'add_user',
				'module_name' 	=> 'Add',
				'module_slug' 	=> 'manage_user',
				'description' 	=> 'Users',
				'status' 		=> 1
			],
			[
				'name' 			=> 'View',
				'slug' 			=> 'view_transporter',
				'module_name' 	=> 'View',
				'module_slug' 	=> 'manage_transporter',
				'description' 	=> 'transporter',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Edit',
				'slug' 			=> 'edit_transporter',
				'module_name' 	=> 'Edit',
				'module_slug' 	=> 'manage_transporter',
				'description' 	=> 'Transporter',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Delete',
				'slug' 			=> 'delete_transporter',
				'module_name' 	=> 'Delete',
				'module_slug' 	=> 'manage_transporter',
				'description' 	=> 'Transporter',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Add',
				'slug' 			=> 'add_transporter',
				'module_name' 	=> 'Add',
				'module_slug' 	=> 'manage_transporter',
				'description' 	=> 'Transporter',
				'status' 		=> 1
			],
			[
				'name' 			=> 'View',
				'slug' 			=> 'view_admins',
				'module_name' 	=> 'View',
				'module_slug' 	=> 'manage_admins',
				'description' 	=> 'Admins',
				'status' 		=> 1
			],
			
			[
				'name' 			=> 'Edit',
				'slug' 			=> 'edit_admins',
				'module_name' 	=> 'Edit',
				'module_slug' 	=> 'manage_admins',
				'description' 	=> 'Admins',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Delete',
				'slug' 			=> 'delete_admins',
				'module_name' 	=> 'Delete',
				'module_slug' 	=> 'manage_admins',
				'description' 	=> 'Admins',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Add',
				'slug' 			=> 'add_admins',
				'module_name' 	=> 'Add',
				'module_slug' 	=> 'manage_admins',
				'description' 	=> 'Admins',
				'status' 		=> 1
			],
			[
				'name' 			=> 'View',
				'slug' 			=> 'view_jobs',
				'module_name' 	=> 'View',
				'module_slug' 	=> 'manage_jobs',
				'description' 	=> 'Jobs',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Edit',
				'slug' 			=> 'edit_jobs',
				'module_name' 	=> 'Edit',
				'module_slug' 	=> 'manage_jobs',
				'description' 	=> 'Jobs',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Delete',
				'slug' 			=> 'delete_jobs',
				'module_name' 	=> 'Delete',
				'module_slug' 	=> 'manage_jobs',
				'description' 	=> 'Jobs',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Add',
				'slug' 			=> 'add_jobs',
				'module_name' 	=> 'Add',
				'module_slug' 	=> 'manage_jobs',
				'description' 	=> 'Jobs',
				'status' 		=> 1
			],
			[
				'name' 			=> 'View',
				'slug' 			=> 'view_driver',
				'module_name' 	=> 'View',
				'module_slug' 	=> 'manage_driver',
				'description' 	=> 'Driver',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Edit',
				'slug' 			=> 'edit_driver',
				'module_name' 	=> 'Edit',
				'module_slug' 	=> 'manage_driver',
				'description' 	=> 'Driver',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Delete',
				'slug' 			=> 'delete_driver',
				'module_name' 	=> 'Delete',
				'module_slug' 	=> 'manage_driver',
				'description' 	=> 'Driver',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Add',
				'slug' 			=> 'add_driver',
				'module_name' 	=> 'Add',
				'module_slug' 	=> 'manage_driver',
				'description' 	=> 'Driver',
				'status' 		=> 1
			],
			[
				'name' 			=> 'View',
				'slug' 			=> 'view_email',
				'module_name' 	=> 'View',
				'module_slug' 	=> 'manage_email',
				'description' 	=> 'Email',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Edit',
				'slug' 			=> 'edit_email',
				'module_name' 	=> 'Edit',
				'module_slug' 	=> 'manage_email',
				'description' 	=> 'Email',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Delete',
				'slug' 			=> 'delete_email',
				'module_name' 	=> 'Delete',
				'module_slug' 	=> 'manage_email',
				'description' 	=> 'Email',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Add',
				'slug' 			=> 'add_email',
				'module_name' 	=> 'Add',
				'module_slug' 	=> 'manage_email',
				'description' 	=> 'Email',
				'status' 		=> 1
			],


			[
				'name' 			=> 'View',
				'slug' 			=> 'view_payment',
				'module_name' 	=> 'View',
				'module_slug' 	=> 'manage_payment',
				'description' 	=> 'Payment',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Edit',
				'slug' 			=> 'edit_payment',
				'module_name' 	=> 'Edit',
				'module_slug' 	=> 'manage_payment',
				'description' 	=> 'Payment',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Delete',
				'slug' 			=> 'delete_payment',
				'module_name' 	=> 'Delete',
				'module_slug' 	=> 'manage_payment',
				'description' 	=> 'Payment',
				'status' 		=> 1
			],
			[
				'name' 			=> 'Add',
				'slug' 			=> 'add_payment',
				'module_name' 	=> 'Add',
				'module_slug' 	=> 'manage_payment',
				'description' 	=> 'Payment',
				'status' 		=> 1
			],

			[
				'name' 			=> 'View',
				'slug' 			=> 'view_website_content',
				'module_name' 	=> 'View',
				'module_slug' 	=> 'manage_website_content',
				'description' 	=> 'Content',
				'status' 		=> 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_website_content',
				'module_name' => 'Edit',
				'module_slug' => 'manage_website_content',
				'description' => 'Content',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_website_content',
				'module_name' => 'Delete',
				'module_slug' => 'manage_website_content',
				'description' => 'Content',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_website_content',
				'module_name' => 'Add',
				'module_slug' => 'manage_website_content',
				'description' => 'Content',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_mobile_content',
				'module_name' => 'View',
				'module_slug' => 'manage_mobile_content',
				'description' => 'Content',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_mobile_content',
				'module_name' => 'Edit',
				'module_slug' => 'manage_mobile_content',
				'description' => 'Content',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_mobile_content',
				'module_name' => 'Delete',
				'module_slug' => 'manage_mobile_content',
				'description' => 'Content',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_mobile_content',
				'module_name' => 'Add',
				'module_slug' => 'manage_mobile_content',
				'description' => 'Content',
				'status' => 1
			],


			




			[
				'name' => 'View',
				'slug' => 'view_banner',
				'module_name' => 'View',
				'module_slug' => 'manage_banner',
				'description' => 'Banner',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_banner',
				'module_name' => 'Edit',
				'module_slug' => 'manage_banner',
				'description' => 'Banner',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_banner',
				'module_name' => 'Delete',
				'module_slug' => 'manage_banner',
				'description' => 'Banner',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_banner',
				'module_name' => 'Add',
				'module_slug' => 'manage_banner',
				'description' => 'Banner',
				'status' => 1
			],
			[
				'name' => 'View Feedback',
				'slug' => 'view_feedback',
				'module_name' => 'View Feedback',
				'module_slug' => 'feedback',
				'description' => 'Feedback',
				'status' => 1
			],
			[
				'name' => 'Reply Feedback',
				'slug' => 'reply_feedback',
				'module_name' => 'Reply Feedback',
				'module_slug' => 'feedback',
				'description' => 'Feedback',
				'status' => 1
			],
			[
				'name' => 'View Reviews',
				'slug' => 'view_review',
				'module_name' => 'View Reviews',
				'module_slug' => 'reviews',
				'description' => 'Reviews',
				'status' => 1
			],
			[
				'name' => 'Delete Reviews',
				'slug' => 'delete_review',
				'module_name' => 'Delete Reviews',
				'module_slug' => 'reviews',
				'description' => 'Reviews',
				'status' => 1
			],

			[
				'name' => 'Edit Reviews',
				'slug' => 'edit_review',
				'module_name' => 'Edit Reviews',
				'module_slug' => 'reviews',
				'description' => 'Reviews',
				'status' => 1
			],



			[
				'name' => 'View Testimonials',
				'slug' => 'view_testimonials',
				'module_name' => 'View Testimonials',
				'module_slug' => 'testimonials',
				'description' => 'Testimonials',
				'status' => 1
			],
			[
				'name' => 'Delete Testimonials',
				'slug' => 'delete_testimonials',
				'module_name' => 'Delete Testimonials',
				'module_slug' => 'testimonials',
				'description' => 'Testimonials',
				'status' => 1
			],
			[
				'name' => 'Edit Testimonials',
				'slug' => 'edit_testimonials',
				'module_name' => 'Edit Testimonials',
				'module_slug' => 'testimonials',
				'description' => 'Testimonials',
				'status' => 1
			],
			[
				'name' => 'Add Testimonials',
				'slug' => 'add_testimonials',
				'module_name' => 'Add Testimonials',
				'module_slug' => 'testimonials',
				'description' => 'Testimonials',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_reports',
				'module_name' => 'View',
				'module_slug' => 'manage_reports',
				'description' => 'Reports',
				'status' => 1
			],


			[
				'name' => 'View',
				'slug' => 'view_misc',
				'module_name' => 'View',
				'module_slug' => 'manage_misc',
				'description' => 'Misc Data',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_misc',
				'module_name' => 'Edit',
				'module_slug' => 'manage_misc',
				'description' => 'Misc Data',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_misc',
				'module_name' => 'Delete',
				'module_slug' => 'manage_misc',
				'description' => 'Misc Data',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_misc',
				'module_name' => 'Add',
				'module_slug' => 'manage_misc',
				'description' => 'Misc Data',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'add_role',
				'module_name' => 'Add Role',
				'module_slug' => 'manage_roles',
				'description' => 'Roles',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_role',
				'module_name' => 'Edit Role',
				'module_slug' => 'manage_roles',
				'description' => 'Roles',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_role',
				'module_name' => 'Delete Role',
				'module_slug' => 'manage_roles',
				'description' => 'Roles',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_role',
				'module_name' => 'Add Role',
				'module_slug' => 'manage_roles',
				'description' => 'Roles',
				'status' => 1
			],

			//New Data
			[
				'name' => 'View',
				'slug' => 'view_job_booked',
				'module_name' => 'View',
				'module_slug' => 'manage_job_booked',
				'description' => 'Jobs',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_job_booked',
				'module_name' => 'Add',
				'module_slug' => 'manage_job_booked',
				'description' => 'Jobs',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_job_booked',
				'module_name' => 'Edit',
				'module_slug' => 'manage_job_booked',
				'description' => 'Jobs',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_job_booked',
				'module_name' => 'Delete',
				'module_slug' => 'manage_job_booked',
				'description' => 'Jobs',
				'status' => 1
			],


			[
				'name' => 'View',
				'slug' => 'view_transporter_wallets',
				'module_name' => 'View',
				'module_slug' => 'manage_transporter_wallets',
				'description' => 'Transporter Wallets',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_transporter_wallets',
				'module_name' => 'Add',
				'module_slug' => 'manage_transporter_wallets',
				'description' => 'Transporter Wallets	',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_transporter_wallets',
				'module_name' => 'Edit',
				'module_slug' => 'manage_transporter_wallets',
				'description' => 'Transporter Wallets	',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_transporter_wallets',
				'module_name' => 'Delete',
				'module_slug' => 'manage_transporter_wallets',
				'description' => 'Transporter Wallets	',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_user_refunds',
				'module_name' => 'View',
				'module_slug' => 'manage_user_refunds',
				'description' => 'User Refunds',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_user_refunds',
				'module_name' => 'Edit',
				'module_slug' => 'manage_user_refunds',
				'description' => 'User Refunds',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_user_refunds',
				'module_name' => 'Delete',
				'module_slug' => 'manage_user_refunds',
				'description' => 'User Refunds',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_user_refunds',
				'module_name' => 'Add',
				'module_slug' => 'manage_user_refunds',
				'description' => 'User Refunds',
				'status' => 1
			],


			[
				'name' => 'Permission',
				'slug' => 'permission',
				'module_name' => 'permission',
				'module_slug' => 'manage_permission',
				'description' => 'manage_permission',
				'status' => 1
			],
			[
				'name' => 'Recycle Bin',
				'slug' => 'recycle_bin',
				'module_name' => 'recycle_bin',
				'module_slug' => 'manage_recycle_bin',
				'description' => 'Recycle Bin',
				'status' => 1
			],
		
		]);
		
		
		$allPermissions = \DB::table('permissions')->get();
		for($i=0; $i < count($allPermissions); $i++) {
			$permission = $allPermissions[$i];
			\DB::table('permission_role')->insert([
				'permission_id' => $permission->id,
				'role_id' => 1
			]);
		}


	}
}
