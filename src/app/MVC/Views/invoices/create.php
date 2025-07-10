<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="/invoices/create">
                <label for="amount">Amount:</label>
                <input type="number" name="amount" id="amount">
                <br>
                <label for="description">Description:</label>
                <input type="text" name="description" id="description">
                <br>
                <button type="submit">Create Invoice</button>
            </form>
</body>
</html>