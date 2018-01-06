<?php
//esse arquivo você baixa na aba developers do site https://puce.io
include 'Puce_io.php';

$Puce = new Puce('7F5B4E9201908753DCFFA16BB586263B863EB93B');

$altcoins = $Puce->getAltcoins('btc');
print_r($altcoins);

echo "<br><br><hr>";
echo $altcoins->name;
