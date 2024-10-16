<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de votre commande</title>
</head>
<body>
    <h1>Bonjour {{ $order->firstname }} {{ $order->lastname }},</h1>

    <p>Merci pour votre commande. Voici les détails :</p>

    <ul>
        <li>Nom : {{ $order->lastname }}</li>
        <li>Prénoms : {{ $order->firstname }}</li>
        <li>Email : {{ $order->email }}</li>
        <li>Contact : {{ $order->phone }}</li>
        <li>Quantité : {{ $order->quantity }}</li>
        <li>Type de Conditionnement : {{ $order->type_package->name }}</li>
        <li>Lieu de livraison : {{ $order->lieu_livraison }}</li>
        <li>État de la commande : {{ $order->state }}</li>
    </ul>

    <p>Merci de nous faire confiance.</p>

    <p>Cordialement,</p>
    <p>L'équipe</p>
</body>
</html>