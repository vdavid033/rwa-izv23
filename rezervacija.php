<?php
    require("connection.php");

    $conn = connection();
    // http://127.0.0.1/RWA/rezervacija.php?id_filma=3&id_korisnika=1
    $id_filma = $_GET["id_filma"];
    $id_korisnika = $_GET["id_korisnika"];
    $datum ="2023-11-10 18:52:00";

    //SELECT count(film) FROM rezervacija WHERE film = $id_filma
    //SELECT film.ukupan_broj-film.iznajmljeni-count(film) FROM `rezervacija`, film WHERE rezervacija.film=5 AND rezervacija.film=film.id 
    //UPDATE film SET rezervirani=rezervirani+1 WHERE id = 3 
    $query1 = "SELECT film.ukupan_broj-film.iznajmljeni-
        count(film) AS broj FROM `rezervacija`, film WHERE 
        rezervacija.film=". $id_filma." AND rezervacija.film=film.id";
    $res1 = mysqli_query($conn, $query1);
    
    while ($row1 = mysqli_fetch_array ($res1)) {
        $broj_slobodnih_filmova = $row1['broj'];
    }
    if ($broj_slobodnih_filmova>0) {
    
        $query2 = "INSERT INTO rezervacija (datum_sat, korisnik, film) VALUES ". 
        "('".$datum."',".$id_korisnika.",".$id_filma.")";
        $res2 = mysqli_query($conn, $query2);
        $query3 = "UPDATE film SET rezervirani=rezervirani+1 WHERE id = ".$id_filma;
        $res3 = mysqli_query($conn, $query3);
        if ($res2) {
            echo "<br>Rezervacija je unesena";
        } 
        else {
             echo $query2;
        }
        if ($res3){
            echo "<br>Rezervacija je ažurirana";
        } 
        else {
            echo $query3;
        }
    }
    else {
        echo "Nema slobodnih filmova";
    }
    mysqli_close($conn);
?>