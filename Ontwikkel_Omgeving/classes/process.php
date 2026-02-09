<?php
// Stap 1: Foutmeldingen aanzetten zodat we de error zien
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Stap 2: De benodigde klasses laden
require_once 'database.php';
require_once 'nieuwsbrief.php';

// Stap 3: Check of het formulier is verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();
    
    if($db === null) {
        die("Database connectie mislukt. Controleer je Database.php instellingen.");
    }

    $nieuwsbrief = new Nieuwsbrief($db);

    // Stap 4: Data opvangen (namen komen exact overeen met jouw HTML)
$data = [
    'voornaam'          => $_POST['voornaam'] ?? '',      // Was 'Voornaam' in HTML
    'tussenvoegsel'     => $_POST['tussenvoegsel'] ?? '', // Was 'Tussenvoegsel' in HTML
    'achternaam'        => $_POST['achternaam'] ?? '',    // Was 'Achternaam' in HTML
    'geboortedatum'     => $_POST['geboortedatum'] ?? '', 
    'straatnaam_nummer' => $_POST['straatnaam_nummer'] ?? '',        // Was 'Straat' in HTML
    'postcode'          => $_POST['postcode'] ?? '',      // Was 'Postcode' in HTML
    'woonplaats'        => $_POST['woonplaats'] ?? '',    // Was 'Woonplaats' in HTML
    'telefoonnummer'    => $_POST['telefoonnummer'] ?? '',      // Was 'Telefoon' in HTML
    'akkoord'           => isset($_POST['akkoord']) ? 1 : 0
];

    // Stap 5: Proberen op te slaan
    if ($nieuwsbrief->opslaan($data)) {
        echo "<h2>Succes!</h2>";
        echo "De aanvraag voor de nieuwsbrief is succesvol verwerkt in de ontwikkelomgeving[cite: 92, 99].";
    } else {
        echo "Er is een fout opgetreden bij het opslaan van de gegevens.";
    }
} else {
    echo "Geen data ontvangen via POST.";
}
?>