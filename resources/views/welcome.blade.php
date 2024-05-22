<!DOCTYPE html>
<html>
<head>
    <title>Forms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: rgb(14, 14, 21);
            color: white;
            font-size: 1.4rem;
        }


        .mainHeder{
            background-color: #1DA1F2;
            height: 3rem;
            width: 100%;
            margin-bottom: 4rem;
        }
        a{
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
<body></body>

<div class="mainHeder">
    <div class="d-flex mb-3 mx-5">
        <a class="p-2">Home</a>
        <a class="p-2" href="/forms">Forms</a>
        @if (Auth::check())
            <a class="ms-auto p-2" href="/profile">{{ Auth::user()->name }}</a>
        @else
            <a class="ms-auto p-2" href="/login">Log In</a>
        @endif
    </div>
</div>

<div class="d-flex justify-content-center"><h1>Yo this is a form website</h1></div>
<div class="d-flex justify-content-center"><h1>...</h1></div>

 
</body>
</html>