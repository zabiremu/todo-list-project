<!DOCTYPE html>
<html>

<head>
    <title>Todo Reminder</title>
</head>

<body>
    <h1>Reminder: {{ $todo->title }}</h1>
    <p>Your todo item is due soon!</p>

    <h2>Todo Details:</h2>
    <p><strong>Title:</strong> {{ $todo->title }}</p>
    <p><strong>Description:</strong> {{ $todo->description }}</p>
    <p><strong>Due Date:</strong> {{ $todo->due_date->format('Y-m-d H:i') }}</p>

    <p>Please find attached the requested data in CSV format.</p>

    <p>Thank you,<br>Todo App Team</p>
</body>

</html>
