<?php
require("koneksi.php");
if(isset($_POST['login'])){
	$nip = addslashes(trim($_POST['nip']));
	$pass = md5($_POST['password']);
	
	$sql = mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE nip = '$nip' AND password = '$pass'");
	$cek = mysqli_num_rows($sql);

  $row = $sql->fetch_assoc();

	if($cek > 0){
		session_start();
		if($row['id_akses'] == 1){
			header('location:hal/admin/index.php');
		}
		else if($row['id_akses'] == 2 ){
			header('location:hal/pegawai/index.php');
		}
		else{
			header('location:index.php?error');
		}
		$_SESSION['nip'] = $row['nip'];
		$_SESSION['nama_pegawai'] = $row['nama_pegawai'];
		$_SESSION['password'] = $row['password'];
		$_SESSION['jabatan'] = $row['jabatan'];
    $_SESSION['jatah_cuti'] = $row['jatah_cuti'];
	} 
	else{
		header('location:index.php?error');
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | NEURON</title>
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
	<div class="wrapper d-flex justify-content-center align-items-center">
		<div class="img-bg-wp"></div>
		<div class="wrapp-login rounded-2 d-flex row align-items-center">
			<div class="bg-texture"></div>
			<div class="input-field p-5">
				<h2 class="d-block text-center fw-bold mt-5">LOGIN</h2>
				<div class="input-group d-flex flex-column mt-5">
					<form method="POST">
					<div class="col mb-3">
						<label>NIP</label>
						<input type="text" name="nip" class="form-control fs border border-secondary rounded-3" required placeholder="Masukan NIP yang sesuai">
					</div>
					<div class="col mb-3">
						<label>Kata sandi</label>
						<input type="password" name="password" class="form-control fs border border-secondary rounded-3" required placeholder="Masukan kata sandi yang sesuai">
					</div>
					<div class="btn-wrapp">
						<input type="submit" name="login" class="btn btn-submit rounded-4 mt-4" value="Login">
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>

<?php 
if(isset($_GET['error'])){
  echo "<script type='text/javascript'>
			swal({
	  			title: 'Error',
	  			text: 'Maaf, NIP atau password anda tidak sesuai!',
	  			icon: 'error',
	  			button: 'OK',
			});
		</script>";
}
?>