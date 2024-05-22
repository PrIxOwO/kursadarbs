<!DOCTYPE html>
<html>
<head>
    <title>Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: rgb(14, 14, 21);
            color: white;
            font-size: 1.4rem;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .message {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .message .heading {
            font-weight: bold;
        }

        .message .content {
            margin-top: 5px;
        }

        .message .author {
            font-size: 12px;
            color: #999;
        }

        .mainHeader {
            background-color: #1DA1F2;
            height: 3rem;
            width: 100%;
            margin-bottom: 4rem;
        }

        a {
            color: white;
            text-decoration: none;
        }

        .customprimary{
            margin-top: 2rem;
            background-color: transparent;
            border: 1px solid #1DA1F2;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
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
    <div class="mainHeader">
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

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @foreach ($data ? [$data] : [] as $item)
    
    <div class="container">
        <div class="message">
        <div class="d-flex">
        <div class=" w-100"><div class="heading">{{ $item->heading }}</div></div>
        <div class="p-2 flex-shrink-1"><div class="author">{{ $item->user->name }}</div></div>
        </div>
           
            <div class="content">{{ $item->full_description }}</div>
            @if ($item->photos)
              <img src="{{ asset('uploads\inserts/' . $item->photos) }}" class="img-fluid" alt="Responsive image">
            @else
              <p>No image available !!!</p>
            @endif
            
           

            @if (Auth::check() && Auth::user()->id == $item->ID_user)
                <form action="{{ route('delete.post', $item->ID) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="customDelButton">Delete</button>
                </form>
            @endif


            <form class="mt-3 mb-3" action="/comments/{{ $item->ID }}" enctype="multipart/form-data" method="POST">

                @csrf
                <input type="hidden" name="post_id" value="{{ $item->ID }}">
                <input type="hidden" name="inserter_id" value="{{ auth()->user()->id }}">

                <div class="form-group">
                    <textarea class="form-control" name="coment" rows="3" placeholder="Add your coment"></textarea>
                </div>
                <button type="submit" class="customprimary">Submit</button>
            </form>




        </div>
    </div>
@endforeach

    @foreach ($data2 as $coment)
    @if ($coment->post_id == $item->ID)
        <div class="container">
            <div class="message mb-0">
                <div class="content mb-0">{{ $coment->coment }}</div>
                <div class="author mb-0">{{ $coment->user->name }}</div>
            </div>
            @if (Auth::check() && Auth::user()->id == $coment->inserter_id)
                    <form action="{{ route('delete.comment', $coment->ID) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="customDelButton">Delete</button>
                    </form>
                @endif
        </div>
        
    @endif
    
@endforeach

</body>
</html>
