<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            margin-bottom: 20px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registration Confirmation</h1>
        <p>Dear {{ $user->first_name }},</p>
        <p>Thank you for registering with us!</p>
        <table>
            <tr>
                <th>First Name:</th>
                <td>{{ $user->first_name }}</td>
            </tr>
            <tr>
                <th>Last Name:</th>
                <td>{{ $user->last_name }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Username:</th>
                <td>{{ $user->username }}</td>
            </tr>
            <!-- Add more user data fields here as needed -->
        </table>
        <p>If you have any questions or concerns, please don't hesitate to contact us.</p>
        <div class="footer">
            <p>This email confirms your registration with our service. If you received this email by mistake, please ignore it.</p>
            <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
