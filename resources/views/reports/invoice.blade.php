<!DOCTYPE html>
<html>
<head>
   <style type="text/css">
      *{
         font-family: 'Roboto', sans-serif;
         margin:0;
         padding: 0;
         list-style: none;
         outline-style: none;
      }
      body {
         background-color: #eef1f6;
         font-size: 14px;
         font-weight: 400;
         font-family: "Nunito", "Segoe UI", arial;
         color: #000;         
      }
      .invoice {
         width: 100%;
         max-width: 1016px;
         margin: 0 auto;
         /*          padding: 30px;*/
         border-radius: 5px;
         background-color: #ffffff;
         margin-bottom: 15px;
         /*          background-image: url("{{asset('captain_america/images/shape_image.png')}}");*/
         background-repeat: no-repeat;
         background-position: top left;
         background-size: 350px;
}  
td.top_header_inner {
   background-color: #ffcd00;
   padding: 20px;
   padding-bottom:15px;
   width: 50%;
   z-index: 0;
   position: relative;
}   
.top_header {
   display: flex;
   align-items: center;
   justify-content: space-between;
   flex-wrap: wrap;
}
.top_header .left {
   width: 60%;
   position: relative;
}
.top_header  .invoice_logo {
   width: 40%;
   text-align: right;
}
.top_header {
   position: relative;
   padding: 0 140px 0 0px;
}               
.top_header .left h2,
.order_number,
.invoice_number {
   position: relative;
   z-index: 1;
   color: #ffffff;
}
.order_number,
.invoice_number{
   font-size: 14px;
}
.top_header .left h2 {
   font-size: 24px;
   font-weight: 800;
   display: block;
   text-transform: uppercase;
   padding-bottom: 12px;
}
.order_number {
   padding: 0 0 5px;
}
.contact_info {
   margin: 40px 0 0;
   display: flex;
   align-items: center;
   justify-content: space-between;
   padding: 0 30px;
}
.product_data_wrapper, .product_list {
   padding: 0 30px;
}
.footer {
   padding-bottom: 30px;
}
.contact_info .address {
   line-height: 24px;
}
.contact_info ul li {
   padding: 3px 0;
}
.product_header h2 {
   font-size: 24px;
   color: #111;
   font-weight: 600;
   display: inline-block;
   margin-bottom: 15px;
}
.product_header {
   display: flex;
   align-items: center;
   justify-content: space-between;
   margin: 30px 0 0;
}
table {
   width: 100%;
}
.table thead th {
   vertical-align: bottom;
   border-bottom: 2px solid #dee2e6;
}
.table-bordered td, .table-bordered th {
   border: 1px solid #dee2e6;
}
.table thead tr th {
   padding: 15px;
   font-size: 16px;
   font-weight: 500;
   text-align: left;
   color: #212529;
}
.table thead {
   background: #EBEBEB;
}
.table {
   border-top-left-radius: 5px;
   border-top-right-radius: 5px;
}
.table td, .table th {
   padding: .75rem;
   vertical-align: top;
   border-bottom: 0px solid #dee2e6;
   border-top: 0px;
}
tbody tr:nth-of-type(odd) {
   background-color: rgb(0 0 0 / 2%);
}

