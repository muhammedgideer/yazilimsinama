<?php 

ob_start();
session_start();
include'nedmin/netting/baglan.php'; 

$uyesor=$db->prepare("SELECT * from uye where uye_mail=:mail");
$uyesor->execute(
  array('mail'=>$_SESSION['useruye_mail']));
    //rowcount fonksiyonu kullanıcı sayısını sayar .
$say=$uyesor->rowCount();
$uyecek=$uyesor->fetch(PDO::FETCH_ASSOC);

$girisyapan_uyeid=$uyecek['uye_id'];
$girisyapan_uyead=$uyecek['uye_ad'];
$girisyapan_uyesoyad=$uyecek['uye_soyad'];
$girisyapan_uyemail=$uyecek['uye_mail'];

//aşagıda yapılan işlem eğer kullanıcı yok ise sizi login sayfasına gönderir.linkleri yazıp örneğin index sayfasına gidiyorken bu işlem ile buna izin vermez ve login den giriş yapılarak o sayfalara yani kontrol paneline giriş yapılıp gidilir.
if($say==0)
{
  header("Location:login.php"); 
  exit;
}


$panosor=$db->prepare("SELECT * FROM panolar where pano_yoneticiid=:pano_yoneticiid");
$panosor->execute(array(
  'pano_yoneticiid' => $girisyapan_uyeid
));
 ?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Sortable - Portlets</title>


  <link rel="stylesheet" href="jquery/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="jquery/jquery-ui.js"></script>

  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

 <style>
  body {
    min-width: 520px;
    overflow-x: hidden;
  }



  .kartduzenlediv
  {
    z-index: 1;
    display: none;
    width: 1000px;
    height: 700px;
    position: absolute;
    background-color: white;
    top:200px;
    left: 500px;
    border: 7px solid #EBECF0;
    border-radius: 20px;
    position: fixed;
  }
  .kartduzenlediv .kapatbtn{
    width: 20px;
    height: 20px;
    border-radius: 20px;
    float: right;
    position: relative;
    right: 20px;
    top: 10px;
    font-size: 30px;
    cursor: pointer;
    
  
  } 
  
  .kartduzenlediv .kapak{
    width: 100%;
    height: 100px;
    border-radius: 20px;
  } 


  .panokart a{
    text-decoration: none;
    color: white;
    
  }

  .panokart p{

    color:white;
    width: 250px;
    height: 150px;
    border-radius: 15px;
    text-align: center;
    padding: 15px;
    word-wrap: break-word;
    margin:10px;
    float: left;
    background-size: 250px 150px;

  }
  .menu{
    padding: 8px;
    background-color: #026AA7;
  }
  .column {
    width: 300px;
    float: left;
    padding-bottom: 15px;
    padding-top: 20px;   
    border-radius: 5px;
    background-color:;
    margin: 5px;
  }
  .portlet {
    margin: 3px 1em 1em 0;
    padding: 0.3em;

  }
  .portlet-header {
    padding: 0.2em 0.3em;
    margin-bottom: 0.5em;
    position: relative;
    word-wrap: break-word;


  }
  .portlet-toggle {
    position: absolute;
    top: 50%;
    right: 0;
    margin-top: -8px;

  }
  .portlet-content {
    padding: 0.4em;
    word-wrap: break-word;

  }
  .portlet-placeholder {
    border: 1px dotted black;
    margin: 0 1em 1em 0;
    height: 50px;
  }

.listheader{
  padding-left:10px;
  font-size: 15px;
  
    
    
}
.kartekle .btn{
  width: 95%;
  margin:5px;

}

.kartekle .acılandiv{
  display: none;
}
.btn{
  font-size: 17px;
  font-weight: 20px;
}


.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  right: 0;
  background-color: #F4F5F7;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
  padding-left:8px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 15px;
  color: black;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
 background-color: grey;
 color: white;
}
.closebtn {
  position: absolute;
  top: 0;
  right: 0;
  width: 50%;

}
.backbtn{
  position: absolute;
  top: 0;
  left: 0;
  width: 50%;
}

.wrapper{
  max-height: 100%;
  display: flex; 
  overflow-x: auto;

}
.wrapper:: -webkit-scrolbar{
width: 0;
}

.wrapper .column{
min-width: 300px;
height: 100%;
line-height: 25px;

background-color: #ddd;
margin-right: 2px;
}


.column #acanbuton{
  width: 100%;
  background-color: #026AA7;
  color: white;
  height: 60px;


}
.column #acılandiv{
  display: none;
}

.column #kapatanbutton
{
  height: 50px;
  width: 100%;
}

#panoduzenlediv{
display: none;
}
#panoduzenlediv input{
margin:10px;
width: 90%

}

#panoolusturdiv{
display: none;
}

#panoolusturdiv input{
margin:10px;
width: 90%

}

#ekipolusturdiv{
display: none;
}

#ekipolusturdiv input{
margin:10px;
width: 90%

}


