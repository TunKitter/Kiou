<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Mã xác nhận</h1>
    @if(session('send_code'))
        <div class="">
            {{ session('send_code') }}
        </div>
    @endif
</body>
</html>