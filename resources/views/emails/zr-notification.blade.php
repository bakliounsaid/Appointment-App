<!DOCTYPE html>
<html>
<head>
    <title>Votre colis Chaima Rideaux est en cours de livraison !</title>
</head>
<body>
    <h1>Bonjour, {{ $order->fullname }}</h1>
    <p>Nous avons le plaisir de vous informer que votre colis Chaima Rideaux est en cours de livraison avec le service ZrExpress</p>
    <p>
        <strong>Voici votre code de suivi:</strong> {{ $order->tracking_code }} <br>
    </p>
    <p>Pour toute question,vous pouvez nous contacter par téléphone :</p>
    <ul>
        <li><a href="tel:+213671369955">0671369955</a></li>
        <li><a href="tel:+213560105292">0560105292</a></li>
        <li><a href="tel:+213667879955">0667879955</a></li>
    </ul>
    <p>Ou par e-mail à <a href="mailto:Chaimarideaux@gmail.com">Chaimarideaux@gmail.com</a>.</p>
    <p>Vous pouvez aussi visiter notre site web : <a href="https://www.chaima-rideaux.com">www.chaima-rideaux.com</a></p>
    <p>Si vous avez besoin de nous localiser, veuillez utiliser ce lien pour obtenir l'itinéraire : <a href="https://maps.app.goo.gl/WoJwWXBDZ4URtmDj6" target="_blank">Voir sur Google Maps</a></p>
    <p>Cordialement, <br>
    Chaima Rideaux</p>
</body>
</html>
