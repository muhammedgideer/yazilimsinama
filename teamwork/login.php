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
<br><br>
     
     <!-- PRICING -->
     <section id="pricing" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title">
                              <h1><strong>TeamWork</strong></h1>
                              <small><?php 

                              if ($_GET['durum']=="basarisizgiris") {?>

                                   <div class="alert alert-danger">
                                        <strong>Hata!</strong> Giriş Yapamadınız.
                                   </div>

                              <?php } ?>
                             </small>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         
                    </div>

                    <form action="nedmin/netting/islem.php" method="POST" class="online-form">

                    <div class="col-md-4 col-sm-6">
                         <div class="pricing-thumb">
                             <div class="pricing-title">
                                  <h4><strong>Giriş Yap</strong></h4>
                             </div>
                             <div class="pricing-info">
                                   <input style="width: 100%;margin: 5px;" type="email" name="uye_mail" class="form-control" placeholder="Enter your email" required>
                                   <input style="width: 100%" type="password" name="uye_password" class="form-control" placeholder="Enter your password" required>
                                   <br>
                                   
                             
                             </div>
                             <div class="pricing-bottom">
                              <button style="width: 50%;text-align: center;" name="girisyap" type="submit" class="form-control">Giriş Yap</button> 
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

<br><br><br><br>
<br><br><br><br><br><br><br><br>
         <!-- FOOTER -->
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