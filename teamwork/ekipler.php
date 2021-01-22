<?php include'header.php';  ?>
<style type="text/css">
	body{
		background-image: url();

	}
	.menu{
		background-color: #026AA7;

	</style>
	<div class="container">
		<div class="row">
			

			<div class="col-md-4">

				<div class="card" style="width: 18rem;">
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><a style="text-decoration: none;color: black;" href="hesap.php"><strong><i class="fa fa-home"></i> Hesap</strong></a></li>
						<li class="list-group-item "><a style="text-decoration: none;color: black;" href="panolar.php"><strong><i class="fa fa-th-large"></i> Panolar</strong></a></li>
						<li class="list-group-item bg-dark"><a style="text-decoration: none;color: white;" ><strong><i class="fa fa-handshake-o"></i> Ekiplerim</strong></a></li>


						<?php  
						
						$ekipsor=$db->prepare("SELECT * from ekipler where  ekip_yoneticiid=:ekip_yoneticiid ");
						$ekipsor->execute(array(
							'ekip_yoneticiid' => $uyecek['uye_id']
						));

						while($ekipcek=$ekipsor->fetch(PDO::FETCH_ASSOC)){  ?>
							<li class="list-group-item  "><a style="text-decoration: none;color: black;" href="ekipler.php?ekip_id=<?php echo  $ekipcek['ekip_id']; ?>"><?php echo $ekipcek['ekip_ad'];?></a></li>
						<?php } ?>

<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////-->

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

			<?php 
			$ekipsor=$db->prepare("SELECT * from ekipler where  ekip_id=:ekip_id");
			$ekipsor->execute(array(
				'ekip_id' => $_GET['ekip_id']
			));
			$ekipcek=$ekipsor->fetch(PDO::FETCH_ASSOC);
			?>

	
			<div class="col-md-8">


				<div class="row">
					<small><?php 

					if  (isset($_GET['davetdurum']) && $_GET['davetdurum']=="ok")  {?>

						<div class="alert alert-success">
							<strong>Üye Davet Edildi.</strong>
						</div>

					<?php } 

					else if (isset($_GET['davetdurum']) && $_GET['davetdurum']=="no")  {?>

						<div class="alert alert-danger">
							<strong>Hata!</strong>Bir Sorun Oluştu.
						</div>

					<?php } 
					else if (isset($_GET['davetdurum']) && $_GET['davetdurum']=="mukerrerkayit")  {?>

						<div class="alert alert-warning">
							<strong>Bu üye zaten ekipte..</strong>.
						</div>

					<?php } ?>
				</small>
				<div class="col-md-4"><h3><?php echo $ekipcek['ekip_ad']; ?></h3></div>

				<div class="col-md-6">
					<form action="nedmin/netting/islem.php" method="POST">
						<input class="form-control" type="email" required="" placeholder="Davet etmek istediğiniz kullanıcının e-mailini giriniz" name="uye_mail"></div>
						<input type="hidden" name="ekip_id" value="<?php echo $ekipcek['ekip_id']; ?>">


						<div class="col-md-2"><button class="btn btn-success" name="davetet" type="submit">Davet Et</button> 
						</form>



					</div>

<br>

					<br>

					<div class="row">
						<hr>
						<h3><i class="fa fa-th-large"></i> Ekip Panoları </h3>
						<hr>
						<div class="row">
							<?php 

							$panosor=$db->prepare("SELECT * FROM panolar where pano_ekipid=:pano_ekipid");
							$panosor->execute(array(
								'pano_ekipid' => $_GET['ekip_id']
							));

							while($panocek=$panosor->fetch(PDO::FETCH_ASSOC)) {?>

								<div class="panokart col-md-4">

									<a href="pano.php?pano_id=<?php echo $panocek['pano_id']; ?>"><p style="background-image: url(images/panokapak/<?php echo $panocek['pano_arkaplan']; ?>.png);" ><strong><?php echo $panocek['pano_ad']; ?></strong></p></a>

								</div>



							<?php } ?>
						</div>

					</div>


					<div  class="row">
						<hr>
						<h3><i class="fa fa-user"></i> Ekip Üyeleri
							<hr>
							<?php $uyesor=$db->prepare("SELECT * from uye where uye_id=:uye_id");
							$uyesor->execute(array(
								'uye_id'=>$ekipcek['ekip_yoneticiid']
							));
							$uyecek=$uyesor->fetch(PDO::FETCH_ASSOC);

								?>
								<div style="font-size: 18px;"  class="row">
									<div class="col-md-4"><p><?php echo $uyecek['uye_ad']." ".$uyecek['uye_soyad'] ;?></p></div>
									<div class="col-md-4"><p>Yönetici</p></div>
									<div class="col-md-4">
										<?php if($ekipcek['ekip_yoneticiid']==$girisyapan_uyeid){ ?>
										<a  href="nedmin/netting/islem.php?ekip_id=<?php echo $ekipcek['ekip_id']; ?>&ekipsil=ok" class="btn btn-danger">Ekibi Sil</a>
									<?php } ?>
									</div>
								</div>

								<hr>


							
							 
							 
					

							<?php 
							$ekipuyelerisor=$db->prepare("SELECT * from ekipuyeleri where  ekip_id=:ekip_id ");
							$ekipuyelerisor->execute(array(
								'ekip_id' => $_GET['ekip_id']
							));
							while($ekipuyelericek=$ekipuyelerisor->fetch(PDO::FETCH_ASSOC))
							{
								$uyesor=$db->prepare("SELECT * from uye where uye_id=:uye_id");
								$uyesor->execute(
									array('uye_id'=>$ekipuyelericek['uye_id']));

									while($uyecek=$uyesor->fetch(PDO::FETCH_ASSOC)){?>
										<!--/////////////////////////////////////////////////////////////////-->	
										<?php if($ekipcek['ekip_yoneticiid']==$girisyapan_uyeid){ ?>

										<div style="font-size: 18px;" class="row">
											<div class="col-md-4"><p><?php echo $uyecek['uye_ad']." ".$uyecek['uye_soyad'] ;?></p></div>
											<div class="col-md-4"><p>Üye</p></div>
											<div class="col-md-4"><a href="nedmin/netting/islem.php?ekip_id=<?php echo $_GET['ekip_id'];?>&uye_id=<?php echo $uyecek['uye_id'];?>&ekipuyesil=ok" class="btn btn-danger btn-lg">Sil</a> </div>

										</div>
										<hr>
									<?php } else {?>
										<div style="font-size: 18px;" class="row">
											<div class="col-md-4"><p><?php echo $uyecek['uye_ad']." ".$uyecek['uye_soyad'] ;?></p></div>
											<div class="col-md-4"><p>Üye</p></div>
											<div class="col-md-4">
												<?php 
											if($uyecek['uye_id']==$girisyapan_uyeid){?>
												
												 <a   href="nedmin/netting/islem.php?ekip_id=<?php echo $ekipcek['ekip_id'];?>&uye_id=<?php echo $girisyapan_uyeid;?>&ekiptenayril=ok" class="btn btn-danger">Ekipten Ayrıl</a>
												<?php } ?>
											</div>

										</div>
										<hr>
									<?php } ?>

									   <!--////////////////////////////////////////////////////////////////-->	

									<?php }?>



								<?php } ?>
							</div>
						</div>
					


					</div>
				</div>