.photo-input { 
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}
.photo-input + img {
  margin:2px;
  padding: 2px; 
  width:50px;
  height:50px;
  cursor: pointer;
  border: 2px solid #DDDDDD;
}
.photo-input:checked + img {
  border: 2px solid #F00;
  background-color: black;

}
.circle-corners {
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    -khtml-border-radius: 50%;
    border-radius: 50%;

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>

  $( function() {
    $( ".column" ).sortable({
      connectWith: ".column",
      handle: ".portlet-header",
      cancel: ".portlet-toggle",
      placeholder: "portlet-placeholder ui-corner-all",

      update: function() {
               
               var değer  = $(this).sortable("serialize")+"&kartupdate=kartupdate";
               var kart_listeid=$(this).attr("id");
              
               console.log(değer);
               console.log(kart_listeid);

              $.ajax({
                
                 url: "nedmin/netting/islem.php?kart_listeid="+kart_listeid,
                 data: değer,
                 type: "post",
                 success: function(e) {
                  
                  
                 }


                
                
              });

             
              
             }

             

    });
 
    $( ".portlet" )
      .addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
      .find( ".portlet-header" )
        .addClass( "ui-widget-header ui-corner-all" )
        .prepend( "<span class='ui-icon ui-icon-minusthick portlet-toggle'></span>");
 
    $( ".portlet-toggle" ).on( "click", function() {
      var icon = $( this );
      icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
      icon.closest( ".portlet" ).find( ".portlet-content" ).toggle();
    });
  } );
  </script>


  <script >
    $( function() {
    $( "#sortable" ).sortable(
      { 
         
    
             update: function() {
               
               var değer  = $(this).sortable("serialize")+"&listupdate=listupdate";
                console.log(değer);
              $.ajax({
                
                 url: "nedmin/netting/islem.php",
                 data: değer,
                 type: "post",
                 success: function(e) {
                  
                 }
                
                
              });
              
             }
         
         
         });

    $( "#sortable" ).disableSelection();
  } );

  </script>


  <script>

function openNavEkle() {
  document.getElementById("mySidenavEkle").style.width = "300px";
}

function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
}


function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("panoduzenlediv").style.display = "none";

}
function closeNav1() {
    document.getElementById("mySidenavEkle").style.width = "0";


}




</script>
</head>
<body>

<!-- /////////////////////////////////////////////////////////PANO VE EKİP OLUŞTUR BOLUMU BAŞLANGIÇ//////////////////////////////////////////////////////////////////////////////// -->

<div id="mySidenavEkle" class="sidenav">
  <div class="row">
    <h3 align="center">Oluştur</h3>
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav1()"><i class="fa fa-times"></i></a>
  </div>
  <hr>
  <!-- sağ menu content -->
  <form action="nedmin/netting/islem.php" method="POST" >
    <a id="panoolustur">Pano Oluştur</a>
    <div id="panoolusturdiv">
      <input class="form-control" type="text" name="pano_ad" required="" placeholder="Pano başlığı giriniz">
      <input class="form-control" type="text" name="pano_aciklama" required="" placeholder="Pano açıklama giriniz">
      <input class="form-control" type="hidden" name="pano_yoneticiid" value="<?php echo $uyecek['uye_id']?>">


      <hr>
      <h6>Arkaplan Seçiniz</h6>
      <hr>
      <?php for ($i=0; $i < 20 ; $i++) { ?>

       <label>
        <input class="photo-input" name="pano_arkaplan" type="radio" value='<?php echo $i+1 ?>' checked>
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

    <button style="width: 100%" class="btn btn-success" type="submit" name="panoolustur">Pano Oluştur</button>



  
</div>
  </form>
       <hr>

<form action="nedmin/netting/islem.php" method="POST">
<a id="ekipolustur">Ekip Oluştur</a>
<div id="ekipolusturdiv">
      <input class="form-control" type="text" required="" name="ekip_ad" placeholder="Ekip adı giriniz">
      <input class="form-control" type="text"  required="" name="ekip_aciklama" placeholder="Ekip açıklaması giriniz">
      <input class="form-control" type="hidden"   name="ekip_yoneticiid" value="<?php echo $uyecek['uye_id'] ?>">

        <button class="btn btn-success" type="submit" name="ekipolustur" >Oluştur</button>
  </div>
  <hr>
</form>


</div>

<script type="text/javascript">
  $("#panoolustur").click(function(){
           $("#panoolusturdiv").toggle(300);
         });


   $("#ekipolustur").click(function(){
           $("#ekipolusturdiv").toggle(300);
         });
</script>
<!-- /////////////////////////////////////////////////////////PANO VE EKİP OLUŞTUR BOLUMU BİTİŞ//////////////////////////////////////////////////////////////////////////////// -->



<div  class="row menu">
  <div class="col-md-4" align="left">
  <a style="background-color: #67A6CA;" href="panolar.php" class="btn btn-lg text-light"><i class="fa fa-th"></i> Panolar</a>
  <a style="background-color: #67A6CA;"  href="hesap.php" class="btn btn-lg text-light"><i class="fa fa-user"></i><strong> <?php echo $uyecek['uye_ad']." ".$uyecek['uye_soyad'] ?></strong></a>
  </div>

  <div class="col-md-4" align="center">
    <h3  class="text-light"><strong> TeamWork </strong></h3>
  </div>

  <div class="col-md-4" align="right" >
  <a style="background-color: #67A6CA;" href="bilgi.php"  class="btn btn-lg mr-auto text-light "><i class="fa fa-info-circle"></i> Bilgi</a>
  <a style="background-color: #67A6CA;" onclick="openNavEkle()" class="btn btn-lg mr-auto text-light "><i class="fa fa-plus"></i> Ekle</a>
  <a style="background-color: #67A6CA;" href="logout.php" class="btn btn-lg text-light"><strong> <i class="fa fa-sign-out"></i>Çıkış</strong></a>

  </div>
  
</div>



<hr style="color: white;">