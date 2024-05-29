<!DOCTYPE html>
<html>

<head>
    <title>Add</title>
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

        a:hover {
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

        .char-count {
            font-size: 0.9rem;
            color: #999;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="mainHeader">
        <div class="d-flex mb-3 mx-5">
            <a class="p-2" href="/">Home</a>
            <a class="p-2" href="/forms">Forms</a>
        </div>
    </div>

    <form method="POST" action="/edit" enctype="multipart/form-data">
        @csrf

        <label for="heading">Heading:</label>
        <input type="text" id="heading" name="heading" maxlength="250" oninput="updateCharCount()"><br>
        <div class="char-count" id="headingCharCount">250 characters remaining</div>

        <label for="full_description">Description:</label>
        <textarea id="full_description" name="full_description"></textarea><br>

        <label for="photos">Photos:</label>
        <input type="file" id="photos" name="photos"><br>

        <input type="hidden" name="ID_user" value="{{ auth()->user()->id }}">

        <input type="submit" value="Submit">
    </form>

    <script>
        function updateCharCount() {
            const headingInput = document.getElementById('heading');
            const charCount = document.getElementById('headingCharCount');
            const remaining = 250 - headingInput.value.length;
            charCount.textContent = `${remaining} characters remaining`;
        }
    </script>
</body>

</html>
