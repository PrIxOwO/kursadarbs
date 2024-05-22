<head>
    <title>add</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: rgb(14, 14, 21);
            color: white;
            font-size: 1.4rem;
        }

        .container {
            max-width: 600px;
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


        form {
            margin: 0 auto;
            width: 50%;
            padding: 1em;
        }

        label {
            display: block;
            margin-bottom: 0.5em;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 0.5em;
        }

        input[type="submit"] {
            padding: 0.5em 1em;
            margin-top: 1em;
        }
    </style>
</head>
<body>


<form method="POST" action="/edit" enctype="multipart/form-data">
    @csrf

    <label for="heading">Heading:</label>
    <input type="text" id="heading" name="heading"><br>

    <label for="full_description">Description:</label>
    <textarea id="full_description" name="full_description"></textarea><br>

    <label for="photos">Photos:</label>
    <input type="file" id="photos" name="photos"><br>

    <input type="hidden" name="ID_user" value="{{ auth()->user()->id }}">

    <input type="submit" value="Submit">
</form>
</body>