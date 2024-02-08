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
              <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                <h3>{{ __('adminlte::adminlte.role_permissions') }}</h3>
              </div>
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
                              @foreach(@$roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                              @endforeach
                            </select>
                            @if($errors->has('role_name'))
                              <div class="error">{{ $errors->first('role_name') }}</div>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="role-permissions" id="role-permissions">
                      <label for="permissions[]" class="label">{{ __('adminlte::adminlte.permissions') }}</label>
                      <label id="permissions[]-error" class="error" for="permissions[]" style="font-weight: 400 !important;"></label>
                      <br>
                      @if($errors->has('permissions'))
                        <div class="error">{{ $errors->first('permissions') }}</div>
                      @endif

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
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="permissions-section-inner-sec">
                              <p class="headings"><strong class="list-text">Teachers</strong></p>
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" id="teachers_permissions" class="ckbCheckAll">
                                  <span></span>
                                </div>
                                  <strong class="list-text">Select All</strong>
                              </div>
                              <div id="checkBoxes">
                                @foreach(@$teachersPermissions as $permission)
                                  <div class="custom_check_wrap">
                                    <div class="custom-check">
                                      <input type="checkbox" class="checkBoxClass teacherscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                      <span></span>
                                    </div>
                                    <label class="mb-0">{{ $permission->name }}</label>
                                  </div>
                                @endforeach
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="permissions-section-inner-sec">
                              <p class="headings"><strong class="list-text">Students</strong></p>
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" id="students_permissions" class="ckbCheckAll">
                                  <span></span>
                                </div>
                                  <strong class="list-text">Select All</strong>
                              </div>
                              <div id="checkBoxes">
                                @foreach(@$studentsPermissions as $permission)
                                  <div class="custom_check_wrap">
                                    <div class="custom-check">
                                      <input type="checkbox" class="checkBoxClass studentscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                      <span></span>
                                    </div>
                                    <label class="mb-0">{{ $permission->name }}</label>
                                  </div>
                                @endforeach
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
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
                                @foreach(@$adminsPermissions as $permission)
                                  <div class="custom_check_wrap">
                                    <div class="custom-check">
                                      <input type="checkbox" class="checkBoxClass adminscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
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

                      <!-- instructor management -->
                      <div class="title">
                        <h5>Instructor Management</h5>
                        <hr/>
                      </div>

                      <div class="row permissions-section">
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="permissions-section-inner-sec">
                              <p class="headings"><strong class="list-text">Instructors</strong></p>
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" id="instructors_permissions" class="ckbCheckAll">
                                  <span></span>
                                </div>
                                  <strong class="list-text">Select All</strong>
                              </div>
                              <div id="checkBoxes">
                                @foreach(@$instructorPermissions as $permission)
                                  <div class="custom_check_wrap">
                                    <div class="custom-check">
                                      <input type="checkbox" class="checkBoxClass instructorscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
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
                      <!-- instructor management -->
                      <!-- students managements -->
                      <div class="title">
                        <h5>Student Management</h5>
                        <hr/>
                      </div>

                      <div class="row permissions-section">
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="permissions-section-inner-sec">
                              <p class="headings"><strong class="list-text">Students</strong></p>
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" id="students2_permissions" class="ckbCheckAll">
                                  <span></span>
                                </div>
                                  <strong class="list-text">Select All</strong>
                              </div>
                              <div id="checkBoxes">
                                @foreach(@$students_permissions as $permission)
                                  <div class="custom_check_wrap">
                                    <div class="custom-check">
                                      <input type="checkbox" class="checkBoxClass students2checkBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
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
                      <!-- students managements -->


                      <!-- reports  -->
                      <div class="title">
                        <h5>Reports</h5>
                        <hr/>
                      </div>

                      <div class="row permissions-section">
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="permissions-section-inner-sec">
                              <p class="headings"><strong class="list-text">Reports Statistics</strong></p>
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" id="reports_permissions" class="ckbCheckAll">
                                  <span></span>
                                </div>
                                  <strong class="list-text">Select All</strong>
                              </div>
                              <div id="checkBoxes">
                                @foreach(@$reportsPermissions as $permission)
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
                      <!-- reports  -->
                      

                      <!-- payments permission -->
                      <div class="title">
                        <h5>Payments</h5>
                        <hr/>
                      </div>

                      <div class="row permissions-section">
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="permissions-section-inner-sec">
                              <p class="headings"><strong class="list-text">Payments Transactions</strong></p>
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" id="payment_permissions" class="ckbCheckAll">
                                  <span></span>
                                </div>
                                  <strong class="list-text">Select All</strong>
                              </div>
                              <div id="checkBoxes">
                                @foreach(@$paymentsPermissions as $permission)
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
                        
                      </div>
                      <!-- payments permission -->
                      <!-- feedbacks -->
                      <div class="title">
                        <h5>User Feedback</h5>
                        <hr/>
                      </div>

                      <div class="row permissions-section">
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="permissions-section-inner-sec">
                              <p class="headings"><strong class="list-text">Contact Us</strong></p>
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" id="feedback_permissions" class="ckbCheckAll">
                                  <span></span>
                                </div>
                                  <strong class="list-text">Select All</strong>
                              </div>
                              <div id="checkBoxes">
                                @foreach(@$feedbackPermissions as $permission)
                                  <div class="custom_check_wrap">
                                    <div class="custom-check">
                                      <input type="checkbox" class="checkBoxClass feedbackcheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
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
                      <!-- feedbacks -->

                      <!-- content managements -->
                      <div class="title">
                        <h5>Content Management</h5>
                        <hr/>
                      </div>

                      <div class="row permissions-section">
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="permissions-section-inner-sec">
                              <p class="headings"><strong class="list-text">Website Pages</strong></p>
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" id="website_permissions" class="ckbCheckAll">
                                  <span></span>
                                </div>
                                  <strong class="list-text">Select All</strong>
                              </div>
                              <div id="checkBoxes">
                                @foreach(@$websitePermissions as $permission)
                                  <div class="custom_check_wrap">
                                    <div class="custom-check">
                                      <input type="checkbox" class="checkBoxClass websitecheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                      <span></span>
                                    </div>
                                    <label class="mb-0">{{ $permission->name }}</label>
                                  </div>
                                @endforeach
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="permissions-section-inner-sec">
                              <p class="headings"><strong class="list-text">Mobile Pages</strong></p>
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" id="mobile_permissions" class="ckbCheckAll">
                                  <span></span>
                                </div>
                                  <strong class="list-text">Select All</strong>
                              </div>
                              <div id="checkBoxes">
                                @foreach(@$mobilePermissions as $permission)
                                  <div class="custom_check_wrap">
                                    <div class="custom-check">
                                      <input type="checkbox" class="checkBoxClass mobilecheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
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
                      <!-- content managements -->

                      <div class="title">
                        <h5>Misc Data Management</h5>
                        <hr/>
                      </div>

                      <div class="row permissions-section">
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="permissions-section-inner-sec">
                              <p class="headings"><strong class="list-text">Schools</strong></p>
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" id="schools_permissions" class="ckbCheckAll">
                                  <span></span>
                                </div>
                                  <strong class="list-text">Select All</strong>
                              </div>
                              <div id="checkBoxes">
                                @foreach(@$schoolsPermissions as $permission)
                                  <div class="custom_check_wrap">
                                    <div class="custom-check">
                                      <input type="checkbox" class="checkBoxClass schoolscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
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
                      
                      <!-- <div class="title">
                        <h5>Content Management</h5>
                        <hr/>
                      </div>

                      <div class="row permissions-section">
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="permissions-section-inner-sec">
                              <p class="headings"><strong class="list-text">Website</strong></p>
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" id="website_permissions" class="ckbCheckAll">
                                  <span></span>
                                </div>
                                  <strong class="list-text">Select All</strong>
                              </div>
                              <div id="checkBoxes">
                                @foreach(@$websitePagesPermissions as $permission)
                                  <div class="custom_check_wrap">
                                    <div class="custom-check">
                                      <input type="checkbox" class="checkBoxClass websitecheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                      <span></span>
                                    </div>
                                    <label class="mb-0">{{ $permission->name }}</label>
                                  </div>
                                @endforeach
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="permissions-section-inner-sec">
                              <p class="headings"><strong class="list-text">Mobile</strong></p>
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" id="mobile_permissions" class="ckbCheckAll">
                                  <span></span>
                                </div>
                                  <strong class="list-text">Select All</strong>
                              </div>
                              <div id="checkBoxes">
                                @foreach(@$mobilePagesPermissions as $permission)
                                  <div class="custom_check_wrap">
                                    <div class="custom-check">
                                      <input type="checkbox" class="checkBoxClass mobilecheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                      <span></span>
                                    </div>
                                    <label class="mb-0">{{ $permission->name }}</label>
                                  </div>
                                @endforeach
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> -->

                      <div class="title">
                        <h5>Access Control</h5>
                        <hr/>
                      </div>

                      <div class="row permissions-section">
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="permissions-section-inner-sec">
                              <p class="headings"><strong class="list-text">Roles</strong></p>
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" id="roles_permissions" class="ckbCheckAll">
                                  <span></span>
                                </div>
                                  <strong class="list-text">Select All</strong>
                              </div>
                              <div id="checkBoxes">
                                @foreach(@$rolesPermissions as $permission)
                                  <div class="custom_check_wrap">
                                    <div class="custom-check">
                                      <input type="checkbox" class="checkBoxClass rolescheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                      <span></span>
                                    </div>
                                    <label class="mb-0">{{ $permission->name }}</label>
                                  </div>
                                @endforeach
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="permissions-section-inner-sec">
                              <p class="headings"><strong class="list-text">Permissions</strong></p>
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" id="access_permissions" class="ckbCheckAll">
                                  <span></span>
                                </div>
                                  <strong class="list-text">Select All</strong>
                              </div>
                              <div id="checkBoxes">
                                @foreach(@$accessPermissions as $permission)
                                  <div class="custom_check_wrap">
                                    <div class="custom-check">
                                      <input type="checkbox" class="checkBoxClass accesscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
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
                      </div>

                      <div class="title">
                        <h5>Recycle Bin</h5>
                        <hr/>
                      </div>

                      <div class="row permissions-section">
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="permissions-section-inner-sec">
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" id="restore_permissions" class="ckbCheckAll">
                                  <span></span>
                                </div>
                                  <strong class="list-text">Select All</strong>
                              </div>
                              <div id="checkBoxes">
                                @foreach(@$recycleBinPermissions as $permission)
                                  <div class="custom_check_wrap">
                                    <div class="custom-check">
                                      <input type="checkbox" class="checkBoxClass restorecheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
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
            required: "The Role Name field is required."
          },
          "permissions[]": {
            required: "You must select at least one permission.",
          }
        }
      });
    });
    
    function checkAll() {
      // FULL ACCESS CHECK
      $("#full_access").click(function() {
        $("input[type=checkbox]").prop('checked', this.checked)
      });

      if($('.checkBoxClass:checked').length == $('.checkBoxClass').length) {
        $("#full_access").prop('checked', 'true');
      }
      else {
        $("#full_access").prop('checked', false);
      }

      // OTHER ACCESS CHECKS
      $("#teachers_permissions").click(function() {
        $(".teacherscheckBox").prop('checked', this.checked)
      })

      $("#instructors_permissions").click(function() {
        $(".instructorscheckBox").prop('checked', this.checked)
      })

      $("#students_permissions").click(function() {
        $(".studentscheckBox").prop('checked', this.checked)
      })
      $("#students2_permissions").click(function() {
        $(".students2checkBox").prop('checked', this.checked)
      })

      $("#reports_permissions").click(function() {
        $(".reportscheckBox").prop('checked', this.checked)
      })

      $("#admins_permissions").click(function() {
        $(".adminscheckBox").prop('checked', this.checked)
      })
      $("#schools_permissions").click(function() {
        $(".schoolscheckBox").prop('checked', this.checked)
      })
     
      $("#subjects_permissions").click(function() {
        $(".subjectscheckBox").prop('checked', this.checked)
      })
      $("#roles_permissions").click(function() {
        $(".rolescheckBox").prop('checked', this.checked)
      })
      $("#access_permissions").click(function() {
        $(".accesscheckBox").prop('checked', this.checked)
      })
      $("#restore_permissions").click(function() {
        $(".restorecheckBox").prop('checked', this.checked)
      })
      $("#website_permissions").click(function() {
        $(".websitecheckBox").prop('checked', this.checked)
      })
      $("#mobile_permissions").click(function() {
        $(".mobilecheckBox").prop('checked', this.checked)
      })

      $("#payment_permissions").click(function() {
        $(".paymentcheckBox").prop('checked', this.checked)
      })
      $("#feedback_permissions").click(function() {
        $(".feedbackcheckBox").prop('checked', this.checked)
      })

      /* *********************************************** */
      /* *********************************************** */
      
      if($('.teacherscheckBox:checked').length == $('.teacherscheckBox').length) {
        $("#teachers_permissions").prop('checked', 'true');
      }
      else {
        $("#teachers_permissions").prop('checked', false);
      }

      // instructors
      if($('.instructorscheckBox:checked').length == $('.instructorscheckBox').length) {
        $("#instructors_permissions").prop('checked', 'true');
      }
      else {
        $("#instructors_permissions").prop('checked', false);
      }
      // instructors
      
      if($('.studentscheckBox:checked').length == $('.studentscheckBox').length) {
        $("#students_permissions").prop('checked', 'true');
      }
      else {
        $("#students_permissions").prop('checked', false);
      }

      // students 2
      if($('.students2checkBox:checked').length == $('.students2checkBox').length) {
        $("#students2_permissions").prop('checked', 'true');
      }
      else {
        $("#students2_permissions").prop('checked', false);
      }
      // students 2

      // reports
      if($('.reportscheckBox:checked').length == $('.reportscheckBox').length) {
        $("#reports_permissions").prop('checked', 'true');
      }
      else {
        $("#reports_permissions").prop('checked', false);
      }
      // reports
      
      if($('.adminscheckBox:checked').length == $('.adminscheckBox').length) {
        $("#admins_permissions").prop('checked', 'true');
      }
      else {
        $("#admins_permissions").prop('checked', false);
      }
      
      if($('.schoolscheckBox:checked').length == $('.schoolscheckBox').length) {
        $("#schools_permissions").prop('checked', 'true');
      }
      else {
        $("#schools_permissions").prop('checked', false);
      }
      
      
      if($('.subjectscheckBox:checked').length == $('.subjectscheckBox').length) {
        $("#subjects_permissions").prop('checked', 'true');
      }
      else {
        $("#subjects_permissions").prop('checked', false);
      }
      
      if($('.rolescheckBox:checked').length == $('.rolescheckBox').length) {
        $("#roles_permissions").prop('checked', 'true');
      }
      else {
        $("#roles_permissions").prop('checked', false);
      }
      
      if($('.accesscheckBox:checked').length == $('.accesscheckBox').length) {
        $("#access_permissions").prop('checked', 'true');
      }
      else {
        $("#access_permissions").prop('checked', false);
      }
      
      if($('.restorecheckBox:checked').length == $('.restorecheckBox').length) {
        $("#restore_permissions").prop('checked', 'true');
      }
      else {
        $("#restore_permissions").prop('checked', false);
      }
      
      if($('.websitecheckBox:checked').length == $('.websitecheckBox').length) {
        $("#website_permissions").prop('checked', 'true');
      }
      else {
        $("#website_permissions").prop('checked', false);
      }
      
      if($('.mobilecheckBox:checked').length == $('.mobilecheckBox').length) {
        $("#mobile_permissions").prop('checked', 'true');
      }
      else {
        $("#mobile_permissions").prop('checked', false);
      }

      if($('.paymentcheckBox:checked').length == $('.paymentcheckBox').length) {
        $("#payment_permissions").prop('checked', 'true');
      }
      else {
        $("#payment_permissions").prop('checked', false);
      }

      if($('.feedbackcheckBox:checked').length == $('.feedbackcheckBox').length) {
        $("#feedback_permissions").prop('checked', 'true');
      }
      else {
        $("#feedback_permissions").prop('checked', false);
      }
      
    }
  </script>
@stop
