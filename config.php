<?php
//***objektorjenteeritud***//
//sinu andmed
$db_server = 'localhost';
$db_andmebaas = 'knurmetalo';
$db_kasutaja = 'knurmetalo';
$db_salasona = 'fuZi7cjVddVQfaBi';
//yhenduse loomine
$yhendus = new mysqli($db_server, $db_kasutaja, $db_salasona, $db_andmebaas);
// Ć¼henduse kontroll
if(!$yhendus){
	die('Ei saa ühendust andmebaasiga');
}
?>