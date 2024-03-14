
<!DOCTYPE html>
<html>
<head>
</head>
<body style=" background-color: #eef1f6; font-size: 14px; font-weight: 400; font-family: " Nunito", "Segoe UI", arial; color: #000;">
   <section id="invoice_wrapper">
      <div style="box-shadow: 0px 0px 10px #e1e1e1;border: 1px solid #d7d7d7;width: 98%; margin: 10px auto;border-radius: 5px; background-color: #ffffff;
      margin-bottom: 15px;  background-repeat: no-repeat; background-position: top left; background-size: 350px; " >
      <div>
         <div class="top_header" style="padding:0px;">
            <table cellspacing="0" cellpadding="0" style="position: relative; width: 100%;">
               <tr>
                  <td class="top_header_inner" style="background-color: #ffcd00;padding: 15px 30px;padding-bottom: 15px; width: 50%; z-index: 0;position: relative;">
                     <table cellspacing="0" cellpadding="0" class="left" style=" width:100%;  position: relative; "> 
                        <tr>
                           <td><h2 style="color: #000;margin-bottom: 0;margin-top: 0;font-family: 'Roboto', sans-serif;font-size: 24px;font-weight: 800;display: block;padding-bottom: 0px;">Invoice</h2>
                           </td>
                        </tr>
                        <tr>
                            <td><p style="color: #000; padding-top: 0px; font-size: 14px;margin-bottom: 0;margin-top: 0px;" class="invoice_number">
                              <b>Invoice No : </b> {{$data['invoice_no']}}</p>
                           </td>
                        </tr>
                        <tr>
                           <td><p style="color: #000; padding-top: 0px; font-size: 14px;margin-bottom: 0;margin-top: 0px;" class="invoice_number">
                           <b>Booking No : </b> {{$data['book_id']}}</p>
                        </td>
                        </tr>
                        <tr>
                            <td><p style="color: #000; padding-top: 0px; font-size: 14px;margin-bottom: 0;margin-top: 0px;" class="invoice_number">
                              <b>Job ID : </b> {{$data['job']['job_id']}}</p>
                           </td>
                        </tr>
                        <tr>
                           <td><p style="color: #000; padding-top: 0px; font-size: 14px;margin-bottom: 0;margin-top: 0px;" class="invoice_number">
                              <b>Date of Booking : </b>{{date('d/m/Y',strtotime($data['booked_on']))}}</p>
                           </td>
                        </tr>
                        <tr>
                            <td><p style="color: #000; padding-top: 0px; font-size: 14px;margin-bottom: 0;margin-top: 0px;" class="invoice_number">
                              <b>Date of Shipment : </b>
                           {{date('d/m/Y',strtotime($data['job']['schedule_date']))}}</p>
                        </td>
                        </tr>
                        <tr>
                            <td><p style="color: #000; padding-top: 0px; font-size: 14px;margin-bottom: 0;margin-top: 0px;" class="invoice_number">
                              <b>Booking Status: </b>
                           {{str_replace('_', ' ', $data['booking_status']) }}</p>
                        </td>
                        </tr>
                     </table>
                  </td>
                  <td style="background: #fff; float: right; margin: 0px 0 0; right: 0; margin-left: auto; display:flex; text-align:center; padding: 30px 30px 30px;">
                     <table cellspacing="0" cellpadding="0" style="background:#ffffff;width: 100%;">
                        <tr>
                           <td style="background: #ffffff;"><img src="https://web.arabat.sa/images/arabat-logo.png" alt="" style="min-width:110px;max-width:220px;min-height:70px;max-height:90px;float:right;"></td>  
                        </tr>
                     </table>
                  </td>
               </tr>
            </table>

         </div>

         <div class="contact_info" style="margin: 40px 0 0;display: flex;align-items: center;justify-content: space-between;padding: 0 30px;">

            <table style="width: 100%;">
               <tr style="background:transparent;">

                  <td style="vertical-align: baseline;width: 65%">
                     <table style="line-height: 25px;" cellspacing="0" cellpadding="0">
                        <tr>
                           <td style="background: #ffffff; color: #ffcd00; padding-right: 25px; font-size: 14px"><b>Sender's Details</b></td>
                        </tr>

                        <tr>
                           <td style="background: #ffffff;">
                              <b>Name </b> :- {{$data['user']['name']}}</td>
                        </tr>
                        <tr>
                           <td style="background: #ffffff;">
                              <b>Pickup point Address </b> :- {{$data['job']['pick_up_address']}}</td>
                        </tr>
                        <!-- <tr>
                           <td style="background: #ffffff;">
                              <b>City </b> :- {{$data['job']['city']}}</td>
                        </tr> -->
                       
                     </table>
                  </td>
                  <td style="vertical-align: unset; line-height: 24px;">
                     <table cellspacing="0" cellpadding="0">
                        <tbody>
                           <tr>
                              <td style="color: #000; background: #ffffff; padding-right: 25px;"></td>
                           </tr>
                        </tbody>
                     </table>
                  </td>
                  <!-- <td style="vertical-align: baseline;width: 35%;">
                     <table style="line-height: 25px;" cellspacing="0" cellpadding="0">  
                        <tr>
                           <td style="background: #ffffff; color: #ffcd00; padding-right: 25px; font-size: 14px"><b>Transporter Details</b></td>
                        </tr>
                        <tr>
                           <td style="background: #ffffff;">
                              <b>Transporter Name </b> :- {{$data['transporter']['name']}}</td>
                        </tr>
                        <tr>
                           <td style="background: #ffffff;">
                              <b>TGA License No. </b> :- {{$data['transporter']['pta_license_number']}}</td>
                        </tr>

                        <tr>
                           <td style="background: #ffffff; color: #ffcd00; padding-right: 25px; font-size: 14px"><b>Receiver Details</b></td>
                        </tr>

                           @foreach (@$data['jobReceivers'] as $key => $values)                          

                           <tr>
                              <td style="background: #ffffff;"><b>Name </b> :- {{$values->receivers_name}}</td>
                           </tr>
                           <tr>
                              <td style="background: #ffffff;"><b>mobile/ or Phone no.</b> :- {{$values->receiver_number}}</td>
                           </tr>
                           <tr>
                              <td style="background: #ffffff;"><b>City </b> :- {{$values->DestinationAddres->name}}</td>
                           </tr> 
                           @endforeach                        
                     </table>
                  </td> -->
               </tr>
            </table>
         </div>          
         <br>
         <div class="product_data_wrapper" style="margin: 0px 0 0;padding: 0 30px;">
            <div class="">
               <table class="table" style="width: 100%;border-top-left-radius: 5px;border-top-right-radius: 5px;">
                  <thead style="background:transparent;">
                     <tr>
                        <td style="width: 30%;padding: 15px;font-size: 14px;font-weight: 600;border-right: none;text-align: left;border-bottom: 1px solid #cbcbcb;color: #212529;border-top: 1px solid #cbcbcb;background: #fafafa;" scope="col">Title</td>
                        <td style="width: 40%;padding: 15px;font-size: 14px;font-weight: 600;border-right: none;text-align: left;border-bottom: 1px solid #cbcbcb;color: #212529;border-top: 1px solid #cbcbcb;background: #fafafa;" scope="col">Description</td>
                        <td style="width: 15%;padding: 15px;font-size: 14px;font-weight: 600;border-right: none;text-align: left;border-bottom: 1px solid #cbcbcb;color: #212529;border-top: 1px solid #cbcbcb;background: #fafafa;" scope="col">Qty</td>
                        <td scope="col" style="width: 15%;padding-right: 10px;text-align: right;padding: 15px;font-size: 14px;font-weight: 600;border-right: none;text-align: left;border-bottom: 1px solid #cbcbcb;color: #212529;border-top: 1px solid #cbcbcb;background: #fafafa;; padding-right: 10px;text-align: right;" align="right">Price</td>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td style="padding:0px;padding-left: 10px;background: #fff;font-size: 14px;color: #212529;vertical-align: middle;">
                           <table width="100%">
                              <tr style="background:transparent;">
                                 <td align="left" style="background: #0000; border: none;">
                                    <div>
                                       <p>{{$data['job']['title']}}</p>
                                    </div>
                                 </td>
                              </tr>
                           </table>
                        </td> 
                        <?php
                           if(!empty($data['jobReceivers'][0]['destination_address'])){
                              $destinationAddress=$data['jobReceivers'][0]['destination_address'];
                           }else{
                              $destinationAddress=$data['jobReceivers'][0]['DestinationAddres']['name'].' , '.$data['jobReceivers'][0]['DestinationRegion']['name'];
                           }
                           ?>
                        <td style="padding:0px;padding-left: 10px;background: #fff;font-size: 14px;color: #212529;vertical-align: middle;">
                        <p style="margin: 0px;"><strong>Job id</strong> : {{$data['job']['job_id']}}</p>
                           <p style="margin: 0px;"><strong>User Name</strong> : {{$data['transporter']['name']}}</p>
                           <p style="margin: 0px;"><strong>Date of Order</strong> : {{$data['job']['schedule_date']}} </p>
                           <p style="margin: 0px;"><strong>Vehicle Type</strong> : {{$data['job']['vehicle_type']}} </p>
                           <p style="margin: 0px;"><strong>From</strong> : {{$data['job']['pick_up_address']}} </p>
                           <p style="margin: 0px;"><strong>To</strong> : {{$destinationAddress}} </p>



                           <p style="margin: 0px;"><strong style="color: #f00;">Quote Amount (Including TAX) : {{$data['tota']['sub_amount']}} SAR</strong> </p>
                           <p style="margin: 0px;">[<strong>Note</strong>:- Invoice for the order will be issued by Transporter.] </p>
                           
                         
                           
                        </td> 
                        <td style="padding:0px;padding-left: 10px;background: #fff;font-size: 14px;color: #212529;vertical-align: middle;">{{$data['job']['number_of_items']}}</td> 
                        <td  style="padding:0px;padding-right: 10px;background: #fff;font-size: 14px;color: #212529;vertical-align: middle;" align="right">{{$data['job']['sub_amount']}} SAR</td>
                     </tr>

                     <tr>
                     </tr>
                     <!-- <tr style="background:transparent;">
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="background: #f3f3f3;color: #000;vertical-align: middle;padding: 0.75rem;border-bottom: 1px solid #e8e8e8;border-top: 0px;"><b>Sub Total</b></td>
                        <td style="background: #f3f3f3; color: #000;vertical-align: middle; position:relative;padding: 0.75rem;vertical-align: top;border-bottom: 1px solid #e8e8e8;border-top: 0px;" align="right"> {{$data['tota']['sub_amount']}} SAR</td>
                     </tr>  -->
                     @if($data['tota']['discount'])
                     <tr style="background:transparent;">
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="background: #fff; color: #000;vertical-align: middle;padding: 0.75rem;border-bottom: 1px solid #e8e8e8;border-top: 0px;"><b>Discount</b></td>
                        <td style="background: #fff; color: #000;vertical-align: middle; position:relative;padding: 0.75rem;vertical-align: top;border-bottom: 1px solid #e8e8e8;border-top: 0px;" align="right">${{$data['tota']['discount']}} SAR</td>
                     </tr> 
                     @endif
                     <tr >
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="background: #fff; color: #000;vertical-align: middle;padding: 0.75rem;vertical-align: top;border-bottom: 1px solid #e8e8e8;border-top: 0px;"><b>Tax</b></td>
                        <td style="background: #fff; color: #000;vertical-align: middle; position:relative;padding: 0.75rem;vertical-align: top;border-bottom: 1px solid #e8e8e8;border-top: 0px;" align="right">{{$data['tota']['tax_price']}} SAR</td>
                     </tr> 
                     <tr >
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>                          
                        <td style="background: #fff; color: #000;vertical-align: middle;padding: 0.75rem;vertical-align: top;border-bottom: 1px solid #e8e8e8;border-top: 0px;"><b>Commission</b></td>                           
                        <td style="background: #fff; color: #000;vertical-align: middle; position:relative;padding: 0.75rem;vertical-align: top;border-bottom: 1px solid #e8e8e8;border-top: 0px;" align="right">{{$data['tota']['commssion']}} SAR</td>
                     </tr>
                     @if($data['tota']['penaltiy_amount'])
                     <tr >
                        <td style="border: none;"></td>
                        <td style="border: none;"></td> 
                        <td style="background: #fff; color: #000;vertical-align: middle;padding: 0.75rem;vertical-align: top;border-bottom: 1px solid #e8e8e8;border-top: 0px;"><b>Penaltiy</b></td>
                        <td style="background: #fff; color: #000;vertical-align: middle; position:relative;padding: 0.75rem;vertical-align: top;border-bottom: 1px solid #e8e8e8;border-top: 0px;" align="right">{{$data['tota']['penaltiy_amount']}} SAR</td>
                     </tr>
                     @endif
                     <tr>
                        <td style="border: none; background: #fff; border-top: 1px solid #909090;border-bottom: 1px solid #909090;"></td>
                        <td style="border: none; background: #fff; border-top: 1px solid #909090;border-bottom: 1px solid #909090;"></td>
                        <td style="background: #fff;color: #000;vertical-align: middle;border-top: 1px solid #909090;border-bottom: 1px solid #909090;padding: 0.75rem;vertical-align: top;"><b>Total</b></td>
                        <td style="background: #fff;color: #000;vertical-align: middle;border-top: 1px solid #909090;border-bottom: 1px solid #909090; position:relative;padding: 0.75rem;vertical-align: top;" align="right">{{$data['tota']['booking_fee']}} SAR</td>
                     </tr>
                  </tbody>
               </table>         
            </div>
            <div class="footer" style="text-align:center;padding-bottom: 30px;">
               <p style="display: block; color: #111111;text-align: center;margin: 30px 0 15px;  text-transform: uppercase;line-height: 22px;">
                  <b>THANKS FOR YOUR BUSINESS!!</b>
                  <br>IF YOU HAVE ANY QUESTIONS, PLEASE DO GET IN TOUCH WITH US</p>
                  <p style="margin-bottom:0px;display: block;color: #111111;text-align: center;margin: 30px 0 15px;text-transform: uppercase;line-height: 22px;"><b>ARABAT</b>
                    <br> EMAIL/PHONE/WHAT'S APP</p>

                    <table style="margin-top: 10px;">
                     <tbody>
                        <tr style="background: transparent; margin-top:5px;">
                           <td  style="width:20%"></td>
                           <td style="width:13%"></td>
                           <td  style="width:2%">
                              <a href="#" class="footer-social-icons" style="position:relative;">
                                 <img src="https://web.arabat.sa/images/facebook-f.png" style="position: absolute; top:7px; left:7px;width: 50%;" alt="">
                              </a>

                           </td>
                           <td style="width:2%">
                              <a href="#" class="footer-social-icons" style="position:relative;">
                                 <img src="https://web.arabat.sa/images/instagram.png" style="position: absolute; top:7px; left:7px;width: 50%;" alt="">
                              </a>
                           </td>
                           <td style="width:2%">
                              <a href="#" class="footer-social-icons" style="position:relative;">
                                 <img src="https://web.arabat.sa/images/twitter.png" style="position: absolute; top:8px; left:8px;width: 50%;" alt="">
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