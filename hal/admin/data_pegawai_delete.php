<?php
	$nip = $_GET['nip'];
	$del = $koneksi->query("DELETE FROM tb_pegawai WHERE nip = '$nip'");
	if($del){
		header('location:index.php?hal=data_pegawai');
	}
?>