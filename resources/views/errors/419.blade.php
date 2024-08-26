// resources/views/errors/419.blade.php

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Expired</title>
    <style>
        body {
            background-color: #181915;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        img {
            max-width: 80%;
            height: auto;
        }
    </style>
</head>
<body>
    <img src="{{ asset('419.png') }}" alt="Page Expired">
</body>
</html>
