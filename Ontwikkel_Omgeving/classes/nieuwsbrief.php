<?php
class Nieuwsbrief {
    private $conn;
    private $table_name = "aanvragen";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function opslaan($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (voornaam, tussenvoegsel, achternaam, geboortedatum, straatnaam_nummer, postcode, woonplaats, telefoonnummer, akkoord) 
                  VALUES (:vn, :tv, :an, :gd, :sn, :pc, :wp, :tel, :akk)";

        $stmt = $this->conn->prepare($query);

        // Koppelen van de data uit de array aan de SQL query
        $stmt->bindParam(':vn', $data['voornaam']);
        $stmt->bindParam(':tv', $data['tussenvoegsel']);
        $stmt->bindParam(':an', $data['achternaam']);
        $stmt->bindParam(':gd', $data['geboortedatum']);
        $stmt->bindParam(':sn', $data['straatnaam_nummer']);
        $stmt->bindParam(':pc', $data['postcode']);
        $stmt->bindParam(':wp', $data['woonplaats']);
        $stmt->bindParam(':tel', $data['telefoonnummer']);
        $stmt->bindParam(':akk', $data['akkoord']);

        return $stmt->execute();
    }
}
?>