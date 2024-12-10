<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 20px;
            color: #333333;
        }

        .content p {
            font-size: 16px;
            line-height: 1.5;
        }

        .content .password {
            font-size: 18px;
            font-weight: bold;
            color: #4e54c8;
            background-color: #f0f0ff;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
        }

        .footer {
            background-color: #f4f4f4;
            color: #777777;
            text-align: center;
            padding: 10px;
            font-size: 12px;
        }

        .footer a {
            color: #4e54c8;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>Password Reset Request</h1>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>You have requested to reset your password. Please find your new password below:</p>
            <p class="password">{{$new_password}}</p>
            <p>You can use this password to log in to your account. For security reasons, we recommend that you change
                your password after logging in.</p>
            <p>We hope this helps!</p>
        </div>
        <div class="footer">
            <p>Thank you,<br>The koi nahi Team</p>
            <p>If you didn’t request this password reset, please contact us immediately at <a
                    href="nahihoga@mail.com">nahihoga@mail.com</a>.</p>
        </div>
    </div>
</body>

</html>