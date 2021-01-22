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
						<div align="center" style="height: 100px;background-color: lightgrey;" >	
							<h3 style="padding: 30px;"> Bilgi Sayfası</h3>
							<br>
							<div align="left">
							<h5>Başlangıç</h5>
							<hr>
							<p>İlk kayıt olup giriş yaptığınızda herhangi bir panonuz ya da ekibiniz bulunmayazaktır.</p><hr>
							<p>İlk panonuzu ya da  ekibinizi üst ana menüden ekle kısmından ekleyebilirsiniz. </p><hr>
							<p>Sol kısımdaki sidebar da oluşturan ekipler ve üye olduğunuz ekipler bulunmakta.Bu ekiplere basarak üyelerini ve panolarını görebilirsiniz.</p><hr>
							<p>Eğer ekip size ait ise ekibi ya da üyeleri silebilirsiniz</p><hr>
							<p>Eğer ekibe üye iseniz ekipten ayrılabilirsiniz</p><hr>
							<p>Ekipler sayfasının üst bölümündeki boş kutucuğa üyenin email'ini yazarak arkadaşlarınızı davet edebilirsiniz</p><hr>
							<p>Hesabınıza ait bilgileri hesap kısmına görebilirsiniz.</p><hr>
							<p>Panolar bölümünde size ait olan panolar kişisel panolar bölümü altında, kurucusu siz olan ekiplerinizin panoları ve kişisel panolarınız panolarım bölümünün altında ve son olarak başka kişilerin kurucusu olduğu  ve sizin o ekibe üye olduğunuz ekibin panoları ekip panoları kısmında görünecektir. </p><hr>
							<p>Üst menüde olan çıkış butonuyla çıkış yapabilirsiniz</p><hr>
							<p>eklenilen panoların üstüne basarak panoya giriş yapabilirsiniz ve o panoya pano sayfasından liste kart  ekleyebilirsiniz.</p><hr>
							<p>Sağ tarafta bulunan menüyü göster butonuyla sağdan açılan bir pencereden panoyu düzenleye bilirsiniz </p><hr>
							<p>Panoya kart eklerken kart adı kart açıklaması ve kart başlangıç-bitiş tarihleriniz yazmanız zorunludur aksi taktirde kartınız oluşturulmayacaktır.</p><hr>
							<p>kart tarihlerinin alınması projenin tahmini bitiş süresini hesaplar.Bu yukardaki bölümde yazılır.</p><hr>
							<p>Pano sayfasında üst bölümde pano adı, hangi ekibe bağlısa ekip adı ve tahmini kalan gün sayısı  yazılır.</p><hr>
							<p>eğer kart üzerine tıklanırsa kart düzenle ekranı çıkar. Bu ekrandan kartınızı düzenleyebilirsiniz.</p><hr>
							<p>Kartınıza yorum yapabilirsiniz ya da arkadaşlarınızın yaptığı yorumları görebilirsiniz.</p><hr>
							<p>Eğer bir panoyu silerseniz o panoya ait herşeyi silmiş olursunuz.</p><hr>
							<p>Eğer bir listeyi silerseniz o listeye ait tüm kartları silmiş olursunuz.</p><hr>
							<p>Eğer bir kartı silerseniz o karta ait bilgileri ve yorumları silmiş olursunuz.</p>
							</div><hr>
							<br>
							<br>

					</div>
					<hr>



				</div>

			</div>
		</div>