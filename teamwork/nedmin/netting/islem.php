<?php 
ob_start();
session_start();
// DATABASE BAGLANMAK İÇİN İNCLUDE YAPIYORUZ.
include"baglan.php";
include"../production/fonksiyon.php";





if($_GET['panosil']=='ok')
{

	$sil=$db->prepare("DELETE from panolar where pano_id=:pano_id ");
	$kontrol=$sil->execute(	array(
		'pano_id' =>$_GET['pano_id']
	));
	if ($kontrol) {

		header("Location:../../panolar.php?panosildurum=ok");
		exit;
	}
	else{
		header("Location:../../panolar.php?panosildurum=no");
		exit;
	}

}





if($_GET['kartsil']=='ok')
{
	$liste_panoid=$_GET["liste_panoid"];

	$sil=$db->prepare("DELETE from kartlar where kart_id=:kart_id ");
	$kontrol=$sil->execute(	array(
		'kart_id' =>$_GET['kart_id']
	));
	if ($kontrol) {

		header("Location:../../pano.php?pano_id=$liste_panoid&kartsildurum=ok");
		exit;
	}
	else{
		header("Location:../../pano.php?pano_id=$liste_panoid&kartsildurum=no");
		exit;
	}

}






if($_GET['listesil']=='ok')
{
	$liste_panoid=$_GET["liste_panoid"];

	$sil=$db->prepare("DELETE from listeler where liste_id=:liste_id ");
	$kontrol=$sil->execute(	array(
		'liste_id' =>$_GET['liste_id']
	));
	if ($kontrol) {

		header("Location:../../pano.php?pano_id=$liste_panoid&listesildurum=ok");
		exit;
	}
	else{
		header("Location:../../pano.php?pano_id=$liste_panoid&listesildurum=no");
		exit;
	}

}


