<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <title>Reference.app</title>

    <style>
        img {
            vertical-align: bottom;
            max-width: 100%;
        }

        p {
            margin: 0;
            padding: 0;
        }

        td {
            vertical-align: top;
        }
    </style>
</head>
<body
    style="line-height: 1.25; margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; font-size: 16px; color:#8492A6;">
<table width="600" cellpadding="0" cellspacing="0" align="center" style="background:#fff">
    <tr>
        <td width="20">
            <div style="height: 30px"></div>
        </td>
        <td width="560">
            <div style="height: 30px"></div>
        </td>
        <td width="20">
            <div style="height: 30px"></div>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <a href="https://reference.app" target="_blank"><img src="{{asset('img/logo.svg')}}" alt=""></a>
            <div style="height: 20px"></div>
            <p style="font-size: 20px; color: #4A5566; margin-bottom: 10px;">Welcome {{$first_name}} {{$last_name}} 👋
                <br><br/>Thanks for signing up! We hope you enjoy using the Reference App.</p>
            <p>You can use your email address {{$email}} with the password below to login to your account. Or you can
                always choose to login via LinkedIn to access your account.</p>
            <p style="margin-bottom: 20px;color: #1C222C">Password: <b>{{$password}}</b></p>
            <a href="https://reference.app/auth/login" target="_blank"
               style="max-width: 290px;width: 100%;display: block;color: #fff;height: 56px;background: #0052E2;border-radius: 6px;font-weight: bold;text-align: center;vertical-align: middle;text-decoration: none;line-height: 56px">Sign
                in to your account</a>
            <div style="height: 20px"></div>
            <p>If you did not sign up for this account you can ignore this email and the account will be deleted
                automatically after 5 days.</p>
        </td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td style="font-size: 12px">
            <div style="height: 50px"></div>
            <hr style="margin: 0; border: none; height: 1px; background: #EDEDF2">
            <div style="height: 30px"></div>
            <p>This email was sent to you as a registered member of <a href="https://reference.app" target="_blank"
                                                                       style="color: #0052E2">reference.app</a>. To
                update your emails subscription preferences <a href="https://reference.app" target="_blank"
                                                               style="color: #0052E2">click here</a>. Use of the service
                and website is subject to our <a href="https://reference.app/terms-of-use" target="_blank"
                                                 style="color: #0052E2">Terms of Use</a> and <a
                    href="https://reference.app/privacy-policy" target="_blank" style="color: #0052E2">Privacy
                    Statement</a>.</p>
            <div style="height: 15px"></div>
            <p>© 2021 ReferenceApp. All rights reserved</p>
        </td>
        <td></td>
    </tr>
</table>
</body>
</html>
