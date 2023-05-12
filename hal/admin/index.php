<?php 
require '../../koneksi.php';
session_start(); 
if(!isset($_SESSION['nip'])){
	header('location:../../index.php');
}

$getNip = $_SESSION['nip'];

$acc = 'Disetujui';
$denial = 'Ditolak';
$waiting = 'Menunggu Persetujuan';

$buatCuti = 12;

$sql= $koneksi->query("SELECT count(*) as total from tb_pengajuan WHERE status = '$waiting'");
$row = $sql->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard | NEURON</title>
	<link rel="stylesheet" type="text/css" href="../../assets/css/main.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
	<div class="wrapper">
		<header class="d-flex align-items-center justify-content-between ps-5 pe-5">
			<div class="head-left d-flex">
				<div class="d-flex align-items-center gap-2">
					<img src="../../assets/img/logo.png" height="35"> <span class="fw-semibold">NEURON</span>
				</div>
				<ul class="ms-4 d-flex gap-4 nav-menu align-items-center mt-3">	
					<li><a href="index.php">Beranda</a></li>
					<li><a href="?hal=data_pegawai">Data Pegawai</a></li>
					<li><a href="?hal=data_pemohon">Data Pemohon</a></li>
					<li><a href="?hal=riwayat">Riwayat</a></li>
				</ul>
			</div>
			<div class="head-right d-flex align-items-center">
				<div class="btn-group dropdown">
					<a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="i-notif p-2 rounded-circle">
						<i class="fa-solid fa-envelope"></i>
						<?php 
						if($row['total'] != 0){
							echo "<span>".$row['total']."</span>";	
							}
							else{
								echo "<span style='display:none;'>".$row['total']."</span>";
							}					 
						?>	
					</a>
					<div class="dropdown-menu dropdown-menu-end dm-notif">
						<?php
							$i = 1;
							//
							$q = $koneksi->query("SELECT * FROM tb_pengajuan JOIN tb_pegawai ON tb_pengajuan.nip = tb_pegawai.nip WHERE status = '$waiting' ORDER BY data_dibuat DESC");
							while($row = $q->fetch_assoc()){
						?>
						<a href="?hal=data_pemohon" class="d-flex wrapp-notif align-items-center gap-3">
							<div class="col left gap-2">
								<div>
									<img src="../../assets/img/<?= $row['foto'] ?>" height="40" width="40" class="rounded-circle">
								</div>
								<div class="d-flex align-items-center">
									<div>
										<span class="fw-semibold"><?= $row['nama_pegawai']; ?></span>
										<br>
										<?= $row['nip']; ?>
									</div>

								</div>
							</div>
							<div class="col right">
								<span><?= $row['keterangan']; ?></span>
							</div>
						</a>
					<?php } ?>
					</div>
				</div>
				<div class="btn-group dropdown">
					<a class="ms-3 dropdown-toggle text-decoration-none text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['nama_pegawai'].' - '. $_SESSION['jabatan']; ?></a>
					  <ul class="dropdown-menu dropdown-menu-end mt-2">
					    <li><a class="dropdown-item" href="?hal=profil"><i class="fa-solid fa-circle-user"></i> Profil</a></li>
					    <li><a class="dropdown-item" href="../../logout.php"><i class="fa-solid fa-up-right-from-square"></i> Keluar</a></li>
					  </ul>
				</div>
			</div>
		</header>
		<main>
			<?php 
				if(isset($_GET["hal"])){
					if($_GET['hal'] == "data_pegawai"){
							if(@$_GET["aksi"]=="input"){
								require_once "data_pegawai_input.php";
							}else if(@$_GET["aksi"]=="edit"){
								require_once "data_pegawai_edit.php";
							}else if(@$_GET["aksi"]=="delete"){
								require_once "data_pegawai_delete.php";
							}else{
								require_once "data_pegawai.php";
							}
						}else if($_GET["hal"] == "data_pemohon"){
							if(@$_GET["aksi"]=="input"){
								require_once "data_pemohon_input.php";
							}else if(@$_GET["aksi"]=="edit"){
								require_once "data_pemohon_edit.php";
							}else if(@$_GET["aksi"]=="delete"){
								require_once "data_pemohon_delete.php";
							}else{
								require_once "data_pemohon.php";
							}
						}else if($_GET["hal"] == "riwayat"){
							require "riwayat.php";
						}else if($_GET["hal"] == "profil"){
							require "profil.php";
						}else{
								require "dashboard.php";
							}
						}else{
							require "dashboard.php";
						}
			?>
		</main>
		<footer class="mt-3 d-flex justify-content-center align-items-center">
			<p>&copy;2022 Neuron.</p>
		</footer>
	</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="../../assets/js/myScript.js"></script>
</body>
</html>