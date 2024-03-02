<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Due Notification</title>
</head>
<body>
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
        <h1 style="color: #333;">Task Due Notification</h1>
        <p>Hello {{ $user->name }},</p>
        <p>This is to inform you that you have a task titled "{{ $task->title }}" due on {{ $task->due_date }}.</p>
        <p>Please take necessary actions to complete the task on time.</p>
        <p>Best regards,</p>
        <p>Your Company</p>
    </div>
</body>
</html>
