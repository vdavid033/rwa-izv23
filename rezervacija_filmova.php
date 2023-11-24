<!DOCTYPE html>
<?php
    $user = "Ana";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videoteka</title>
    <!--link rel="stylesheet" href="./css/stil.css"-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <div class="w3-bar w3-black">
        
        <h1><img src="pngwing.com.png" alt="" width="100">Videoteka</h1>
        <a href="index.html" class="w3-bar-item w3-button w3-round">Početna</a>
        <a href="filmovi.html" class="w3-bar-item w3-button w3-round w3-grey"">Popis filmova</a>
        <a href="rezervacija_filmova.php" class="w3-bar-item w3-button w3-round">Rezervacija filmova</a>        
        <a href="kontakt.html" class="w3-bar-item w3-button  w3-round">Kontakt</a>
    </div>
<div class="w3-container">
    <h2>Popis filmova</h2>
<?php
    require("connection.php");
    
    $conn = connection();
    $query = "SELECT * FROM film;";
    $res = mysqli_query($conn, $query);
?>

    <table class="w3-table-all w3-responsive" border ="1px">
        <tr>
            <th>
                Naziv filma
            </th>
            <th>
                Glumci
            </th>
            <th>
                Više informacija
            </th>
            <th>
                Trailer
            </th>
            <th>
                Rezervacija
            </th>
        </tr>
        <?php
        while ($row=mysqli_fetch_array($res)){
            echo "<tr>";
            echo "<td class='w3-panel'>
                <h4 class='w3-text-teal' 
                    style='text-shadow:1px 1px 0 #444'>
                    <b>". $row['naslov'] ."</b></h4>
                </td>"; 
            echo "<td  class='w3-panel more'>" .
                $row['glumci']. "</td>";
            echo "<td><img src='".$row['slika']."' 
                width='200px' 
                alt='".$row['naslov'] ."'></td>";
            echo "<td>".$row['trailer']."</td>";
            if ($user=="Pero"){
                echo "<td><a href='rezervacija.php?id_filma=". $row['id']. "&id_korisnika=1'><button> Rezerviraj </button></a> </td>";
            }
            echo "</tr>";
        }
    mysqli_close($conn);
?>
    </table>
</div>
<div class="w3-container w3-black">Više informacija možete naći na <a href="https://www.imdb.com/" target="_blank">IMDB.com</a></div>
<script>
    const elems = Array.from(document.getElementsByClassName("more"));
    console.log(elems); 
    const texts = [];
    elems.forEach((elem, index) => {
        texts.push(elem.innerHTML); 
    });
    elems.forEach((elem, index) => {
        if (elem.innerHTML.length > 200){
                elem.innerHTML=elem.innerHTML.substring(0,195)+"...";
        }
    });

    elems.forEach((elem, index) => {
        elem.addEventListener("click",function() {
            if (elem.innerHTML.length > 200){
                elem.innerHTML=elem.innerHTML.substring(0,195)+"...";
            }
            else if (elem.innerHTML.endsWith("...")) {
                elem.innerHTML = texts[index];                
            }
        })  
    });
   
</script>
</body>
</html>