<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .button-container {
            text-align: center;
        }
        .btn-custom {
            margin: 10px;
            padding: 15px 30px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-login {
            background-color: #007bff;
        }
        .btn-login:hover {
            background-color: #0056b3;
        }
        .btn-register {
            background-color: #28a745;
        }
        .btn-register:hover {
            background-color: #1e7e34;
        }
    </style>
</head>
<body>
    <div class="button-container">
        <a href="{{ route('login') }}" class="btn btn-custom btn-login">Login</a>
        <a href="{{ route('register') }}" class="btn btn-custom btn-register">Register</a>
    </div>
</body>
</html>
