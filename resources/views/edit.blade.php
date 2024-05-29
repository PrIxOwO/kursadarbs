<!DOCTYPE html>
<html>

<head>
    <title>Add</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/edit.css" rel="stylesheet">
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