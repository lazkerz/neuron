<div class="p-4 row-wrapp col-11 mx-auto">
	<h5 class="fw-semibold text-decoration-underline">Data Pegawai</h5>
	<div class="col-12 mx-auto mt-3 p-4">
		<div class="d-flex">
			<a href="index.php?hal=data_pegawai&aksi=input" class="btn btn-cuti btn-fs mb-3"><i class="fa-solid fa-user-plus"></i> Tambah Pegawai</a>
		</div>
		<table class="table tb-peg">
			<thead class="table-secondary">
				<tr>
					<th scope="col">No.</th>
					<th scope="col">NIP</th>
					<th scope="col">Nama Pegawai</th>
					<th scope="col">Jenis Kelamin</th>
					<th scope="col">Jabatan</th>
					<th scope="col">No. Telepon</th>
					<th scope="col">Foto</th>
					<th scope="col" colspan="2" class="text-center">Aksi</th>
				</tr>
			</thead>
			<?php
				$i = 1;
				$q = $koneksi->query("SELECT * FROM tb_pegawai WHERE NOT id_akses = 1");
				while($row = $q->fetch_assoc()){
			?>
			<tbody>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= $row['nip']; ?></td>
					<td><?= $row['nama_pegawai']; ?></td>
					<td><?= $row['jenis_kelamin']; ?></td>
					<td><?= $row['jabatan']; ?></td>
					<td><?= $row['no_telp']; ?></td>
					<td><?= $row['foto']; ?></td>
					<td class="text-center i-aksi"><a class="rounded-1 i-ed" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['nip']; ?>"><i class="fa-solid fa-file-pen"></i></a></td>
					<td class="text-center i-aksi"><a href="?hal=data_pegawai&aksi=delete&nip=<?php echo $row['nip'];?>" class="rounded-1 i-del"><i class="fa-solid fa-trash-can"></i></a></td>
				</tr>
			<!-- Modal Edit -->
			<div class="modal fade" id="editModal<?= $row['nip']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog  modal-lg">
				    <div class="modal-content">
					    <div class="modal-header">
					        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					    </div>
					    <div class="modal-body">
					    	<div class="row">
					    	<form method="POST" enctype="multipart/form-data">
					        <div class="col-6">
					        <div class="mb-3">
					        	<label>NIP</label>
					        	<input type="text" name="nip" class="form-control" value="<?= $row['nip']; ?>" readonly>
					        </div>
					        <div class="mb-3">
					        	<label>Nama Pegawai</label>
					        	<input type="text" name="nama_pegawai" class="form-control" value="<?= $row['nama_pegawai']; ?>">
					        </div>
					        <div class="mb-3">
					        	<label>Jenis Kelamin</label>
					        	<select class="form-select" name="jenis_kelamin">
								    <option selected><?= $row['jenis_kelamin']; ?></option>
								    <option value="Laki-laki">Laki-laki</option>
								    <option value="Perempuan">Perempuan</option>
								</select>
					        </div>
					        <div class="mb-3">
					        	<label>Jabatan</label>
					        	<select class="form-select" name="jabatan">
								    <option selected><?= $row['jabatan']; ?></option>
								    <option value="Administrator">Administrator</option>
								    <option value="Supervisor">Supervisor</option>
								    <option value="Manager">Manager</option>
								    <option value="Staff Pegawai">Staff Pegawai</option>
								</select>
					        </div>
					        <div class="mb-3">
					        	<label>No. Telepon</label>
					        	<input type="text" name="no_telp" class="form-control" value="<?= $row['no_telp']; ?>">
					        </div>
					        <div class="mb-3">
					        	<label>Password</label>
					        	<input type="text" name="password" class="form-control" value="<?= $row['password']; ?>">
					        </div>
					        </div>
					        <div class="col-6">
					        	<div class="mb-3">
					        	<label>Foto</label>
					        	<br>
					        	<img src="../../assets/img/<?= $row['foto'];  ?>" class="img-fluid">
					        	<br>
					        	<input type="file" name="foto" class="form-control mt-3">
					        </div>
						    <div class="mt-4 d-flex justify-content-end">
						        <input type="submit" class="btn btn-cuti mb-3" name="edit" value="Simpan Perubahan">
						    </div>
					        </div>
						    </form>
					    </div>
					    </div>
				    </div>
				</div>
			</div>
			</tbody>
			<?php } ?>
		</table>
	</div>
</div>

<?php 

if (isset($_POST['edit'])) {
	$nip = $_POST['nip'];
	$nama_pegawai = $_POST['nama_pegawai'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$jabatan = $_POST['jabatan'];
	$no_telp = $_POST['no_telp'];
	$password = $_POST['password'];

	// Upload Gambar
		$nama_file = $_FILES['foto']['name'];
		$source = $_FILES['foto']['tmp_name'];
		$folder = '../../assets/img/';

	if($nama_file != ''){
		move_uploaded_file($source, $folder.$nama_file);
		$res = $koneksi->query("UPDATE tb_pegawai SET nama_pegawai = '$nama_pegawai', jenis_kelamin = '$jenis_kelamin', jabatan = '$jabatan', no_telp = '$no_telp', foto = '$nama_file', password = '$password' WHERE tb_pegawai.nip = '$nip'");
	}
	else{
		$res = $koneksi->query("UPDATE tb_pegawai SET nama_pegawai = '$nama_pegawai', jenis_kelamin = '$jenis_kelamin', jabatan = '$jabatan', no_telp = '$no_telp', password = '$password' WHERE tb_pegawai.nip = '$nip'");

	}

	if($res){
		echo "<script>swal({
	    			title: 'Sukses',
	    			text: 'Data berhasil diedit!',
	    			type: 'success',
	    			icon: 'success'
					}).then(function() {
	    			window.location = '?hal=data_pegawai';
				});
			</script>";
	} else{
		echo "<script>alert('Gagal! mengupdate data!');document.location.href='?hal=data_pegawai';</script>";
	}

}

 ?>





