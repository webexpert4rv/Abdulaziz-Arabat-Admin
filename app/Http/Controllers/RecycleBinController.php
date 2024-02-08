<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Job;
use App\Models\JobReceiver;
use App\Models\RequestQuotes;
use App\Models\Page;
use App\Models\Banner;
use App\Models\Testimonial;
use App\Models\Reviews;
use App\Models\OtpVerification;
use App\Models\MoreDocument;
use App\Models\JobDeliveredStatus;
use App\Models\Booking;
use App\Models\Transaction;
use App\Models\ReceiveQuotes;
use App\Models\ReferrerWallet;
use App\Models\SaveCard;
use App\Models\SpecialRequest;
use App\Models\PromoCode;



class RecycleBinController extends Controller
{
    //Functions for users
    public function deletedUsersList(Request $request){
        $users = User::where('role_id',3)->onlyTrashed()->orderBy('email')->get();
        return view('recycle_bin.deleted_app_users_list', ['users' => $users]);
    }



    public function permanentDeleteUsers(Request $request){ 

        $user = User::withTrashed()->findOrFail($request->id);

        $users=PromoCode::where('user_id', $request->id)->delete();
        $receiver = JobReceiver::where('user_id', $request->id)->pluck('id');
        $save_cards=SaveCard::where('user_id', $request->id)->delete();
        $save_cards=SpecialRequest::where('user_id', $request->id)->delete();
        $save_cards=user::where('referrer_id',$request->id)->update(['referrer_id'=>NULL]);
        $save_cards=user::where('referrer_id',$request->id)->onlyTrashed()->update(['referrer_id'=>NULL]);
        $users = JobDeliveredStatus::whereIn('job_receiver_id', $receiver)->delete();
        $users = Transaction::where('user_id', $request->id)->delete();
        $users = Booking::where('user_id', $request->id)->delete();
        $users = JobReceiver::where('user_id', $request->id)->delete();
        $users =  Job::where('user_id', $request->id)->delete();
        $jobs_ids = Job::where('user_id', $request->id)->onlyTrashed()->pluck('id');
        ReceiveQuotes::whereIn('job_id', $jobs_ids)->forceDelete();
        RequestQuotes::whereIn('job_id', $jobs_ids)->forceDelete();
        Reviews::whereIn('job_id', $jobs_ids)->forceDelete();
        $users =  ReferrerWallet::where('user_id', $request->id)->delete();
            //foreach($jobs_ids as $jobs_id){
        Job::whereIn('id', $jobs_ids)->forceDelete();
            //}

        $users = OtpVerification::where('user_id', $request->id)->delete();
        $users = User::where('id', $request->id)->onlyTrashed()->first();

        $deleteUsers = $users->forceDelete();

        if($deleteUsers) {
            $res['success'] = 1;
            return json_encode($res);
        }
        else {
            $res['success'] = 0;
            return json_encode($res);
        }

    }
    public function restore(Request $request){

       $users = User::onlyTrashed()->find($request->id);
       $restoreUsers = $users->restore();
       if($restoreUsers){
        return 1;
    }else{
        return 0;
    }

}

    //Functions for transporter
public function deletedTransporterList(){
    $transporters = User::where('role_id',2)->onlyTrashed()->orderBy('email')->get();
    return view('recycle_bin.deleted_app_transporter_list', ['transporters' => $transporters]);
}

public function permanentDeleteTransporter(Request $request){

    ReferrerWallet::where('user_id', $request->id)->delete();
    OtpVerification::where('user_id', $request->id)->delete();
    MoreDocument::where('user_id', $request->id)->delete();
    $users = User::where('id', $request->id)->onlyTrashed()->first();

    $deleteUsers = $users->forceDelete();

    if($deleteUsers) {
        $res['success'] = 1;
        return json_encode($res);
    }
    else {
        $res['success'] = 0;
        return json_encode($res);
    }
}
public function transporterRestore(Request $request){
    $users = User::onlyTrashed()->find($request->id);
    $restoreUsers = $users->restore();
    if($restoreUsers){
        return 1;
    }else{
        return 0;
    }
}

    //Functions for drivers

public function deletedDriverList(){
    $drivers = User::where('role_id',4)->onlyTrashed()->orderBy('email')->get();
    return view('recycle_bin.deleted_app_driver_list', ['drivers' => $drivers]);
}

public function permanentDeleteDriver(Request $request){

    ReferrerWallet::where('user_id', $request->id)->delete();
    OtpVerification::where('user_id', $request->id)->delete();
    MoreDocument::where('user_id', $request->id)->delete();
    $users = User::where('id', $request->id)->onlyTrashed()->first();

    $deleteUsers = $users->forceDelete();

    if($deleteUsers) {
        $res['success'] = 1;
        return json_encode($res);
    }
    else {
        $res['success'] = 0;
        return json_encode($res);
    }
}
public function driverRestore(Request $request){
    $users = User::onlyTrashed()->find($request->id);
    $restoreUsers = $users->restore();
    if($restoreUsers){
        return 1;
    }else{
        return 0;
    }
}

    //Functions for admins
public function deletedAdminsList(){
    $admins = Admin::where('id','!=',1)->onlyTrashed()->orderBy('email')->get();
    return view('recycle_bin.deleted_admins_list', ['admins' => $admins]);
}
public function permanentDeleteAdmins(Request $request){
    $users = Admin::where('id', $request->id)->onlyTrashed()->first();
    $deleteUsers = $users->forceDelete();
    if($deleteUsers) {
        $res['success'] = 1;
        return json_encode($res);
    }
    else {
        $res['success'] = 0;
        return json_encode($res);
    }
}
public function adminsRestore(Request $request){
    $admins = Admin::onlyTrashed()->find($request->id);
    $restoreAdmins = $admins->restore();
    if($restoreAdmins){
        return 1;
    }else{
        return 0;
    }
}

