<?php
require  './vendor/autoload.php';


if ($_SERVER["REQUEST_METHOD"] == "GET") {

echo <<<END_OF_TEXT
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Electricity declaration form</title>
        <link rel="stylesheet" media="all" href="./public/stylesheet.css"/>
</head>
<body>
END_OF_TEXT;
if(isset($_GET['paid'])){
    $paid =  urldecode($_GET['paid']);
    echo <<<END_OF_TEXT
    <table style="background-color: green">
   <thead>
     <tr>
     <th colspan="2">JŪSŲ MOKĖJIMO INFORMACIJA:</th>
      </tr>
     </thead>
     <tbody>
         <tr>
         <td colspan="2" style="color: blue">SUMOKĖTA $paid EUR</td>
      </tr>
     </tbody>
     </table>
     <p/>
   END_OF_TEXT;
}
echo <<<END_OF_TEXT
<form class="form" action="/process.php" method="post">
    <label> Įveskite kilovatvalandžių kiekį: <br>
Dienos laiko zona<br>
        <input type="number" step="1" min="0" name="klwD" required>
    </label><br><br>
    <label> Įveskite kilovatvalandžių kiekį: <br>
        Nakties laiko zona<br>
        <input type="number" step="1" min="0" name="klwN" required>
    </label><br><br>
    <label> Įveskite dieninės elektros tarifą (EUR/kWh):<br>
        <input type="number" step="0.01" min="0" name="tariffD" required>
    </label><br><br>
    <label> Įveskite naktinės elektros tarifą (EUR/kWh):<br>
        <input type="number" step="0.01" min="0" name="tariffN" required>
    </label><br><br>
    <label> Mėnuo, už kurį mokama:<br><br>
        <input type="month" name="paymentMonth" id="paymentMonth" required><br><br>
        <input type="submit" class="button" value="Skaičiuoti kainą">
    </label>
</form>
</body
END_OF_TEXT;
}