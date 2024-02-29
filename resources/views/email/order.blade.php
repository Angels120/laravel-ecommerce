<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title> Order Mail</title>
    <meta name="description" content="Order Mail template">
</head>

<body style="background-color: #e8e8e8; font-size: 16px;" cellpadding="0" cellspacing="0">

    <table align="center" cellspacing="3" border="0" cellpadding="3"
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
            <td style="text-align: center; padding: 10px;">
                <a href="{{ $mailData['url'] ?? '' }}" title="WebMart Logo" target="_blank">
                    <img width="120"
                        src="https://scontent.fktm17-1.fna.fbcdn.net/v/t39.30808-6/430096653_3577842379153568_2664720199021088549_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=efb6e6&_nc_ohc=HWQYIcqUuHgAX9Nk-5x&_nc_ht=scontent.fktm17-1.fna&oh=00_AfBVTmCxquwoJT9yxmrBCfwYRXDW59aa1-be0ugAMP6kWQ&oe=65E492F6"
                        title="logo" alt="logo" style="display: block; margin: 0 auto;" />
                </a>
            </td>
        </tr>

        <tr>
            <td style="padding: 20px 20px">
                <div style=" text-align: left; font-size: 13px; line-height: 1.4;">
                    Dear<span style="font-weight: bold;"> {{ $mailData['order']->full_name ?? '' }},</span> <br><br>
                    @if ($mailData['userType'] == 'customer')
                        <span >Thanks For Your Order</span><br>
                        <span style="font-weight: bold; color: 	#198754">Your Order is placed successfully</span>
                        <br><br>
                        Your Order Id: <span style="font-weight: bold;">#{{ $mailData['order']->id ?? '' }}</span>
                        <br><br>
                    @else
                        <span>You have recived an order</span>
                        <br><br>
                        Id: <span style="font-weight: bold;">#{{ $mailData['order']->id ?? '' }}</span>
                        <br><br>
                    @endif
                    <span> Your Products:
                        <br>
                        <table align="center" cellspacing="0" border="0" cellpadding="0"
                            style="width: 480px !important; height: 100%; background-color: #fff; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, 'Lucida Grande', sans-serif; font-size: 100%; line-height: 1.6; border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th style="background-color: #38414b76; border: 1px solid #38414b76; padding: 8px;">
                                        Product</th>
                                    <th style="background-color: #38414b76; border: 1px solid #38414b76; padding: 8px;">
                                        Price</th>
                                    <th style="background-color: #38414b76; border: 1px solid #38414b76; padding: 8px;">
                                        Qty</th>
                                    <th style="background-color: #38414b76; border: 1px solid #38414b76; padding: 8px;">
                                        Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mailData['order']->items as $item)
                                    <tr>
                                        <td style="border: 1px solid #38414b76; padding: 8px;">{{ $item->name }}</td>
                                        <td style="border: 1px solid #38414b76; padding: 8px;">Rs.
                                            {{ number_format($item->price, 2) }}</td>
                                        <td style="border: 1px solid #38414b76; padding: 8px;">{{ $item->qty }}</td>
                                        <td style="border: 1px solid #38414b76; padding: 8px;">Rs.
                                            {{ number_format($item->total, 2) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3"
                                        style="border: 1px solid #38414b76; padding: 8px; text-align: right;">
                                        <strong>SubTotal:</strong>
                                    </td>
                                    <td style="border: 1px solid #38414b76; padding: 8px;">Rs.
                                        {{ number_format($mailData['order']->subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"
                                        style="border: 1px solid #38414b76; padding: 8px; text-align: right;">
                                        <strong>Discount:{{ !empty($mailData['order']->coupon_code) ? '(' . $mailData['order']->coupon_code . ')' : '' }}</strong>
                                    </td>
                                    <td style="border: 1px solid #38414b76; padding: 8px;">Rs.
                                        {{ number_format($mailData['order']->discount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"
                                        style="border: 1px solid #38414b76; padding: 8px; text-align: right;">
                                        <strong>Shipping:</strong>
                                    </td>
                                    <td style="border: 1px solid #38414b76; padding: 8px;">Rs.
                                        {{ number_format($mailData['order']->shipping, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"
                                        style="border: 1px solid #38414b76; padding: 8px; text-align: right;">
                                        <strong>Grand Total:</strong>
                                    </td>
                                    <td style="border: 1px solid #38414b76; padding: 8px;">Rs.
                                        {{ number_format($mailData['order']->grand_total, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </span><br>
                    <span> {{ $mailData['message'] ?? '' }} </span><br><br>

                    <p style=" font-weight: ; font-size:13px; "> Do you want to Shop More <a
                            href="{{ $mailData['url'] ?? '' }}" style="font-weight: bold;">WebMart</a>.</p>

                </div>
                <p style=" font-size: 13px; line-height: 1.4;">
                    <span style="font-weight: bold;">Got a question or want to get in touch?</span><br />
                    <a href="https://google.com/" target="_blank" style="font-style: italic; color: #000000;">Get in
                        touch with us here</a>
                    <br /><br />
                    <span>Kind Regards,</span> <br />
                    <span>The WebMart Team</span>
                </p>
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
