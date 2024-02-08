@extends('adminlte::master')

@inject('layoutHelper', '\JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@if($layoutHelper->isLayoutTopnavEnabled())
    @php( $def_container_class = 'container_custom' )
@else
    @php( $def_container_class = 'container_fluid_custom' )
@endif

@section('adminlte_css')
    @stack('css')
    @yield('css')
    <style>
        th:hover {
            cursor: pointer;
        }
        .recruiter-view-link input:hover, .link-text input:hover {
            cursor: pointer;
        }
        .link-text, .link-text>input::placeholder {
            color: #17a2b8 !important;
        }

        li.has-treeview li.nav-item {
            margin-left: 15px;
        }
        li.has-treeview li.nav-item p {
            font-weight: 400 !important;
            font-size: 12px !important;
        }
        a.back-button {
            position: relative;
            top: 5px;
            align-self: flex-end;
            float: right;
            width: 100px;
        }
        .error {
            color: #ff0000 !important;
            font-weight: 300 !important;
            font-size: 12px !important;
        }
        .form-control.error {
            color: #000000 !important;
        }
        .intl-tel-input { display: block !important; }
        .divider { display: none; }
        .country.highlight { display: none; }
        /*.country { display: none; }*/
        .country.preferred { display: block; }
        .permissions-section {
            background-color: #efefef;
            border-radius: 5px;
            padding: 20px;
        }
        .job-description { height: auto; border: 0px none; }


        /*added later for sell form*/
        /*-- Global Css--*/
        /*i commented*/
        /*.sidebar-mini .wrapper .main-sidebar ul.nav-pills li.has-treeview a{
          background-color: #2d8427;
          color:white;
        }*/
        /*i commented*/
        label{
            margin: 0;
        }
        h2{
            font-size: 45px;
            font-weight: 600;
        }
        h3 {
            font-weight: 700;
            font-size: 34px;
            text-transform: uppercase;
        }
        /*-- Global Css--*/

        .form_wrap form {
            /*background-color: #ffffff;*/
            padding: 30px;
            width: 700px;
        }
        .form_wrap form .logo {
            text-align: center;
        }
        .form_wrap form .logo img {
            max-width: 100px;
        }
        .form_wrap form .form_content h5 {
            font-weight: 700;
            font-size: 24px;
            margin: 0;
        }
        .form_wrap form label ,
        section#form_wraper form .form-group{
            font-size: 14px;
        }
        .form_wrap form input.form-control ,
        section#form_wraper form .form-group input.form-control,
        section#form_wraper form .form-group select,
        section#form_wraper form .form-group textarea{
            background-color: transparent;
            min-height: 50px;
            padding: 10px 22px;
            color: #111111;
            font-size: 13px;
            outline-style: none;
            box-shadow: none;
            border: 1px solid #1d2637;
            /*border-radius: 10px*/
        }
        .form_wrap form input.form-control.error ,
        section#form_wraper form .form-group input.form-control.error,
        section#form_wraper form .form-group select.error,
        section#form_wraper form .form-group textarea.error{
            border: 1px solid #dc3545;
        }
        section#form_wraper form .form-group textarea {
            height: 100px;
        }
        .form_wrap form label i.fa.fa-envelope {
            font-size: 15px;
            margin: 0 5px 7px 0px;
        }
        .form_wrap form label i.fa.fa-unlock-alt {
            font-size: 20px;
            margin: 0 5px 7px 0px;
            position: relative;
            top: 2px;
        }
        .form_wrap form input.form-control::-webkit-input-placeholder,
        section#form_wraper form .form-group input.form-control::-webkit-input-placeholder { /* Edge */
          color: #b2b2b2;
        }
        .form_wrap form input.form-control:-ms-input-placeholder,
        section#form_wraper form .form-group input.form-control:-ms-input-placeholder { /* Internet Explorer 10-11 */
          color: #b2b2b2;
        }
        .form_wrap form input.form-control::placeholder ,
        section#form_wraper form .form-group input.form-control::placeholder {
          color: #b2b2b2;
        }
        .form_wrap form .btn_wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .form_wrap form .btn_wrap button.btn.btn-primary ,
        section#form_wraper form button,
        .step_form_header .btn_grp a:last-child,
        .next_btn a{
            background-color: #ffc513;
            border-color: #ffc513;
            color: #121a27;
            font-weight: 600;
            padding: 7px 20px;
            display: flex;
            align-items: center;
            font-size: 14px;
            margin: 5px 0 0; 
            border-radius: 0;   
        }
        .form_wrap form .dont_have_account {
            text-align: center;
            font-size: 13px;
            font-weight: 500;
        }
        .form_wrap form .dont_have_account a {
            font-weight: 700;
            margin: 0 0 0 5px;
            text-decoration: underline;
        }
        .form_wrap form a.back_btn,
        .step_form_header .btn_grp a:first-child {
            background-color: #121a27;
            padding: 8px 15px;
            border-radius: 3px;
            font-weight: 600;
            font-size: 12px;
            color: #ffffff;
            border-radius: 0;
        }
        .form_wrap form a.back_btn i,
        .step_form_header .btn_grp a:first-child i{
            color: #ffffff;
        }
        .form_wrap form .form_content small {
            display: inline-block;
            line-height: 15px;
            padding: 5px 0 0;
        }
        .form_wrap form .btn_wrap a {
            text-decoration: underline;
            font-size: 13px;
            font-weight: 500;
        }
        body.sign_register_form form .form-group label.error,
        section#form_wraper form .form-group  label.error {
            color: #dc3545;
            font-size: 12px;
            font-weight: 400;
        }
        section#form_wraper .sell_form .radio_wrap .form-group.field_error label {
            margin: 0;
            color: #dc3545;
            font-size: 12px;
            font-weight: 400;
        }
        section#form_wraper .sell_form .radio_wrap .form-group.field_error {
            margin: 0;
        }
        section#form_wraper form .form-group span.required {
            color: #dc3545;    
        }
        section#form_wraper form .checkbox_wrap .form-group label.select_all {
            font-weight: 600;   
        }
        body.sign_register_form form a.back_btn i {
            display: inline-block;
        }


        .form-group .form-check .custom_check input[type="checkbox"] {
            height: 16px;
            width: 16px;
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            opacity: 0;
            font-size: 0;
            margin: 0 auto;
            cursor: pointer;
            z-index: 1;
        }
        .form-group .form-check .custom_check span {
            height: 14px;
            width: 14.5px;
            display: inline-block;
            border: 1px solid transparent;
            position: absolute;
            top: 0;
        }
        .form-group .form-check .custom_check input[type="checkbox"]:checked~span {
            background-color: #ffc513;
        }
        .form-group .form-check .custom_check input[type="checkbox"]:checked~span:before{
            content: "";
            position: absolute;
            left: 4px;
            top: 0px;
            width: 5px;
            height: 9px;
            border: solid #121a27;
            border-width: 0 2px 2px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);    
        }
        /*service page*/

        .btn_wrap button {
            background-color: #ffc513;
            border: 1px solid #ffc513;
            border-radius: 2px;
            padding: 15px 33px;
            margin-right: 15px;
            font-size: 17px;
            color: #1c2534;
            font-weight: 600;
        }
        .btn_wrap button img {
            padding-right: 7px;
        }

        select.form-control:not([size]):not([multiple]) {
            height: auto;
            border-radius: 0;
        }
        .service_box .service_img img {
            height: 250px;
            object-fit: cover;
        }
        section#form_wraper form .upload_images .form-group label {
            margin: 0 0 10px;
        }
        /*Sell Form*/
         
        section#form_wraper form .form-group i.fa.fa-tag {
            font-size: 17px;
            position: relative;
            top: 1px;
        }
        section#form_wraper .sell_form,
        .step_form_wrap {
            -webkit-box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            -moz-box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            -ms-box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            padding: 30px;
            margin: 0 auto;
            background-color: #ffffff;
            width: 75%;
            /*border-radius: 20px;
            border-top: 3px solid #ffc513;   */ 
        }
        section#form_wraper .sell_form .title h4,
        .schedule_tabs .tab-content h4 {
            font-weight: 600;
            font-size: 28px;
            margin: 0 0 20px;
            text-align: center;
            position: relative;
        }
        section#form_wraper .sell_form .title h4:before {
            content: "";
            height: 4px;
            width: 100%;
            background-color: #ffc513;
            position: absolute;
            bottom: -10px;
            display: none;
        } 
        section#form_wraper form .form-group select {
            cursor: pointer;
            width: 100%;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            /*background-image: url(../images/select_arrow.png);*/
            background-repeat: no-repeat;
            background-position: center right;
        }
        section#form_wraper .sell_form .custom_check~label {
            font-weight: 400;
        } 
        section#form_wraper form .form-group i.fa.fa-thumb-tack {
            font-size: 17px;
        }
        section#form_wraper form .form-group label {
            margin: 0 0 4px;
            font-weight: 600;
        }

        section#form_wraper form hr {
            border-color: #797979;
        }
        section#form_wraper .custom_check input.form-control {
            position: absolute;
            height: 20px;
            width: 20px;
            min-height: auto !important;
            cursor: pointer;
            z-index: 1;
            opacity: 0;
            left: 0;
            right: 0;
            top: 0;
        }
        section#form_wraper .custom_check {
            position: relative;
            width: 20px;
            height: 20px;
            border: 1px solid #121a27;
        }
        section#form_wraper .custom_check input.form-control:checked~span {
            background-color: #ffc513;
            height: 18.2px;
            width: 18px;
            display: block;
            border: 1px solid #ffc513;
            position: absolute;
        }
        section#form_wraper .custom_check input.form-control:checked~span:before{
            content: "";
            position: absolute;
            left: 5px;
            top: 0px;
            width: 7px;
            height: 12px;
            border: solid #121a27;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);  
        }
        section#form_wraper form .checkbox_wrap .form-group,
        section#form_wraper .radio_wrap .form-group{
            display: flex;
            align-items: center;
        }
        section#form_wraper form .checkbox_wrap .form-group label,
        section#form_wraper .radio_wrap .form-group label,
        section#form_wraper form .form-group label.keys_count {
            margin: 0 0 0 5px;
        }
        section#form_wraper .custom_check.radio {
            border-radius: 100px;
        }
        section#form_wraper .custom_check.radio input.form-control:checked~span {
            border-radius: 100px;
        }
        section#form_wraper .custom_check.radio input.form-control:checked~span:before {
            border: none;
            background-color: #121a27;
            height: 9px;
            width: 9px;
            left: 0;
            right: 0;
            top: 50%;
            margin: 0 auto;
            transform: translateY(-50%);
            border-radius: 100px;
        }
        input[type="file"] {
          display: block;
        }
        .imageThumb {
            border: 1px solid;
            padding: 1px;
            cursor: pointer;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }
        .pip {
            display: inline-block;
            margin: 0px 0px 0 10px;
            position: relative;
            width: 80px;
            height: 100px;
        }
        .pip2 {
            display: inline-block;
            margin: 0px 0px 0 10px;
            position: relative;
            width: 80px;
            height: 100px;
        }
        .remove {
          display: block;
          background: #444;
          border: 1px solid black;
          color: white;
          text-align: center;
          cursor: pointer;
        }
        .delete_image {
          display: block;
          background: #444;
          border: 1px solid black;
          color: white;
          text-align: center;
          cursor: pointer;
        }
        .delete_image2 {
          display: block;
          background: #444;
          border: 1px solid black;
          color: white;
          text-align: center;
          cursor: pointer;
        }
        video {
          border: 1px solid black;
          display: block;
        }
        .upload_images button#choose_image {
            background-color: #f6f6f6;
            border: none;
            height: 100px;
            padding: 35px;
            width: 80px;
            outline-style: none;
            box-shadow: none;
            border: 1px solid #1d2637;
            border-radius: 10px;
            margin: 0;
        }
        .upload_images button#choose_panorama {
            background-color: #f6f6f6;
            border: none;
            height: 100px;
            padding: 35px;
            width: 80px;
            outline-style: none;
            box-shadow: none;
            border: 1px solid #1d2637;
            border-radius: 10px;
            margin: 0;
        }
        #choose_video{
          background-color: #ffffff;
          border: none
        }
        .image_wrapper {
            display: flex;
            align-items: center;
            position: relative;
        }
        .pip span.remove {
            height: 18px;
            width: 18px;
            background-color: #dc3545;
            border: none;
            font-size: 12px;
            border-radius: 100px;
            position: absolute;
            top: -7px;
            right: -5px;
        }
        .pip2 span.remove {
            height: 18px;
            width: 18px;
            background-color: #dc3545;
            border: none;
            font-size: 12px;
            border-radius: 100px;
            position: absolute;
            top: -7px;
            right: -5px;
        }
        .pip span.delete_image {
            height: 18px;
            width: 18px;
            background-color: #dc3545;
            border: none;
            font-size: 12px;
            border-radius: 100px;
            position: absolute;
            top: -7px;
            right: -5px;
        }
        .pip2 span.delete_image {
            height: 18px;
            width: 18px;
            background-color: #dc3545;
            border: none;
            font-size: 12px;
            border-radius: 100px;
            position: absolute;
            top: -7px;
            right: -5px;
        }
        .pip span.delete_image2 {
            height: 18px;
            width: 18px;
            background-color: #dc3545;
            border: none;
            font-size: 12px;
            border-radius: 100px;
            position: absolute;
            top: -7px;
            right: -5px;
        }
        .pip2 span.delete_image2 {
            height: 18px;
            width: 18px;
            background-color: #dc3545;
            border: none;
            font-size: 12px;
            border-radius: 100px;
            position: absolute;
            top: -7px;
            right: -5px;
        }
        section#form_wraper form button#choose_video {
            background-color: #f6f6f6;
            border: 1px solid #cccccc;
            font-size: 13px;
        }
        section#form_wraper .sell_form video#video {
            width: 530px;
            margin: 0 0 20px;
        }
        .or {
            padding: 0 0 15px;
            position: relative;
        }
        .or label {
            font-size: 14px;
            background-color: #ffffff;
            position: relative;
            padding: 0 5px 0;
            margin: 0 0 0 20px;
        }
        .or:before {
            content: "";
            height: 1px;
            background-color: #cccccc;
            width: 30%;
            position: absolute;
            top: 35%;
            transform: translateY(-50%);
        }
        section#form_wraper form .form-group label.trim img {
            margin: 0 4px 0 0;
        }
        section#form_wraper {
            background-color: #ecf0f3;
            /*background-image: url("../images/form_bg.jpg");*/
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        section#form_wraper form .form-group label i,
        section#form_wraper form .form-group label img {
            display: none;
        }
        section#form_wraper form .form-group h5,
        .individual_services h5,
        .need_a_ride h5{
            font-size: 16px;
            margin: 0;
            color: #757171;
            text-transform: capitalize;
        }
        section#form_wraper .sell_form h6 {
            font-weight: 600;
            margin: 0;
        }
        section#form_wraper .sell_form .radio_wrap .form-group {
            margin: 0 0 10px;
        }
        section#form_wraper .sell_form .title {
            display: inline-block;
        }
        body.sign_register_form form .form-group i {
            display: none;
        }

        section#form_wraper .image_wrapper button.btn.btn-secondary {
            padding: 4px 5px;
            position: absolute;
            bottom: 5px;
            left: 51px;
        }
        section#form_wraper .image_wrapper button.btn.btn-secondary i.fa.fa-question-circle {
            font-size: 15px;
        }
        .upload_video_title {
            display: flex;
            align-items: center;
            margin: 0 0 10px;
        }
        section#form_wraper form .upload_video_title label {
            margin: 0 5px 0 0;
        }
        section#form_wraper form .upload_video_title button {
            margin: 0;
            padding: 3px 5px;
            border-radius: 5px;
        }
        section#form_wraper form .upload_video_title button i {
            font-size: 15px;
        }
        section#form_wraper .image_wrapper button[data-toggle="tooltip"] {
            border-radius: 5px;
        }

        /*Schedule Repair Page*/

        section#form_wraper.step_form_main {
            padding: 70px 0;
        }
        .step_form_wrap {
            margin: 0 auto;
        }

        .schedule_tabs .tab-content h4 {
            font-size: 20px;
        }
        .next_btn {
            display: inline-block;
        }
        section#form_wraper .individual_services .form-group label {
            font-weight: 400;
        }
        .need_a_ride .need_box {
            background-color: #f2f2f2;
            padding: 20px;
            margin: 0 0 20px;
        }
        .need_a_ride .need_box ul.choose_wrap {
            margin: 0;
            display: flex;
            align-items: center;
        }
        .need_a_ride .need_box ul.choose_wrap li label {
            border: 1px solid #121a27;
            padding: 5px 10px;
            margin: 0 5px 0 0;
            border-radius: 100px;
            font-size: 12px;
            cursor: pointer;
        }
        .need_a_ride .need_box h6 {
            font-weight: 600;
        }
        /*Responsive*/

        @media only screen and (min-width: 1500px) {
        .container {
            max-width: 1400px;
        }
        .banner_wrap {
            padding: 120px 0;
        }
        }
        @media only screen and (max-width: 1499px) {
        .right_sec {
            width: calc(100% - 165px);
        }

        .search_wrap form.form-inline {
            width: 81%;
        }


        .choose_image_wrap .left_sec .img span:nth-child(4) {
            background-position: 71%;
        }
        .choose_image_wrap .left_sec .img span:nth-child(3) {
            background-position: 48.66666%;
        }
        .choose_image_wrap .left_sec .img span:nth-child(2) {
            background-position: 26.33333%;
        }
        .choose_image_wrap .left_sec .content h2 {
            font-size: 22px;
        }
        section#who_we_are .choose_image_wrap .left_sec .content p {
            font-size: 13px;
        }
        section#form_wraper .sell_form {
            width: 100%;
        }
        section#form_wraper .sell_form h6 {
            font-size: 14px;
        }
        section#form_wraper form .checkbox_wrap .form-group label, 
        section#form_wraper .sell_form .radio_wrap .form-group label, 
        section#form_wraper form .form-group label.keys_count {
            font-size: 13px;
        }
        section#form_wraper .sell_form .title h4 {
            font-size: 24px;
        }

        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            background: transparent;
            bottom: 0;
            color: transparent;
            cursor: pointer;
            height: auto;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            width: auto;
        }
        /*css for date picker*/
        /*added later for sell form*/

        /*added by me*/
        .advertise_sub_title{
            margin-top: 10px !important;
            font-size: 14px !important;
            /*font-weight: 300 !important;*/
        }
        .feature_type{
            color:#121a27 !important;
            /*color:rgb(5,51,97) !important;*/
            margin: 20px 0px !important;
        }
        .terms_and_condition a{
            color: blue;
            cursor: pointer;
        }
        .terms_and_condition p{
            margin-top: 10px;
            cursor: pointer !important;
        }
        .terms_and_condition p span{
            color: blue;
        }
        .terms_and_conditio{
            margin: 20px 0px !important;
        }
        #need_help{
            margin: -12px 10px !important;
            /*position: absolute !important;*/
        }
        .sidebar-dark-primary .sidebar .nav-sidebar li.nav-item.has-treeview .menu-open {
            /*background: #d0ebd8;*/
        }

        .sidebar-dark-primary .sidebar .nav-sidebar li.nav-item.has-treeview .menu-open  hover{
            background: #d0ebd8;
        }
        /*added by me*/

    </style>
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        <div class="content-wrapper {{ config('adminlte.classes_content_wrapper') ?? '' }}">

            {{-- Content Header --}}
            <div class="content-header">
                <div class="{{ config('adminlte.classes_content_header') ?: $def_container_class }}">
                    @yield('content_header')
                </div>
            </div>

            {{-- Main Content --}}
            <div class="content">
                <div class="{{ config('adminlte.classes_content') ?: $def_container_class }}">
                    @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('success') }}
                            <a href="javascript:void(0)" id="close_button" class="float-right text-white close_button">X</a>
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session()->get('error') }}
                            <a href="javascript:void(0)" id="close_button" class="float-right text-white close_button">X</a>
                        </div>
                    @endif
                    @if(session()->has('warning'))
                        <div class="alert alert-warning" role="alert">
                            {{ session()->get('warning') }}
                            <a href="javascript:void(0)" id="close_button" class="float-right text-white close_button">X</a>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>

        </div>

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
    <script>
        $(document).ready(function() {
           

            /* $.validator.messages.required = function (param, input) {
                var title = $(input).attr('fieldTitle');
                return 'The ' + title + ' field is required.';
            } */
            $("#close_button").click(function() {
                $(".alert").hide();
            });
            setTimeout(() => {
                $(".alert").hide();
            }, 3000);
        });
    </script>

    <script type="text/javascript">
        $(".nav-link").on("click", function(){
            $('.nav-link').not(this).removeClass('active');
            $(this).addClass("active");
        })
    </script>


    <!-- data table -->
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
      <script>
        $(document).ready(function() {
          $('#exampleTable').DataTable( {
            columnDefs: [ {
              targets: 0,
              render: function ( data, type, row ) {
                return data.substr( 0, 15 );
              }
            }]
          });
        })  
      </script> 
    <!-- data table -->


    <!-- on hidden sidebar -->
    <script type="text/javascript">
        $(document).on('mouseenter','.main-sidebar',function(){
            if($('.sidebar-mini').hasClass('sidebar-collapse')){
                $('.sidebar-mini').addClass('sidebar-hover');
            }
        })
        $(document).on('mouseleave','.main-sidebar',function(){
            if($('.sidebar-mini').hasClass('sidebar-collapse') && !$('.main-sidebar').hasClass('sidebar-focused')){
                $('.sidebar-mini').removeClass('sidebar-hover');
            }
        })
    </script>
    <!-- on hidden sidebar -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.13/moment-timezone-with-data.js"></script>

    <script type="text/javascript">
      var timezone = moment.tz.guess();
      console.log('timezone---');
      console.log(timezone);


     $.ajax({
        url: "{{ route('setSession') }}",
        type: 'POST',
        data: {
          timezone : timezone
        },
        dataType: "JSON",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          console.log("Response", response);
          
        }
      }); 

    </script>


@stop
