<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TransporterController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\CmsPageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentsController;

use App\Http\Controllers\EmailController;
use App\Http\Controllers\VehicleTypesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductShapeController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\PromoCodeController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RecycleBinController;
use App\Http\Controllers\TransporterWalletController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SubRegionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\TutorialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/






Route::get('/', function () {
  return redirect()->route('login');
})->name('admin_home'); 


Route::middleware(['auth:admin','prevent-back-history'])->group(function (){
  Route::group(['prefix' => 'admin'], function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/set-session',[AdminController::class, 'setSession'])->name('setSession');
    // Route::post('/set-session',[AdminController::class, 'setSession'])->name('setSession');
    
    Route::resource('users',UserController::class);
    Route::get('create-user', [UserController::class, 'create'])->name('create-user');
    Route::get('/check_user_email', [UserController::class, 'checkUserEmail'])->name('check_user_email');
    Route::post('add-user', [UserController::class, 'add'])->name('add_user');
    Route::get('create-market', [UserController::class, 'market'])->name('create-market');
    Route::post('add-market', [UserController::class, 'addMarket'])->name('add_market');
    Route::get('show-market', [UserController::class, 'showMarket'])->name('show_market');
    Route::get('/edit-market/{id}', [UserController::class, 'editMarket'])->name('edit-market');
    Route::put('/update-market/{id}', [UserController::class, 'updateMarket'])->name('update-market');
    // Route::delete('/delete-market/{id}', [UserController::class, 'deleteMarket'])->name('delete-market');






    
    Route::post('update-user-status',[UserController::class,'updateUserStatus'])->name('update.user.status');
    Route::post('user-email-check',[UserController::class,'emailCheck'])->name('user.email.check');
    Route::post('user-phone-check',[UserController::class,'phoneCheck'])->name('user.phone.check');
    Route::post('get-user-details',[UserController::class,'getUserdetails'])->name('get-user-details');
    Route::post('get-driver-list',[UserController::class,'getDriverList'])->name('get-driver-list');
    Route::post('get-vehicle-details',[UserController::class,'getVehicleList'])->name('get-vehicle-details');
    Route::post('get-vehicle-number-details',[UserController::class,'getVehicleNumber'])->name('get-vehicle-number-details');
    Route::get('job-show/{id}',[UserController::class,'jobShow'])->name('job.show');
    Route::post('job-delete/{id}',[UserController::class,'jobDelete'])->name('job.delete');
    Route::post('filter-user',[UserController::class,'filetrUser'])->name('filter.user');
    Route::post('reset-user',[UserController::class,'resetUser'])->name('reset.user');
    Route::get('export-user/{type}', [UserController::class, 'exportUser'])->name('export-user');
    Route::get('export-login-user', [UserController::class, 'exportLoginUser'])->name('export-login-user');
    Route::get('pdf-user/{type}', [UserController::class, 'pdfUser'])->name('pdf-user');
    Route::get('csv-user/{type}', [UserController::class, 'csvUser'])->name('csv-user');



    Route::resource('transporters',TransporterController::class);
    Route::get('create-transporter', [TransporterController::class, 'create'])->name('create-transporter');
    Route::get('/check_transporter_email', [UserController::class, 'checkTransporterEmail'])->name('check_transporter_email');
    Route::post('add-transporter', [TransporterController::class, 'add'])->name('add_transporter');
    Route::post('check-phone_number',[TransporterController::class, 'checkPhoneNumber'])->name('user.check.phone_number');
    Route::post('forward-quotation', [TransporterController::class,'forwardQuotation'])->name('forward.quotation');
    Route::post('check-job-accepted', [TransporterController::class,'checkJobAccepted'])->name('check.job.accepted');
    Route::post('filter-transporter',[TransporterController::class,'filterTransporter'])->name('transporters.filter');
    Route::post('reset-transporter',[TransporterController::class,'resetTransporter'])->name('transporter.reset');
    Route::get('driver-show/{id}',[TransporterController::class,'DriverShow'])->name('driver.show');
    Route::get('driver-add-details',[TransporterController::class,'DriverAddDetails'])->name('driver.add.details');
    Route::post('driver-add',[TransporterController::class,'DriverAdd'])->name('driver.add');
    Route::post('driver-update',[TransporterController::class,'DriverUpdate'])->name('driver.update');
    Route::post('driver-delete/{id}',[TransporterController::class,'DriverDelete'])->name('driver.delete');

    Route::resource('jobs',JobsController::class);
    Route::get('create-job', [JobsController::class, 'create'])->name('create-job');
    Route::get('create-job2', [JobsController::class, 'create2'])->name('create-job2');
    Route::get('create-job2-edit/{id}', [JobsController::class, 'create2'])->name('create-job2-edit');
    Route::get('create-job3', [JobsController::class, 'create3'])->name('create-job3');
    Route::get('edit-job', [JobsController::class, 'editJob'])->name('edit-job');
    Route::get('manually-job', [JobsController::class, 'manuallyJob'])->name('manually-job');
    Route::get('download-past-invoice', [JobsController::class, 'downloadPastInvoice'])->name('download-past-invoice');
    Route::post('sub-regions',  [JobsController::class, 'subRegions'])->name('job.sub-regions');
    Route::post('receiver_wrap',  [JobsController::class, 'receiverWrap'])->name('job.receiver_wrap');
    Route::post('job-store',  [JobsController::class, 'jobStore'])->name('job.store');
    Route::post('job-store2',  [JobsController::class, 'jobStore2'])->name('job.store2');
    Route::post('get-transporter-list', [JobsController::class, 'getTransporterList'])->name('get-transporter-list');
    
    Route::post('job-expiredJobSent',[JobsController::class,'expiredJobSent'])->name('job.expiredJobSent');
    Route::post('job-update-manually',  [JobsController::class, 'jobUpdateManually'])->name('job.update.manually');
    Route::post('manuallyPayment',  [JobsController::class, 'manuallyPaymentFromAdmin'])->name('manuallyPayment');
    Route::get('cancel-job',  [JobsController::class, 'cancel'])->name('cancel-job');


    Route::get('view-receiver-detail/{id}',[JobsController::class,'viewRecieverDetail'])->name('view.receiver.detail');
    Route::get('view-received-quoatation-detail/{id}',[JobsController::class,'viewRecievedQuotationDetail'])->name('view.received.quotation.detail');

    Route::post('jobs-update-activeDate',[JobsController::class,'updateActiveDate'])->name('jobs.update.ActiveDate');

    Route::post('filter-job',[JobsController::class,'filetrJob'])->name('filetr.job');
    Route::post('reset-job',[JobsController::class,'resetJob'])->name('reset.job');
    Route::get('export-job', [JobsController::class, 'exportJob'])->name('export-job');
    Route::get('pdf-job', [JobsController::class, 'pdfJob'])->name('pdf-job');
    Route::get('csv-job', [JobsController::class, 'csvJob'])->name('csv-job');

    Route::post('transport-approve-status',[TransporterController::class,'transportApproveStatus'])->name('transport.approve.status');
    Route::post('transport-unapprove-status',[TransporterController::class,'transportUnApproveStatus'])->name('transport.unapprove.status');
    Route::match(['get','post'],'pricing',[PricingController::class,'pricingCreateUpdate'])->name('pricing.index');
    Route::resource('bank-account',BankAccountController::class);

    Route::post('update-bankaccount-status',[BankAccountController::class,'updateBankAccountStatus'])->name('update.bankaccount.status');

    Route::resource('region',RegionController::class);
    Route::post('update-region-status',[RegionController::class,'updateRegionStatus'])->name('update.region.status');

    Route::resource('sub-region',SubRegionController::class);
    Route::post('update-sub-region-status',[SubRegionController::class,'updateSubRegionStatus'])->name('update.sub-region.status');


    Route::resource('faq',FAQController::class);

    Route::resource('video',VideoController::class);

    Route::resource('blog-category',BlogCategoryController::class);


    Route::post('update-blog-category-status',[BlogCategoryController::class,'updateBlogCategoryStatus'])->name('update.blog-category.status');

    Route::resource('blogs',BlogController::class);
    Route::post('update-blogs-status',[BlogController::class,'updateBlogsStatus'])->name('update.blogs.status');


    Route::resource('reviews',ReviewsController::class);
    Route::resource('cms',CmsPageController::class);

    Route::resource('payments',PaymentsController::class);
    Route::post('filter-payment',[PaymentsController::class,'filetrPayment'])->name('filetr.payment');
    Route::post('reset-payment',[PaymentsController::class,'resetPayment'])->name('reset.payment');
    Route::get('export-payment', [PaymentsController::class, 'exportPayment'])->name('export-payment');
    Route::get('pdf-payment', [PaymentsController::class, 'pdfPayment'])->name('pdf-payment');
    Route::get('csv-payment', [PaymentsController::class, 'csvPayment'])->name('csv-payment');



    Route::resource('wallets',TransporterWalletController::class);
    Route::get('payment-validation',[TransporterWalletController::class,'paymentValidation'])->name('payment.validation');
    Route::resource('refunds',RefundController::class);
    Route::get('refund-payment-validation',[RefundController::class,'refundPaymentValidation'])->name('refund.payment.validation');
    Route::get('export-transporter-account', [TransporterWalletController::class, 'exportTransporterAccount'])->name('export-transporter-account');
    Route::get('export-user-account', [RefundController::class, 'exportUserAccount'])->name('export-user-account');


    Route::resource('vehicletypes',VehicleTypesController::class);

    Route::get('booking',[BookingController::class,'index'])->name('booking.index');
    Route::get('expired',[JobsController::class,'expiredJob'])->name('expired');
    Route::get('pending-payment',[JobsController::class,'pendingPayment'])->name('pending.payment');
    Route::post('pending-payment-approve',[JobsController::class,'pendingPaymentApprove'])->name('pending.payment.approve');
    Route::get('view-booking/{id}',[BookingController::class,'viewBooking'])->name('view-booking');
    Route::post('filter-booking',[BookingController::class,'filetrBooking'])->name('filetr.booking');
    Route::post('reset-booking',[BookingController::class,'resetBooking'])->name('reset.booking');
    Route::get('export-booking', [BookingController::class, 'exportBooking'])->name('export-booking');
    Route::get('pdf-booking', [BookingController::class, 'pdfBooking'])->name('pdf-booking');
    Route::get('csv-booking', [BookingController::class, 'csvBooking'])->name('csv-booking');

    Route::get('reports',[ReportController::class,'index'])->name('reports');

    Route::get('download-quation-invoice',[ReportController::class,'downloadQuationInvoice'])->name('download-quation-invoice');

    Route::post('download-user-quation',[ReportController::class,'downloadUserQuationInvoice'])->name('download-user-quation');
    Route::post('download-transporter-quation',[ReportController::class,'downloadTransporterQuationInvoice'])->name('download-transporter-quation');
    Route::post('download-user-invoice',[ReportController::class,'downloadUserInvoice'])->name('download-user-invoice');
    Route::post('download-user-past-invoice',[ReportController::class,'downloadUserPastInvoice'])->name('download-user-past-invoice');
    


    Route::resource('emails',EmailController::class);
    Route::post('send-email-users',[EmailController::class,'sendEmailUsers'])->name('send.email.users');
    Route::resource('product',ProductController::class);
    Route::resource('productshape',ProductShapeController::class);

    Route::resource('promocodes',PromoCodeController::class);

    Route::match(['get','post'],'setting',[SettingController::class,'setting'])->name('setting');

        //For testimonials
    Route::resource('testimonials',TestimonialController::class);
    Route::resource('banner',BannerController::class);

        //Admins add update delete view
    Route::group(['prefix' => 'admins'], function () {
      Route::get('/list', [AdminsController::class, 'adminsList'])->name('admins_list');
      Route::get('/view/{id}', [AdminsController::class, 'viewAdmin'])->name('view_admin');
      Route::get('/edit/{id}', [AdminsController::class, 'editAdmin'])->name('edit_admin');
      Route::post('/update', [AdminsController::class, 'updateAdmin'])->name('update_admin');
      Route::delete('/delete', [AdminsController::class, 'deleteAdmin'])->name('delete_admin');
      Route::delete('/delete_admin_permanantly', [AdminsController::class, 'deleteAdminPermanantly'])->name('delete_admin_permanantly');

      Route::post('update-admin-status',[AdminsController::class,'updateAdminStatus'])->name('update.admin.status');
      Route::get('/add', [AdminsController::class, 'addAdmin'])->name('add_admin');
      Route::post('/save', [AdminsController::class, 'saveAdmin'])->name('save_admin');
      Route::get('/check_email', [AdminsController::class, 'checkEmail'])->name('check_email');

      Route::post('/filter', [AdminsController::class, 'filter'])->name('admins.filter'); 
    });

        //Role
    Route::group(['prefix' => 'roles'], function () {
      Route::get('/list', [RolesController::class, 'rolesList'])->name('roles_list');
      Route::get('/view/{id}', [RolesController::class, 'viewRole'])->name('view_role');
      Route::get('/add', [RolesController::class, 'addRole'])->name('add_role');
      Route::post('/save', [RolesController::class, 'saveRole'])->name('save_role');
      Route::get('/edit/{id}', [RolesController::class, 'editRole'])->name('edit_role');
      Route::post('/update', [RolesController::class, 'updateRole'])->name('update_role');
      Route::post('/get_role_permissions', [RolesController::class, 'getRolePermissions'])->name('get_role_permissions');
      Route::post('/save_permissions', [RolesController::class, 'saveRolePermissions'])->name('save_permissions');
      Route::delete('/delete', [RolesController::class, 'deleteRole'])->name('delete_role');
      Route::delete('/deleteRolePermanantly', [RolesController::class, 'deleteRolePermanantly'])->name('delete_role_permanantly');
    });

        //Role Permission
    Route::get('/role_permissions', [RolesController::class, 'rolePermissions'])->name('role_permissions');

        // Contact Us
    Route::group(['prefix' => 'contact_us'], function () {
      Route::get('/list', [TicketsController::class, 'contactUsMessagesList'])->name('contact_us_message_list');

      Route::get('/view/{id}', [TicketsController::class, 'viewContactUsMessage'])->name('view_contact_us_message');

      Route::post('/update-status', [TicketsController::class, 'updateStatus'])->name('update_status');

      Route::get('/reply/{id}', [TicketsController::class, 'reply'])->name('contact_us.reply');

      Route::post('/send-reply', [TicketsController::class, 'SendReply'])->name('contact_us.send_reply');

      Route::post('/filter', [TicketsController::class, 'filter'])->name('contact_us.filter');
    });
        //End Contact Us


   //Update information

    Route::group(['prefix' => 'update_info'], function () {
      Route::get('/list', [TicketsController::class, 'updateInformationList'])->name('update_information_list');
      Route::get('/view/{id}', [TicketsController::class, 'viewupdateInformationMessage'])->name('view_update_information_list_message');
      Route::get('/reply1/{id}', [TicketsController::class, 'reply1'])->name('update_info.reply1');
     Route::post('/send-reply1', [TicketsController::class, 'SendReply1'])->name('update_information.send_reply1');



    });








    Route::group(['prefix' => 'special-requests'], function () {
      Route::get('/list', [TicketsController::class, 'specialRrequestlist'])->name('special-requests');

    });




        // Content Management
    Route::group(['prefix' => 'content'], function () {

      Route::resource('tutorials',TutorialController::class);

      Route::group(['prefix' => 'website'], function () {
        Route::get('/list', [ContentController::class, 'websitePagesList'])->name('website_pages_list');
        Route::get('/view/{id}', [ContentController::class, 'viewWebsitePage'])->name('view_website_page');
        Route::get('/add', [ContentController::class, 'addWebsitePage'])->name('add_website_page');
        Route::post('/save', [ContentController::class, 'saveWebsitePage'])->name('save_website_page');

        Route::get('/edit/{id}', [ContentController::class, 'editWebsitePage'])->name('edit_website_page');

        Route::post('/update', [ContentController::class, 'updateWebsitePage'])->name('update_website_page');

      });
      Route::group(['prefix' => 'mobile'], function () {
        Route::get('/list', [ContentController::class, 'mobilePagesList'])->name('mobile_pages_list');
        Route::get('/view/{id}', [ContentController::class, 'viewMobilePage'])->name('view_mobile_page');
        Route::get('/edit/{id}', [ContentController::class, 'editMobilePage'])->name('edit_mobile_page');
        Route::post('/update', [ContentController::class, 'updateMobilePage'])->name('update_mobile_page');
        Route::get('/add', [ContentController::class, 'addMobilePage'])->name('add_mobile_page');
        Route::post('/save', [ContentController::class, 'saveMobilePage'])->name('save_mobile_page');

      });
    });
        // End Content Management

        // Recycle Bin
    Route::group(['prefix' => 'recycle_bin'], function () {

      Route::group(['prefix' => 'users'], function () {
        Route::get('/deleted', [RecycleBinController::class, 'deletedUsersList'])->name('deleted_users_list');
        Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteUsers'])->name('permanent_delete_app_users');
        Route::post('/restore', [RecycleBinController::class, 'restore'])->name('restore_app_user');
      });

      Route::group(['prefix' => 'transporters'], function () {
        Route::get('/deleted', [RecycleBinController::class, 'deletedTransporterList'])->name('deleted_transporter_list');
        Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteTransporter'])->name('permanent_delete_transporter');
        Route::post('/restore', [RecycleBinController::class, 'transporterRestore'])->name('restore_transporter');
      });

      Route::group(['prefix' => 'drivers'], function () {
        Route::get('/deleted', [RecycleBinController::class, 'deletedDriverList'])->name('deleted_driver_list');
        Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteDriver'])->name('permanent_delete_driver');
        Route::post('/restore', [RecycleBinController::class, 'driverRestore'])->name('restore_driver');
      });

      Route::group(['prefix' => 'admins'], function () {
        Route::get('/deleted', [RecycleBinController::class, 'deletedAdminsList'])->name('deleted_admins_list');
        Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteAdmins'])->name('permanent_delete_admins');
        Route::post('/restore', [RecycleBinController::class, 'adminsRestore'])->name('restore_admins');
      });
      Route::group(['prefix' => 'jobs'], function () {
        Route::get('/deleted', [RecycleBinController::class, 'deletedJobsList'])->name('deleted_jobs_list');
        Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteJobs'])->name('permanent_delete_jobs');
        Route::post('/restore', [RecycleBinController::class, 'jobsRestore'])->name('restore_jobs');


      });

      Route::group(['prefix' => 'webiste_content'], function () {
        Route::get('/deleted', [RecycleBinController::class, 'deletedWebsiteContentList'])->name('deleted_website_content_list');
        Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteWebsiteContent'])->name('permanent_delete_website_content');
        Route::post('/restore', [RecycleBinController::class, 'WebsiteContentRestore'])->name('restore_website_content');
      });
      Route::group(['prefix' => 'mobile_content'], function () {
        Route::get('/deleted', [RecycleBinController::class, 'deletedMobileContentList'])->name('deleted_mobile_content_list');
        Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteMobileContent'])->name('permanent_delete_mobile_content');
        Route::post('/restore', [RecycleBinController::class, 'MobileContentRestore'])->name('restore_mobile_content');
      });
      Route::group(['prefix' => 'banner'], function () {
        Route::get('/deleted', [RecycleBinController::class, 'deletedBannerList'])->name('deleted_banner_list');
        Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteBanner'])->name('permanent_delete_banner');
        Route::post('/restore', [RecycleBinController::class, 'bannerRestore'])->name('restore_banner');
      });
      Route::group(['prefix' => 'testimonials'], function () {
        Route::get('/deleted', [RecycleBinController::class, 'deletedTestimonialsList'])->name('deleted_testimonials_list');
        Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteTestimonials'])->name('permanent_delete_testimonials');
        Route::post('/restore', [RecycleBinController::class, 'testimonialsRestore'])->name('restore_testimonials');
      });

      Route::group(['prefix' => 'reviews'], function () {
        Route::get('/deleted', [RecycleBinController::class, 'deletedReviewList'])->name('deleted_review_list');
        Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteReview'])->name('permanent_delete_review');
        Route::post('/restore', [RecycleBinController::class, 'reviewRestore'])->name('restore_review');
      });

    });
        //End Recycle Bin

  });
});
Auth::routes();


