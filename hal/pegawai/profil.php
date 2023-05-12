<?php 
$getData = $koneksi->query("SELECT * FROM tb_pegawai WHERE nip = '$getNip'");
while($row = $getData->fetch_assoc()){
 ?>

<div class="p-4 col-11 mx-auto">
	<div class="row-wrapp p-2 ps-4 pt-3">
		<h5 class="fw-semibold text-decoration-underline">Informasi Profil</h5>
	</div>
	<div class="row gap-1 justify-content-around mt-3">
		<div class="col-3 border border-1 p-5 row-wrapp left-p">
			<div class="profil d-flex flex-column align-items-center">
				<img src="../../assets/img/<?= $row['foto']; ?>" height="200" width="200" class="d-block rounded-circle">
			</div>
			<div class="text-center mt-4">
				<a href="" class="btn btn-cuti" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['nip']; ?>">Edit Profil</a>
			</div>
		</div>
		<div class="col-6">
			<div class="row-wrapp p-5 flex-column">
				<div class="mb-3">
					<label>NIP</label>
					<br>
					<label class="fw-semibold"><?= $row['nip']; ?></label>
				</div>
				<div class="mb-3">
					<label>Nama</label>
					<br>
					<label class="fw-semibold"><?= $row['nama_pegawai']; ?></label>
				</div>
				<div class="mb-3">
					<label>Jabatan</label>
					<br>
					<label class="fw-semibold"><?= $row['jabatan']; ?></label>
				</div>
				<div class="mb-3">
					<label>Jenis Kelamin</label>
					<br>
					<label class="fw-semibold"><?= $row['jenis_kelamin']; ?></label>
				</div>
				<div class="mb-3">
					<label>Nomor Telepon</label>
					<br>
					<label class="fw-semibold">+62<?= $row['no_telp']; ?></label>
				</div>
			</div>
		</div>
		<div class="col-2">
			<div class="row row-wrapp p-3 text-end">
				<div>
					<label>Sisa Cuti</label>
					<br>
					<label class="fw-semibold fs-2"><?= $row['jatah_cuti']; ?></label>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal<?= $row['nip']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profil</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<form method="POST" enctype="multipart/form-data">
					<div class="col-6 mx-auto">
					    <div class="mb-3">
					        <img src="../../assets/img/<?= $row['foto'];  ?>" class="img-fluid">
					        <br>
					        <input type="file" name="foto" class="form-control mt-3" required>
					    </div>
						<div class="mt-4 d-flex justify-content-center">
						    <input type="submit" class="btn btn-cuti mb-3" name="editP" value="Simpan Perubahan">
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
}
if(isset($_POST['editP'])){
	$nama_file = $_FILES['foto']['name'];
	$source = $_FILES['foto']['tmp_name'];
	$folder = '../../assets/img/';

	move_uploaded_file($source, $folder.$nama_file);
	$res = $koneksi->query("UPDATE tb_pegawai SET foto = '$nama_file' WHERE nip = '$getNip'");

	if($res){
		echo "<script>swal({
	    			title: 'Sukses',
	    			text: 'Data berhasil diedit!',
	    			type: 'success',
	    			icon: 'success'
					}).then(function() {
	    			window.location = '?hal=profil';
				});
			</script>";
	} else{
		echo "<script>alert('Gagal! mengupdate data!');document.location.href='?hal=profil';</script>";
	}
}

 ?>