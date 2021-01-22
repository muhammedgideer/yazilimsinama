<?php include'header.php';  ?>
<style type="text/css">
	body{
		background-image: url();

	}
	.menu{
		background-color: #026AA7;

	</style>
	<div  class="container">
		<div class="row">
			

			<div class="col-md-4">

				<div class="card" style="width: 18rem;">
					<ul class="list-group list-group-flush">
						<li class="list-group-item bg-dark"><a style="text-decoration: none;color: white;" href="hesap.php"><strong><i class="fa fa-home"></i> Hesap</strong></a></li>
						<li class="list-group-item"><a style="text-decoration: none;color: black;" href="panolar.php"><strong><i class="fa fa-th-large"></i> Panolar</strong></a></li>
						<li class="list-group-item"><a style="text-decoration: none;color: black;" ><strong><i class="fa fa-handshake-o"></i> Ekipler</strong></a></li>

						<?php  
						
						$ekipsor=$db->prepare("SELECT * from ekipler where  ekip_yoneticiid=:ekip_yoneticiid ");
						$ekipsor->execute(array(
							'ekip_yoneticiid' => $uyecek['uye_id']
						));

						while($ekipcek=$ekipsor->fetch(PDO::FETCH_ASSOC)){  ?>
							<li class="list-group-item  "><a style="text-decoration: none;color: black;" href="ekipler.php?ekip_id=<?php echo  $ekipcek['ekip_id']; ?>"><?php echo $ekipcek['ekip_ad'];?></a></li>
						<?php } ?>



						<?php 

						$ekipuyelerisor=$db->prepare("SELECT * from ekipuyeleri where  uye_id=:uye_id ");
						$ekipuyelerisor->execute(array(
							'uye_id' => $girisyapan_uyeid
						));
						while($ekipuyelericek=$ekipuyelerisor->fetch(PDO::FETCH_ASSOC))
							{?>
								<?php  
								$ekipsor=$db->prepare("SELECT * from ekipler where  ekip_id=:ekip_id ");
								$ekipsor->execute(array(
									'ekip_id' => $ekipuyelericek['ekip_id']
								));

								while($ekipcek=$ekipsor->fetch(PDO::FETCH_ASSOC)){?>

									<li class="list-group-item  "><a style="text-decoration: none;color: black;" href="ekipler.php?ekip_id=<?php echo  $ekipcek['ekip_id']; ?>"><?php echo $ekipcek['ekip_ad'];?></a></li>
									<?php ; } ?>

								<?php } ?>
							</ul>
						</div>

					</div>

					<div class="col-md-8">
						<div align="center" style="height: 120px;background-color: lightgrey;" >	
							<h3 style="padding: 30px;"> <?php echo strtoupper($girisyapan_uyead." ".$girisyapan_uyesoyad)  ?></h3>
							<p style="margin-top: -20px;"><strong><?php echo $girisyapan_uyemail ?>

						</strong></p>

					</div>
					<hr>

					<div>
						<form action="nedmin/netting/islem.php" method="POST">
						<hr>
						<h3><i class="fa fa-user"></i> Hesap Ayarları</h3>
						<small><?php 

                              if (isset($_GET['sifredurum']) && $_GET['sifredurum']=="farklisifre") {?>

                                   <div class="alert alert-danger">
                                        <strong>Hata!</strong> Girdiğiniz şifreler eşleşmiyor.
                                   </div>

                              <?php } elseif  (isset($_GET['sifredurum']) && $_GET['sifredurum']=="eksiksifre") {?>

                                   <div class="alert alert-danger">
                                        <strong>Hata!</strong> Şifreniz minimum 6 karakter uzunluğunda olmalıdır.
                                   </div>

                              <?php } elseif  (isset($_GET['sifredurum']) && $_GET['sifredurum']=="eksiksifrehata") {?>

                                   <div class="alert alert-danger">
                                        <strong>Hata!</strong> Bu eski şifre yanlış girildi.
                                   </div>

                              <?php } elseif  (isset($_GET['sifredurum']) && $_GET['sifredurum']=="basarisiz") {?>

                                   <div class="alert alert-danger">
                                        <strong>Hata!</strong> Sistem Yöneticisine Danışınız.
                                   </div>
                              <?php } elseif  (isset($_GET['sifredurum']) && $_GET['sifredurum']=="loginbasarili") {?>

                                   <div class="alert alert-success">
                                        <strong>Tamamlandı!</strong> Şifreniz değiştirildi.
                                   </div>

                              <?php }
                              ?></small>
						<hr>
						<input type="hidden" name="uye_id" value="<?php echo $girisyapan_uyeid ?>">
						<input class="form-control" type="email" disabled="" name="uye_mail" value="<?php echo $girisyapan_uyemail ?>">
						<br>
						<input class="form-control" type="text" name="uye_ad" value="<?php echo strtoupper($girisyapan_uyead) ?> " placeholder="Üye ad giriniz">
						<br>
						<input class="form-control" type="text" name="uye_soyad" value="<?php echo strtoupper($girisyapan_uyesoyad) ?>" placeholder="Üye soyad giriniz">
						<br>
						<button style="float: right;" class="btn btn-success" type="submit" name="hesapguncelle">Hesap Güncelle</button>
						</form>
						<br>
						<h3>Şifre Değiştir</h3>
						<hr>

						<form action="nedmin/netting/islem.php" method="POST">
						<input type="hidden" name="uye_id" value="<?php echo $girisyapan_uyeid ?>">

						<input class="form-control" type="password" name="uye_passwordeski"  placeholder="Eski şifrenizi giriniz">
						<br>
						<input class="form-control" type="password" name="uye_passwordone"  placeholder="Yeni şifre giriniz">
						<br>
						<input class="form-control" type="password" name="uye_passwordtwo"  placeholder="Yeni şifre tekrar giriniz">
						<br>

						<button style="float: right;" class="btn btn-success" type="submit" name="sifreguncelle">Şifre Güncelle</button>
					</form>
					</div>


				</div>

			</div>
		</div>