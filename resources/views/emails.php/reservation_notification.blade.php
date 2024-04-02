<!DOCTYPE html>
<html>
<head>
    <title>New Reservation Notification</title>
</head>
<body>
    <h2>New Reservation Notification</h2>
    <p>Hello {{ $user->name }},</p>
    <p>A new reservation has been made at your store.</p>
    <p>You can view the reservation details <a href="{{ $reservationUrl }}">here</a>.</p>
    <p>Thank you for using our application!</p>
</body>
</html>