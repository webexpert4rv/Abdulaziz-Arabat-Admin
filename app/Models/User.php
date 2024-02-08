<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Jobs\QueuedVerifyEmailJob;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail {
	use HasFactory, Notifiable,  HasApiTokens,SoftDeletes;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	*/
	protected $fillable = [
		'role_id',
		'unique_ID',
		'name', 
		'email',
		'country_code',
		'phone_number',
		'password',
		'profile_image',
		'address',
		'lat',
		'long',  
		'city',  
		'zip_code',  
		'email_verified_token',  
		'is_email_verified',
		'email_verified_at',
		'is_phone_verified',
		'ip_address',
		'device_token',
		'token_type',
		'user_locked',
		'privacy_policy',
		'user_locked_at',
		'login_with',
		'last_logged_in_at',
		'is_deleted',
		'is_push_notifications',
		'is_email_notifications',
		'status',
		'account_type',
		'parent_id',
		'created_by',
		'company_name',
		'is_approve',
		'is_online',
		'login_status',
		'language_code',
		'referrer_id',
		'referrer_code',
		'referral_token',
		'commission',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	*/
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	*/
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	protected $appends = ['referral_link'];


	public function getReferralLinkAttribute()
	{
		 return $this->referral_link = env('STORAGE_PATH').'index.php/'.'register-type?ref='.$this->referral_token;
		// return $this->referral_link = route('user.register', ['ref' =>$this->referral_token]);
	}


	
	public function markEmailAsVerified() {
		return $this->forceFill([
			'email_verified_at' => $this->freshTimestamp(),
			'is_email_verified' => 1,
		])->save();
	}	

	public function socialLogins() {
		return $this->hasMany(UserSocialLogin::class);
	}	
	
	public function fcmTokens()
	{
		return $this->morphMany(FcmToken::class, 'tokenable');
	}

	public function routeNotificationForFcm($notification)
	{

		return $this->fcmTokens->pluck('token')->toArray();
	}

	public function scopeUserStatus($query){


		return  $query->where('login_status','1')
		->where('is_online','1')
		->where('status','1')
		->where('is_push_notifications','1')
		->where('account_type','4') ;


	}






	public function scopeNearBy($query, $latitude, $longitude, $radius = 2)
	{
		$haversine_formula = "*,(3959 * acos (cos ( radians($latitude) )* cos( radians( users.lat ) )* cos( radians( users.long ) - radians($longitude) )+ sin ( radians($latitude) )* sin( radians( users.lat ) ))) AS distance";
		$query->selectRaw("{$haversine_formula}");
		$query->orderBy("distance");
		return $query->havingRaw("distance < ?", [$radius]);
	}


	public function transporterDetails()
	{		
		return $this->belongsTo(TransporterDetail::class, 'id','transporter_id');
	}

	public function reviews()
	{
		return $this->hasOne(Reviews::class,'driver_id','id');
	}

	public function vehicle()
	{
		return $this->hasOne(Vehicle::class,'driver_id')->with('vehicleType','insuranceType','preferredLocation');
	}

	public function driverDetails()
	{
		return $this->belongsTo(TransporterDetail::class,'id','driver_id');
	} 


	public function totalEarnings()
	{		
		return $this->hasMany(TransporterWallet::class,'transporter_id','id');
	}


	public function  totalDriverEarning()
	{		
		return $this->hasMany(DriverWallet::class,'driver_id','id');
	} 



	public function moreDocument()
	{
		return $this->hasMany(MoreDocument::class);
	}

	public function transporter()
	{		
		return $this->belongsTo(User::class,'parent_id','id');
	}

	public function drivers()
	{		
		return $this->hasMany(User::class,'parent_id','id');
	}

	public function  driverPenalty()
	{		
		return $this->hasMany(DriverCancelJobPenalty::class,'driver_id','id');
	}

	public function  driverEarning()
	{		
		return $this->hasMany(Booking::class,'driver_id','id')->where('status','service_completed');
	}








	
	public function upcomingJobs(){
		$mytime = \Carbon\Carbon::now();

		return $this->hasMany(Job::class,'user_id','id')->where('schedule_date','>=',$mytime->toDateTimeString())->where('status','pending')->with('PickupRegion','PickupSubRegion','JobReceiver');
	}
	public function completedJobs(){
		return $this->hasMany(Job::class,'user_id','id')->where('status','completed')->with('PickupRegion','PickupSubRegion','JobReceiver');
	}
	public function currentJobs(){
		$mytime = \Carbon\Carbon::now();

		return $this->hasMany(Job::class,'user_id','id')->where('status','in-progress')
		//->where('schedule_date','=',$mytime->toDateTimeString())
		->with('PickupRegion','PickupSubRegion','JobReceiver');
	}
	public function totalJobs(){

		return $this->hasMany(Job::class,'user_id','id')->with('PickupRegion','PickupSubRegion','JobReceiver')->orderBy('status','ASC');
	}
	
	public function vehicleDetails(){
		return $this->belongsTo(Vehicle::class,'id','driver_id')->with('insuranceType','vehicleType');
	}
	public function transaction(){
		return $this->belongsTo(Transaction::class,'id','user_id')->whereHas('booking',function($q){
			$q->where('status','=','cancelled');
		});
	}
	public function userRefunds(){
		return $this->belongsTo(UserRefund::class,'id','user_id');
	}
	public function booking(){

		return $this->belongsTo(Booking::class,'id','user_id');
	}

	
	public function scopereportFilter($query,$request)
	{
		$year=$request->year;
		$month=$request->month;
		//->whereYear('created_at',$year)
		//->whereMonth('created_at',$month)
		if(!empty($year)){
			$query->whereYear('created_at',$year);
		}
		if(!empty($month)){
			$query->whereMonth('created_at',$month);
		}
		return $query;
	}



	public function referrer()
	{
		return $this->belongsTo(User::class, 'referrer_id', 'id');
	}


	public function referrals()
	{
		return $this->hasMany(User::class, 'referrer_id', 'id');
	}
	
}
