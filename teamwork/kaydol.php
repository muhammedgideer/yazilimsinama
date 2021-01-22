<!DOCTYPE html>
<html lang="en">
<head>

	<title>TeamWork</title>
	<!--

    Template 2106 Soft Landing

	http://www.tooplate.com/view/2106-soft-landing

    -->
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="team" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="cssindex/bootstrap.min.css">
     <link rel="stylesheet" href="cssindex/owl.carousel.css">
     <link rel="stylesheet" href="cssindex/owl.theme.default.min.css">
     <link rel="stylesheet" href="cssindex/font-awesome.min.css">
       <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="cssindex/tooplate-style.css">

</head>
<body>

     
     <!-- PRICING -->
     <section id="pricing" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title">
                              <h1><strong>TeamWork</strong></h1>
                              <small><?php 

                              if (isset($_GET['durum']) && $_GET['durum']=="farklisifre") {?>

                                   <div class="alert alert-danger">
                                        <strong>Hata!</strong> Girdiğiniz şifreler eşleşmiyor.
                                   </div>

                              <?php } elseif (isset($_GET['durum']) && $_GET['durum']=="eskisifre") {?>

                                   <div class="alert alert-danger">
                                        <strong>Hata!</strong> Şifreniz minimum 6 karakter uzunluğunda olmalıdır.
                                   </div>

                              <?php } elseif (isset($_GET['durum']) && $_GET['durum']=="mukerrerkayit") {?>

                                   <div class="alert alert-danger">
                                        <strong>Hata!</strong> Bu kullanıcı daha önce kayıt edilmiş.
                                   </div>

                              <?php } elseif (isset($_GET['durum']) && $_GET['durum']=="basarisiz") {?>

                                   <div class="alert alert-danger">
                                        <strong>Hata!</strong> Kayıt Yapılamadı Sistem Yöneticisine Danışınız.
                                   </div>
                              <?php } elseif (isset($_GET['durum']) && $_GET['durum']=="loginbasarili") {?>

                                   <div class="alert alert-success">
                                        <strong>Kayıt Tamamlandı!</strong> Kayıt Yapıldı İstediğiniz Zaman Giriş Yapabilirsiniz.
                                   </div>

                              <?php }
                              ?></small>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         
                    </div>

                    <form action="nedmin/netting/islem.php" method="POST" class="online-form">

                    <div class="col-md-4 col-sm-6">
                         <div class="pricing-thumb">
                             <div class="pricing-title">
                                  <h4><strong>Bir hesap oluşturmak için kayıt olun!</strong></h4>
                             </div>
                             <div class="pricing-info">
                                   <input style="width: 100%;margin:5px;" value="<?php echo $_GET['uye_mail']; ?>" type="email" name="uye_mail" class="form-control" placeholder="Enter your email" required>
                                   <input style="width: 100% ;margin:5px;" type="text" name="uye_ad" class="form-control" placeholder="Enter your name" required>

                                   <input style="width: 100% ;margin:5px;" type="text" name="uye_soyad" class="form-control" placeholder="Enter your surname" required>                                   

                                   <input style="width: 100%;margin:5px;" type="password" name="uye_passwordone" class="form-control" placeholder="Enter your password" required>

                                   <input style="width: 100%;margin: 5px;" type="password" name="uye_passwordtwo" class="form-control" placeholder="Enter your password again" required>
                                   <br>
                                   
                             
                             </div>
                             <div class="pricing-bottom">
                              <button style="width: 50%;text-align: center;" name="uyekaydet" type="submit" class="form-control">Kayıt Ol</button> 
                              <br>                        
                              </div>

                         </div>
                        
                    </div>

                     </form>

                    <div class="col-md-4 col-sm-6">
                         
                    </div>
                    
               </div>
          </div>
     </section>   
<br>  <br>  
    <!-- FOOTER -->
     <footer id="footer" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="copyright-text col-md-12 col-sm-12">
                         <div class="col-md-6 col-sm-6">
                              <p>Copyright &copy; '2020 TeamWork'</p>
                         </div>

                         <div class="col-md-6 col-sm-6">
                              <ul class="social-icon">
                                   <li><a href="https://www.facebook.com/muhammed.gideer" class="fa fa-facebook" attr="facebook icon"></a></li>
                                   <li><a href="https://twitter.com/muhammedgideer" class="fa fa-twitter"></a></li>
                                   <li><a href="https://www.instagram.com/muhammedgider.com.tr/" class="fa fa-instagram"></a></li>
                              </ul>
                         </div>
                    </div>

               </div>
          </div>
     </footer>

    

     <!-- FOOTER -->
    


     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>