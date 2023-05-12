<?php
	$id_pengajuan = $_GET['id_pengajuan'];
	$del = $koneksi->query("DELETE FROM tb_pengajuan WHERE id_pengajuan = '$id_pengajuan'");
	if($del){
		header('location:index.php?hal=data_pemohon');
	}
?>