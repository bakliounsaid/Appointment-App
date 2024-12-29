<!DOCTYPE html>
<html>
<head>
    <title>Rendez-vous de montage</title>
</head>
<body>
    <h1>Bonjour, {{ $appointment->name }}</h1>
    <p>Nous vous informons que la date de montage de vos rideaux a été confirmée et que vos rideaux sont prêts.</p>
    <p>
        <strong>Date de montage :</strong> {{ $appointment->formatted_assembly_date }} <br>
    </p>
    <p>Pour toute question ou modification de votre rendez-vous, vous pouvez nous contacter par téléphone :</p>
    <ul>
        <li><a href="tel:+213671369955">0671369955</a></li>
        <li><a href="tel:+213560105292">0560105292</a></li>
        <li><a href="tel:+213667879955">0667879955</a></li>
    </ul>
    <p>Ou par e-mail à <a href="mailto:contact@chaima-rideaux.com">contact@chaima-rideaux.com</a>.</p>
    <p>Vous pouvez aussi visiter notre site web : <a href="https://www.chaima-rideaux.com">www.chaima-rideaux.com</a></p>
    <p>Si vous avez besoin de nous localiser, veuillez utiliser ce lien pour obtenir l'itinéraire : <a href="https://maps.app.goo.gl/WoJwWXBDZ4URtmDj6" target="_blank">Voir sur Google Maps</a></p>
    <p>Nous avons hâte de vous rencontrer et de vous offrir nos services.</p>
    <p>Cordialement, <br>
    Chaima Rideaux</p>
</body>
</html>
