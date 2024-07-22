<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration Confirmation</title>
</head>
<body>
    <h1>Account Created Successfully</h1>
    <p>Hello {{ $username }},</p>
    <p>Your account has been successfully created with the following details:</p>
    <ul>
        <li>Email: {{ $email }}</li>
        <li>Password: {{ $password }}</li>
    </ul>
    <p>Thank you for registering!</p>
</body>
</html>
