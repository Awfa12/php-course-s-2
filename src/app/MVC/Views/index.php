<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="/upload" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="file" name="receipt" />
    <br>
    <button type="submit">Submit</button>

    <br>
    <br>

    <hr>

    <div>
        <?php if (! empty($invoice)): ?>
            HI<br>
            Invoice ID: <?= htmlspecialchars($invoice['id'], ENT_QUOTES) ?><br>
            Invoice Amount: <?= htmlspecialchars($invoice['amount'], ENT_QUOTES) ?><br>
            User: <?= htmlspecialchars($invoice['full_name'], ENT_QUOTES) ?><br>
        <?php endif ?>
    </div>
</form>
</body>
</html>