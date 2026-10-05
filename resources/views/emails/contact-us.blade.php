<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We’ve Received Your Inquiry – Abyzone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f7;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 700px;
            margin: 0px;
            background-color: #ffffff;
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333333;
            border-bottom: 2px solid #f4f4f4;
            padding-bottom: 10px;
        }
        p {
            font-size: 16px;
            color: #555555;
            line-height: 1.6;
        }
        .label {
            font-weight: bold;
            color: #333333;
        }
        .footer {
            margin-top: 30px;
            font-size: 13px;
            color: #888888;
            text-align: center;
        }
        a {
            color: #1a73e8;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Hello {{ $contact->name }},</h2>

        <p>Thank you for reaching out to <strong>Abyzone</strong>.<br>
        We appreciate your interest and have successfully received your inquiry.</p>

        <p>Our team is currently reviewing the details you shared and will get back to you within <strong>24–48 business hours</strong>.</p>

        <h3>Your Submitted Details:</h3>
        <p><span class="label">Name:</span> {{ $contact->name }}</p>
        <p><span class="label">Email:</span> {{ $contact->email }}</p>
        <p><span class="label">Phone:</span> {{ $contact->phone }}</p>
        <p><span class="label">Message:</span> {{ $contact->message }}</p>

        <p>If you have any additional information to share, feel free to reply to this email or contact us directly.</p>

        <p>We look forward to connecting with you soon.</p>

        <p>Warm Regards,<br>
        Team Abyzone<br>
        <a href="https://www.abyzone.com">www.abyzone.com</a><br>
        <a href="mailto:connect@abyzone.com">connect@abyzone.com</a></p>

        <div class="footer">
            ABYzone © 2025. All rights reserved.
        </div>
    </div>
</body>
</html>
