<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JobSeekersController;
use App\Http\Controllers\RecruitersController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\MiscController;
use App\Http\Controllers\CreditsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\GuestsController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\AutoAndMotoPartsController;
use App\Http\Controllers\PowerEquipmentController;
use App\Http\Controllers\Admin\SellController;
use App\Http\Controllers\Admin\EngineController;
use App\Http\Controllers\Admin\TrimController;
use App\Http\Controllers\Admin\StyleController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\ExtendedWarrantyPlanController;
use App\Http\Controllers\Admin\User\UserContoller;
// use App\Http\Controllers\Admin\RecycleBinController;
use App\Http\Controllers\RecycleBinController;

use App\Http\Controllers\Admin\AutoMotoRepairController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\ExtendedWarrantyComponentCovered;
use App\Http\Controllers\Admin\ConfigurationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SchoolController;

use App\Http\Controllers\ReportController;



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
  // return view('welcome');
})->name('admin_home');
 Route::post('/preview', [ContentController::class, 'previewDoroosiWeb'])->name('preview_web');
Route::middleware(['auth:admin'])->group(function () {
  // Admin Panel
  Route::group(['prefix' => 'admin_panel'], function () {
    Route::get('/user_permissions', [RolesController::class, 'getUserPermissions'])->name('user_permissions');
    Route::get('/all_permissions', [RolesController::class, 'getAllPermissions'])->name('all_permissions');
    
    // Common
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::post('/set-session',[AdminController::class, 'setSession'])->name('setSession');

    Route::get('/admin_profile', [AdminController::class, 'adminProfile'])->name('admin_profile');
    Route::post('/update_profile', [AdminController::class, 'updateProfile'])->name('update_profile');
    Route::post('/check_password', [AdminController::class, 'checkPassword'])->name('check_password');
    Route::post('/change_password', [AdminController::class, 'changePassword'])->name('change_password');


    // Users Management
    Route::group(['prefix' => 'users'], function () {
      // Normal Customer
        Route::get('/list', [UserContoller::class, 'index'])->name('user_index');
        Route::get('/view/{id}', [UserContoller::class, 'viewUser'])->name('user_view');
        Route::get('/edit/{id}', [UserContoller::class, 'editUser'])->name('user_edit');
        Route::post('/update/user', [UserContoller::class, 'updateUser'])->name('update_user');
        Route::post('/delete/user', [UserContoller::class, 'deleteUser'])->name('delete_user');
        Route::post('/restore', [UserContoller::class, 'restoreUser'])->name('restore_user');
        Route::post('/permanent_delete', [UserContoller::class, 'permanentDeleteUser'])->name('permanent_delete_user');

    });

    // instructor Management
    Route::group(['prefix' => 'instructor-management'], function () {
        Route::get('/list', [TeacherController::class, 'teachers'])->name('teacher_management_list');
        Route::get('/view/{id}', [TeacherController::class, 'viewteacher'])->name('teacher_management_view');
        Route::get('/view/questions/{set_id}', [TeacherController::class, 'setQuestions'])->name('teacher_management_set_questions');

        Route::post('/filter',[TeacherController::class, 'filterSets'])->name('instructors.sets.filter');
    });

    // students management
    Route::group(['prefix' => 'student-management'], function () {
        Route::get('/list', [StudentController::class, 'students'])->name('student_management_list');
        Route::get('/view/{id}', [StudentController::class, 'viewStudent'])->name('student_management_view');
        Route::get('/view/questions/{user_id}/{set_id}', [StudentController::class, 'setQuestions'])->name('student_management_set_questions');

        Route::get('/courses', [StudentController::class, 'courses'])->name('student_management_courses');
        Route::get('/courses/students/{course_id}', [StudentController::class, 'courseStudents'])->name('student_management_course_students');

        Route::post('/courses/students/enable-or-disable', [StudentController::class, 'enableOrDisableStudent'])->name('student_management.course_student.enable_or_disable');

        Route::post('/filter',[StudentController::class, 'filterSets'])->name('students.sets.filter');
    });
    // students management

    // reports
    Route::group(['prefix' => 'reports'], function () {
        Route::get('/students', [ReportController::class, 'students'])->name('reports.students');
        Route::get('/teachers', [ReportController::class, 'teachers'])->name('reports.teachers');
        Route::get('/payments', [ReportController::class, 'payments'])->name('reports.payments');

        Route::post('/filter-students-reports', [ReportController::class, 'filterStudentsReport'])->name('reports.filter_students_report');

        Route::post('/filter-teachers-reports', [ReportController::class, 'filterTeachersReport'])->name('reports.filter_teachers_report');

        Route::post('/filter-payments-reports', [ReportController::class, 'filterPaymentsReport'])->name('reports.filter_payments_report');
    });
    // reports


    // added later
    // Teachers
    Route::group(['prefix' => 'teachers'], function () {
      Route::get('/list', [TeacherController::class, 'list'])->name('teachers_list');
      Route::get('/view/{id}', [TeacherController::class, 'view'])->name('view_teacher');
      Route::get('/edit/{id}', [TeacherController::class, 'edit'])->name('edit_teacher');
      Route::post('/update', [TeacherController::class, 'update'])->name('update_teacher');
      Route::delete('/delete', [TeacherController::class, 'delete'])->name('delete_teacher');
      Route::delete('/deleteTeacherPermanantly', [TeacherController::class, 'deleteTeacherPermanantly'])->name('delete_teacher_permanantly');

      
      Route::get('/add', [TeacherController::class, 'add'])->name('add_teacher');
      Route::post('/save', [TeacherController::class, 'save'])->name('save_teacher');

      //ajax routes
      Route::post('/toggle-job-alert', [TeacherController::class, 'toggleJobAlert'])->name('toggle.job.alert');
      Route::post('/store-job-alert/{id}', [TeacherController::class, 'storeJobAlert'])->name('store.job.alert');

      Route::post('/filter', [TeacherController::class, 'filter'])->name('teachers.filter');

    });

    // Students
    Route::group(['prefix' => 'students'], function () {
      Route::get('/list', [StudentController::class, 'list'])->name('students_list');
      Route::get('/view/{id}', [StudentController::class, 'view'])->name('view_student');
      Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('edit_student');
      Route::post('/update', [StudentController::class, 'update'])->name('update_student');
      Route::delete('/delete', [StudentController::class, 'delete'])->name('delete_student');
      Route::get('/add', [StudentController::class, 'add'])->name('add_student');
      Route::post('/save', [StudentController::class, 'save'])->name('save_student');
      Route::delete('/deleteStudentPermanently', [StudentController::class, 'deleteStudentPermanently'])->name('delete_student_permanantly');

      Route::post('/filter', [StudentController::class, 'filter'])->name('students.filter');

    });
    
    // added later

    // School Management
    Route::group(['prefix' => 'schools'], function () {
        Route::get('/list', [SchoolController::class, 'schoolList'])->name('schools_list');
        Route::get('/add', [SchoolController::class, 'addschool'])->name('add_school');
        Route::post('/save', [SchoolController::class, 'saveSchool'])->name('save_school');
        Route::get('/view/{id}', [SchoolController::class, 'viewschool'])->name('view_school');
        Route::get('/edit/{id}', [SchoolController::class, 'editschool'])->name('edit_school');

        Route::get('/instructors/{school_id}', [SchoolController::class, 'schoolInstructors'])->name('school_instructors');

        Route::post('/update_school', [SchoolController::class, 'updateschool'])->name('update_school');
        Route::delete('/delete_school', [SchoolController::class, 'deleteschool'])->name('delete_school');
        Route::delete('/delete_school_pemanantly', [SchoolController::class, 'deleteSchoolPermanantly'])->name('delete_school_permanantly');
        Route::post('/filter', [SchoolController::class, 'filter'])->name('schools.filter');

    });

    // Admins
    Route::group(['prefix' => 'admins'], function () {
      Route::get('/list', [AdminsController::class, 'adminsList'])->name('admins_list');
      Route::get('/view/{id}', [AdminsController::class, 'viewAdmin'])->name('view_admin');
      Route::get('/edit/{id}', [AdminsController::class, 'editAdmin'])->name('edit_admin');
      Route::post('/update', [AdminsController::class, 'updateAdmin'])->name('update_admin');
      Route::delete('/delete', [AdminsController::class, 'deleteAdmin'])->name('delete_admin');
      Route::delete('/delete_admin_permanantly', [AdminsController::class, 'deleteAdminPermanantly'])->name('delete_admin_permanantly');

      // Route::post('/restore', [AdminsController::class, 'restoreAdmin'])->name('restore_admin');
      Route::get('/add', [AdminsController::class, 'addAdmin'])->name('add_admin');
      Route::post('/save', [AdminsController::class, 'saveAdmin'])->name('save_admin');
      Route::post('/check_email', [AdminsController::class, 'checkEmail'])->name('check_email');

      Route::post('/filter', [AdminsController::class, 'filter'])->name('admins.filter');
      
    });

    Route::get('/check_email', [AdminsController::class, 'checkEmail'])->name('check_email');

    // Contact Us
    Route::group(['prefix' => 'contact_us'], function () {
      Route::get('/list', [TicketsController::class, 'contactUsMessagesList'])->name('contact_us_message_list');
      Route::get('/view/{id}', [TicketsController::class, 'viewContactUsMessage'])->name('view_contact_us_message');

      Route::post('/update-status', [TicketsController::class, 'updateStatus'])->name('update_status');

      Route::get('/reply/{id}', [TicketsController::class, 'reply'])->name('contact_us.reply');

      Route::post('/send-reply', [TicketsController::class, 'SendReply'])->name('contact_us.send_reply');

      Route::post('/filter', [TicketsController::class, 'filter'])->name('contact_us.filter');
    });


    // configurations
    Route::get('/configurations',[ConfigurationController::class, 'configurations'])->name('configurations');

    Route::post('/configurations/update',[ConfigurationController::class, 'updateConfigurations'])->name('configurations.update');
    // configurations

     // Payments Transactions
    Route::group(['prefix' => 'payment_transactions'], function () {
      Route::get('/list', [PaymentsController::class, 'paymentTransactionsList'])->name('payment_transactions_list');

      Route::get('/view/{id}', [PaymentsController::class, 'view'])->name('payment_transactions_view');

      Route::post('/filter', [PaymentsController::class, 'filter'])->name('payment_transactions_filter');
      Route::post('/reset', [PaymentsController::class, 'reset'])->name('payment_transactions_reset');
    
    });

    // promo codes
    Route::group(['prefix' => 'promo-codes'], function () {
      Route::get('/list', [PaymentsController::class, 'promoCodes'])->name('promo_codes');
      Route::get('/add', [PaymentsController::class, 'addPromoCode'])->name('promo_codes.add');
      Route::get('/edit/{id}', [PaymentsController::class, 'editPromoCode'])->name('promo_codes.edit');
      Route::post('/save', [PaymentsController::class, 'savePromoCode'])->name('promo_codes.save');
      Route::post('/update', [PaymentsController::class, 'updatePromoCode'])->name('promo_codes.update');

      Route::post('/delete', [PaymentsController::class, 'deletePromoCode'])->name('promo_codes.delete');
    });
    // promo codes



    Route::get('/privacy-policy', [ContentController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::get('/pricing-policy', [ContentController::class, 'pricingPolicy'])->name('pricing-policy');
    Route::get('/terms-and-conditions', [ContentController::class, 'termsAndConditions'])->name('terms-and-conditions');
    Route::post('/save-privacy-policy', [ContentController::class, 'savePrivacyPolicy'])->name('save-privacy-policy');
    Route::post('/save-pricing-policy', [ContentController::class, 'savePricingPolicy'])->name('save-pricing-policy');
    Route::post('/save-terms-and-conditions', [ContentController::class, 'saveTermsAndConditions'])->name('save-terms-and-conditions');
    

    // Access Controls
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
    Route::get('/role_permissions', [RolesController::class, 'rolePermissions'])->name('role_permissions');

    // Content Management
    Route::group(['prefix' => 'content'], function () {
      Route::group(['prefix' => 'website'], function () {
        Route::get('/list', [ContentController::class, 'websitePagesList'])->name('website_pages_list');
        Route::get('/view/{id}', [ContentController::class, 'viewWebsitePage'])->name('view_website_page');
        Route::get('/edit/{id}', [ContentController::class, 'editWebsitePage'])->name('edit_website_page');
        Route::post('/update', [ContentController::class, 'updateWebsitePage'])->name('update_website_page');
        Route::post('/save_as_draft', [ContentController::class, 'saveAsDraft'])->name('save_draft_website_page');
        Route::get('/page_revisions', [ContentController::class, 'pageRevisions'])->name('website_page_revisions');
        Route::get('/page_drafts', [ContentController::class, 'pageDrafts'])->name('website_page_drafts');
         Route::get('/view-page-revision/{id}', [ContentController::class, 'viewRevision'])->name('view_page_revision');
        Route::get('/restore-page-revision/{id}', [ContentController::class, 'restoreContent'])->name('restore_page_content');
        Route::get('/view-page-draft/{id}', [ContentController::class, 'viewPageDraft'])->name('view_draft');
        Route::post('/rename_draft_revision', [ContentController::class, 'renameDraftRevion'])->name('rename_draft_revision');
         Route::get('/edit_draft_revision/{id}', [ContentController::class, 'editDraftRevisionPage'])->name('edit_draft_revision');
        Route::post('/edit_draft_revision', [ContentController::class, 'updateDraftRevision'])->name('update_draft_revision');
        
      });
      Route::group(['prefix' => 'mobile'], function () {
        Route::get('/list', [ContentController::class, 'mobilePagesList'])->name('mobile_pages_list');
        Route::get('/view/{id}', [ContentController::class, 'viewMobilePage'])->name('view_mobile_page');
        Route::get('/edit/{id}', [ContentController::class, 'editMobilePage'])->name('edit_mobile_page');
        Route::post('/update', [ContentController::class, 'updateMobilePage'])->name('update_mobile_page');
      });
    });

    // Recycle Bin
    Route::group(['prefix' => 'recycle_bin'], function () {
      Route::group(['prefix' => 'teachers'], function () {
        Route::get('/deleted', [RecycleBinController::class, 'deletedTeachersList'])->name('deleted_teachers_list');
        Route::post('/restore', [RecycleBinController::class, 'restoreTeacher'])->name('restore_teacher');
        Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteTeacher'])->name('permanent_delete_teacher');
      });

      Route::group(['prefix' => 'students'], function () {
        Route::get('/deleted', [RecycleBinController::class, 'deletedStudentsList'])->name('deleted_students_list');
        Route::post('/restore', [RecycleBinController::class, 'restoreStudent'])->name('restore_student');
        Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteStudent'])->name('permanent_delete_student');
      });
      
      Route::group(['prefix' => 'admins'], function () {
        Route::get('/deleted', [RecycleBinController::class, 'deletedAdminsList'])->name('deleted_admins_list');
        Route::post('/restore', [RecycleBinController::class, 'restoreAdmin'])->name('restore_admin');
        Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteAdmin'])->name('permanent_delete_admin');
      });

      Route::group(['prefix' => 'schools'], function () {
        Route::get('/deleted', [RecycleBinController::class, 'deletedSchoolsList'])->name('deleted_schools');
        Route::post('/restore', [RecycleBinController::class, 'restoreSchool'])->name('restore_school');
        Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteSchool'])->name('permanent_delete_school');
      });

      Route::group(['prefix' => 'roles'], function () {
        Route::get('/deleted', [RecycleBinController::class, 'deletedRolesList'])->name('deleted_roles');
        Route::post('/restore', [RecycleBinController::class, 'restoreRole'])->name('restore_role');
        Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteRole'])->name('permanent_delete_role');
      });
    });

      

    Route::prefix('datatable')->as('datatable.')->group(function(){
      
      Route::get('/payment-logs',[DatatableController::class,'getPaymentLogs'])->name('payment.logs');
      Route::post('/export-payment-logs',[DatatableController::class,'exportPaymentLogs'])->name('export.payment.logs');
      Route::post('/export-bulk-invoices',[DatatableController::class,'exportBulkInvoices'])->name('export.bulk.invoices');
    });
  });
});

Auth::routes([
  'register' => false,
  'reset' => false,
  'verify' => false,
]);


Route::post('get-qualifications',[JobsController::class,'getQualifications'])->name('recruiter.get.qualification');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
