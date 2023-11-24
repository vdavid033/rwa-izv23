<div>
<?php
    echo "Pozdrav sa serverske strane!";
    $email = $_GET["email"];
    $tekst = $_GET["tekst"];
    
    $server="localhost";
    $username="root";
    $password="";
    $database="rwa";

    $conn = mysqli_connect($server,$username,$password,
        $database) or die("Nema konekcije na bazu");
    
    $query = "INSERT INTO kontakti(email, poruka) VALUES ('"
        .$email."','".$tekst."');";
    echo $query;
    $res = mysqli_query($conn, $query);
    echo $res;
    if ($res) {
        echo "<br>Dobili smo vašu poruku: ".$tekst;
        echo "<br>Odgovorit ćemo na vaš e-mail: ".$email;
    }
    mysqli_close($conn);

?>
</div>