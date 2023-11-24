<?php
    function connection() {
        $server="student.veleri.hr";
        $username="oot2";
        $password="11";
        $database="oot2_izv";

        $conn = mysqli_connect($server,$username,$password,
            $database) or die("Nema konekcije na bazu");
        return $conn;
    }
?>