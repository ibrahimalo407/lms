<!DOCTYPE html>
<html>
<head>
    <title>Meeting Invitation</title>
</head>
<body>
    <h1>Meeting Invitation</h1>
    <p>You have been invited to a meeting: {{ $meeting->roomName }}</p>
    <p>Join the meeting using the following link: <a href="{{ $meeting->roomUrl }}">{{ $meeting->roomUrl }}</a></p>
</body>
</html>
