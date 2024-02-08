@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
<h1>Dashboard</h1>
@stop
@section('content')
<style>
   .modebar{
      display: none;
   }
</style>
<!-- Main content -->
<section class="content">
   <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
         @can('view_user')
         <a href="{{route('users.index')}}">
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-12">
               <div class="small-box teacher">
                  <div class="inner">
                     <div class="left p-0" style="width:60px;height: 60px;">
                        <img src="{{asset('images/users.png')}}" style="width:27px;" class="d-block"/>
                     </div>
                     <div class="right">
                        <p>Users</p>
                        <h3>{{$totalUsers}}</h3>
                     </div>
                  </div>
                  <a href="{{route('users.index')}}" class="small-box-footer">  
                  More Info
                  <img src="{{asset('images/next-three.svg')}}" alt="" class="on-hover">
                  <img src="{{asset('images/next-three.svg')}}" alt="">
                  </a>
               </div>
            </div>
         </a> 
         @endcan

         @can('view_transporter')
         <a href="{{route('transporters.index')}}">
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-12">
               <div class="small-box student">
                  <div class="inner">
                     <div class="left p-0" style="width:60px;height: 60px; ">
                        <img src="{{asset('images/truck.png')}}" style="width:27px;" class="d-block"/>
                     </div>
                     <div class="right">
                        <p>Transporters</p>
                        <h3>{{$totalTransporters}}</h3>
                     </div>
                  </div>
                  <a href="{{route('transporters.index')}}" class="small-box-footer">
                  More Info
                  <img src="{{asset('images/next-three.svg')}}" alt="" class="on-hover">
                  <img src="{{asset('images/next-three.svg')}}" alt="">
                  </a>
               </div>
            </div>
         </a>
         @endcan
         @can('view_admins')
         <a href="{{route('admins_list')}}">
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-12">
               <div class="small-box student">
                  <div class="inner">
                     <div class="left p-0" style="width:60px;height: 60px;">
                        <img src="{{asset('images/admin1.png')}}" style="width:27px;" class="d-block"/>
                     </div>
                     <div class="right">
                        <p>Admins</p>
                        <h3>{{$totalAdmin}}</h3>
                     </div>
                  </div>
                  <a href="{{route('admins_list')}}" class="small-box-footer">
                  More Info
                  <img src="{{asset('images/next-three.svg')}}" alt="" class="on-hover">
                  <img src="{{asset('images/next-three.svg')}}" alt="">
                  </a>
               </div>
            </div>
         </a>
         @endcan
         @can('view_jobs')
          <a href="{{route('jobs.index')}}">
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-12">
               <div class="small-box student">
                  <div class="inner">
                     <div class="left p-0" style="width:60px;height: 60px;">
                        <img src="{{asset('images/job.png')}}" style="width:27px;" class="d-block"/>
                     </div>
                     <div class="right">
                        <p>Jobs</p>
                        <h3>{{$totalJob}}</h3>
                     </div>
                  </div>
                  <a href="{{route('jobs.index')}}" class="small-box-footer">
                  More Info
                  <img src="{{asset('images/next-three.svg')}}" alt="" class="on-hover">
                  <img src="{{asset('images/next-three.svg')}}" alt="">
                  </a>
               </div>
            </div>
         </a>  
         @endcan
         @can('view_job_booked')
         <a href="{{route('booking.index')}}">
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-12">
               <div class="small-box student">
                  <div class="inner">
                     <div class="left p-0" style="width:60px;height: 60px;">
                        <img src="{{asset('images/job.png')}}" style="width:27px;" class="d-block"/>
                     </div>
                     <div class="right">
                        <p>Job Booked</p>
                        <h3>{{$totalBooking}}</h3>
                     </div>
                  </div>
                  <a href="{{route('booking.index')}}" class="small-box-footer">
                  More Info
                  <img src="{{asset('images/next-three.svg')}}" alt="" class="on-hover">
                  <img src="{{asset('images/next-three.svg')}}" alt="">
                  </a>
               </div>
            </div>
         </a>
         @endcan
         @can('view_email')
         <a href="{{route('emails.index')}}">
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-12">
               <div class="small-box student">
                  <div class="inner">
                     <div class="left p-0" style="width:60px;height: 60px;">
                        <img src="{{asset('images/email.png')}}" style="width:27px;" class="d-block"/>
                     </div>
                     <div class="right">
                        <p>Email templates</p>
                        <h3>{{$totalEmailTemplates}}</h3>
                     </div>
                  </div>
                  <a href="{{route('emails.index')}}" class="small-box-footer">
                  More Info
                  <img src="{{asset('images/next-three.svg')}}" alt="" class="on-hover">
                  <img src="{{asset('images/next-three.svg')}}" alt="">
                  </a>
               </div>
            </div>
         </a>
         @endcan
         @can('view_payment')
         <a href="{{route('payments.index')}}">
            
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-12">
               <div class="small-box school">
                  <div class="inner">
                     <div class="left p-0" style="width:60px;height: 60px;">
                        <img src="{{asset('images/transaction.png')}}" style="width:27px;" class="d-block"/>
                     </div>
                     <div class="right">
                        <p>Payment transactions</p>
                        <h3>{{$totalPayments}}</h3>
                     </div>
                  </div>
                  <a href="{{route('payments.index')}}" class="small-box-footer">
                  More Info
                  <img src="{{asset('images/next-three.svg')}}" alt="" class="on-hover">
                  <img src="{{asset('images/next-three.svg')}}" alt="">
                  </a>
               </div>
            </div>
         </a>
         @endcan
         @can('view_transporter_wallets')
         <a href="{{route('wallets.index')}}">
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-12">
               <div class="small-box student">
                  <div class="inner">
                     <div class="left p-0" style="width:60px;height: 60px;">
                        <img src="{{asset('images/wallet.png')}}" style="width:27px;" class="d-block"/>
                     </div>
                     <div class="right">
                        <p>Transporter Wallets </p>
                        <h3>{{$transporterWallets}}</h3>
                     </div>
                  </div>
                  <a href="{{route('wallets.index')}}" class="small-box-footer">
                  More Info
                  <img src="{{asset('images/next-three.svg')}}" alt="" class="on-hover">
                  <img src="{{asset('images/next-three.svg')}}" alt="">
                  </a>
               </div>
            </div>
         </a>
         @endcan
         @can('view_user_refunds')
           <a href="{{route('refunds.index')}}">
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-12">
               <div class="small-box student">
                  <div class="inner">
                     <div class="left p-0" style="width:60px;height: 60px;">
                        <img src="{{asset('images/refund.png')}}" style="width:27px;" class="d-block"/>
                     </div>
                     <div class="right">
                        <p>User Refunds </p>
                        <h3>{{$totalRefunds}}</h3>
                     </div>
                  </div>
                  <a href="{{route('refunds.index')}}" class="small-box-footer">
                  More Info
                  <img src="{{asset('images/next-three.svg')}}" alt="" class="on-hover">
                  <img src="{{asset('images/next-three.svg')}}" alt="">
                  </a>
               </div>
            </div>
         </a>
         @endcan
         @can('view_website_content')
         <a href="{{route('website_pages_list')}}">
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-12">
               <div class="small-box student">
                  <div class="inner">
                     <div class="left p-0" style="width:60px;height: 60px;">
                        <img src="{{asset('images/website.png')}}" style="width:27px;" class="d-block"/>
                     </div>
                     <div class="right">
                        <p>Website</p>
                        <h3>{{$websitePages}}</h3>
                     </div>
                  </div>
                  <a href="{{route('website_pages_list')}}" class="small-box-footer">
                  More Info
                  <img src="{{asset('images/next-three.svg')}}" alt="" class="on-hover">
                  <img src="{{asset('images/next-three.svg')}}" alt="">
                  </a>
               </div>
            </div>
         </a>
         @endcan
         @can('view_mobile_content')
         <a href="{{route('mobile_pages_list')}}">
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-12">
               <div class="small-box student">
                  <div class="inner">
                     <div class="left p-0" style="width:60px;height: 60px;">
                        <img src="{{asset('images/mobile.png')}}" style="width:27px;" class="d-block"/>
                     </div>
                     <div class="right">
                        <p>Mobile</p>
                        <h3>{{$mobilePages}}</h3>
                     </div>
                  </div>
                  <a href="{{route('mobile_pages_list')}}" class="small-box-footer">
                  More Info
                  <img src="{{asset('images/next-three.svg')}}" alt="" class="on-hover">
                  <img src="{{asset('images/next-three.svg')}}" alt="">
                  </a>
               </div>
            </div>
         </a> 
         @endcan
         @can('view_banner')
          <a href="{{route('banner.index')}}">
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-12">
               <div class="small-box student">
                  <div class="inner">
                     <div class="left p-0" style="width:60px;height: 60px;">
                        <img src="{{asset('images/banner.png')}}" style="width:27px;" class="d-block"/>
                     </div>
                     <div class="right">
                        <p>Banners</p>
                        <h3>{{$totalBanner}}</h3>
                     </div>
                  </div>
                  <a href="{{route('banner.index')}}" class="small-box-footer">
                  More Info
                  <img src="{{asset('images/next-three.svg')}}" alt="" class="on-hover">
                  <img src="{{asset('images/next-three.svg')}}" alt="">
                  </a>
               </div>
            </div>
         </a> 
         @endcan
         @can('view_feedback')

          <a href="{{route('contact_us_message_list')}}">
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-12">
               <div class="small-box student">
                  <div class="inner">
                     <div class="left p-0" style="width:60px;height: 60px;">
                        <img src="{{asset('images/contact.png')}}" style="width:27px;" class="d-block"/>
                     </div>
                     <div class="right">
                        <p>Contact Us</p>
                        <h3>{{$totalContactUs}}</h3>
                     </div>
                  </div>
                  <a href="{{route('contact_us_message_list')}}" class="small-box-footer">
                  More Info
                  <img src="{{asset('images/next-three.svg')}}" alt="" class="on-hover">
                  <img src="{{asset('images/next-three.svg')}}" alt="">
                  </a>
               </div>
            </div>
         </a>


  <a href="{{route('update_information_list')}}">
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-12">
               <div class="small-box student">
                  <div class="inner">
                     <div class="left p-0" style="width:60px;height: 60px;">
                        <img src="{{asset('images/contact.png')}}" style="width:27px;" class="d-block"/>
                     </div>
                     <div class="right">
                        <p>Update information</p>
                     </div>
                  </div>
                  <a href="{{route('update_information_list')}}" class="small-box-footer">
                  More Info
                  <img src="{{asset('images/next-three.svg')}}" alt="" class="on-hover">
                  <img src="{{asset('images/next-three.svg')}}" alt="">
                  </a>
               </div>
            </div>
         </a>











         @endcan
         @can('view_review')
         <a href="{{route('reviews.index')}}">
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-12">
               <div class="small-box student">
                  <div class="inner">
                     <div class="left p-0" style="width:60px;height: 60px;">
                        <img src="{{asset('images/review.png')}}" style="width:27px;" class="d-block"/>
                     </div>
                     <div class="right">
                        <p>Reviews</p>
                        <h3>{{$totalReviews}}</h3>
                     </div>
                  </div>
                  <a href="{{route('reviews.index')}}" class="small-box-footer">
                  More Info
                  <img src="{{asset('images/next-three.svg')}}" alt="" class="on-hover">
                  <img src="{{asset('images/next-three.svg')}}" alt="">
                  </a>
               </div>
            </div>
         </a>
         @endcan
         @can('view_testimonials')
         <a href="{{route('testimonials.index')}}">
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-12">
               <div class="small-box student">
                  <div class="inner">
                     <div class="left p-0" style="width:60px;height: 60px;">
                        <img src="{{asset('images/testimonial.png')}}" style="width:27px;" class="d-block"/>
                     </div>
                     <div class="right">
                        <p>Testimonials</p>
                        <h3>{{$totalTestimonials}}</h3>
                     </div>
                  </div>
                  <a href="{{route('testimonials.index')}}" class="small-box-footer">
                  More Info
                  <img src="{{asset('images/next-three.svg')}}" alt="" class="on-hover">
                  <img src="{{asset('images/next-three.svg')}}" alt="">
                  </a>
               </div>
            </div>
         </a>
         @endcan
         @can('view_reports')
         <a href="{{url('admin/reports')}}">
            
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-12">
               <div class="small-box admin">
                  <div class="inner">
                     <div class="left p-0" style="width:60px;height: 60px;">
                        <img src="{{asset('images/sale.png')}}" style="width:27px;" class="d-block"/>
                     </div>
                     <div class="right">
                        <p>Reports & Analytics</p>
                        <h3>{{$totalSale}}</h3>
                     </div>
                  </div>
                  <a href="{{url('admin/reports')}}" class="small-box-footer">
                  More Info
                  <img src="{{asset('images/next-three.svg')}}" alt="" class="on-hover">
                  <img src="{{asset('images/next-three.svg')}}" alt="">
                  </a>
               </div>
            </div>
         </a>
         
         @endcan
        
       
         
      </div>
      @can('view_transporter_wallets')
      <div class="col-md-12 col-lg-12 col-xl-12 col-12 p-0">
	      <script src='https://cdn.plot.ly/plotly-2.16.1.min.js'></script>
         <body>
            <div id='myDiv'>
               <!-- Plotly chart will be drawn inside this DIV -->
            </div>
         </body>
      </div> 
      @endcan
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
   var totalPaidAmount = "<?php echo json_encode($totalAmount); ?>";
   var a =  JSON.parse(totalPaidAmount);

   var totalDriverPaidAmount = "<?php echo json_encode($totaldriverAmount); ?>";
   var b =  JSON.parse(totalDriverPaidAmount);

   var trace1 = {
  x: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  y: b,
  type: 'bar',
  name: 'Total Paid Amount To Transporters',
  marker: {
    color: 'rgb(255,201,57)',
    opacity: 0.7,
  }
};

var trace2 = {
  x: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  y: a,
  type: 'bar',
  name: 'Total Amount',
  marker: {
    color: 'rgb(245, 9, 42)',
    opacity: 0.5
  }
};

var data = [trace1, trace2];

var layout = {
  title: `${new Date().getFullYear()} Sales Report`,
  xaxis: {
    tickangle: -45,
    width:1000
  },
  barmode: 'group'
};

Plotly.newPlot('myDiv', data, {
            "layout": { "width": 1000, "height": 600}
        });

</script>
@endsection