<?php
date_default_timezone_set('Asia/Jakarta');
DEFINE("HOST", "localhost");
DEFINE("USER", "root");
DEFINE("PASS", "");
DEFINE("DB", "db_neuron");
$koneksi = new mysqli(HOST,USER,PASS,DB);
if($koneksi->connect_errno){
	die("Koneksi Gagal : ". $koneksi->connect_errno);
}
?>
