<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle demande de rendez-vous</title>
</head>
<body>
    <h1>Nouvelle demande de rendez-vous</h1>
    <p>Bonjour Admin,</p>
    <p>Une nouvelle demande de rendez-vous a été reçue. Voici les détails du client :</p>
    <p>
        <strong>Nom complet:</strong> {{ $appointment->name }} <br>
        <strong>Email :</strong> <a href="mailto:{{ $appointment->email }}">{{ $appointment->email }}</a> <br>
        <strong>Téléphone:</strong> <a href="tel:{{ $appointment->phone }}">{{ $appointment->phone }}</a> <br>
        <strong>Commune:</strong> {{ $appointment->city->fr_name }} <br>
        <strong>Wilaya:</strong> {{ $appointment->city->state->fr_name }} <br>
        <strong>Nombre de fenetere:</strong> {{ $appointment->windows }} <br>
        <strong>Date de RDV :</strong> {{ $appointment->formatted_client_date }} <br>
    </p>
    <p>Vous pouvez contacter le client pour confirmer ou modifier le rendez-vous si nécessaire.</p>
    <p>Merci de vérifier cette demande dès que possible.</p>
    <p>Cordialement, <br>
    Chaima Rideaux</p>
</body>
</html>