if(isset($_POST['hesapguncelle']) )
{			
	$uyekaydet=$db->prepare("UPDATE  uye set

		uye_ad=:uye_ad,
		uye_soyad=:uye_soyad

		where uye_id={$_POST['uye_id']}
		");

	$update=$uyekaydet->execute(array(

		'uye_ad'=> $_POST['uye_ad'],
		'uye_soyad'=> $_POST['uye_soyad']
	));

	if ($update) {
		header("Location:../../hesap.php?sifredurum=loginbasarili");
	}
	else
	{
		header("Location:../../hesap.php?sifredurum=basarisiz");
	}
}


if(isset($_POST['sifreguncelle']) )
{			

	// TRİM SAG VE SOLDAKİ BOSLUKLARI YOK SAYAR

	$uye_passwordeski=trim($_POST['uye_passwordeski']);
	$uye_passwordone= trim($_POST['uye_passwordone']);
	$uye_passwordtwo= trim($_POST['uye_passwordtwo']);


	$uye_password=md5($uye_passwordeski);

	$uyesor=$db->prepare("SELECT * from uye where uye_password=:uye_password and uye_id=:uye_id");
	$uyesor->execute(array(
		'uye_password' => $uye_password,
		'uye_id' => $_POST["uye_id"]
	));
	$say=$uyesor->rowCount();

	if ($say==0) {
		header("Location:../../hesap.php?sifredurum=eskisifrehata");
	}
	else {


		if ($uye_passwordone==$uye_passwordtwo)
		{

			if (strlen($uye_passwordone)>=6)
			{
				//başlangıç


					//md5 algoritmasına çevirir
				$password=md5($uye_passwordone);




				$uyekaydet=$db->prepare("UPDATE  uye set

					uye_password=:uye_password,
					uye_sifre=:uye_sifre

					where uye_id={$_POST['uye_id']}
					");

				$update=$uyekaydet->execute(array(
					
					'uye_password'=> $password,
					'uye_sifre'=> $uye_passwordone
				));

				if ($update) {
					header("Location:../../hesap.php?sifredurum=loginbasarili");
				}
				else
				{
					header("Location:../../hesap.php?sifredurum=basarisiz");
				}

				

				//bitiş
				
			}
			else{
				header("Location:../../hesap.php?sifredurum=eksiksifre");	
			}
			


		}
		else{
			header("Location:../../hesap.php?sifredurum=farklisifre");

		}


	}






} 


if($_GET['ekiptenayril']=='ok')
{

	$sil=$db->prepare("DELETE from ekipuyeleri where ekip_id=:ekip_id and uye_id=:uye_id");
	$kontrol=$sil->execute(	array(
		'ekip_id' =>$_GET['ekip_id'],
		'uye_id' =>$_GET['uye_id']
	));
	if ($kontrol) {

		header("Location:../../panolar.php?durum=ok");
		exit;
	}
	else{
		header("Location:../../panolar.php?durum=no");
		exit;
	}

}


if($_GET['ekipuyesil']=='ok')
{
	$ekip_id=$_GET['ekip_id'];

	$sil=$db->prepare("DELETE from ekipuyeleri where ekip_id=:ekip_id and uye_id=:uye_id");
	$kontrol=$sil->execute(	array(
		'ekip_id' =>$_GET['ekip_id'],
		'uye_id' =>$_GET['uye_id']
	));




	if ($kontrol) {

		header("Location:../../ekipler.php?ekip_id=$ekip_id&durum=ok");
		exit;
	}
	else{
		header("Location:../../ekipler.php?ekip_id=$ekip_id&durum=no");
		exit;
	}

}

if($_GET['ekipsil']=='ok')
{
	
	$sil=$db->prepare("DELETE from ekipler where ekip_id=:id");
	$kontrol=$sil->execute(	array(
		'id' =>$_GET['ekip_id']));

	if ($kontrol) {

		header("Location:../../panolar.php?durum=ok");
		exit;
	}
	else{
		header("Location:../../panolar.php?durum=no");
		exit;
	}

}


if(isset($_POST['davetet']))
{


	$ekipsor=$db->prepare("SELECT * from ekipler where  ekip_id=:ekip_id ");
	$ekipsor->execute(array(
		'ekip_id' => $_POST['ekip_id']
	));

	$ekipcek=$ekipsor->fetch(PDO::FETCH_ASSOC);


	$say=0;
	$uyesor=$db->prepare("SELECT * from uye where uye_mail=:uye_mail");
	$uyesor->execute(
		array('uye_mail'=> $_POST['uye_mail']));
	$uyecek=$uyesor->fetch(PDO::FETCH_ASSOC);

	$ekipuyelerisor=$db->prepare("SELECT * from ekipuyeleri where  uye_id=:uye_id and ekip_id=:ekip_id");
	$ekipuyelerisor->execute(array(
		'uye_id' => $uyecek['uye_id'],
		'ekip_id' => $_POST['ekip_id']

	));

	$say=$ekipuyelerisor->rowCount();

	if($uyecek['uye_id']==$ekipcek['ekip_yoneticiid'])
	{
		$say++;
	}
	$ekip_id=$_POST['ekip_id'];


	if($say==0)
	{

		$ekipuyekaydet=$db->prepare("INSERT INTO ekipuyeleri set
			ekip_id=:ekip_id,
			uye_id=:uye_id					
			");

		$insert=$ekipuyekaydet->execute(array(
			'ekip_id' => $_POST['ekip_id'],
			'uye_id' => $uyecek['uye_id']		
		));

		if ($insert) {
			header("Location:../../ekipler.php?ekip_id=$ekip_id&davetdurum=ok");
			exit;
		}
		else{
			header("Location:../../ekipler.php?ekip_id=$ekip_id&davetdurum=no");
			exit;
		}

	}
	else{
		header("Location:../../ekipler.php?ekip_id=$ekip_id&davetdurum=mukerrerkayit");
		exit;
	}

}


if(isset($_POST['ekipolustur']))
{

	$ekipkaydet=$db->prepare("INSERT INTO ekipler set
		ekip_ad=:ekip_ad,
		ekip_aciklama=:ekip_aciklama,
		ekip_yoneticiid=:ekip_yoneticiid					
		");

	$insert=$ekipkaydet->execute(array(
		'ekip_ad' => $_POST['ekip_ad'],
		'ekip_aciklama' => $_POST['ekip_aciklama'],
		'ekip_yoneticiid' => $_POST['ekip_yoneticiid']			
	));




	if ($insert) {
		header("Location:../../panolar.php?durum=ok");
		exit;
	}
	else{
		header("Location:../../panolar.php?durum=no");
		exit;
	}

}






if(isset($_POST['panoduzenle']) )
{
	$pano_id=$_POST['pano_id'];
	$ayarkaydet=$db->prepare("UPDATE panolar set
		pano_ad=:pano_ad,
		pano_aciklama=:pano_aciklama,
		pano_arkaplan=:pano_arkaplan,
		pano_link=:pano_link,
		pano_ekipid=:pano_ekipid,
		pano_yoneticiid=:pano_yoneticiid
		where pano_id={$_POST['pano_id']}");

	$update=$ayarkaydet->execute(array(
		'pano_ad'=> $_POST['pano_ad'],
		'pano_aciklama'=> $_POST['pano_aciklama'],
		'pano_arkaplan'=> $_POST['pano_arkaplan'],
		'pano_link'=> $_POST['pano_link'],
		'pano_ekipid'=> $_POST['pano_ekipid'],
		'pano_yoneticiid'=> $_POST['pano_yoneticiid']
	));
	

	if ($update) {
		header("Location:../../pano.php?pano_id=$pano_id");
		exit;
	}
	else{
		header("Location:../../pano.php?pano_id=$pano_id");
		exit;
	}

} 





$yorum_icerik_kartid_uyeid = $_GET["yorum_icerik_kartid_uyeid"];
$dilimler=explode("/",$yorum_icerik_kartid_uyeid);
$yorum_icerik=$dilimler[0];
$yorum_kartid=$dilimler[1];
$yorum_uyeid=$dilimler[2];

$yorumkaydet=$db->prepare("INSERT INTO yorum set
	yorum_kartid=:yorum_kartid,
	yorum_uyeid=:yorum_uyeid,
	yorum_icerik=:yorum_icerik
	");

$insert=$yorumkaydet->execute(array(
	'yorum_kartid' => $yorum_kartid,
	'yorum_uyeid' => $yorum_uyeid,
	'yorum_icerik' => $yorum_icerik

));



if(isset($_POST['kartduzenle']) )
{
	$pano_id=$_POST['pano_id'];
	$ayarkaydet=$db->prepare("UPDATE kartlar set
		kart_ad=:kart_ad,
		kart_aciklama=:kart_aciklama,
		kart_baslangictarih=:kart_baslangictarih,
		kart_bitistarih=:kart_bitistarih,
		kart_kapak=:kart_kapak
		where kart_id={$_POST['kart_id']}");

	$update=$ayarkaydet->execute(array(
		'kart_ad'=> $_POST['kart_ad'],
		'kart_aciklama'=> $_POST['kart_aciklama'],
		'kart_baslangictarih'=> $_POST['kart_baslangictarih'],
		'kart_bitistarih'=> $_POST['kart_bitistarih'],
		'kart_kapak'=> $_POST['kart_kapak']
	));
	

	if ($update) {
		header("Location:../../pano.php?pano_id=$pano_id&durum=ok");
		exit;
	}
	else{
		header("Location:../../pano.php?pano_id=$pano_id&durum=no");
		exit;
	}

} 



if(isset($_POST['panoolustur']) )
{

	$panokaydet=$db->prepare("INSERT INTO panolar set
		pano_ad=:pano_ad,
		pano_aciklama=:pano_aciklama,
		pano_arkaplan=:pano_arkaplan,
		pano_ekipid=:pano_ekipid,
		pano_yoneticiid=:pano_yoneticiid

		");

	$insert=$panokaydet->execute(array(
		'pano_ad' => $_POST['pano_ad'],
		'pano_aciklama' => $_POST['pano_aciklama'],
		'pano_arkaplan' => $_POST['pano_arkaplan'],
		'pano_ekipid' => $_POST['pano_ekipid'],
		'pano_yoneticiid' => $_POST['pano_yoneticiid']



	));


	if ($insert) {
		header("Location:../../panolar.php?durum=ok");
		exit;
	}
	else{
		header("Location:../../panolar.php?durum=no");
		exit;
	}

} 


/////////////////liste ekleme//////////////////////////////////////////////
$liste_ad_panoid_sira = $_GET["liste_ad_panoid_sira"];
$dilimler=explode("/",$liste_ad_panoid_sira);
$liste_ad=$dilimler[0];
$liste_panoid=$dilimler[1];
$liste_sira=$dilimler[2];

$listekaydet=$db->prepare("INSERT INTO listeler set
	liste_ad=:liste_ad,
	liste_panoid=:liste_panoid,
	liste_sira=:liste_sira
	");

$insert=$listekaydet->execute(array(
	'liste_ad' => $liste_ad,
	'liste_panoid' => $liste_panoid,
	'liste_sira' => $liste_sira

));



///////////kart ekleme////////////////////////////////////////////////////////
$ad_aciklama_id_baslangictrh_bitistrh = $_GET["ad_aciklama_id_baslangictrh_bitistrh"];

$dilimler=explode("/",$ad_aciklama_id_baslangictrh_bitistrh);
$kart_ad=$dilimler[0];
$kart_aciklama=$dilimler[1];
$kart_listeid=$dilimler[2];
$kart_baslangictarih=$dilimler[3];
$kart_bitistarih=$dilimler[4];



$kartkaydet=$db->prepare("INSERT INTO kartlar set
	kart_ad=:kart_ad,
	kart_aciklama=:kart_aciklama,
	kart_listeid=:kart_listeid,
	kart_baslangictarih=:kart_baslangictarih,
	kart_bitistarih=:kart_bitistarih

	");

$insert=$kartkaydet->execute(array(
	'kart_ad' => $kart_ad,
	'kart_aciklama' => $kart_aciklama,
	'kart_listeid' => $kart_listeid,
	'kart_baslangictarih' => $kart_baslangictarih,
	'kart_bitistarih' => $kart_bitistarih

));



/////////////////////////////////////////////////////////////////////

////////////////////kart sıra güncelleme    

if($_POST["kartupdate"] == "kartupdate"){

	$dizi = $_POST["kartid"];
	$kart_listeid = $_GET["kart_listeid"];
	$dilimler=explode("-", $kart_listeid);
	$kart_listeid=$dilimler[1];


	$say = 1;


	foreach($dizi as $idler){


		$ayarkaydet=$db->prepare("UPDATE kartlar set
			kart_sira=:kart_sira,
			kart_listeid=:kart_listeid

			where kart_id=$idler");

		$update=$ayarkaydet->execute(array(
			'kart_sira'=> $say,
			'kart_listeid'=> $kart_listeid

		));

		$say++;

	}




	echo 'guncelleme basarılı';

}

/////////////////////////////////////////




////////////////////liste sıra güncelleme    

if($_POST["listupdate"] == "listupdate"){


	$dizi = $_POST["listeid"];
	$say = 1;


	foreach($dizi as $idler){



		$ayarkaydet=$db->prepare("UPDATE listeler set
			liste_sira=:liste_sira

			where liste_id=$idler");

		$update=$ayarkaydet->execute(array(
			'liste_sira'=> $say

		));
		$say++;
	}


	echo 'guncelleme basarılı';

}

/////////////////////////////////////////


if(isset($_POST['uyekaydet']) )
{
	$uye_ad=htmlspecialchars($_POST['uye_ad']);
	$uye_soyad=htmlspecialchars($_POST['uye_soyad']);
	$uye_mail=htmlspecialchars($_POST['uye_mail']);
	$uye_passwordone= $_POST['uye_passwordone'];
	$uye_passwordtwo= $_POST['uye_passwordtwo'];



	if ($uye_passwordone==$uye_passwordtwo)
	{

		if (strlen($uye_passwordone)>=6)
		{
			//başlangıç



			$uyesor=$db->prepare("SELECT * from uye where uye_mail=:mail");
			$uyesor->execute(array(
				'mail' => $uye_mail ));
			//dönen satır sayısını verir sıfır ise hiç donmemiştir yanı böylece bulunan kullanıcı iki kez kayıt yapamaz.
			$say=$uyesor->rowCount();



			if($say==0)
			{

				//md5 algoritmasına çevirir
				$password=md5($uye_passwordone);
				$uye_yetki=1;


				//kullanıcı kayıt işlemi yapılan bolum
				$uyekaydet=$db->prepare("INSERT INTO uye set
					uye_ad=:uye_ad,
					uye_soyad=:uye_soyad,
					uye_mail=:uye_mail,
					uye_password=:uye_password,
					uye_sifre=:uye_sifre,
					uye_yetki=:uye_yetki
					");

				$insert=$uyekaydet->execute(array(
					'uye_ad' => $uye_ad,
					'uye_soyad' => $uye_soyad,
					'uye_mail' => $uye_mail,
					'uye_password' => $password,
					'uye_sifre' => $uye_passwordone,
					'uye_yetki' => $uye_yetki
				));






				if ($insert) {
					header("Location:../../kaydol.php?durum=loginbasarili");
				}
				else
				{
					header("Location:../../kaydol.php?durum=basarisiz");
				}



			}
			else{
				header("Location:../../kaydol.php?durum=mukerrerkayit");
			}



	//bitiş

		}
		else{
			header("Location:../../kaydol.php?durum=eksiksifre");	
		}



	}
	else
	{
		header("Location:../../kaydol.php?durum=farklisifre");

	}

} 

//  Girisyap Bölümü--------------------------------------------------

if (isset($_POST['girisyap'])) {



	$uye_mail=htmlspecialchars($_POST['uye_mail']); 
	$uye_password=md5($_POST['uye_password']); 



	$uyesor=$db->prepare("SELECT * from uye where uye_mail=:mail and uye_yetki=:yetki and uye_password=:password and uye_durum=:durum");
	$uyesor->execute(array(
		'mail' => $uye_mail,
		'yetki' => 1,
		'password' => $uye_password,
		'durum' => 1
	));


	$say=$uyesor->rowCount();



	if ($say==1) {

		echo $_SESSION['useruye_mail']=$uye_mail;

		header("Location:../../panolar.php");
		exit;





	} else {


		header("Location:../../login.php?durum=basarisizgiris");

	}


}
//  Girisyap Bölümü Bitiş--------------------------------------------------
