<?php include 'header.php'; 

  
date_default_timezone_set('Europe/Istanbul');

$panosor=$db->prepare("SELECT * FROM panolar where pano_id=:pano_id");
$panosor->execute(array(
  'pano_id' =>$_GET['pano_id'] 
));
$panocek=$panosor->fetch(PDO::FETCH_ASSOC);


?>


<style type="text/css">
  body{
    background: url(images/panokapak/<?php echo $panocek['pano_arkaplan'];?>.png) ;
    background-size: 100%;

  }
  .menu{
    background-color: #026AA7;

  </style>
  <!-- ////////////////////////////////////////////////////pano duzenle bolumu başlangıç////////////////////////////////////////////////////////////////////////////  -->

  <div id="mySidenav" class="sidenav">
    <div class="row">
      <h3 align="center">Menü</h3>
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa fa-times"></i></a>
    </div>
    <hr>
    
    <form action="nedmin/netting/islem.php" method="POST" >
      <a id="panoduzenle">Pano Düzenle</a>
      <hr>
      <div id="panoduzenlediv">
        <input class="form-control" type="text" required="" name="pano_ad"  value="<?php echo $panocek['pano_ad']; ?>">
        <input class="form-control" type="text" required=""  name="pano_aciklama"  value="<?php echo $panocek['pano_aciklama']; ?>">
        <input class="form-control" type="hidden" name="pano_id" value="<?php echo $panocek['pano_id']; ?>">
        <input class="form-control" type="hidden" name="pano_yoneticiid" value="<?php echo $panocek['pano_yoneticiid']; ?>">


        <hr>
        <h6>Arkaplan Seçiniz</h6>
        <hr>
        <?php for ($i=0; $i < 20 ; $i++) { ?>

         <label>
          <input class="photo-input" name="pano_arkaplan" <?php echo $panocek['pano_arkaplan']==($i+1) ?"checked":" "; ?> type="radio" value='<?php echo $i+1 ?>' >
          <img class="circle-corners" src="images/panokapak/<?php echo $i+1 ?>.png">
        </label>
        
      <?php } ?>

      <hr>
      
      <h6>Ekip Seçiniz</h6>

      <select class="form-select" aria-label="Default select example" name="pano_ekipid" required>
        <option value="0" >Kişisel</option>
        <?php 
        $ekipsor=$db->prepare("SELECT * from ekipler where  ekip_yoneticiid=:ekip_yoneticiid ");
        $ekipsor->execute(array(
         'ekip_yoneticiid' => $uyecek['uye_id']
       ));
       while($ekipcek=$ekipsor->fetch(PDO::FETCH_ASSOC)){  ?>

        <option value="<?php echo $ekipcek['ekip_id']; ?>" ><?php echo $ekipcek['ekip_ad']; ?></option>
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

            <option value="<?php echo $ekipcek['ekip_id']; ?>" ><?php echo $ekipcek['ekip_ad']; ?></option>
            <?php ; } ?>

          <?php } ?>
        </select>

        <br>
        <button style="width: 95%" class="btn btn-success" type="submit" name="panoduzenle">Pano Düzenle</button>
        <br>
        <br>
        <a style="width: 95%" class="btn btn-success" href="nedmin/netting/islem.php?pano_id=<?php echo $panocek['pano_id'];?>&panosil=ok">Pano Sil</a>




      </div>
    </form>

    <style >
      #listesildiv{
        display: none;
      }
    </style>

    <script type="text/javascript">
      $("#panoduzenle").click(function(){
       $("#panoduzenlediv").toggle(300);
     });

      function listeSil(){


       alert("Listeniz silindi");
     }



   </script>

   <!-- ////////////////////////////////////////////////////pano duzenle bolumu bitiş////////////////////////////////////////////////////////////////////////////  -->

 </div>
 <div class="row">
  <div class="col-md-8" align="left">

    <button style="background-color: transparent;" class="btn btn-lg text-light ">|</button>
    <button style="background-color: transparent;margin-left:-30px;" class="btn btn-lg text-light border-dark"><strong><?php echo $panocek['pano_ad']; ?></strong></button>
    <button style="background-color: transparent;" class="btn btn-lg text-light border-dark"><i class="fa fa-handshake-o"></i> <strong>
      <?php 
      if($panocek['pano_ekipid']==0)
        echo"Kişisel";
      else
      {
        $ekipsor=$db->prepare("SELECT * from ekipler where  ekip_id=:ekip_id ");
        $ekipsor->execute(array(
         'ekip_id' => $panocek['pano_ekipid']
       ));
        $ekipcek=$ekipsor->fetch(PDO::FETCH_ASSOC);
        echo $ekipcek['ekip_ad'];
        
      }


      $ekipuyelerisor=$db->prepare("SELECT * from ekipuyeleri where  ekip_id=:ekip_id ");
      $ekipuyelerisor->execute(array(
        'ekip_id' => $panocek["pano_ekipid"]
      ));
    $ekipuyelericek=$ekipuyelerisor->fetch(PDO::FETCH_ASSOC);
            $ekipuyelerisay=$ekipuyelerisor->rowCount();
            if($ekipuyelerisay==0)
            {
              $ekipuyelerisay=1;
            }
            else{
              $ekipuyelerisay+=1;

            }


      ?>
      
    </strong></button>

    <button style="background-color: transparent;" class="btn btn-lg text-light border-dark"><strong><i class="fa fa-clock-o"></i>  <?php echo "Kalan Tahmini Gün Sayısı:".$_SESSION['proje_bitimine_kalan_gun'] ;?> </strong></button>

 <button style="background-color: transparent;" class="btn btn-lg text-light border-dark"><strong><i class="fa fa-clock-o"></i>  <?php echo "Kişi Bazlı Gün Sayısı:".($_SESSION['proje_bitimine_kalan_gun']/$ekipuyelerisay);?> </strong></button>



  </div>

  <div  class="col-md-4" align="right" >
    <button onclick="openNav()" style="background-color: transparent;" class="btn btn-lg text-light border-dark"><i class="fa fa-align-justify"></i> <strong>Menüyü Göster</strong></button>
  </div>

