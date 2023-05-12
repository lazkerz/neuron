<div class="p-4 row-wrapp col-11 mx-auto">
	<h5 class="fw-semibold text-decoration-underline">Riwayat</h5>
	<div class="mt-2 p-4 pb-0">
		<form method="post">
		<div class="row justify-content-end">
			<div class="col-2">
				<label>Dari tanggal</label>
				<input type="date" name="dari" required class="form-control">
			</div>
			<div class="col-2">
				<label>Sampai tanggal</label>
				<input type="date" name="ke" required class="form-control">
			</div>
			<div class="col-1 align-self-end">
				<input type="submit" class="btn btn-cuti" name="filter" value="Filter">
			</div>
		</div>
		</form>
	</div>
	<div class="col-12 mx-auto p-4">
		<table class="table tb-peg">
			<thead class="table-secondary">
				<tr>
					<th scope="col">No.</th>
					<th scope="col">Tanggal Mulai</th>
					<th scope="col">Tanggal Berakhir</th>
					<th scope="col">Jenis Perizinan</th>
					<th scope="col">Keterangan</th>
					<th scope="col">Status</th>
					<th scope="col" class="text-center">Waktu disetujui/ditolak</th>
				</tr>
			</thead>
			<?php
				$i = 1;

				if (isset($_POST['filter'])) {
					$dari = mysqli_real_escape_string($koneksi, $_POST['dari']);
					$ke = mysqli_real_escape_string($koneksi, $_POST['ke']);
					$q = mysqli_query($koneksi,"SELECT * FROM tb_pengajuan WHERE terakhir_dibuat BETWEEN '$dari' AND '$ke'");
				}else{
				$q = $koneksi->query("SELECT * FROM tb_pengajuan WHERE NOT status = 'Menunggu Persetujuan' order by terakhir_dibuat desc");
			}
				while($row = $q->fetch_assoc()){
			?>
			<tbody>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= $row['tanggalMulai']; ?></td>
					<td><?= $row['tanggalBerakhir']; ?></td>
					<td><?= $row['jenis_izin']; ?></td>
					<td><?= $row['keterangan']; ?></td>
					<td><?= $row['status']; ?></td>
					<td class="text-center"><?= $row['terakhir_dibuat'] ?></td>
				</tr>
			</tbody>
		<?php } ?>
		</table>
	</div>
</div>