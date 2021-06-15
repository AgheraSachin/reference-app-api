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
            <p style="font-size: 20px; color: #4A5566; margin-bottom: 30px;">Hi {{explode("@",$sent_to_email)[0]}} 🔑
                <br><br/>Your colleague <b>{{$user['first_name']}} {{$user['last_name']}}</b> has requested a work review
                from you! Please click below to complete the review and send it back
                to {{$user['first_name']}} {{$user['last_name']}}. Have a wonderful day!</p>
            <a href="https://reference.app/submit-ratings?token={{$token}}" target="_blank"
               style="max-width: 290px;width: 100%;display: block;color: #fff;height: 56px;background: #0052E2;border-radius: 6px;font-weight: bold;text-align: center;vertical-align: middle;text-decoration: none;line-height: 56px">Click
                to Review</a>
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
