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
						<li class="list-group-item"><a style="text-decoration: none;color: black;" href="hesap.php"><strong><i class="fa fa-home"></i> Hesap</strong></a></li>
						<li class="list-group-item bg-dark"><a style="text-decoration: none;color: white;" href="panolar.php"><strong><i class="fa fa-th-large"></i> Panolar</strong></a></li>
						<li class="list-group-item"><a style="text-decoration: none;color: black;"><strong><i class="fa fa-handshake-o"></i> Ekipler</strong></a></li>

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
						<div class="row">	
							<h3><i class="fa fa-user"></i> Kişisel Panolarım</h3>
							<hr>


							<?php 


							$kisiselpanosor=$db->prepare("SELECT * FROM panolar where pano_ekipid=:pano_ekipid and pano_yoneticiid=:pano_yoneticiid");
							$kisiselpanosor->execute(array(
								'pano_ekipid' => 0,
								'pano_yoneticiid' => $uyecek['uye_id']

							));
							while($kisiselpanocek=$kisiselpanosor->fetch(PDO::FETCH_ASSOC)) {?>

								<div class="panokart col-md-4">

									<a href="pano.php?pano_id=<?php echo $kisiselpanocek['pano_id']; ?>"><p style="background-image: url(images/panokapak/<?php echo $kisiselpanocek['pano_arkaplan']; ?>.png);" ><strong><?php echo $kisiselpanocek['pano_ad']; ?></strong></p></a>

								</div>






							<?php } ?>

						</div>


						<div class="row">
							<hr>
							<h3><i class="fa fa-th-large"></i> Panolarım</h3>
							<hr>


							<?php 
							while($panocek=$panosor->fetch(PDO::FETCH_ASSOC)) {?>

								<div class="panokart col-md-4">

									<a href="pano.php?pano_id=<?php echo $panocek['pano_id']; ?>"><p style="background-image: url(images/panokapak/<?php echo $panocek['pano_arkaplan']; ?>.png);" ><strong><?php echo $panocek['pano_ad']; ?></strong></p></a>

								</div>






							<?php } ?>


						</div>

						<div class="row">
							<hr>
							<h3><i class="fa fa-th-large"></i> Ekip Panoları </h3>
							<hr>
							<div class="row">
								<?php 
								$ekipuyelerisor=$db->prepare("SELECT * from ekipuyeleri where  uye_id=:uye_id ");
								$ekipuyelerisor->execute(array(
									'uye_id' => $girisyapan_uyeid
								));
								while($ekipuyelericek=$ekipuyelerisor->fetch(PDO::FETCH_ASSOC))
								{

									$panosor=$db->prepare("SELECT * FROM panolar where pano_ekipid=:pano_ekipid");
									$panosor->execute(array(
										'pano_ekipid' => $ekipuyelericek['ekip_id']
									));

									while($panocek=$panosor->fetch(PDO::FETCH_ASSOC)) {?>

										<div class="panokart col-md-4">

											<a href="pano.php?pano_id=<?php echo $panocek['pano_id']; ?>"><p style="background-image: url(images/panokapak/<?php echo $panocek['pano_arkaplan']; ?>.png);" ><strong><?php echo $panocek['pano_ad']; ?></strong></p></a>

										</div>



									<?php } ?>
								<?php } ?>

							</div>

						</div>






					</div>

				</div>
			</div>