</div>

<br>


<!--///////////////////////////////////////////////////////////LİSTELERİN SIRALANMASI////////////////////////////////////////-->
<div id="sortable" class="wrapper">

 <?php 

 $listesor=$db->prepare("SELECT * from listeler where  liste_panoid=:liste_panoid order by liste_sira ASC");
 $listesor->execute(array(
   'liste_panoid' => $_GET['pano_id']

 ));

 $say=1;
 $kart_enkucuk_baslangictrh=strtotime('2030-01-01');
     $kart_enbuyuk_bitistrh=strtotime('2000-01-01');
 while ($listecek=$listesor->fetch(PDO::FETCH_ASSOC) ) 
  {?>
    <div id="listeid-<?php echo $listecek['liste_id'];?>" class="column">



     <a onclick="listeSil()" href="nedmin/netting/islem.php?liste_panoid=<?php echo $listecek['liste_panoid'];?>&liste_id=<?php echo $listecek['liste_id'];?>&listesil=ok" style="color:black;"  ><i style="padding: 5px;" class="fa fa-times-circle-o fa-1x"></i></a> <?php echo $listecek['liste_ad'];?> 
     
     <?php 
     $kartsor=$db->prepare("SELECT * from kartlar where kart_listeid=:kart_listeid order by kart_sira ASC");
     $kartsor->execute(array(
      'kart_listeid' => $listecek['liste_id']
    ));
     
     
     
     while ($kartcek=$kartsor->fetch(PDO::FETCH_ASSOC) ) 
     {?>

      <?php 

      if($kart_enkucuk_baslangictrh>strtotime($kartcek["kart_baslangictarih"]))
      {
        $kart_enkucuk_baslangictrh=strtotime($kartcek["kart_baslangictarih"]);
      }
       if($kart_enbuyuk_bitistrh<strtotime($kartcek["kart_bitistarih"]))
      {
        $kart_enbuyuk_bitistrh=strtotime($kartcek["kart_bitistarih"]);
      }
    
       $gecen_gun_sayisi=(strtotime(date('Y-m-d')) - $kart_enkucuk_baslangictrh)/86400;
       $gunfarki=($kart_enbuyuk_bitistrh-$kart_enkucuk_baslangictrh)/86400;
       $proje_bitimine_kalan_gun=$gunfarki-$gecen_gun_sayisi;
       $_SESSION['proje_bitimine_kalan_gun']=$proje_bitimine_kalan_gun;



      ?>


      <div  id="kartid-<?php echo $kartcek['kart_id']?>"  class="portlet">
        <div style="background-image: url(images/panokapak/<?php echo $kartcek['kart_kapak'] ?>.png);"  class="portlet-header"><?php echo $kartcek['kart_ad']; ?></div>
        <div class="portlet-content"><?php echo $kartcek['kart_aciklama']; ?></div>
      </div>
      <!--///////////////////kart duzenle bolumu divi////////////////////////////////////////////////////////////////// -->


      <form action="nedmin/netting/islem.php" method="POST">

        <div id="kartduzenlediv-<?php echo $kartcek['kart_id']?>" class="kartduzenlediv " >

          <div id="kapatbtn-<?php echo $kartcek['kart_id']?>" class="kapatbtn"><strong>x</strong></div>

          <div style="background-image: url(images/panokapak/<?php echo $kartcek['kart_kapak']; ?>.png);" class="kapak"></div>


          <div class="row">

            <div style="overflow-y: scroll; height: 580px;" class="col-md-8">
              <input type="hidden" name="pano_id" value="<?php echo $_GET['pano_id']; ?>" class="form-control">
              <input type="hidden" name="kart_id" value="<?php echo $kartcek['kart_id']; ?>" class="form-control">
              <label style="padding: 10px;"><strong>Kart Adı</strong></label>
              <input type="text" name="kart_ad" value="<?php echo $kartcek['kart_ad']; ?>" class="form-control">
              <label style="padding: 10px;"><strong>Kart Açıklaması</strong></label>
              <input type="text" name="kart_aciklama" value="<?php echo $kartcek['kart_aciklama']; ?>" class="form-control">
              <hr>
              <!--///////////////////////////////yorum bolumu////////////////////////////////////////////////////////////// -->
              <label style="padding: 10px;"><strong>Yorumlar</strong></label>
              <hr>
              <p><i style="padding: 5px;" class="fa fa-user"></i><strong><?php echo $girisyapan_uyead ?> <?php echo $girisyapan_uyesoyad?></strong></p>
              <div class="row">
                <div class="col-md-10"><input id="yorum_icerik-<?php echo $kartcek['kart_id']?>" type="text" name="yorum_icerik" class="form-control" placeholder="Yorum yaz..."></div>
                <div class="col-md-2"><button id="butonyorum-<?php echo $kartcek['kart_id']?>" type="button" class="btn btn-sm btn-success">Gönder</button></div>


                <script>
                  $("#butonyorum-<?php echo $kartcek['kart_id']?>").click(function(){


                    var yorum_icerik=$("#yorum_icerik-<?php echo $kartcek['kart_id']?>").val();
                    var yorum_icerik_kartid_uyeid=$("#yorum_icerik-<?php echo $kartcek['kart_id']?>").val()+"/"+"<?php echo $kartcek['kart_id']?>"+"/"+"<?php echo $girisyapan_uyeid?> ";

                    if(yorum_icerik==" ")
                    {
                    }
                    else{
                      $.ajax({
                        type:'GET',
                        url:'nedmin/netting/islem.php',
                        data:'yorum_icerik_kartid_uyeid='+yorum_icerik_kartid_uyeid, 
                        success:function(data){

                         alert("Yorumunuz eklendi yorum.Yorumu görmek için sayfayı yenileyin")
                       }


                     });
                    }


                  });
                </script>
              </div>
              <hr>

              <?php 
              $yorumsor=$db->prepare("SELECT * FROM yorum where yorum_kartid=:yorum_kartid");
              $yorumsor->execute(array(
                'yorum_kartid' => $kartcek['kart_id']
              )); 
              while ($yorumcek=$yorumsor->fetch(PDO::FETCH_ASSOC) ) 
               {?>

                <?php $uyesor=$db->prepare("SELECT * from uye where uye_id=:uye_id");
                $uyesor->execute(
                 array('uye_id'=>$yorumcek['yorum_uyeid']
               )); 

                $uyecek=$uyesor->fetch(PDO::FETCH_ASSOC)
                ?>


                <i style="padding: 5px;" class="fa fa-user"></i><strong><?php echo $uyecek['uye_ad'] ?> <?php echo $uyecek['uye_soyad'] ?></strong><span style="margin-left: 15px;" class="badge bg-secondary"><?php echo $yorumcek['yorum_zaman']; ?></span>
                <p style="padding: 10px;"><?php echo $yorumcek['yorum_icerik'] ?></p>
                <hr>
              <?php } ?>
              <!--///////////////////////////////yorum bolumu////////////////////////////////////////////////////////////// -->

            </div>

            <div class="col-md-4">


              <label style="padding: 10px;"><strong>Kart Başlangıç Tarihi</strong></label><span class="badge bg-success"><?php echo $kartcek['kart_baslangictarih']; ?></span>
              <input type="date" name="kart_baslangictarih" class="form-control " value="<?php echo $kartcek['kart_baslangictarih']; ?>">
              <label style="padding: 10px;"><strong>Kart Bitiş Tarihi</strong></label><span class="badge bg-danger"><?php echo $kartcek['kart_bitistarih']; ?></span>
              <input type="date" name="kart_bitistarih" class="form-control" value="<?php echo $kartcek['kart_bitistarih']; ?>">
              <hr>
              <label style="padding: 10px;"><strong>Kart Kapak</strong></label><br>
              <?php for ($i=10; $i < 20 ; $i++) { ?>
               <label>
                <input class="photo-input"<?php echo $kartcek['kart_kapak']==($i+1) ?"checked":" "; ?>  name="kart_kapak" type="radio" value="<?php echo $i+1 ?>" >
                <img class="circle-corners" src="images/panokapak/<?php echo $i+1 ?>.png">
              </label>
            <?php } ?>
            <hr>

            <button type="submit" name="kartduzenle" class="btn btn-lg btn-success">Kartı Güncelle</button>
            <a  href="nedmin/netting/islem.php?liste_panoid=<?php echo $listecek['liste_panoid'];?>&kart_id=<?php echo $kartcek['kart_id'];?>&kartsil=ok"  class="btn btn-lg btn-success">Kartı Sil</a>

          </div>


        </div>

      </div>

      <script>

        $("#kartid-<?php echo $kartcek['kart_id']?>").click(function(){
          document.getElementById("kartduzenlediv-<?php echo $kartcek['kart_id']?>").style.display = "block";         
        });

        $("#kapatbtn-<?php echo $kartcek['kart_id']?>").click(function(){
          document.getElementById("kartduzenlediv-<?php echo $kartcek['kart_id']?>").style.display = "none";         
        });



      </script>

    </form>  

    <!--///////////////////////////////////////////////////////////////////////////////////// -->

  <?php } ?>





  <!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
  <div  class="kartekle" id="kartekle">
    <button id="acanbuton<?php echo $listecek['liste_id'] ?>"   class="btn btn-success"><i class="fa fa-plus"></i> Başka bir kart ekle</button>

    <div id="acılandiv<?php echo $listecek['liste_id'] ?>" class="acılandiv" >

      <input id="kart_ad<?php echo $listecek['liste_id'] ?>"      type="text" class="form-control"   name="kart_ad" placeholder="kart adı giriniz:">
      <input id="kart_aciklama<?php echo $listecek['liste_id'] ?>"  type="text" class="form-control"  name="kart_aciklama" placeholder="kart açıklama giriniz:">
      <div class="row">
        <div class="col-md-6">
          <label style="padding-left: 5px;"> Başlangıç Tarihi</label>
          <input id="kart_baslangictarih<?php echo $listecek['liste_id'] ?>"  type="date" class="form-control form-control-sm"  name="kart_baslangictarih" placeholder="kart başlangıç tarihi giriniz:">

        </div>
        <div class="col-md-6">
          <label style="padding-left: 5px;"> Bitiş Tarihi</label>
          <input id="kart_bitistarih<?php echo $listecek['liste_id'] ?>"  type="date" class="form-control form-control-sm"  name="kart_bitistarih" placeholder="kart bitiş tarihi giriniz:">
        </div>



      </div>

      <button id="kapatanbutton<?php echo $listecek['liste_id'] ?>"  class="btn btn-success">kart ekle</button>
    </div>
  </div> 
  <!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->

</div>

<script>
  $("#acanbuton<?php echo $listecek['liste_id'] ?>").click(function(){
   $("#acılandiv<?php echo $listecek['liste_id'] ?>").toggle(300);
 });



  $("#kapatanbutton<?php echo $listecek['liste_id'] ?>").click(function(){



    var kart_ad=$("#kart_ad<?php echo $listecek['liste_id'] ?>").val();
    var kart_aciklama=$("#kart_aciklama<?php echo $listecek['liste_id'] ?>").val();
    var ad_aciklama_id=kart_ad+"/"+ kart_aciklama +"/"+"<?php echo $listecek['liste_id'] ?>";

    var kart_baslangictarih=$("#kart_baslangictarih<?php echo $listecek['liste_id'] ?>").val();
    var kart_bitistarih=$("#kart_bitistarih<?php echo $listecek['liste_id'] ?>").val();
    var baslangictrh_bitistrh=kart_baslangictarih+"/"+kart_bitistarih ;

    var ad_aciklama_id_baslangictrh_bitistrh=ad_aciklama_id+"/"+baslangictrh_bitistrh;
    
    var yil=new Date();
    var yil=yil.getFullYear();
    var ay=new Date();
    var ay=ay.getMonth()+1;
    var gun=new Date();
    var gun=gun.getDate();
    var bugunun_tarihi=yil+"-"+ay+"-"+gun;

    



    if(kart_ad==" " || kart_aciklama=="" || kart_baslangictarih=="" || kart_bitistarih=="" )
    {
     alert("kart oluşturulmadı.Bilgileri tam giriniz!!!");
   }
   else if(new Date(kart_baslangictarih) > new Date(kart_bitistarih)  ||new Date(kart_baslangictarih) < new Date(bugunun_tarihi)   )
   {
    alert("Lütfen kart başlangıç tarihi bitiş tarihinden önce ve bugünün tarihinden sonra olmasına dikkat ediniz.");
  }
  else{
    $.ajax({
      type:'GET',
      url:'nedmin/netting/islem.php',
      data:'ad_aciklama_id_baslangictrh_bitistrh='+ad_aciklama_id_baslangictrh_bitistrh, 
      success:function(data){

        window.location.assign("http://localhost/teamwork/pano.php?pano_id=<?php echo $_GET['pano_id'] ?>")

      }


    });


  }


});


</script>

<?php   $say++;} ?>
<!-- //////////////liste ekle bölumu///////////////////////////////////////////////////////////////////////////////////// -->
<div  class="column" id="listeekle">
  <button id="acanbuton"   class="btn btn-success"><i class="fa fa-plus"></i> Başka bir liste ekle</button>

  <div  id="acılandiv" class="acılandiv" >
    <input id="liste_ad" type="text" class="form-control" name="liste_ad" placeholder="Liste adı giriniz:">
    <input id="liste_panoid" type="hidden" value="<?php echo $_GET['pano_id'] ?>" class="form-control" name="liste_panoid">
    <input id="liste_sira" type="hidden"   value="<?php echo $say ?>" class="form-control" name="liste_sira" >
    <button id="kapatanbutton"  class="btn btn-success">Liste ekle</button>
  </div>
</div> 
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->



<script>

  $("#acanbuton").click(function(){
   $("#acılandiv").toggle(300);
 });





  $("#kapatanbutton").click(function(){


    var liste_ad=$("#liste_ad").val();
    var liste_ad_panoid_sira=$("#liste_ad").val()+"/"+$("#liste_panoid").val()+"/"+$("#liste_sira").val();


    if(liste_ad=="")
    {
     alert("kart oluşturulmadı.Bilgileri tam giriniz!!!");
   }
   else{
    $.ajax({
      type:'GET',
      url:'nedmin/netting/islem.php',
      data:'liste_ad_panoid_sira='+liste_ad_panoid_sira, 
      success:function(data){

        window.location.assign("http://localhost/teamwork/pano.php?pano_id=<?php echo $_GET['pano_id'] ?>")

      }


    });
  }


});
</script>

<br /><br />





</div><!-- sortable div bitiş -->













</body>
</html>