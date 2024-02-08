<!doctype html>
<html lang="en">
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <meta content="width=device-width" name="viewport"/>
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
    <title>Email Template</title>
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet" type="text/css"/>
    <style type="text/css">
      body { margin: 0; padding: 0; }
      table, td, tr { vertical-align: top; border-collapse: collapse; }
      * { line-height: inherit; }
      a[x-apple-data-detectors=true] { color: inherit !important; text-decoration: none !important; }
    </style>
    <style id="media-query" type="text/css">
      @media (max-width: 620px) {
        .block-grid, .col { min-width: 320px !important; max-width: 100% !important; display: block !important; }
        .block-grid { width: 100% !important; }
        .col { width: 100% !important; }
        .col_cont { margin: 0 auto; }
        img.fullwidth, img.fullwidthOnMobile { max-width: 100% !important; }
        .no-stack .col { min-width: 0 !important; display: table-cell !important; }
        .no-stack.two-up .col { width: 50% !important; }
        .no-stack .col.num2 { width: 16.6% !important; }
        .no-stack .col.num3 { width: 25% !important; }
        .no-stack .col.num4 { width: 33% !important; }
        .no-stack .col.num5 { width: 41.6% !important; }
        .no-stack .col.num6 { width: 50% !important; }
        .no-stack .col.num7 { width: 58.3% !important; }
        .no-stack .col.num8 { width: 66.6% !important; }
        .no-stack .col.num9 { width: 75% !important; }
        .no-stack .col.num10 { width: 83.3% !important; }
        .video-block { max-width: none !important; }
        .mobile_hide { min-height: 0px; max-height: 0px; max-width: 0px; display: none; overflow: hidden; font-size: 0px; }
        .desktop_hide { display: block !important; max-height: none !important; }
      }
    </style>
    <style id="icon-media-query" type="text/css">
      @media (max-width: 620px) {
        .icons-inner { text-align: left; }
        .icons-inner td { margin: 0 auto; }
      }
    </style>
  </head>
  <body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #ffffff;">
    <table bgcolor="#ffffff" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%; height: 100vh;" valign="top" width="100%">
        <tbody>
          <tr style="vertical-align: top;" valign="">
              <td style="word-break: break-word;" valign="top">
                
                <div style="background-color:transparent;">
                    <div class="block-grid" style="min-width: 320px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
                      <div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
                          <div class="col num12" style="min-width: 320px; display: table-cell; vertical-align: top; width: 600px;">
                            <div class="col_cont" style="width:100% !important;">
                                <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:35px; padding-bottom:0px; padding-right: 10px; padding-left: 10px;">
                                  <div style="color:#1f2936;font-family:'Ubuntu', Tahoma, Verdana, Segoe, sans-serif;line-height:1.2;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                                      <div class="txtTinyMce-wrapper" style="line-height: 1.2; font-size: 12px; font-family: 'Ubuntu', Tahoma, Verdana, Segoe, sans-serif; color: #1f2936; mso-line-height-alt: 14px;">
                                        <p style="font-size: 46px; line-height: 1.2; word-break: break-word; text-align: left; font-family: Ubuntu, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 55px; margin: 0;"><span style="font-size: 20px;"><strong>Hello! {{ $username }},</strong></span></p>
                                      </div>
                                  </div>
                                  <div style="color:#343d49;font-family:Rubik, Trebuchet MS, Helvetica, sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                                      <div class="txtTinyMce-wrapper" style="line-height: 1.5; color: #343d49; font-family: Rubik, Trebuchet MS, Helvetica, sans-serif; mso-line-height-alt: 18px;font-size: 14px;">
                                        <p style="font-size: 14px; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 21px; margin: 0;">{!! $msg !!}</p>
                                      </div>
                                  </div>
                                  
                                  <div style="color:#343d49;font-family:Rubik, Trebuchet MS, Helvetica, sans-serif;line-height:1.5;padding-top:10px;padding-right:20px;padding-bottom:20px;padding-left:14px;">
                                      <div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 14px; color: #343d49; font-family: Rubik, Trebuchet MS, Helvetica, sans-serif; mso-line-height-alt: 18px;font-weight: 600;">
                                        <!-- <p style="text-align: left; line-height: 1.5; word-break: break-word; font-size: 14px; mso-line-height-alt: 21px; margin: 0;"><span style="font-size: 14px;">Thank you for using our application!</span></p>
                                        <p style="text-align: left; line-height: 1.5; word-break: break-word; font-size: 14px; mso-line-height-alt: 21px; margin: 0;"><span style="font-size: 14px;">Regards,</span><br/><span style="font-size: 14px;">Team Doroosi </span></p> -->

                                        <p style="text-align: left; line-height: 1.5; word-break: break-word; font-size: 14px; mso-line-height-alt: 21px; margin: 0;">{!! $signature !!}</p>

                                      </div>
                                  </div>
                                </div>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
                <div style="background-color:transparent;">
                    <div class="block-grid" style="min-width: 320px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
                      <div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
                          <div class="col num12" style="min-width: 320px; display: table-cell; vertical-align: top; width: 600px;">
                            <div class="col_cont" style="width:100% !important;">
                                <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                                  <div class="mobile_hide">
                                      <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
                                        <tbody>
                                            <tr style="vertical-align: top;" valign="top">
                                              <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;" valign="top">
                                                  <table align="left" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 1px solid #E0E0E0; width: 90%;" valign="top" width="90%">
                                                    <tbody>
                                                        <tr style="vertical-align: top;" valign="top">
                                                          <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
                                                        </tr>
                                                    </tbody>
                                                  </table>
                                              </td>
                                            </tr>
                                        </tbody>
                                      </table>
                                  </div>
                                </div>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
                
                <div style="background-color:transparent;">
                    <div class="block-grid" style="min-width: 320px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #fbfbfb;">
                      <div style="border-collapse: collapse;display: table;width: 100%;background-color:#fbfbfb;">
                          <div class="col num12" style="min-width: 320px; display: table-cell; vertical-align: top; width: 600px;">
                            <div class="col_cont" style="width:100% !important;">
                                <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:10px; padding-right: 0px; padding-left: 0px;">
                                  <div style="color:#343d49;font-family:Rubik, Trebuchet MS, Helvetica, sans-serif;line-height:1.5;padding-top:0px;padding-right:10px;padding-bottom:00px;padding-left:10px;">
                                      <div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #343d49; font-family: Rubik, Trebuchet MS, Helvetica, sans-serif; mso-line-height-alt: 18px;">
                                        <p style="font-size: 12px; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 18px; margin: 0;"><span style="font-size: 12px;">Copyright © 2022 Arabat</span></p>
                                      </div>
                                  </div>
                                </div>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
              </td>
          </tr>
        </tbody>
    </table>
  </body>
</html>