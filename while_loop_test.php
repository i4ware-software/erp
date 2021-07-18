<?php
$i = rand(1, 99999);
$ii = 0;
while ($ii<=$i) {
	$ii++;
}
//echo $ii;
echo preg_replace('/[^\da-zA-Z.]/i', '_', "Etunimi_.SukunimiŠ").$ii;