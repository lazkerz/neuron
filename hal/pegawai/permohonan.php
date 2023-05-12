<?php 
error_reporting(0);
 ?>

<div class="col-11 mx-auto">
	<div class="wrapp-tabs">
		<ul class="buttonTabs d-flex p-0">
			<li>
				<button onclick="showContent(0)">Ajukan Cuti</button>
			</li>
			<li>
				<button onclick="showContent(1)">Izin Sakit</button>
			</li>
		</ul>
		<div class="row-wrapp tabContent">
			<form method="POST" enctype="multipart/form-data">
			<div class="col-6 mx-auto">
				<div class="mb-3">
					<label>NIP</label>
					<input type="text" name="jenis_izin" value="Cuti" hidden>
					<input type="text" name="nip" value="<?= $_SESSION['nip']; ?>" class="form-control" disabled>
				</div>
				<div class="mb-3">
					<label>Nama</label>
					<input type="text" name="nama_pegawai" value="<?= $_SESSION['nama_pegawai']; ?>" class="form-control" disabled>
				</div>
				<div class="mb-3">
					<label>Tanggal Mulai</label>
					<input type="date" name="tanggalMulai" class="form-control" required>
				</div>
				<div class="mb-3">
					<label>Tanggal Berakhir</label>
					<input type="date" name="tanggalBerakhir" class="form-control" required>
				</div>
				<div class="mb-3">
					<label>Keterangan</label>
					<br>
					<textarea name="keterangan" class="form-control" required></textarea>
				</div>
				<div class="d-flex justify-content-end">
					<input type="submit" name="ajukan" value="Ajukan" class="btn btn-cuti">
				</div>
			</div>
			</form>
		</div>
		<div class="row-wrapp tabContent">
			<form method="POST" enctype="multipart/form-data">
			<div class="col-6 mx-auto">
				<div class="mb-3">
					<label>NIP</label>
					<input type="text" name="jenis_izin" value="Sakit" hidden>
					<input type="text" name="nip" value="<?= $_SESSION['nip']; ?>" disabled class="form-control">
				</div>
				<div class="mb-3">
					<label>Nama</label>
					<input type="text" name="nama_pegawai" value="<?= $_SESSION['nama_pegawai']; ?>" disabled class="form-control">
				</div>
				<div class="mb-3">
					<label>Tanggal Mulai</label>
					<input type="date" name="tanggalMulai" class="form-control" required>
				</div>
				<div class="mb-3">
					<label>Tanggal Berakhir</label>
					<input type="date" name="tanggalBerakhir" class="form-control" required>
				</div>
				<div class="mb-3">
					<label>Bukti Pendukung</label>
					<br>
					<input type="file" name="gambar" class="form-control" required>
				</div>
				<div class="mb-3">
					<label>Keterangan Sakit</label>
					<br>
					<textarea name="keterangan" class="form-control" required></textarea>
				</div>
				<div class="d-flex justify-content-end">
					<input type="submit" name="ajukan" value="Ajukan" class="btn btn-cuti">
				</div>
			</div>
			</form>
		</div>
	</div>
</div>

<?php
	if(isset($_POST['ajukan'])){
		$jenis_izin = $_POST['jenis_izin'];
		$nip = $_SESSION['nip'];
		$nama_pegawai = $_SESSION['nama_pegawai'];
		$tglMulai = $_POST['tanggalMulai'];
		$tglBerakhir = $_POST['tanggalBerakhir'];
		$keterangan = $_POST['keterangan'];
		$status = 'Menunggu Persetujuan';
		$dataCreated = date("Y-m-d H:i:s");
		$lastUpdate = date("Y-m-d H:i:s");

		// Upload Gambar
		$nama_file = $_FILES['gambar']['name'];
		$source = $_FILES['gambar']['tmp_name'];
		$folder = '../../assets/img/';
		
		// Hitung Tanggal
		$tgl1 = new DateTime($tglMulai);
		$tgl2 = new DateTime($tglBerakhir);

		$diff = $tgl1->diff($tgl2);

		if ($diff->days > $jatahCuti) {
			echo "<script>swal({
	    			title: 'Gagal',
	    			text: 'Jatah cuti anda melebihi batas/sudah habis!',
	    			type: 'error',
	    			icon: 'error'
					}).then(function() {
	    			window.location = '?hal=permohonan';
				});
			</script>";
		}
		else{
			$jml_cuti = $diff->days;
			$sisa = $jatahCuti - $diff->days;
			if ($nama_file != '') {
			move_uploaded_file($source, $folder.$nama_file);
			$res = mysqli_query($koneksi, "INSERT INTO tb_pengajuan VALUES('','$jenis_izin','$nip', '$nama_pegawai','$tglMulai','$tglBerakhir','$jml_cuti','$nama_file','$keterangan','$status','$dataCreated','$lastUpdate')");
			$res = mysqli_query($koneksi, "UPDATE tb_pegawai SET jatah_cuti = '$sisa' WHERE tb_pegawai.nip = '$getNip'");
			}
			else{
				$res = mysqli_query($koneksi, "INSERT INTO tb_pengajuan VALUES('','$jenis_izin','$nip', '$nama_pegawai','$tglMulai','$tglBerakhir','$jml_cuti','','$keterangan','$status','$dataCreated','$lastUpdate')");
				$res = mysqli_query($koneksi, "UPDATE tb_pegawai SET jatah_cuti = '$sisa' WHERE tb_pegawai.nip = '$getNip'");	
			}
		}		
		
		if($res){
			echo "<script>swal({
	    			title: 'Sukses',
	    			text: 'Pengajuan berhasil dibuat!',
	    			type: 'success',
	    			icon: 'success'
					}).then(function() {
	    			window.location = '?hal=permohonan';
				});
			</script>";
		} else{
			echo mysqli_error($koneksi);
		}
	}
?>	