.product_data {
   display: flex;
}
.product_image {
   margin: 0 20px 0 0;
}
.product_data p {
   font-size: 16px;
   color: #212529;
   margin: 0 0 2px;
}
.product_data  a {
   color: #269ffb;
   display: block;
   font-size: 15px;
   list-style: none;
   text-decoration: none;
}
.table tbody td {
   font-size: 14px;
   color: #212529;
   vertical-align: middle;
}
.product_list {
   margin: 40px 0 0;
}
.footer p {
   display: block;
   color: #111111;
   text-align: center;
   margin: 30px 0 15px;
   text-transform: uppercase;
   line-height: 22px;
}
.invoice .top_header table tbody tr {
   background-color: transparent; 
   align-items: center;
   justify-content: space-between;
}  
.triangle-up {
   width: 110px;
   height: 0;
   border-left: 100px solid #ffffff;
   border-right: 100px solid #ffffff;
   border-bottom: 115px solid #ffffff;
   position: absolute;
   right: -190px;
   top: 85px;
   z-index: -9;
   transform: rotate(130deg);
}
.product_data_wrapper .table thead tr td{
   padding: 15px;
   font-size: 14px;
   font-weight: 600;
   border-right: none;
   text-align: left;
   border-bottom: 1px solid #909090;
   color: #212529;
   border-top: 1px solid #909090;
   background: #fafafa;
}   
.footer-social-icons {
    background: #000;
    border-radius: 0;
    /* display: flex; */
    width: 36px;
    margin: 0px 5px;
    /* align-items: center; */
    /* justify-content: center; */
    height: 30px;
    display: inline-block;
    line-height: 40px;
}
.footer-social-icons img {
    text-decoration: inherit;
    text-decoration-color: #000;
    position: relative;
    top: 4px;
    left: 8px;
}
/* a5 css start */
body.childa5 {
   font-size: 12px;
}
body.childa5 td {
   font-size: 12px !important;
}
body.childa5 p {
   font-size: 12px !important;
}
body.childa5 h2 {
   font-size: 18px !important;
}
body.childa5 .triangle-up {
   width: 200px !important;
   height: 0;
   border-left: 50px solid #ffffff;
   border-right: 15px solid #ffffff;
   border-bottom: 100px solid #ffffff !important;
   position: absolute;
   right: -140px !important;
   top: 80px !important;
   z-index: -9;
   transform: rotate(110deg) !important;
}
</style>
</head>
<body>
   <section id="invoice_wrapper">
      <div class="invoice">
         <div>

            @foreach($data as $datas) 
            <div class="top_header" style="padding:0px;">
               <table cellspacing="0" cellpadding="0" style="position: relative;">
                  <tr>
                     <td class="top_header_inner" style="width:60%;padding-left: 40px;">

                        <table cellspacing="0" cellpadding="0" class="left"> 
                           <tr>
                              <td><h2 style="color: #000; font-family: 'Roboto', sans-serif;">Invoice</h2></td>
                           </tr>
                           <tr>
                              <td><p style="color: #000; padding-top: 3px;" class="invoice_number"><b>Invoice No. :</b>   {{$datas['invoice_no']}}</p></td>
                           </tr>
                           <!-- <tr>
                              <td><p style="color: #000; padding-top: 3px; padding-bottom: 0px;" class="order_number"><b>Booking No. :</b>  {{$datas['book_id']}}</p></td>
                           </tr> -->
                           <tr>
                              <td><p style="color: #000; padding-top: 3px; padding-bottom: 0px;" class="order_number"><b>Job ID :</b>  {{$datas['job']['job_id']}}</p></td>
                           </tr>
                           <tr>
                              <td><p style="color: #000; padding-top: 3px;" class="invoice_number"><b>Date of Booking : </b>
                              {{date('d/m/Y',strtotime($datas['booked_on']))}}</p></td>
                           </tr> 
                           <tr>
                              <td><p style="color: #000; padding-top: 3px;" class="invoice_number"><b>Date of Shipment : </b>
                              {{date('d/m/Y',strtotime($datas['job']['schedule_date']))}}</p></td>
                           </tr>
                           <tr>
                              <td><p style="color: #000; padding-top: 3px;" class="invoice_number"><b>Booking Status :</b>
                              {{ucfirst(str_replace('_', ' ', $datas['booking_status']))}}</p></td>
                           </tr>

                        </table>
                     </td>
                     <td style="background: #fff; float: right; margin: 0px 0 0; right: 0; margin-left: auto; display:flex; text-align:center; padding: 30px 30px 30px;">
                        <table cellspacing="0" cellpadding="0" style="background:#ffffff;">
                           <tr>
                              <td style="background: #ffffff;"><img src="{{env('STORAGE_PATH')}}images/arabat-logo.png" alt="" style="min-width:110px;max-width:220px;min-height:70px;max-height:90px;float:right;"></td>
                           </tr>
                        </table>
                     </td>
                  </tr>
               </table>

            </div>
            <div class="contact_info">

               <table>
                  <tr style="background:transparent;">
                    
                     <td style="vertical-align: baseline; width: 40%;">
                        <table style="line-height: 25px;" cellspacing="0" cellpadding="0">
                           <tr>
                              <td style="background: #ffffff; color: #f1bb2f; padding-right: 25px;"><b>Sender's Details</b></td>
                           </tr>
                           <tr>
                              <td style="background: #ffffff;"><b>Name</b>  :- {{$datas['user']['name']}}</td>
                           </tr>
                           <tr>
                              <td style="background: #ffffff;"><b>Pickup point Address</b> :- {{$datas['job']['pick_up_address']}}</td>
                           </tr>                           
                           <tr>                               
                              <td style="background: #ffffff;"><b>City</b> :- {{$datas['job']['city']}}</td>
                           </tr>
                        </table>
                     </td>
                     <td style="vertical-align: unset; line-height: 24px; width: 20%;">
                        <table cellspacing="0" cellpadding="0">
                           <tbody>
                              <tr>
                                 <td style="color: #000; background: #ffffff; visibility: hidden; padding-right: 25px;"><b></b></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                     <td style="vertical-align: baseline; width: 40%; float: right;">
                        <table style="line-height: 25px;" cellspacing="0" cellpadding="0">  
                           <tr>
                              <td style="color: #f1bb2f; background: #ffffff; padding-right: 25px;"><b>Transporter Details</b></td>
                           </tr>
                           <tr>
                              <td style="background: #ffffff;"><b>Transporter Name </b> :- {{$datas['transporter']['name']}}</td>
                           </tr>
                           <tr>
                              <td style="background: #ffffff;"><b>TGA License No. </b> :- {{$datas['transporter']['pta_license_number']}}</td>
                           </tr>

                           <tr>
                              <td style="color: #f1bb2f; background: #ffffff; padding-right: 25px;"><b>Receiver Details</b></td>
                           </tr>


                           @foreach (@$datas['jobReceivers'] as $key => $value)                          

                           <tr>
                              <td style="background: #ffffff;"><b>Name </b> :- {{$value->receivers_name}}</td>
                           </tr>
                           <tr>
                              <td style="background: #ffffff;"><b>mobile/ or Phone no.</b> :- {{$value->receiver_number}}</td>
                           </tr>
                           <tr>
                              <td style="background: #ffffff;"><b>City </b> :- {{$value->DestinationAddres->name}}</td>
                           </tr>  

                           @endforeach

                        </table>
                     </td>
                  </tr>
               </table>
            </div>
        <!--     <div class="" style="display: flex; justify-content: end; float: right;">
               <div class="label-invoice" style="margin: 6px 138px 8px 0;">
                  <h3 class="ship-invoice" style="font-size:16px; margin-bottom: 5px;">{{__('web.receiver_details')}}</h3>
                  <p>{{date('d/m/Y - h:i A')}}</p>
               </div>
            </div>  -->


            <br>
            <div class="product_data_wrapper" style="margin: 1px 0 0;">
               <div class="">
                  <table class="table">
                     <thead style="background:transparent;">
                        <tr>
                           <td style="width: 24%;" scope="col">Type</td>
                           <td style="width: 40%;" scope="col">Description</td>
                           <td style="width: 18%;" scope="col">Quantity</td>
                           <td scope="col" style="width: 18%; padding-right: 10px;text-align: right;" align="right">Price</td>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td style="padding:0px; padding-left: 10px;">
                              <table width="100%">
                                 <tr style="background:transparent;">
                                    <td align="left" style=" border: none;">
                                       <div>
                                          <p>{{$datas['job']['title']}}</p>
                                       </div>
                                    </td>
                                 </tr>
                              </table>
                           </td> 
                           <td style="padding:0px; padding-left: 10px;">
                              <p>Schedule date : {{$datas['job']['schedule_date']}}</p>
                              <p>Schedule time : {{$datas['job']['schedule_time']}}</p>
                              <p>Total weight of goods : {{$datas['job']['total_goods_weight']}} {{ $datas['job']['total_goods_weight']?'Tonne':''}}</p>
                              <p>Description of goods :{{$datas['job']['description_of_goods']}}</p>
                           </td> 
                           <td style="padding:0px; padding-left: 10px;">{{$datas['job']['number_of_items']}}</td> 
                           <td  style="padding:0px; padding-right: 10px;" align="right">{{$datas['job']['sub_amount']}} SAR</td>
                        </tr>

                        <tr>
                        </tr>
                        <tr style="background:transparent;">
                           <td style="border: none;"></td>
                           <!--  <td style="border: none;"></td> -->
                           <td colspan="2"   align="right"><b>Subtotal</b></td>
                           <td style=" position:relative;" align="right"> {{$datas['tota']['sub_amount']}} SAR</td>
                        </tr> 
                        @if($datas['tota']['discount'])
                        <tr style="background:transparent;">
                           <td style="border: none;"></td>
                           <!-- <td style="border: none;"></td> -->
                           <td colspan="2"   align="right"><b>Discount</b></td>
                           <td style=" position:relative;" align="right">{{$datas['tota']['discount']}} SAR</td>
                        </tr> 
                        @endif
                        <tr >
                           <td style="border: none;"></td>
                           <!--  <td style="border: none;"></td> -->
                           <td colspan="2"   align="right"><b>Tax</b></td>
                           <td style="position:relative;" align="right">{{$datas['tota']['tax_price']}} SAR</td>
                        </tr> 
                        <tr >
                           <td style="border: none;"></td>
                           <!--  <td style="border: none;"></td> -->
                           <td colspan="2"   align="right"><b>Commission</b></td>
                           <td style="position:relative;" align="right">{{$datas['tota']['commssion']}} SAR</td>
                        </tr>
                        @if($datas['tota']['penaltiy_amount'])
                        <tr >
                           <td style="border: none;"></td>
                           <!--      <td style="border: none;"></td>  -->
                           <td colspan="2"   align="right"><b>Penalty</b></td>
                           <td style=" position:relative;" align="right">{{$datas['tota']['penaltiy_amount']}} SAR</td>
                        </tr>
                        @endif
                        <tr>
                           <td style="border: none; background: #fff;"></td>
                           <td style="border: none; background: #fff;"></td>
                           <td style="border-top: 1px solid #909090; border-bottom: 1px solid #909090;"><b>Total</b></td>
                           <td style="border-top: 1px solid #909090; border-bottom: 1px solid #909090; position:relative;" align="right">{{$datas['tota']['booking_fee']}} SAR</td>
                        </tr>
                     </tbody>
                  </table>         
               </div>
               <div class="footer" style="text-align:center;">

                  <p><b>THANKS FOR YOUR BUSINESS!</b> 
                     <br>IF YOU HAVE ANY QUESTIONS, PLEASE DO GET IN TOUCH WITH US</p>
                     <p style="margin-bottom:0px;"><b>ARABAT</b><br>
                        www.arabat.sa
                       <br>EMAIL/PHONE/WHAT'S APP</p>                        
                       <table style="margin-top: 0px;">
                        <tbody>
                           <tr style="background: transparent; margin-top:5px;">
                              <td ></td>
                              <td></td>
                              <td  style="width:2%;">
                                 <a href="#" class="footer-social-icons" style="position:relative;padding:5px;">
                                    <img src="{{env('STORAGE_PATH')}}images/facebook-f.png" style="width: 20px;" alt="">
                                 </a>

                              </td>
                              <td style="width:2%;">
                                 <a href="#" class="footer-social-icons" style="position:relative;padding:5px;">
                                    <img src="{{env('STORAGE_PATH')}}images/instagram.png" style="width: 20px;"  alt="">
                                 </a>
                              </td>
                              <td style="width:2%;">
                                 <a href="#" class="footer-social-icons" style="position:relative;padding:5px;">
                                    <img src="{{env('STORAGE_PATH')}}images/twitter.png"  style="width: 20px;"  alt="">
                                 </a>
                              </td>
                              <td></td>
                              <td></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>

               @endforeach
            </div>



         </div>
      </section>
   </body>
   </html>