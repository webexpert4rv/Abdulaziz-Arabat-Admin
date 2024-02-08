<!DOCTYPE html>
<html>
<head>

   <style type="text/css">
     *{
         font-family: 'Roboto', sans-serif,'XB Riyaz';
         margin:0;
         padding: 0;
         list-style: none;
         outline-style: none;

         font-style: normal;
         font-weight: normal;
         src: url("{{ asset('storage/fonts/XB Riyaz.ttf') }}") format('truetype');
         }
         body {
            background-color: #eef1f6;
            font-size: 16px;
            font-weight: 400;
            font-family: "Nunito", "Segoe UI", arial;
            color: #000;
            font-family: 'XB Riyaz';
         }
         .invoice {
            width: 100%;
            max-width: 1016px;
            margin: 0 auto;

            border-radius: 5px;
            background-color: #ffffff;
            margin-bottom: 15px; 
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
            width: 100%;
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
            font-size: 16px;
         }
         .top_header .left h2 {
            font-size: 26px;
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
            font-size: 26px;
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
            font-size: 18px;
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
            font-size: 18px;
            color: #212529;
            margin: 0 0 2px;
         }
         .product_data  a {
            color: #269ffb;
            display: block;
            font-size: 17px;
            list-style: none;
            text-decoration: none;
         }
         .table tbody td {
            font-size: 16px;
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
            font-size: 16px;
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
             width: 50px;
             margin: 0px 5px;
             align-items: center; 
             justify-content: center; 
             height: 50px; 
         }
         .footer-social-icons img {
             text-decoration: inherit;
             text-decoration-color: #000; 
         }

         body.childa5 {
            font-size: 14px;
         }
         body.childa5 td {
            font-size: 14px !important;
         }
         body.childa5 p {
            font-size: 14px !important;
         }
         body.childa5 h2 {
            font-size: 20px !important;
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
    p{
      text-align: right;
    }
         
      </style> 
   </head>
   <body>
      <section id="invoice_wrapper">
         <div class="invoice"> 
            <div>

               <?php $type=$data[0]['user']['type'];  if($type=='user'){ $userType='Transporter';}else{$userType='User';} ?>
               <div class="top_header" style="padding:0px;">
                  <table cellspacing="0" cellpadding="0" style="position: relative;">
                     <tr>
                       <td style="background: #fff; float: right; margin: 0px 0 0; right: 0; margin-left: auto; display:flex; text-align:center; padding: 30px 30px 30px;">
                        <table cellspacing="0" cellpadding="0" style="background:#ffffff;">
                           <tr>
                              <td style="background: #ffffff;"><img src="{{env('STORAGE_PATH')}}images/arabat-logo.png" alt="" style="min-width:110px;max-width:220px;min-height:70px;max-height:90px;float:right;"></td>
                           </tr>
                        </table>
                     </td>
                     <td class="top_header_inner" style="width:70%; padding-left: 40px;">

                        <table cellspacing="0" cellpadding="0" class="left" style="text-align: right;"> 
                           <tr>
                              <td><h2 style="color: #000; font-family: 'Roboto', sans-serif;">فاتورة</h2>
                              </td>
                           </tr>
                           <tr>
                              <td><p style="color: #000; padding-top: 3px;" class="invoice_number">
                                 {{$data[0]['invoice_no']}}  <b> : رقم الفاتورة</b>  </p>
                              </td>
                           </tr>
                           
                           <tr>
                              <td><p style="color: #000; padding-top: 3px; padding-bottom: 0px;" class="order_number">
                                 {{$data[0]['job']['job_id']}}<b> : معرف الوظيفة</b>  </p>
                              </td>
                           </tr>
                           <tr>
                              <td><p style="color: #000; padding-top: 3px;" class="invoice_number">
                                 {{date('d/m/Y',strtotime($data[0]['booked_on']))}}<b> : تاريخ الحجز</b>
                              </p>
                           </td>
                        </tr> 
                        <tr>
                           <td><p style="color: #000; padding-top: 3px;" class="invoice_number">
                            {{date('d/m/Y',strtotime($data[0]['job']['schedule_date']))}} <b> : تاريخ التحميل </b>
                         </p>
                      </td>
                   </tr>
                   <tr>
                     <td><p style="color: #000; padding-top: 3px;" class="invoice_number">
                      {{ucfirst(str_replace('_', ' ', LanguageStatus($data[0]['booking_status'])))}} <b> : حالة الشحن</b>
                   </p>
                </td>
             </tr>

          </table>
       </td>

    </tr>
 </table>

</div>
<div class="contact_info">

   <table>
      <tr style="background:transparent;">
                    <!--  <td style="vertical-align: unset; line-height: 24px;">
                        <table cellspacing="0" cellpadding="0">
                           <tbody>
                              <tr>
                                 <td style="background: #ffffff; padding-right: 25px;"><b>Client Details</b></td>
                              </tr>
                           </tbody>
                        </table>
                     </td> -->
                     <td style="vertical-align: unset; line-height: 24px; width: 20%;">
                        <table cellspacing="0" cellpadding="0">
                           <tbody>
                              <tr>
                                 <td style="color: #000; background: #ffffff; visibility: hidden; padding-right: 25px;"><b></b></td>
                              </tr>
                           </tbody>
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
                     <td style="vertical-align: unset; line-height: 24px; width: 20%;">
                        <table cellspacing="0" cellpadding="0">
                           <tbody>
                              <tr>
                                 <td style="color: #000; background: #ffffff; visibility: hidden; padding-right: 25px;"><b></b></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                     
                     @if($data[0]['user']['type']=='user')

                         <td style="vertical-align: baseline; width: 40%; text-align:right;">
                        <table style="line-height: 25px;" cellspacing="0" cellpadding="0">
                           <tr>
                              <td style="background: #ffffff; color: #f1bb2f; padding-right: 25px;"><b>عنوان المرسل</b></td>
                           </tr>
                           <tr>
                              <td style="background: #ffffff;">{{$data[0]['user']['name']}} -:<b>اسم</b></td>
                           </tr>
                           <tr>
                              <td style="background: #ffffff;">
                                  {{$data[0]['job']['pick_up_address']}} -:<b>نقطة التحميل</b> </td>
                           </tr>                           
                            
                        </table>
                     </td>
                     @endif
                     @if($data[0]['user']['type']=='transporter')
                     <td style="vertical-align: baseline; width: 40%; float: right; text-align:right;">
                        <table style="line-height: 25px;" cellspacing="0" cellpadding="0">  
                           <tr>
                              <td style="color: #f1bb2f; background: #ffffff; padding-right: 25px;">
                                 <b>تفاصيل الناقل</b></td>
                           </tr>
                           <tr>
                              <td style="background: #ffffff;">
                                 {{$data[0]['transporter']['name']}} -:<b> اسم </b></td>
                           </tr>
                           <tr>
                              <td style="background: #ffffff;">
                                 {{$data[0]['transporter']['pta_license_number']}} -:<b>ترخيص هيئة النقل </b></td>
                           </tr>

                           <!-- <tr>
                              <td style="color: #f1bb2f; background: #ffffff; padding-right: 25px;"><b>المستلم</b></td>
                           </tr>


                           @foreach (@$data[0]['jobReceivers'] as $key => $value)                          

                           <tr>
                              <td style="background: #ffffff;">  {{$value->receivers_name}} -:<b>اسم </b></td>
                           </tr>
                           <tr>
                              <td style="background: #ffffff;"> {{$value->receiver_number}} -: <b>جوال/هاتف</b></td>
                           </tr>
                             

                           @endforeach -->



                        </table>
                     </td>
                     @endif
                     
                      

                    <!--  <td style="vertical-align: baseline; width: 40%; text-align:right;">
                        <table style="line-height: 25px;" cellspacing="0" cellpadding="0">
                           <tr>
                              <td style="background: #ffffff; color: #f1bb2f; padding-right: 25px;"><b>عنوان المرسل</b></td>
                           </tr>
                           <tr>
                              <td style="background: #ffffff;">{{$data[0]['user']['name']}} -:<b>اسم</b></td>
                           </tr>
                           <tr>
                              <td style="background: #ffffff;">
                                  {{$data[0]['job']['pick_up_address']}} -:<b>نقطة التحميل</b> </td>
                           </tr>                           
                            
                        </table>
                     </td> -->
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

            <div class="product_data_wrapper" style="margin: 10px 0 0;">
               <div class="">
                  <table class="table">
                      <thead style="background:transparent;">
                        <tr>
                           <td scope="col" style="width: 35%; padding-right: 10px;text-align: right;" align="right">السعر</td>
                           <td style="text-align: right; width: 20%;" scope="col">عدد </td>
                           <td style="text-align: right; width: 45%;" scope="col">وصف</td>
                           <td style="text-align: right; width: 16%;" scope="col">نوعية</td>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                          <td  style="text-align: right;padding:0px; padding-right: 10px;" align="right"></td>

                          <td style="text-align: right; padding:0px; padding-left: 10px;">1</td> 
                          <td style="text-align: right; padding:0px; padding-left: 10px;">
                           <p>{{$data[0]['job']['job_id']}} : <strong>رقم الطلب</strong></p>
                           @if($data[0]['user']['type']=='user')
                           <p>{{$data[0]['transporter']['name']}} : <strong>العميل</strong></p>
                           @else
                           <p>{{$data[0]['user']['name']}} : <strong>العميل</strong></p>
                           @endif
                           <p> {{$data[0]['job']['schedule_date']}} : <strong>تاريخ الطلب</strong></p>
                           <!-- <p> {{date('Y-m-d')}} : التاريخ الي</p> -->
                           <!-- <p> {{$data[0]['job']['schedule_time']}} : وقت النقل</p> -->
                           <p> {{$data[0]['job']['vehicle_type']}} : <strong>نوع المركبة</strong></p>
                           <!-- <p>{{$data[0]['job']['description_of_goods']}} : الوزن الإجمالي للبضائع</p> -->
                           <p>{{$data[0]['jobReceivers'][0]['destination_address']}} - <strong>الى</strong> {{$data[0]['job']['pick_up_address']}} - <strong>من</strong></p>
                           <p style="color:red"><b>{{$data[0]['tota']['sub_amount']}} : تكلفة الشحن (شامل الضريبة)</b></p>
                           <strong>[ملحوظة:-</strong>سيتم إصدار فاتورة الطلب من قبل الناقل.]
                        </td>
                        <td style="text-align: right; padding:0px; padding-left: 10px;">
                           <table width="100%">
                              <tr style="background:transparent;">
                                 <td align="right" style=" border: none;">
                                    <div>
                                       <p>{{$data[0]['job']['title']}}</p>
                                    </div>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr> 
                     
                   
                   @if($data[0]['tota']['discount'])
                   <tr style="background:transparent;">                           
                     <td style=" position:relative;" align="right">ريال سعودي {{$data[0]['tota']['discount']}} </td>
                     <td colspan="2"><b>تخفيض</b></td>

                  </tr> 
                  @endif
                  
                  <tr>
                     <td style="position:relative;" align="right">ريال سعودي {{$data[0]['tota']['commssion']}} </td>
                     <td colspan="2"><b>عمولة</b></td>
                  </tr>
                  <tr >                           
                     <td style="position:relative;" align="right"> ريال سعودي {{$data[0]['tota']['tax_price']}}</td>
                     <td colspan="2"><b>الضريبة</b></td>

                  </tr> 
                  @if($data[0]['tota']['penaltiy_amount'])
                  <tr >

                     <td style=" position:relative;" align="right">ريال سعودي {{$data[0]['tota']['penaltiy_amount']}} </td>
                     <td colspan="2"><b>غرامة</b></td>
                  </tr>
                  @endif
                  <tr>

                     <td style="border-top: 1px solid #909090; border-bottom: 1px solid #909090; position:relative;" align="right">ريال سعودي {{$data[0]['tota']['tax_price']+$data[0]['tota']['commssion']}} SAR </td>
                     <td style="border-top: 1px solid #909090; border-bottom: 1px solid #909090;"><b>المجموع</b></td>
                     <td style="border-top: 1px solid #909090; border-bottom: 1px solid #909090;"></td>
                     <td style="border-top: 1px solid #909090; border-bottom: 1px solid #909090;"></td>
                      
                  </tr>
               </tbody>
            </table>         
         </div>

        <div class="footer" style="text-align:center;">
            <p><b>شكراً للتعامل معنا!</b> 
               <br>إذا كان لديك أي أسئلة ، فيرجى التواصل معنا</p>

               <p style="margin-bottom:0px;"><b> عربات</b>                    
                       <br>  www.arabat.sa
                 <br>بريد إلكتروني / هاتف / واتس اب</p>

                 <!-- <a href="#" style=" text-decoration: none; color: #333338; font-weight: 500;">Arabat.com</a> -->
                 <table style="margin-top: 0px;">
                  <tbody>
                     <tr style="background: transparent; margin-top:1px;">
                        <td  style="width:15%;"></td>
                        <td style="width:24%;"></td>
                        <td  style="width:2%;">
                           <a href="#" class="" style="position:relative;padding:5px;">
                              <img src="{{env('STORAGE_PATH')}}images/facebook-f.png" style="position: absolute; top:7px; left:7px;background: #000;border-radius: 50px;margin: 0px 5px;width:15px;padding:10px;" alt="">
                           </a>

                        </td>
                        <td style="width:2%;">
                           <a href="#" class="footer-social-icons" style="position:relative;padding:5px;">
                              <img src="{{env('STORAGE_PATH')}}images/instagram.png" style="position: absolute; top:7px; left:7px;background: #000;border-radius: 50px;margin: 0px 5px;width:15px;padding:10px;" alt="">
                           </a>
                        </td>
                        <td style="width:2%;">
                           <a href="#" class="footer-social-icons" style="position:relative;padding:5px;">
                              <img src="{{env('STORAGE_PATH')}}images/twitter.png" style="position: absolute; top:8px; left:8px;background: #000;border-radius: 50px;margin: 0px 5px;width:15px;padding:10px;" alt="">
                           </a>
                        </td>
                        <td style="width:20%;"></td>
                        <td style="width:20%;"></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</section> 
</body>
</html> 
<?php //die; ?>