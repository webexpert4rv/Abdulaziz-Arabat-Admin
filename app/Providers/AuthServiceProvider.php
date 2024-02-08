<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth;

class AuthServiceProvider extends ServiceProvider {
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	*/
	protected $policies = [
		// 'App\Models\Model' => 'App\Policies\ModelPolicy',
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	*/
	public function boot() {
		$this->registerPolicies();

	//Gate For User
		Gate::define('manage_user', function ($user) {
			
			$user = Auth::guard('admin')->user();
			
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'add_user' || 
					 $permissions[$i]->slug == 'view_user' || 
					 $permissions[$i]->slug == 'edit_user' || 
					 $permissions[$i]->slug == 'delete_user' 
				) {
					return true;
				}
			}
		});

			Gate::define('edit_user', function ($user) {
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'edit_user') {
						return true;
					}
				}
			});

			Gate::define('add_user', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'add_user') {
						return true;
					}
				}
			});		
			
			Gate::define('view_user', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'view_user') {
						return true;
					}
				}
			});	

			Gate::define('delete_user', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'delete_user') {
						return true;
					}
				}
			});	
	//End user

	//Gate For transporter
		Gate::define('manage_transporter', function ($user) {
			
			$user = Auth::guard('admin')->user();
			
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'add_transporter' || 
					 $permissions[$i]->slug == 'view_transporter' || 
					 $permissions[$i]->slug == 'edit_transporter' || 
					 $permissions[$i]->slug == 'delete_transporter' 
				) {
					return true;
				}
			}
		});
			Gate::define('edit_transporter', function ($user) {
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'edit_transporter') {
						return true;
					}
				}
			});

			Gate::define('add_transporter', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'add_transporter') {
						return true;
					}
				}
			});		
			
			Gate::define('view_transporter', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'view_transporter') {
						return true;
					}
				}
			});	

			Gate::define('delete_transporter', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'delete_transporter') {
						return true;
					}
				}
			});	
	//End Transporter

	//Gate For Admins
		Gate::define('manage_admins', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'add_admins' || 
					 $permissions[$i]->slug == 'view_admins' || 
					 $permissions[$i]->slug == 'edit_admins' || 
					 $permissions[$i]->slug == 'delete_admins' 
				) {
					return true;
				}
			}
		});
			Gate::define('edit_admins', function ($user) {
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'edit_admins') {
						return true;
					}
				}
			});

			Gate::define('add_admins', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'add_admins') {
						return true;
					}
				}
			});		
			
			Gate::define('view_admins', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'view_admins') {
						return true;
					}
				}
			});	

			Gate::define('delete_admins', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'delete_admins') {
						return true;
					}
				}
			});	
	//End Admins

	//Gate For Jobs
		Gate::define('manage_jobs', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'add_jobs' || 
					 $permissions[$i]->slug == 'view_jobs' || 
					 $permissions[$i]->slug == 'edit_jobs' || 
					 $permissions[$i]->slug == 'delete_jobs' 
				) {
					return true;
				}
			}
		});
			Gate::define('edit_jobs', function ($user) {
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'edit_jobs') {
						return true;
					}
				}
			});

			Gate::define('add_jobs', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'add_jobs') {
						return true;
					}
				}
			});		
			
			Gate::define('view_jobs', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'view_jobs') {
						return true;
					}
				}
			});	

			Gate::define('delete_jobs', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'delete_jobs') {
						return true;
					}
				}
			});	
	//End Jobs

	//Gate For Job Booked
		Gate::define('manage_job_booked', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'add_jobs_booked' || 
					 $permissions[$i]->slug == 'view_job_booked' || 
					 $permissions[$i]->slug == 'edit_jobs_booked' || 
					 $permissions[$i]->slug == 'delete_jobs_booked' 
				) {
					return true;
				}
			}
		});
			Gate::define('edit_job_booked', function ($user) {
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'edit_job_booked') {
						return true;
					}
				}
			});

			Gate::define('add_job_booked', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'add_job_booked') {
						return true;
					}
				}
			});		
			
			Gate::define('view_job_booked', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'view_job_booked') {
						return true;
					}
				}
			});	

			Gate::define('delete_job_booked', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'delete_job_booked') {
						return true;
					}
				}
			});	
	//End Job Booked

	//Gate For Email
		Gate::define('manage_email', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'add_email' || 
					 $permissions[$i]->slug == 'view_email' || 
					 $permissions[$i]->slug == 'edit_email' || 
					 $permissions[$i]->slug == 'delete_email' 
				) {
					return true;
				}
			}
		});

			Gate::define('edit_email', function ($user) {
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'edit_email') {
						return true;
					}
				}
			});

			Gate::define('add_email', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'add_email') {
						return true;
					}
				}
			});		
			
			Gate::define('view_email', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'view_email') {
						return true;
					}
				}
			});	

			Gate::define('delete_email', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'delete_email') {
						return true;
					}
				}
			});	
	//End Email

	//Gate For Payment
		Gate::define('manage_payment', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'add_payment' || 
					 $permissions[$i]->slug == 'view_payment' || 
					 $permissions[$i]->slug == 'edit_payment' || 
					 $permissions[$i]->slug == 'delete_payment' 
				) {
					return true;
				}
			}
		});
			Gate::define('edit_payment', function ($user) {
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'edit_payment') {
						return true;
					}
				}
			});

			Gate::define('add_payment', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'add_payment') {
						return true;
					}
				}
			});		
			
			Gate::define('view_payment', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'view_payment') {
						return true;
					}
				}
			});	

			Gate::define('delete_payment', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'delete_payment') {
						return true;
					}
				}
			});	
	//End Email

	//Gate For transporter Wallest
		Gate::define('manage_transporter_wallets', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'add_transporter_wallets' || 
					 $permissions[$i]->slug == 'view_transporter_wallets' || 
					 $permissions[$i]->slug == 'edit_transporter_wallets' || 
					 $permissions[$i]->slug == 'delete_transporter_wallets' 
				) {
					return true;
				}
			}
		});
			Gate::define('edit_transporter_wallets', function ($user) {
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'edit_transporter_wallets') {
						return true;
					}
				}
			});

			Gate::define('add_transporter_wallets', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'add_transporter_wallets') {
						return true;
					}
				}
			});		
			
			Gate::define('view_transporter_wallets', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'view_transporter_wallets') {
						return true;
					}
				}
			});	

			Gate::define('delete_transporter_wallets', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'delete_transporter_wallets') {
						return true;
					}
				}
			});	
	//End transport wallets

	//Gate For User Refunds
		Gate::define('manage_user_refunds', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'add_user_refunds' || 
					 $permissions[$i]->slug == 'view_user_refunds' || 
					 $permissions[$i]->slug == 'edit_user_refunds' || 
					 $permissions[$i]->slug == 'delete_user_refunds' 
				) {
					return true;
				}
			}
		});
			Gate::define('edit_user_refunds', function ($user) {
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'edit_user_refunds') {
						return true;
					}
				}
			});

			Gate::define('add_user_refunds', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'add_user_refunds') {
						return true;
					}
				}
			});		
			
			Gate::define('view_user_refunds', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'view_user_refunds') {
						return true;
					}
				}
			});	

			Gate::define('delete_user_refunds', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'delete_user_refunds') {
						return true;
					}
				}
			});	
	//End User Refunds

	//Gate For Website Content
		Gate::define('manage_website_content', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'add_website_content' || 
					 $permissions[$i]->slug == 'view_website_content' || 
					 $permissions[$i]->slug == 'edit_website_content' || 
					 $permissions[$i]->slug == 'delete_website_content' 
				) {
					return true;
				}
			}
		});

			Gate::define('edit_website_content', function ($user) {
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'edit_website_content') {
						return true;
					}
				}
			});

			Gate::define('add_website_content', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'add_website_content') {
						return true;
					}
				}
			});		
			
			Gate::define('view_website_content', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'view_website_content') {
						return true;
					}
				}
			});	

			Gate::define('delete_website_content', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'delete_website_content') {
						return true;
					}
				}
			});	
	//End Webiste Content
	//Gate For Mobile Content
		Gate::define('manage_mobile_content', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'add_mobile_content' || 
					 $permissions[$i]->slug == 'view_mobile_content' || 
					 $permissions[$i]->slug == 'edit_mobile_content' || 
					 $permissions[$i]->slug == 'delete_mobile_content' 
				) {
					return true;
				}
			}
		});
			Gate::define('edit_mobile_content', function ($user) {
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'edit_mobile_content') {
						return true;
					}
				}
			});

			Gate::define('add_mobile_content', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'add_mobile_content') {
						return true;
					}
				}
			});		
			
			Gate::define('view_mobile_content', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'view_mobile_content') {
						return true;
					}
				}
			});	

			Gate::define('delete_mobile_content', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'delete_mobile_content') {
						return true;
					}
				}
			});	
	//End Mobile Content
	//Gate For Banner
		Gate::define('manage_banner', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'add_banner' || 
					 $permissions[$i]->slug == 'view_banner' || 
					 $permissions[$i]->slug == 'edit_banner' || 
					 $permissions[$i]->slug == 'delete_banner' 
				) {
					return true;
				}
			}
		});

			Gate::define('edit_banner', function ($user) {
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'edit_banner') {
						return true;
					}
				}
			});

			Gate::define('add_banner', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'add_banner') {
						return true;
					}
				}
			});		
			
			Gate::define('view_banner', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'view_banner') {
						return true;
					}
				}
			});	

			Gate::define('delete_banner', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'delete_banner') {
						return true;
					}
				}
			});	
	//End Banner

	//Gate For feedback
		Gate::define('manage_feedback', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'view_feedback' || 
					 $permissions[$i]->slug == 'reply_feedback'  
					
				) {
					return true;
				}
			}
		});
			Gate::define('view_feedback', function ($user) {
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'view_feedback') {
						return true;
					}
				}
			});

			Gate::define('reply_feedback', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'reply_feedback') {
						return true;
					}
				}
			});		
	//End For feedback
		
	//Gate For Review
		Gate::define('manage_reviews', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'view_review' || 
					 $permissions[$i]->slug == 'delete_review' 
					
				) {
					return true;
				}
			}
		});
			Gate::define('view_review', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'view_review') {
						return true;
					}
				}
			});	
			Gate::define('edit_review', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'edit_review') {
						return true;
					}
				}
			});

			Gate::define('delete_review', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'delete_review') {
						return true;
					}
				}
			});	
	//End For feedback

	//Gate For Testimonial
		Gate::define('manage_testimonials', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'add_testimonials' || 
					 $permissions[$i]->slug == 'view_testimonials' || 
					 $permissions[$i]->slug == 'edit_testimonials' || 
					 $permissions[$i]->slug == 'delete_testimonials' 
				) {
					return true;
				}
			}
		});

			Gate::define('edit_testimonials', function ($user) {
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'edit_testimonials') {
						return true;
					}
				}
			});

			Gate::define('add_testimonials', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'add_testimonials') {
						return true;
					}
				}
			});		
			
			Gate::define('view_testimonials', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'view_testimonials') {
						return true;
					}
				}
			});	

			Gate::define('delete_testimonials', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'delete_testimonials') {
						return true;
					}
				}
			});	
	//End For feedback

		Gate::define('manage_reports', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'view_reports' 
					
				) {
					return true;
				}
			}
		});
		Gate::define('view_reports', function ($user) {
			
			$user = Auth::guard('admin')->user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_reports') {
					return true;
				}
			}
		});	
		Gate::define('manage_misc', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'view_misc'||
				$permissions[$i]->slug 	== 'edit_misc'||
				$permissions[$i]->slug 	== 'delete_misc'||
				$permissions[$i]->slug 	== 'add_misc' 
					
				) {
					return true;
				}
			}
		});
	//Gate For Testimonial
		Gate::define('manage_roles', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'view_role'||
				$permissions[$i]->slug 	== 'edit_role'||
				$permissions[$i]->slug 	== 'delete_role'||
				$permissions[$i]->slug 	== 'add_role'
					
				) {
					return true;
				}
			}
		});
			Gate::define('edit_role', function ($user) {
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'edit_role') {
						return true;
					}
				}
			});

			Gate::define('add_role', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'add_role') {
						return true;
					}
				}
			});		
			
			Gate::define('view_role', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'view_role') {
						return true;
					}
				}
			});	

			Gate::define('delete_role', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'delete_role') {
						return true;
					}
				}
			});	
	//Gate For Testimonial

		Gate::define('manage_permission', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'permission'
					
				) {
					return true;
				}
			}
		});

		Gate::define('manage_recycle_bin', function ($user) {
			
			$user = Auth::guard('admin')->user();
			//dd($user );
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'recycle_bin'
					
				) {
					return true;
				}
			}
		});

		/////////////Blog
		Gate::define('manage_blog', function ($user) {
			
			$user = Auth::guard('admin')->user();
			
			$permissions = $user->role->permissions;
			
			for ($i=0; $i < count($permissions); $i++) { 
				
				if($permissions[$i]->slug 	== 'add_blog' || 
					 $permissions[$i]->slug == 'view_blog' || 
					 $permissions[$i]->slug == 'edit_blog' || 
					 $permissions[$i]->slug == 'delete_blog' 
				) {
					return true;
				}
			}
		});

			Gate::define('edit_blog', function ($user) {
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'edit_blog') {
						return true;
					}
				}
			});

			Gate::define('add_blog', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'add_blog') {
						return true;
					}
				}
			});		
			
			Gate::define('view_blog', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'view_blog') {
						return true;
					}
				}
			});	

			Gate::define('delete_blog', function ($user) {
				
				$user = Auth::guard('admin')->user();
				$permissions = $user->role->permissions;
				for ($i=0; $i < count($permissions); $i++) { 
					if($permissions[$i]->slug == 'delete_blog') {
						return true;
					}
				}
			});	
		
	}
}
