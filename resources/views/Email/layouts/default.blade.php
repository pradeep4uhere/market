<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; color: #74787E; height: 100%; hyphens: auto; line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;">
    <style>
        @media  only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media  only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>



<table class="content" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #78a206; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
<tr>
<!-- <td><img src="{{env('APP_URL')}}/public/theme/prssystem/img/front/rsz_go4shoponline.jpg" alt="Image" style="width:65px;"></td> -->
<td style="width:10%;text-align:left; padding: 5px 0px 0px 5px;">
    <img src="http://www.go4shop.online/public/theme/prssystem/img/front/rsz_go4shoponline.jpg" alt="Image" style="width:65px; border-radius: 50%">
</td>
<td class="header"  style=" width:90%; text-align:left; font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 0px; text-align: center;">
    <a href="{{env('APP_URL')}}" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #FFF; font-size: 24px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;">
        {{env('APP_NAME')}}
    </a>
</td>
</tr>
</table>

<!-- BEGIN MAIN CONTENT -->
 @yield('content')
<!-- END MAIN CONTENT -->

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #FFF; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; color: #FFFFFF"><tr>
<td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0 auto; padding: 0; text-align: center; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;"><tr>
<td class="content-cell" align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding:10px;">
        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; line-height: 1.5em; margin-top: 0; color: #666; font-size: 12px; text-align: center;">2018-1019&nbsp; {{env('APP_URL')}}</p>
    </td>
</tr></table>
</td>
</tr>
</table>

</body>
</html>
