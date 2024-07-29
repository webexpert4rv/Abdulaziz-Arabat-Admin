<!DOCTYPE html>
<html>
<head>
</head>
<body style=" background-color: #eef1f6; font-size: 14px; font-weight: 400; font-family: " Nunito", "Segoe UI", arial; color: #000;">
   <section id="invoice_wrapper" style="text-align: right">
      <div style="box-shadow: 0px 0px 10px #e1e1e1;border: 1px solid #d7d7d7;width: 98%; margin: 10px auto;border-radius: 5px; background-color: #ffffff;
      margin-bottom: 15px;  background-repeat: no-repeat; background-position: top left; background-size: 350px; " >
      <div>
         <div class="top_header" style="padding:0px;">
            <table cellspacing="0" cellpadding="0" style="position: relative; width: 100%;">
               <tr>
                   <td style="width: 30% background: #fff; float: right; margin: 0px 0 0; right: 0; margin-left: auto; display:flex; text-align:center; padding: 30px 30px 30px;">
                     <table cellspacing="0" cellpadding="0" style="background:#ffffff;width: 100%;">
                        <tr>
                           <td style="background: #ffffff;"><img src="{{env('STORAGE_PATH')}}images/arabat-logo.png" alt="" style="min-width:110px;max-width:220px;min-height:70px;max-height:90px;float:right;"></td>  
                        </tr>
                     </table>
                  </td>
                  <td style="width: 5%">

                  </td>
                  <td class="top_header_inner" style="background-color: #ffcd00;padding: 15px 30px;padding-bottom: 15px; width: 55%; z-index: 0;position: relative;">
                     <table cellspacing="0" cellpadding="0" class="left" style=" width:100%;  position: relative;text-align: right; "> 
                        <tr>
                           <td><h2 style="color: #000;margin-bottom: 0;margin-top: 0;font-family: 'Roboto', sans-serif;font-size: 24px;font-weight: 800;display: block;padding-bottom: 0px;">فاتورة</h2>
                           </td>
                        </tr>
                        <tr>
                            <td><p style="color: #000; padding-top: 0px; font-size: 14px;margin-bottom: 0;margin-top: 0px;" class="invoice_number">
                               {{$data['invoice_no']}}  <b> : رقم الفاتورة</b>  </p>   
                           </td>
                        </tr>
                        <tr>
                           <td><p style="color: #000; padding-top: 0px; font-size: 14px;margin-bottom: 0;margin-top: 0px;" class="invoice_number">
                            {{$data['book_id']}}<b> : رقم الحجز</b>  </p>
                        </td>
                        </tr>
                        <tr>
                            <td><p style="color: #000; padding-top: 0px; font-size: 14px;margin-bottom: 0;margin-top: 0px;" class="invoice_number">
                              {{$data['job']['job_id']}}<b> : معرف الوظيفة</b>  </p>
                           </td>
                        </tr>
                        <tr>
                           <td><p style="color: #000; padding-top: 0px; font-size: 14px;margin-bottom: 0;margin-top: 0px;" class="invoice_number">
                              {{date('d/m/Y',strtotime($data['booked_on']))}}<b> : تاريخ الحجز</b>
                           </td>
                        </tr>
                        <tr>
                            <td><p style="color: #000; padding-top: 0px; font-size: 14px;margin-bottom: 0;margin-top: 0px;" class="invoice_number">
                              <b>Date of Shipment : </b>
                           {{date('d/m/Y',strtotime($data['job']['schedule_date']))}} <b> : تاريخ التحميل </b>
                        </td>
                        </tr>
                        <tr>
                            <td><p style="color: #000; padding-top: 0px; font-size: 14px;margin-bottom: 0;margin-top: 0px;" class="invoice_number">
                              {{ucfirst(str_replace('_', ' ', LanguageStatus($data['booking_status'])))}} <b> : حالة الشحن</b>
                        </td>
                        </tr>
                     </table>
                  </td>                 
               </tr>
            </table>

         </div>

         <div class="contact_info" style="margin: 40px 0 0;display: flex;align-items: center;justify-content: space-between;padding: 0 30px;">

            <table style="width: 100%; text-align: right">
               <tr style="background:transparent;">                 
                  <!-- <td style="vertical-align: baseline;width: 35%;">
                     <table style="line-height: 25px;     margin-left: auto;" cellspacing="0" cellpadding="0">  
                        <tr>
                           <td style="background: #ffffff; color: #ffcd00; padding-right: 25px; font-size: 14px"><b>تفاصيل الناقل</b></td>
                        </tr>
                        <tr>
                           <td style="background: #ffffff;">
                              {{$data['transporter']['name']}} -:<b> اسم </b></td>
                        </tr>
                        <tr>
                           <td style="background: #ffffff;">
                               {{$data['transporter']['pta_license_number']}} -:<b>ترخيص هيئة النقل </b></td>
                        </tr>

                        <tr>
                           <td style="background: #ffffff; color: #ffcd00; padding-right: 25px; font-size: 14px"><b>المستلم</b></td>
                        </tr>

                           @foreach (@$data['jobReceivers'] as $key => $values)                          

                           <tr>
                              <td style="background: #ffffff;">{{$values->receivers_name}} -:<b>اسم </b></td>
                           </tr>
                           <tr>
                              <td style="background: #ffffff;">{{$values->receiver_number}} -: <b>جوال/هاتف</b></td>
                           </tr>
                           <tr>
                              <td style="background: #ffffff;">{{$values->DestinationAddres->name}} -: <b>المدينة </b> </td>
                           </tr> 
                           @endforeach                        
                     </table>
                  </td> -->
                  <td style="vertical-align: unset; line-height: 24px; width: 15%;">
                     <table cellspacing="0" cellpadding="0">
                        <tbody>
                           <tr>
                              <td style="color: #000; background: #ffffff; padding-right: 25px;"></td>
                           </tr>
                        </tbody>
                     </table>
                  </td>
                  <td style="vertical-align: baseline;width: 50%">
                     <table style="line-height: 25px; margin-left: auto;" cellspacing="0" cellpadding="0">
                        <tr>
                           <td style="background: #ffffff; color: #ffcd00; padding-right: 25px; font-size: 14px"><b>عنوان المرسل</b></td>
                        </tr>

                        <tr>
                           <td style="background: #ffffff;">
                             {{$data['user']['name']}} -:<b>اسم</b></td>
                        </tr>
                        <tr>
                           <td style="background: #ffffff;">
                               {{$data['job']['pick_up_address']}} -:<b>نقطة التحميل</b> </td>
                        </tr>
                        <tr>
                           <td style="background: #ffffff;"> 
                              {{$data['job']['city']}} -:<b>المدينة</b></td>
                        </tr>
                       
                     </table>
                  </td>
               </tr>
            </table>
         </div>          
         <br>
         <div class="product_data_wrapper" style="margin: 0px 0 0;padding: 0 30px;">
            <div class="">
               <table class="table" style="width: 100%;border-top-left-radius: 5px;border-top-right-radius: 5px;">
                  <thead style="background:transparent;">
                     <tr>
                         <td scope="col" style="width: 20%;padding-right: 10px;text-align: right;padding: 15px;font-size: 14px;font-weight: 600;border-right: none;text-align: left;border-bottom: 1px solid #cbcbcb;color: #212529;border-top: 1px solid #cbcbcb;background: #fafafa;; padding-right: 10px;text-align: right;" align="right">السعر</td>
                         <td style="width: 10%;padding: 15px;font-size: 14px;font-weight: 600;border-right: none;text-align: left;border-bottom: 1px solid #cbcbcb;color: #212529;border-top: 1px solid #cbcbcb;background: #fafafa;" scope="col">عدد</td>
                           <td style="width: 40%;padding: 15px;font-size: 14px;font-weight: 600;border-right: none;text-align: left;border-bottom: 1px solid #cbcbcb;color: #212529;border-top: 1px solid #cbcbcb;background: #fafafa;" scope="col">وصف</td>
                        <td style="width: 10%;padding: 15px;font-size: 14px;font-weight: 600;border-right: none;text-align: left;border-bottom: 1px solid #cbcbcb;color: #212529;border-top: 1px solid #cbcbcb;background: #fafafa;" scope="col">نوعية</td>  
                       
                     </tr>
                  </thead>
                  <tbody>
                     <tr>


                        <td  style="padding:0px;padding-right: 10px;background: #fff;font-size: 14px;color: #212529;vertical-align: middle;" align="right">{{$data['job']['sub_amount']}} SAR</td>
                        <td style="padding:0px;padding-left: 10px;background: #fff;font-size: 14px;color: #212529;vertical-align: middle;">{{$data['job']['number_of_items']}}</td>
                        <td style="padding:0px;padding-left: 10px;background: #fff;font-size: 14px;color: #212529;vertical-align: middle;">
                           <p style="margin: 0px;"> {{$data['job']['job_id']}} : ><strong>رقم الطلب</strong></p>
                           <p style="margin: 0px;"> {{$data['transporter']['name']}} : ><strong>العميل</strong></p>
                           <p style="margin: 0px;"> {{$data['job']['schedule_date']}} : ><strong>تاريخ الطلب</strong></p>
                           <p style="margin: 0px;">{{$data['job']['description_of_goods']}} : <strong>الوزن الإجمالي للبضائع</strong></p>
                           <p style="margin: 0px;">{{$data['job']['vehicle_type']}}  : ><strong>نوع المركبة</strong></p>
                           <p style="margin: 0px;">{{$data['job']['pick_up_address']}}  : ><strong>من</strong></p>
                           <p style="margin: 0px;">- {{@$destinationAddress}}  : ><strong>الى</strong></p> 
                           <p style="margin: 0px;">- <strong style="color: #f00;">{{$data['tota']['sub_amount']}} : تكلفة الشحن (شامل الضريبة)</strong></p>
                           <p style="margin: 0px;">- [ سيتم إصدار فاتورة الطلب من قبل الناقل : <strong>ملحوظة</strong>.]</p>






                        </td>
                        <td style="padding:0px;padding-left: 10px;background: #fff;font-size: 14px;color: #212529;vertical-align: middle;">
                            {{$data['job']['title']}}
                           <!-- <table width="100%">
                              <tr style="background:transparent;">
                                 <td align="left" style="background: #0000; border: none;">
                                    <div>
                                       <p>{{$data['job']['title']}}</p>
                                    </div>
                                 </td>
                              </tr>
                           </table> -->
                        </td>                         
                     </tr>

                     <tr>
                     </tr>
                     <!-- <tr style="background:transparent;">
                        

                        <td style="background: #fff; color: #000;vertical-align: middle; position:relative;padding: 0.75rem;vertical-align: top;border-bottom: 1px solid #e8e8e8;border-top: 0px;" align="right">  ريال سعودي {{$data['tota']['sub_amount']}}</td>

                        <td style="background: #fff;color: #000;vertical-align: middle;padding: 0.75rem;border-bottom: 1px solid #e8e8e8;border-top: 0px;"><b>المجموع قبل الضريبة</b></td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        
                     </tr>  -->
                     @if($data['tota']['discount'])
                     <tr style="background:transparent;">
                        
                         <td style="background: #fff; color: #000;vertical-align: middle; position:relative;padding: 0.75rem;vertical-align: top;border-bottom: 1px solid #e8e8e8;border-top: 0px;" align="right">ريال سعودي  {{$data['tota']['discount']}}</td>
                        <td style="background: #fff; color: #000;vertical-align: middle;padding: 0.75rem;border-bottom: 1px solid #e8e8e8;border-top: 0px;"><b>تخفيض</b></td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                       
                     </tr> 
                     @endif
                     <tr >
                        
                         <td style="background: #fff; color: #000;vertical-align: middle; position:relative;padding: 0.75rem;vertical-align: top;border-bottom: 1px solid #e8e8e8;border-top: 0px;" align="right">ريال سعودي {{$data['tota']['tax_price']}}</td>
                        <td style="background: #fff; color: #000;vertical-align: middle;padding: 0.75rem;vertical-align: top;border-bottom: 1px solid #e8e8e8;border-top: 0px;"><b>الضريبة</b></td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                       
                     </tr> 
                     <tr >
                        
                          <td style="background: #fff; color: #000;vertical-align: middle; position:relative;padding: 0.75rem;vertical-align: top;border-bottom: 1px solid #e8e8e8;border-top: 0px;" align="right">ريال سعودي {{$data['tota']['commssion']}}</td>                         
                        <td style="background: #fff; color: #000;vertical-align: middle;padding: 0.75rem;vertical-align: top;border-bottom: 1px solid #e8e8e8;border-top: 0px;"><b>عمولة</b></td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>                            
                      
                     </tr>
                     @if($data['tota']['penaltiy_amount'])
                     <tr >
                        
                        <td style="background: #fff; color: #000;vertical-align: middle; position:relative;padding: 0.75rem;vertical-align: top;border-bottom: 1px solid #e8e8e8;border-top: 0px;" align="right">ريال سعودي {{$data['tota']['penaltiy_amount']}}</td>
                        <td style="background: #fff; color: #000;vertical-align: middle;padding: 0.75rem;vertical-align: top;border-bottom: 1px solid #e8e8e8;border-top: 0px;"><b>غرامة</b></td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td> 
                        
                     </tr>
                     @endif
                     <tr>
                        
                        <td style="background: #fff;color: #000;vertical-align: middle;border-top: 1px solid #909090;border-bottom: 1px solid #909090; position:relative;padding: 0.75rem;vertical-align: top;" align="right">ريال سعودي {{$data['tota']['booking_fee']}}</td>
                        <td style="background: #fff;color: #000;vertical-align: middle;border-top: 1px solid #909090;border-bottom: 1px solid #909090;padding: 0.75rem;vertical-align: top;"><b>المجموع</b></td>
                        <td style="border: none; background: #fff; border-top: 1px solid #909090;border-bottom: 1px solid #909090;"></td>
                        <td style="border: none; background: #fff; border-top: 1px solid #909090;border-bottom: 1px solid #909090;"></td>
                        
                     </tr>
                  </tbody>
               </table>         
            </div>
            <div class="footer" style="text-align:center;padding-bottom: 30px;">
               <p style="display: block; color: #111111;text-align: center;margin: 30px 0 15px;  text-transform: uppercase;line-height: 22px;">
                  <b>شكراً للتعامل معنا</b>
                  <br>إذا كان لديك أي أسئلة ، فيرجى التواصل معنا</p>
                  <p style="margin-bottom:0px;display: block;color: #111111;text-align: center;margin: 30px 0 15px;text-transform: uppercase;line-height: 22px;"><b>عربات</b>
                    <br> بريد إلكتروني / هاتف / واتس اب</p>

                    <table style="margin-top: 10px;">
                     <tbody>
                        <tr style="background: transparent; margin-top:5px;">
                           <td  style="width:20%"></td>
                           <td style="width:13%"></td>
                           <td  style="width:2%">
                              <a href="#" class="footer-social-icons" style="position:relative;">
                                 <img src="{{env('STORAGE_PATH')}}images/facebook-f.png" style="position: absolute; top:7px; left:7px;width: 50%;" alt="">
                              </a>

                           </td>
                           <td style="width:2%">
                              <a href="#" class="footer-social-icons" style="position:relative;">
                                 <img src="{{env('STORAGE_PATH')}}images/instagram.png" style="position: absolute; top:7px; left:7px;width: 50%;" alt="">
                              </a>
                           </td>
                           <td style="width:2%">
                              <a href="#" class="footer-social-icons" style="position:relative;">
                                 <img src="{{env('STORAGE_PATH')}}images/twitter.png" style="position: absolute; top:8px; left:8px;width: 50%;" alt="">
                              </a>
                           </td>
                           <td style="width:13%"></td>
                           <td style="width:20%"></td>
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