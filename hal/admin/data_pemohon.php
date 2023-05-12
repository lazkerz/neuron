<div class="col-11 mx-auto">
	<div class="wrapp-tabs">
		<ul class="buttonTabs d-flex p-0">
			<li>
				<button onclick="showContent(0)">Data Cuti</button>
			</li>
			<li>
				<button onclick="showContent(1)">Data Sakit</button>
			</li>
		</ul>
		<div class="tabContent p-0">
			<div class="row-wrapp mx-auto p-2">
				<span class="fw-semibold mt-4 mb-2"><i class="fa-solid fa-clipboard-user me-1 ms-2"></i> Daftar Pemohon Cuti Pegawai</span>
			</div>
			<div class="mx-auto mt-3">
				<table class="table tb-peg">
					<thead class="table-secondary">
						<tr>
							<th scope="col">No.</th>
							<th scope="col">NIP</th>
							<th scope="col">Nama Pegawai</th>
							<th scope="col">Tanggal diajukan</th>
							<th scope="col">Status</th>
							<th scope="col" colspan="3" class="text-center">Aksi</th>
						</tr>
					</thead>
					<?php
						$i = 1;
						$q = $koneksi->query("SELECT * FROM tb_pengajuan WHERE jenis_izin = 'Cuti' AND status = '$waiting'");
						while($row = $q->fetch_assoc()){
					?>
					<tbody>
						<tr>
							<th scope="row"><?= $i++; ?></th>
							<td><?= $row['nip']; ?></td>
							<td><?= $row['nama_pegawai']; ?></td>
							<td><?= $row['data_dibuat']; ?></td>
							<td><?= $row['status']; ?></td>
							<td class="text-center i-aksi"><a class="rounded-1 i-ed" data-bs-toggle="modal" data-bs-target="#detailModal<?= $row['id_pengajuan']; ?>"><i class="fa-solid fa-eye"></i></a>
							</td>
							<td class="text-center i-aksi"><a href="?hal=data_pemohon&aksi=delete&id_pengajuan=<?= $row['id_pengajuan'];?>" class="rounded-1 i-del"><i class="fa-solid fa-trash-can"></i></a></td>
						</tr>
						<!-- Modal Detail -->
					<div class="modal fade" id="detailModal<?= $row['id_pengajuan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg">
						    <div class="modal-content">
							    <div class="modal-header">
							        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data</h1>
							        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							    </div>
							    <div class="modal-body">
							    <form method="POST">
							    	<div class="row justify-content-evenly">
							        <div class="col-6">
								        <div class="mb-3">
								        	<input type="text" name="id_pengajuan" value="<?= $row['id_pengajuan'] ?>" hidden>
								        	<label>NIP</label>
								        	<input type="text" name="nip" class="form-control" value="<?= $row['nip']; ?>" readonly>
								        </div>
								        <div class="mb-3">
								        	<label>Nama Pegawai</label>
								        	<input type="text" name="nama_pegawai" class="form-control" value="<?= $row['nama_pegawai']; ?>">
								        </div>
								        <div class="mb-3">
								        	<label>Tanggal Mulai</label>
								        	<input type="text" name="tanggalMulai" value="<?= $row['tanggalMulai']; ?>" class="form-control">
								        </div>
								        <div class="mb-3">
								        	<label>Tanggal Berakhir</label>
								        	<input type="text" name="tanggalBerakhir" value="<?= $row['tanggalBerakhir']; ?>" class="form-control">
								        </div>
								    </div>
								    <div class="col-4">
								    	<div class="mb-3">
								        	<label>Keterangan</label>
								        	<textarea name="keterangan" class="form-control"><?= $row['keterangan']; ?></textarea>
								        </div>
								        <div class="mb-3">
								        	<label>Aksi</label>
								        	<select class="form-select" name="status">
											    <option selected><?= $row['status']; ?></option>
											    <option value="Disetujui">Setuju</option>
											    <option value="Ditolak">Tolak</option>
											</select>
								        </div>
									    <div class="mt-4 d-flex justify-content-end">
									        <input type="submit" class="btn btn-cuti mb-3" name="simpan" value="Simpan Perubahan">
									    </div>
							        </div>
								    </div>
								</form>
							    </div>
						    </div>
						</div>
					</div>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="tabContent p-0">
			<div class="row-wrapp mx-auto p-2">
				<span class="fw-semibold mt-4 mb-2"><i class="fa-solid fa-clipboard-user me-1 ms-2"></i> Daftar Pemohon Izin Sakit Pegawai</span>
			</div>
			<div class="mx-auto mt-3">
				<table class="table tb-peg">
					<thead class="table-secondary">
						<tr>
							<th scope="col">No.</th>
							<th scope="col">NIP</th>
							<th scope="col">Nama Pegawai</th>
							<th scope="col">Tanggal diajukan</th>
							<th scope="col">Status</th>
							<th scope="col" colspan="3" class="text-center">Aksi</th>
						</tr>
					</thead>
					<?php
						$i = 1;
						$q = $koneksi->query("SELECT * FROM tb_pengajuan WHERE jenis_izin = 'Sakit' AND status = '$waiting'");	
						while($row = $q->fetch_assoc()){
					?>
					<tbody>
						<tr>
							<th scope="row"><?= $i++; ?></th>
							<td><?= $row['nip']; ?></td>
							<td><?= $row['nama_pegawai']; ?></td>
							<td><?= $row['data_dibuat']; ?></td>
							<td><?= $row['status']; ?></td>
							<td class="text-center i-aksi"><a class="rounded-1 i-ed" data-bs-toggle="modal" data-bs-target="#detail1Modal<?= $row['id_pengajuan']; ?>"><i class="fa-solid fa-eye"></i></a>
							</td>
							<td class="text-center i-aksi"><a href="?hal=data_pemohon&aksi=delete&id_pengajuan=<?= $row['id_pengajuan'];?>" class="rounded-1 i-del"><i class="fa-solid fa-trash-can"></i></a></td>
						</tr>
						<!-- Modal Detail -->
					<div class="modal fade" id="detail1Modal<?= $row['id_pengajuan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg">
						    <div class="modal-content">
							    <div class="modal-header">
							        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data</h1>
							        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							    </div>
							    <div class="modal-body">
							    <form method="POST">
							    	<div class="row justify-content-evenly">
							        <div class="col-6">
								        <div class="mb-3">
								        	<input type="text" name="id_pengajuan" value="<?= $row['id_pengajuan'] ?>" hidden>
								        	<label>NIP</label>
								        	<input type="text" name="nip" class="form-control" value="<?= $row['nip']; ?>" readonly>
								        </div>
								        <div class="mb-3">
								        	<label>Nama Pegawai</label>
								        	<input type="text" name="nama_pegawai" class="form-control" value="<?= $row['nama_pegawai']; ?>">
								        </div>
								        <div class="mb-3">
								        	<label>Tanggal Mulai</label>
								        	<input type="text" name="tanggalMulai" value="<?= $row['tanggalMulai']; ?>" class="form-control">
								        </div>
								        <div class="mb-3">
								        	<label>Tanggal Berakhir</label>
								        	<input type="text" name="tanggalBerakhir" value="<?= $row['tanggalBerakhir']; ?>" class="form-control">
								        </div>
								        <div class="mb-3">
								        	<label>Keterangan</label>
								        	<textarea name="keterangan" class="form-control"><?= $row['keterangan']; ?></textarea>
								        </div>
								    </div>
								    <div class="col-4">
								    	<div class="mb-3">
								    		<label>Bukti Pendukung</label>
								    		<br>
								    		<img src="../../assets/img/<?= $row['berkas']; ?>" class="img-fluid">
								    	</div>
								        <div class="mb-3">
								        	<label>Aksi</label>
								        	<select class="form-select" name="status">
											    <option selected><?= $row['status']; ?></option>
											    <option value="Setuju">Setuju</option>
											    <option value="Tolak">Tolak</option>
											</select>
								        </div>
									    <div class="mt-4 d-flex justify-content-end">
									        <input type="submit" class="btn btn-cuti mb-3" name="simpan" value="Simpan Perubahan">
									    </div>
							        </div>
								    </div>
								</form>
							    </div>
						    </div>
						</div>
					</div>
					</tbody>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
</div>

<?php 

if (isset($_POST['simpan'])) {
	$id_p = $_POST['id_pengajuan'];
	$status = $_POST['status'];

	$res = $koneksi->query("UPDATE tb_pengajuan SET status = '$status' WHERE tb_pengajuan.id_pengajuan = '$id_p'");
	if($res){
		echo "<script>swal({
	    			title: 'Sukses',
	    			text: 'Perubahan telah dilakukan!',
	    			type: 'success',
	    			icon: 'success'
					}).then(function() {
	    			window.location = '?hal=data_pemohon';
				});
			</script>";
	} else{
		echo "<script>alert('Gagal! mengupdate data!');document.location.href='?hal=data_pemohon';</script>";
	}

}

 ?>