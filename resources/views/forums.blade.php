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

        .container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 20px;
        }

        .mesage {
            padding: 10px;
            margin-bottom: 10px;
        }

        .mesage .heding {
            font-weight: bold;
        }

        .mesage .content {
            margin-top: 5px;
        }

        .mesage .author {
            font-size: 12px;
            color: #999;
        }

        .mainHeder {
            background-color: #1DA1F2;
            height: 3rem;
            width: 100%;
            margin-bottom: 4rem;
        }

        a {
            color: white;
            text-decoration: none;
        }

        .addPostButton {
            margin-bottom: 1rem;
        }

        .addPostButton a {
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border: solid 1px #1DA1F2;
        }

        .addPostButton a:hover {
            background-color: #1DA1F2;
        }

        .cardButton {
            border: solid 1px #ccc;
            color: white;
            margin: 0;
            background-color: transparent;
            text-align: left;
            cursor: pointer;
            width: 100%;
        }

        .customDelButton {
            background-color: #510000;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="mainHeder">
        <div class="d-flex mb-3 mx-5">
            <a class="p-2" href="/">Home</a>
            <a class="p-2" href="/forms">Forms</a>
            @if (Auth::check())
            <a class="ms-auto p-2" href="/profile">{{ Auth::user()->name }}</a>
            @else
            <a class="ms-auto p-2" href="/login">Log In</a>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="addPostButton">
            <a href="/edit">Add Post</a>
        </div>
    </div>
    
    @foreach($data as $item)
    <div class="container">
        <button class="cardButton" onclick="window.location.href='{{ url('/comments/' . $item->ID) }}'">
            <div class="mesage">
                <div class="heding">{{ $item->heading }}</div>
                <div class="content">{{ \Illuminate\Support\Str::limit($item->full_description, 500, '...') }}</div>
                <div class="author">{{ $item->user_name }}</div>
                @if (Auth::check() && Auth::user()->id == $item->ID_user)
                <form action="{{ route('delete.post', $item->data_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="customDelButton">Delete</button>
                </form>
                @endif
            </div>
        </button>
    </div>
    @endforeach
</body>

</html>
