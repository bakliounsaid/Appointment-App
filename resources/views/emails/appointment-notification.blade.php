<!DOCTYPE html>
<html>
<head>
    <title>{{ __('Appointment Notification') }}</title>
</head>
<body>
    <h1>{{ __('Hello') }}, {{ $appointment->name }}</h1>
    <p>{{ __('We are writing to inform you about your upcoming appointment.') }}</p>
    <p>
        <strong>{{ __('Date') }}:</strong> {{ $appointment->formatted_admin_date }} <br>
    </p>
    <p>{{ __('Thank you for choosing our services!') }}</p>
    <p>{{ __('We look forward to seeing you soon!') }}</p>

    <p>{{ __('Best regards,') }}<br>
    {{ __('Chaima Rideaux') }}</p>
</body>
</html>
