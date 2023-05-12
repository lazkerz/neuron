<div class="p-4 row-wrapp col-11 mx-auto">
	<div class="d-flex justify-content-between align-items-center">
		<h5 class="fw-semibold text-decoration-underline">Tambah Data Pegawai</h5>
		<a href="index.php?hal=data_pegawai" class="fs-4"><i class="fa-solid fa-circle-arrow-left"></i></a>
	</div>
	<form method="POST" enctype="multipart/form-data">
	<div class="row mt-3 p-4 tb-peg">
		<div class="col-lg-6">
			<div class="mb-3">
				<label>NIP</label>
				<input type="text" name="nip" class="form-control">
			</div>
			<div class="mb-3">
				<label>Nama Pegawai</label>
				<input type="text" name="nama_pegawai" class="form-control">
			</div>
			<div class="mb-3">
				<label>Jenis Kelamin</label>
				<select class="form-select" name="jenis_kelamin">
				    <option selected>Pilih</option>
				    <option value="Laki-laki">Laki-laki</option>
					<option value="Perempuan">Perempuan</option>
				</select>
			</div>
			<div class="mb-3">
				<label>Jabatan</label>
				<select class="form-select" name="jabatan">
				    <option selected>Pilih</option>
				    <option value="Administrator">Administrator</option>
					<option value="Supervisor">Supervisor</option>
				    <option value="Manager">Manager</option>
				    <option value="Staff Pegawai">Staff Pegawai</option>
				</select>
			</div>
			<div class="mb-3">
				<label>No. Telepon</label>
				<input type="text" name="no_telp" class="form-control">
			</div>
		</div>
		<div class="col-lg-6">
			<div class="mb-3">
				<label>Foto</label>
				<input type="file" name="foto" class="form-control">
			</div>
			<div class="mb-3">
				<label>Buat Password</label>
				<input type="text" name="password" class="form-control">
			</div>
			<div class="mb-3">
				<label>Hak Akses</label>
				<select class="form-select" name="id_akses">
				    <option selected>Pilih</option>
				    <option value="1">1</option>
				    <option value="2">2</option>
				</select>
			</div>
			<div class="d-flex justify-content-end">
				<input type="submit" name="tambah" class="btn btn-cuti" value="Tambah">
			</div>
		</div>
	</div>
	</form>
</div>

<?php
	if(isset($_POST['tambah'])){
		$nip = $_POST['nip'];
		$nama_pegawai = $_POST['nama_pegawai'];
		$jenis_kelamin = $_POST['jenis_kelamin'];
		$jabatan = $_POST['jabatan'];
		$no_telp = $_POST['no_telp'];
		$password = md5($_POST['password']);
		$id_akses = $_POST['id_akses'];
		$nama_file = $_FILES['foto']['name'];
		$source = $_FILES['foto']['tmp_name'];
		$folder = '../../assets/img/';

		move_uploaded_file($source, $folder.$nama_file);
		$res = $koneksi->query("INSERT INTO tb_pegawai VALUES('$nip', '$nama_pegawai','$jenis_kelamin','$jabatan','$no_telp','$nama_file','$buatCuti','$password','$id_akses')");
		if($res){
			echo "<script>swal({
	    			title: 'Sukses',
	    			text: 'Data pegawai berhasil ditambahkan!',
	    			type: 'success',
	    			icon: 'success'
					}).then(function() {
	    			window.location = '?hal=data_pegawai';
				});
			</script>";		} else{
			echo mysqli_error($koneksi);
		}
	}
?>	