    //Functions for jobs
public function deletedJobsList(){
    $jobs = Job::onlyTrashed()->get();
    return view('recycle_bin.deleted_job_list', ['jobs' => $jobs]);
}
public function permanentDeleteJobs(Request $request){
       // dd( Reviews::where('job_id',$request->id)->forceDelete());
    Transaction::where('job_id',$request->id)->delete();
    Booking::where('job_id',$request->id)->delete();
    JobDeliveredStatus::where('job_id',$request->id)->delete();
    JobReceiver::where('job_id',$request->id)->delete();
    RequestQuotes::where('job_id',$request->id)->delete();
    ReceiveQuotes::where('job_id',$request->id)->delete();
    Reviews::where('job_id',$request->id)->forceDelete();

    $jobs = Job::where('id', $request->id)->onlyTrashed()->first();

    $deleteJobs = $jobs->forceDelete();
    if($deleteJobs) {
        $res['success'] = 1;
        return json_encode($res);
    }
    else {
        $res['success'] = 0;
        return json_encode($res);
    }
}
public function jobsRestore(Request $request){
    $jobs = Job::onlyTrashed()->find($request->id);
    $restoreJobs = $jobs->restore();
    if($restoreJobs){
        return 1;
    }else{
        return 0;
    }
}
    //Functions for mobile content

public function deletedMobileContentList(){
    $pages = Page::where('device_type','=','mobile')->onlyTrashed()->get();
    return view('recycle_bin.deleted_mobile_content_list', ['pages' => $pages]);
}
public function permanentDeleteMobileContent(Request $request){
    $page = Page::where('id', $request->id)->onlyTrashed()->first();

    $deletepage = $page->forceDelete();
    if($deletepage) {
        $res['success'] = 1;
        return json_encode($res);
    }
    else {
        $res['success'] = 0;
        return json_encode($res);
    }
}
public function mobileContentRestore(Request $request){
    $pages = Page::onlyTrashed()->find($request->id);
    $restorePages = $pages->restore();
    if($restorePages){
        return 1;
    }else{
        return 0;
    }
}
    //Functions for website content

public function deletedWebsiteContentList(){
    $pages = Page::where('device_type','=','web')->onlyTrashed()->get();
    return view('recycle_bin.deleted_website_content_list', ['pages' => $pages]);
}
public function permanentDeleteWebsiteContent(Request $request){
    $page = Page::where('id', $request->id)->onlyTrashed()->first();

    $deletepage = $page->forceDelete();
    if($deletepage) {
        $res['success'] = 1;
        return json_encode($res);
    }
    else {
        $res['success'] = 0;
        return json_encode($res);
    }
}
public function WebsiteContentRestore(Request $request){
    $pages = Page::onlyTrashed()->find($request->id);
    $restorePages = $pages->restore();
    if($restorePages){
        return 1;
    }else{
        return 0;
    }
}
    //Functions for reviews 

public function deletedReviewList(){
    $review = Reviews::with('user')->onlyTrashed()->get();
    return view('recycle_bin.deleted_reviews_list', ['review' => $review]);
}
public function permanentDeleteReview(Request $request){
    $review = Reviews::where('id', $request->id)->onlyTrashed()->first();

    $deletereview = $review->forceDelete();
    if($deletereview) {
        $res['success'] = 1;
        return json_encode($res);
    }
    else {
        $res['success'] = 0;
        return json_encode($res);
    }
}
public function reviewRestore(Request $request){
    $reviews = Reviews::onlyTrashed()->find($request->id);
    $restoreReviews = $reviews->restore();
    if($restoreReviews){
        return 1;
    }else{
        return 0;
    }
}
    //Functions for banner
public function deletedBannerList(){
    $banner = Banner::onlyTrashed()->get();
    return view('recycle_bin.deleted_banner_list', ['banner' => $banner]);
}
public function permanentDeleteBanner(Request $request){
    $banner = Banner::where('id', $request->id)->onlyTrashed()->first();

    $deletebanner = $banner->forceDelete();
    if($deletebanner) {
        $res['success'] = 1;
        return json_encode($res);
    }
    else {
        $res['success'] = 0;
        return json_encode($res);
    }
}
public function bannerRestore(Request $request){
    $banner = Banner::onlyTrashed()->find($request->id);
    $restoreBanner = $banner->restore();
    if($restoreBanner){
        return 1;
    }else{
        return 0;
    }
}
    //Funcitons for testimonial
public function deletedTestimonialsList(){
    $testimonial = Testimonial::onlyTrashed()->get();
    return view('recycle_bin.deleted_testimonial_list', ['testimonial' => $testimonial]);
}
public function permanentDeleteTestimonials(Request $request){
    $testimonial = Testimonial::where('id', $request->id)->onlyTrashed()->first();

    $deletetestimonial = $testimonial->forceDelete();
    if($deletetestimonial) {
        $res['success'] = 1;
        return json_encode($res);
    }
    else {
        $res['success'] = 0;
        return json_encode($res);
    }
}
public function testimonialsRestore(Request $request){
    $testimonial = Testimonial::onlyTrashed()->find($request->id);
    $restoreTestimonial = $testimonial->restore();
    if($restoreTestimonial){
        return 1;
    }else{
        return 0;
    }
}
}
