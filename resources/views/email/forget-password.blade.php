<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title> Reset Passsword</title>
    <meta name="description" content="Email verification template">
</head>

<body style="background-color: #e8e8e8;" cellpadding="0" cellspacing="0">
    <table align="center" cellspacing="0" border="0" cellpadding="0"
        style="
        width: 480px !important;
        height: 100%;
        background-color: #fff;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial,
          'Lucida Grande', sans-serif;
        font-size: 100%;
        line-height: 1.6;
      ">
        <tr>
            <td style="text-align: left; padding: 10px 10px">
                <a href="{{ $mailData['url'] ?? '' }}" title="logo" target="_blank">
                    <img width="120"
                        src="https://scontent.fktm17-1.fna.fbcdn.net/v/t39.30808-6/430096653_3577842379153568_2664720199021088549_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=efb6e6&_nc_ohc=HWQYIcqUuHgAX9Nk-5x&_nc_ht=scontent.fktm17-1.fna&oh=00_AfBVTmCxquwoJT9yxmrBCfwYRXDW59aa1-be0ugAMP6kWQ&oe=65E492F6"
                        title="logo" alt="logo" style="display: block; margin: 0 auto;" />
                </a>
            </td>
        </tr>

        <tr>
            <td style="padding: 20px 20px">
                <div style=" text-align: left; font-size: 13px; line-height: 1.4;">
                    <span style="font-weight: bold;">Dear </span><span> {{ $mailData['name'] ?? '' }},</span> <br><br>
                    <span> You can reset your password from this link. <br>
                        <a href="{{ route('user.resetPassword', ['token' => $mailData['token'] ?? '']) }}">Reset Password</a>
                </div>
            </td>
        </tr>
        <tr>
            <td align="center" style="background-color: #f3f6f9; padding: 20px 20px; ">
                <a href="https://www.facebook.com/profile.php?id=61556675918891" target="_blank"
                    style="margin: 0 5px; text-decoration: none">
                    <img width="26"
                        src="http://s3-ap-southeast-2.amazonaws.com/cdn.fxdms.net/images/qsuper/202010/502718d519b43fd89ef277f60a1c7854.png" />
                </a>
                <a href="https://www.instagram.com/" target="_blank" style="margin: 0 5px; text-decoration: none">
                    <img width="26"
                        src="http://s3-ap-southeast-2.amazonaws.com/cdn.fxdms.net/images/qsuper/202010/7767545634e584686793bdbbece763a5.png" />
                </a>
            </td>
        </tr>

    </table>
</body>

</html>
