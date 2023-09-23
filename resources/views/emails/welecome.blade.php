<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <style>
        .btn-genix {
            background-color: #1d345e !important;
            color: white !important;
        }

        .btn-genix:hover {
            background-color: #0c2e6d !important;
        }
    </style>
</head>

<body class=""
    style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <table border="0" cellpadding="0" cellspacing="0" class="body"
        style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
        <tr>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
            <td class="container"
                style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
                <div class="content"
                    style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">
                    <center>
                        <img src="{{ asset('images/logo-black.png') }}" alt="{{ config('app.name') }}" width="200">
                    </center>

                    <table class="main"
                        style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">
                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class="wrapper"
                                style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                                <table border="0" cellpadding="0" cellspacing="0"
                                    style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                    <center>
                                        <img src="{{ asset('images/logo-black.png') }}" alt="{{ config('app.name') }}"
                                            width="200">
                                    </center>
                                    <tr>
                                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                                            <p
                                                style="font-family: sans-serif; font-size: 14px; font-weight: 600; margin: 0; Margin-bottom: 15px; margin-top:20px; text-align:center;">
                                                {{ __('Dear') }} {{ auth()->user()->name }}</p>
                                            <p
                                                style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">
                                                {{ __('Thank you for joining ') }}
                                                {{ setting('app_name') }}{{ __(', We are happy to have you on board our ship. We just wanted to send you some information to help you get started.') }}
                                            </p>
                                            <div
                                                style="font-family: sans-serif; font-size: 14px; margin-bottom: 25px; margin-top: 20px; text-align:center;">
                                                <p
                                                    style="font-family: sans-serif; font-size: 16px; font-weight: 600; margin: 0; Margin-bottom: 20px; text-align:center;">
                                                    {{ __('Login Information') }}
                                                </p>
                                                <div style="display:flex; align-items:center; justify-content: center;">
                                                    <span>{{ __('Sign In to your') }}<br>{{ setting('app_name') }}
                                                        {{ __('account') }}</span>
                                                    <a href="{{ route('company.dashboard') }}" class="btn-genix"
                                                        style="margin-left: 15px; padding:8px 40px; border:none; border-radius:5px;text-decoration:none;">Login</a>
                                                </div>

                                                <div
                                                    style="display:flex; align-items:center; justify-content: center; margin-top:10px;">
                                                    <span>{{ __('Sign In to your') }}<br>
                                                        {{ __('Dashboard account') }}</span>
                                                    <a href="http://dashboard.smartgenix.co.uk/" class="btn-genix"
                                                        style="margin-left: 23px; padding:8px 40px; border:none; border-radius:5px;text-decoration:none;">Login</a>
                                                </div>
                                            </div>
                                            <p>{{ __('If you need help with anything just send us an email and we can help you or go to your ') }}
                                                {{ setting('app_name') }}
                                                {{ __(' account and then create support tickets.') }}
                                            </p>
                                            <p
                                                style="font-family: sans-serif; font-size: 16px; font-weight: 600; margin: 0; Margin-bottom: 15px; text-align:center;">
                                                {{ __('Start recording!') }}
                                            </p>
                                            <p
                                                style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 7px;">
                                                {{ __('Your faithfully') }}</p>
                                            <p
                                                style="font-family: sans-serif; font-size: 14px; font-weight: 600; margin: 0; Margin-bottom: 2px;">
                                                Mr. M Asim</p>
                                            <p
                                                style="font-family: sans-serif; font-size: 14px; font-weight: 600; margin: 0; Margin-bottom: 15px;">
                                                Founder</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- END MAIN CONTENT AREA -->
                    </table>

                    <!-- START FOOTER -->
                    <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
                        <table border="0" cellpadding="0" cellspacing="0"
                            style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                            <tr>
                                <td class="content-block powered-by"
                                    style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                                    Powered by <a href="{{ url('/') }}"
                                        style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;">{{ setting('app_name') }}</a>.
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- END FOOTER -->

                    <!-- END CENTERED WHITE CONTAINER -->
                </div>
            </td>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
        </tr>
    </table>
</body>

</html>
