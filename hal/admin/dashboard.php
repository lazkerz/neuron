<nav class="mx-auto mt-4 row-wrapp rounded-2 overflow-hidden">
	<div class="row p-5 bg--main">
		<div class="col-lg-6 mb-5">
			<h4>Halo, <?php echo $_SESSION['nama_pegawai']; ?>!</h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua.</p>
			<div>
				<a href="index.php?hal=data_pemohon" class="btn btn-cuti">Lihat Pemohon <i class="fa-solid fa-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-6 d-flex justify-content-end">
			<ul class="d-flex gap-2 flex-wrap justify-content-end">
				<li><div class="data--count">
						<h4>
							<?php 
								$sql= $koneksi->query("SELECT count(*) as total from tb_pegawai WHERE NOT id_akses = 1");
								$row = $sql->fetch_assoc();
								echo $row['total'];
							?>
						</h4>
						<p>Data Pegawai</p>
					</div></li>
				<li><div class="data--count">
						<h4>
							<?php 
								$sql= $koneksi->query("SELECT count(*) as total from tb_pengajuan WHERE status = '$waiting'");
								$row = $sql->fetch_assoc();
								echo $row['total'];
							?>	
						</h4>
						<p>Data Pemohon</p>
					</div></li>
				<li><div class="data--count">
						<h4>
							<?php 
								$sql= $koneksi->query("SELECT count(*) as total from tb_pengajuan WHERE status = '$acc'");
								$row = $sql->fetch_assoc();
								echo $row['total'];
							?>
						</h4>
						<p>Data Disetujui</p>
					</div></li>
				<li><div class="data--count">
						<h4>
							<?php 
								$sql= $koneksi->query("SELECT count(*) as total from tb_pengajuan WHERE status = '$denial'");
								$row = $sql->fetch_assoc();
								echo $row['total'];
							?>
						</h4>
						<p>Data Ditolak</p>
					</div></li>
			</ul>
		</div>
	</div>
</nav>
<div class="row-wrapp mt-5 w90 mx-auto p-3">
	<span class="fw-bold mt-4 mb-2"><i class="fa-solid fa-clock-rotate-left"></i> Histori terakhir</span>
</div>
<div class="row-wrapp w90 mx-auto p-3">
	<table class="table tb-peg">
		<thead>
			<tr>
				<th scope="col">No.</th>
				<th scope="col">NIP</th>
				<th scope="col">Nama Pegawai</th>
				<th scope="col">Tanggal Mulai</th>
				<th scope="col">Tanggal Berakhir</th>
				<th scope="col">Keterangan</th>
				<th scope="col">Status</th>
			</tr>
		</thead>
		<?php
			$i = 1;
			$q = $koneksi->query("SELECT * FROM tb_pengajuan WHERE NOT status = '$waiting' LIMIT 5");
			while($row = $q->fetch_assoc()){
		?>
		<tbody>
			<tr>
				<td><?= $i++; ?></td>
				<td><?= $row['nip']; ?></td>
				<td><?= $row['nama_pegawai']; ?></td>
				<td><?= $row['tanggalMulai']; ?></td>
				<td><?= $row['tanggalBerakhir']; ?></td>
				<td><?= $row['keterangan']; ?></td>
				<td><?= $row['status']; ?></td>
			</tr>
		</tbody>
		<?php } ?>
	</table>
</div>