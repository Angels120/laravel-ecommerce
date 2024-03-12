<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Email</title>
    <style>
        body {
            background-color: #e8e8e8;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, 'Lucida Grande', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 480px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo {
            margin-bottom: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .contact-info {
            margin-bottom: 20px;
        }

        .contact-info p {
            margin: 5px 0;
        }

        .social-media {
            text-align: center;
            margin-top: 20px;
        }

        .social-media a {
            margin: 0 5px;
            text-decoration: none;
        }

        .social-media img {
            width: 26px;
            height: 26px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="https://scontent.fktm17-1.fna.fbcdn.net/v/t39.30808-6/430096653_3577842379153568_2664720199021088549_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=5f2048&_nc_ohc=MGstW9pUMeYAX81uxme&_nc_ht=scontent.fktm17-1.fna&oh=00_AfBHO5G9O0jsikAqk-AnRQfW9SM3cQ75F_hWOhkX_O43Hw&oe=65F464F6"
                height="40px" width="40px" alt="logo">
        </div>

        <h1>You have received a contact email</h1>

        <div class="contact-info">
            <b>From:</b>
            <p>Name: {{ $mailData['name'] ?? '' }}</p>
            <p>Email: {{ $mailData['email'] ?? '' }}</p>
            <p>Subject: {{ $mailData['subject'] ?? '' }}</p>
            <p>Message:</p>
            <p>{{ $mailData['message'] ?? '' }}</p>
        </div>

        <div class="social-media">
            <a href="https://www.facebook.com/profile.php?id=61556675918891" target="_blank">
                <img src="http://s3-ap-southeast-2.amazonaws.com/cdn.fxdms.net/images/qsuper/202010/502718d519b43fd89ef277f60a1c7854.png" alt="Facebook">
            </a>
            <a href="https://www.instagram.com/" target="_blank">
                <img src="http://s3-ap-southeast-2.amazonaws.com/cdn.fxdms.net/images/qsuper/202010/7767545634e584686793bdbbece763a5.png" alt="Instagram">
            </a>
        </div>
    </div>

</body>

</html>
