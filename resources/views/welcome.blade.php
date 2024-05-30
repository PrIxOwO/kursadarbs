<!DOCTYPE html>
<html>
<head>
    <title>Forms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="mainHeder">
        <div class="d-flex mb-3 mx-5">
            <a class="p-2" href="/">Home</a>
            <a class="p-2" href="/forms">Forms</a>
            <form class="ms-auto p-2" action="/search" method="GET">
                <input class="serchBox" type="text" name="query" placeholder="Search">
                <button class="serchBox" type="submit">Search</button>
            </form>
            <!-- atkarībā vai ir lietotājs parāda vainu log out vai log in / register -->
            @if (Auth::check())
            <form class="ms-auto p-1" action="/logout" method="POST">
                @csrf
                <button class="ms-auto customLogOut" type="submit">Log Out</button>
            </form>
            @else
            <div class="mt-2">
                <a class="ms-auto p-2" href="/login">Log In</a>
                <a class="ms-auto p-2" href="/register">Register</a>
            </div>

            @endif
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <h1>Yo this is a form website</h1>
    </div>
    <div class="d-flex justify-content-center">
        <h1>...</h1>
    </div>
</body>
</html>