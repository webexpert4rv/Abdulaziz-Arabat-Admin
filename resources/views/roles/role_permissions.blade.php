@extends('adminlte::page')

@section('title', 'Role Permissions')

@section('content_header')
@stop

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="order_details">
          <div class="card">
            <div class="card-header alert d-flex justify-content-between align-items-center">
            <!-- <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a> -->
              <h3>{{ __('adminlte::adminlte.role_permissions') }}</h3>
            </div>
            <div class="card-body pb-3">
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
              <form id="addRoleForm" method="post", action="{{ route('save_permissions') }}">
                @csrf
                <div class="card-body">
                  <div class="role-name">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="role_name">{{ __('adminlte::adminlte.role_name') }}</label>
                          <input type="hidden" name="role_id" id="role_id">
                          <select name="role_name" class="form-control" id="role_name">
                              <option value="" hidden>Select Role</option>
                            @foreach($roles as $role)
                              <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                          </select>
                        
                            <div class="error role_name_error">  @if($errors->has('role_name')){{ $errors->first('role_name') }} @endif</div>
                        
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="role-permissions" id="role-permissions">
                    <label for="permissions[]" class="label">{{ __('adminlte::adminlte.permissions') }}</label>
                  
                    <br>
                  
                      <div class="error permissions_error">   <label id="permissions[]-error" class="error" for="permissions[]" style="font-weight: 400 !important;"></label>@if($errors->has('permissions')){{ $errors->first('permissions') }} @endif</div>
                  

                    <div class="custom_check_wrap">
                      <div class="custom-check">
                        <input type="checkbox" id="full_access" class="">
                        <span></span>       
                      </div>
                      <strong>FULL ACCESS</strong>                     
                    </div> 

                    <div class="title">
                      <h5>Users Management</h5>
                      <hr/>
                    </div>

                    <div class="row permissions-section">
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Users</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="appusers_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($appUsersPermissions as $Userpermission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass appUserscheckBox" name="permissions[]" value="{{ $Userpermission->id }}" id="button_{{ $Userpermission->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $Userpermission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Transporter</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="transporter_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($transporterPermissions as $transporterPermission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass transportercheckBox" name="permissions[]" value="{{ $transporterPermission->id }}" id="button_{{ $transporterPermission->id }}">
                                    <span></span>
                                  </div>
                                  <label class="mb-0">{{ $transporterPermission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                      {{-- <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Drivers</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="driver_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($driversPermissions as $driversPermission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass drivercheckBox" name="permissions[]" value="{{ $driversPermission->id }}" id="button_{{ $driversPermission->id }}">
                                    <span></span>
                                  </div>
                                  <label class="mb-0">{{ $driversPermission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div> --}}
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Admins</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="admins_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($adminsPermissions as $adminsPermission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass adminscheckBox" name="permissions[]" value="{{ $adminsPermission->id }}" id="button_{{ $adminsPermission->id }}">
                                    <span></span>
                                  </div>
                                  <label class="mb-0">{{ $adminsPermission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>


                    <div class="title">
                      <h5>Job Management</h5>
                      <hr/>
                    </div>
                    <div class="row permissions-section">
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Jobs</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="jobs_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($jobsPermissions as $jobsPermission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass jobscheckBox" name="permissions[]" value="{{ $jobsPermission->id }}" id="button_{{ $jobsPermission->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $jobsPermission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Jobs Booked</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="jobs_booked_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($jobsBookedPermissions as $jobsBookedPermission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass jobsBookedcheckBox" name="permissions[]" value="{{ $jobsBookedPermission->id }}" id="button_{{ $jobsBookedPermission->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $jobsBookedPermission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="title">
                      <h5>Email Management</h5>
                      <hr/>
                    </div>
                    <div class="row permissions-section">
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Email</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="email_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($emailPermissions as $emailPermission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass emailcheckBox" name="permissions[]" value="{{ $emailPermission->id }}" id="button_{{ $emailPermission->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $emailPermission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="title">
                      <h5>Blog Management</h5>
                      <hr/>
                    </div>
                    <div class="row permissions-section">
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Blog</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="blog_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($blogPermissions as $blogPermission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass blogcheckBox" name="permissions[]" value="{{ $blogPermission->id }}" id="button_{{ $blogPermission->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $blogPermission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="title">
                      <h5>Payment Management</h5>
                      <hr/>
                    </div>
                    <div class="row permissions-section">
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Payment Transactions</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="payment_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($paymentPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass paymentcheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Transporter Wallets</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="transporter_wallets_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($tranporterWalletsPermissions as $WalletsPermissions)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass transporterWalletscheckBox" name="permissions[]" value="{{ $WalletsPermissions->id }}" id="button_{{ $WalletsPermissions->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $WalletsPermissions->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">User Refunds</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="user_refunds_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($userRefundsPermissions as $RefundsPermissions)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass userRefundscheckBox" name="permissions[]" value="{{ $RefundsPermissions->id }}" id="button_{{ $RefundsPermissions->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $RefundsPermissions->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="title">
                      <h5>Content Management</h5>
                      <hr/>
                    </div>
                    <div class="row permissions-section">
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Website Content</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="website_content_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($webisteContentPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass websitecontentcheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Mobile Content</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="mobile_content_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($mobileContentPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass mobilecontentcheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Banner</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="banner_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($bannerPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass bannercheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="title">
                      <h5>User Feedback</h5>
                      <hr/>
                    </div>
                    <div class="row permissions-section">
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Contact Us</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="contact_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($feedbackPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass contactcheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Reviews</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="reviews_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($reviewsPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass reviewscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Testimonials</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="testimonials_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($testimonialsPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass testimonialscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="title">
                      <h5>Report & Analytics</h5>
                      <hr/>
                    </div>
                    <div class="row permissions-section">
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Report & Analytics</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="reports_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($RepostsPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass reportscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="title">
                      <h5>Misc Data Management</h5>
                      <hr/>
                    </div>
                    <div class="row permissions-section">
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Misc Data</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="misc_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($miscPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass misccheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="title">
                      <h5>Access Control</h5>
                      <hr/>
                    </div>
                    <div class="row permissions-section">
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Roles</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="access_control_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($rolesPermissions as $ControlPermissions)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass accessControlcheckBox" name="permissions[]" value="{{ $ControlPermissions->id }}" id="button_{{ $ControlPermissions->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $ControlPermissions->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Permission</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="permission_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($accessControlPermissions as $ControlPermissions)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass permissioncheckBox" name="permissions[]" value="{{ $ControlPermissions->id }}" id="button_{{ $ControlPermissions->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $ControlPermissions->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="title">
                      <h5>Recycel Bin</h5>
                      <hr/>
                    </div>
                    <div class="row permissions-section">
                      <div class="col-3">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Recycle Bin</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="recycle_bin_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($recycleBinPermissions as $recyclebinpermission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass recycleBincheckBox" name="permissions[]" value="{{ $recyclebinpermission->id }}" id="button_{{ $recyclebinpermission->id }}">
                                    <span></span>
                                  </div>
                                    <label class="mb-0">{{ $recyclebinpermission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer pt-0">
                  <button type="submit" class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
                </div>
              </form>
            </div>
          </div>
          </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    strong.list-text {
      position: relative;
      left: -8px;
      top: -3px;
    }
    span.list-text {
      position: relative;
      left: -8px;
      top: -3px;
    }
    /* .role-permissions { display:none; } */
  </style>
@stop

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
 <script>
    $(document).ready(function() {
      checkAll();
      $("input[type='checkbox']").change(function() {
        checkAll();
      });
      $("#role_name").change(function() {
        $('input').filter(':checkbox').prop('checked',false);
        var role = $(this);
        $("#role_id").val(role.val());
        $(".checkBoxClass").removeAttr('checked');
        var id = $("#role_name").val();
        $.ajax({
          url: "{{ route('get_role_permissions') }}",
          type: 'post',
          data: {
            role_id: id
          },
          dataType: "JSON",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(res) {
            for (let i = 0; i < res.length; i++) {
              const response = res[i];
              var permissionId = "#button_"+response.permission_id;
              $(permissionId).prop('checked', 'true');
              checkAll();
            }
          }
        });
      });
      
      $('#addRoleForm').validate({
        ignore: [],
        debug: false,
        rules: {
          role_name: {
            required: true
          },
          "permissions[]":{
            required: true
          }
        },
        messages: {
          role_name: {
            required: "Role Name  is required."
          },
          "permissions[]": {
            required: "You must select at least one permission.",
          }
        }
      
      });
    });
    
    function checkAll() {
      $("#full_access").click(function() {
        $("input[type=checkbox]").prop('checked', this.checked)
      })
      $("#appusers_permissions").click(function() {
        $(".appUserscheckBox").prop('checked', this.checked)
      })
      $("#driver_permissions").click(function() {
        $(".drivercheckBox").prop('checked', this.checked)
      })
      $("#transporter_permissions").click(function() {
          $(".transportercheckBox").prop('checked', this.checked)
        })
        $("#admins_permissions").click(function() {
          $(".adminscheckBox").prop('checked', this.checked)
        })
      $("#jobs_permissions").click(function() {
        $(".jobscheckBox").prop('checked', this.checked)
      })
      $("#jobs_booked_permissions").click(function() {
        $(".jobsBookedcheckBox").prop('checked', this.checked)
      })
      $("#email_permissions").click(function() {
        $(".emailcheckBox").prop('checked', this.checked)
      })
      $("#payment_permissions").click(function() {
        $(".paymentcheckBox").prop('checked', this.checked)
      })

      $("#transporter_wallets_permissions").click(function() {
        $(".transporterWalletscheckBox").prop('checked', this.checked)
      })
      $("#user_refunds_permissions").click(function() {
        $(".userRefundscheckBox").prop('checked', this.checked)
      })
      $("#website_content_permissions").click(function() {
        $(".websitecontentcheckBox").prop('checked', this.checked)
      })
      $("#mobile_content_permissions").click(function() {
        $(".mobilecontentcheckBox").prop('checked', this.checked)
      })
      $("#banner_permissions").click(function() {
        $(".bannercheckBox").prop('checked', this.checked)
      })

      $("#contact_permissions").click(function() {
        $(".contactcheckBox").prop('checked', this.checked)
      })
      $("#reviews_permissions").click(function() {
        $(".reviewscheckBox").prop('checked', this.checked)
      })
      $("#testimonials_permissions").click(function() {
        $(".testimonialscheckBox").prop('checked', this.checked)
      })

      ////
      $("#reports_permissions").click(function() {
        $(".reportscheckBox").prop('checked', this.checked)
      })
      $("#misc_permissions").click(function() {
        $(".misccheckBox").prop('checked', this.checked)
      })

      $("#access_control_permissions").click(function() {
        $(".accessControlcheckBox").prop('checked', this.checked)
      })
      $("#recycle_bin_permissions").click(function() {
        $(".recycleBincheckBox").prop('checked', this.checked)
      })
      
      $("#permission_permissions").click(function() {
        $(".permissioncheckBox").prop('checked', this.checked)
      })
      $("#blog_permissions").click(function() {
        $(".blogcheckBox").prop('checked', this.checked)
      })

      ////////////////////////////////////////

      if($('.checkBoxClass:checked').length == $('.checkBoxClass').length) {
        $("#full_access").prop('checked', 'true');
      }
      else {
        $("#full_access").prop('checked', false);
      }
      if($('.appUserscheckBox:checked').length == $('.appUserscheckBox').length) {
        $("#appusers_permissions").prop('checked', 'true');
      }
      else {
        $("#appusers_permissions").prop('checked', false);
      }

     
      if($('.drivercheckBox:checked').length == $('.drivercheckBox').length) {
        $("#driver_permissions").prop('checked', 'true');
      }
      else {
        $("#driver_permissions").prop('checked', false);
      }



      if($('.transportercheckBox:checked').length == $('.transportercheckBox').length) {
        $("#transporter_permissions").prop('checked', 'true');
      }
      else {
        $("#transporter_permissions").prop('checked', false);
      }
      if($('.adminscheckBox:checked').length == $('.adminscheckBox').length) {
        $("#admins_permissions").prop('checked', 'true');
      }
      else {
        $("#admins_permissions").prop('checked', false);
      }
      if($('.jobscheckBox:checked').length == $('.jobscheckBox').length) {
        $("#jobs_permissions").prop('checked', 'true');
      }
      else {
        $("#jobs_permissions").prop('checked', false);
      }

      if($('.jobsBookedcheckBox:checked').length == $('.jobsBookedcheckBox').length) {
        $("#jobs_booked_permissions").prop('checked', 'true');
      }
      else {
        $("#jobs_booked_permissions").prop('checked', false);
      }
      if($('.emailcheckBox:checked').length == $('.emailcheckBox').length) {
        $("#email_permissions").prop('checked', 'true');
      }
      else {
        $("#email_permissions").prop('checked', false);
      }

      if($('.paymentcheckBox:checked').length == $('.paymentcheckBox').length) {
        $("#payment_permissions").prop('checked', 'true');
      }
      else {
        $("#payment_permissions").prop('checked', false);
      }

      if($('.transporterWalletscheckBox:checked').length == $('.transporterWalletscheckBox').length) {
        $("#transporter_wallets_permissions").prop('checked', 'true');
      }
      else {
        $("#transporter_wallets_permissions").prop('checked', false);
      }
      if($('.userRefundscheckBox:checked').length == $('.userRefundscheckBox').length) {
        $("#user_refunds_permissions").prop('checked', 'true');
      }
      else {
        $("#user_refunds_permissions").prop('checked', false);
      }


      if($('.websitecontentcheckBox:checked').length == $('.websitecontentcheckBox').length) {
        $("#website_content_permissions").prop('checked', 'true');
      }
      else {
        $("#website_content_permissions").prop('checked', false);
      }
      if($('.mobilecontentcheckBox:checked').length == $('.mobilecontentcheckBox').length) {
        $("#mobile_content_permissions").prop('checked', 'true');
      }
      else {
        $("#mobile_content_permissions").prop('checked', false);
      }

      if($('.bannercheckBox:checked').length == $('.bannercheckBox').length) {
        $("#banner_permissions").prop('checked', 'true');
      }
      else {
        $("#banner_permissions").prop('checked', false);
      }
      if($('.contactcheckBox:checked').length == $('.contactcheckBox').length) {
        $("#contact_permissions").prop('checked', 'true');
      }
      else {
        $("#contact_permissions").prop('checked', false);
      }
      if($('.reviewscheckBox:checked').length == $('.reviewscheckBox').length) {
        $("#reviews_permissions").prop('checked', 'true');
      }
      else {
        $("#reviews_permissions").prop('checked', false);
      }
      if($('.testimonialscheckBox:checked').length == $('.testimonialscheckBox').length) {
        $("#testimonials_permissions").prop('checked', 'true');
      }
      else {
        $("#testimonials_permissions").prop('checked', false);
      }
/////
      if($('.reportscheckBox:checked').length == $('.reportscheckBox').length) {
        $("#reports_permissions").prop('checked', 'true');
      }
      else {
        $("#reports_permissions").prop('checked', false);
      }
      if($('.misccheckBox:checked').length == $('.misccheckBox').length) {
        $("#misc_permissions").prop('checked', 'true');
      }
      else {
        $("#misc_permissions").prop('checked', false);
      }

      if($('.accessControlcheckBox:checked').length == $('.accessControlcheckBox').length) {
        $("#access_control_permissions").prop('checked', 'true');
      }
      else {
        $("#access_control_permissions").prop('checked', false);
      }
      if($('.recycleBincheckBox:checked').length == $('.recycleBincheckBox').length) {
        $("#recycle_bin_permissions").prop('checked', 'true');
      }
      else {
        $("#recycle_bin_permissions").prop('checked', false);
      }

      if($('.permissioncheckBox:checked').length == $('.permissioncheckBox').length) {
        $("#permission_permissions").prop('checked', 'true');
      }
      else {
        $("#permission_permissions").prop('checked', false);
      }

      if($('.blogcheckBox:checked').length == $('.blogcheckBox').length) {
        $("#blog_permissions").prop('checked', 'true');
      }
      else {
        $("#blog_permissions").prop('checked', false);
      }
      
    }
  </script>
@stop
