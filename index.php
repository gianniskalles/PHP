<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Πίνακας</title>
</head>
<body style="margin: 50px;">
    <h1>Λίστα με τα προγράμματα της TESAE</h1>
    <br>
    <table class="table">
        <thread>
            <tr>
                <th>Κατηγορία</th>
                <th>Όνομα προγράμματος</th>
</tr>
</thread>
<tbody>

<?php
    // Load arxeio xml
$xmldata = simplexml_load_file("xmldata.xml") or 
die("Error");
    //  foreach gia na diavasei ola ta stoixia
foreach ($xmldata->children() as $data)
{
    //emfanisi olon me tin seira
    echo "<tr>
    <td>" . $data->katigoria . "</td>
    <td>" . $data->name . "</td>
    <tr>";
}
?>
</tbody>
<h3>Πρόσθεσε ένα ακόμα</h3>
<form method = "POST" action = "index.php">
<input type="text" name="kat" placeholder="Κατηγορία"/>
<input type="text" name="on" placeholder="Όνομα προγράμματος"/>
<input type="submit" name="ok" value="Καταχώρηση" style="background: green; color:white" />

<?php
// prosthiki neon stoixion sto xml
  if(isset($_POST['ok'])){
    $xml = new DOMDocument("1.0","utf-8");
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;
    $xml->load('xmldata.xml');
 $kateg = $_POST['kat'];
   $ono = $_POST['on'];

   $rootTag = $xml->getElementsByTagname('solutions')->item(0);

   $categoryTag = $xml->createElement("category");
    $katTag = $xml->createElement("katigoria",$kateg);
    $onTag = $xml->createElement("name",$ono);

    $categoryTag->appendchild($katTag);
    $categoryTag->appendchild($onTag);

    $rootTag->appendChild($categoryTag);
    $xml->save('xmldata.xml');
   
}
?>

</body>
</html>