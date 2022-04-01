<?php
require_once 'views/layouts/header.php';
?>

<!-- Début home  -->

<section class="home">

   <div class="swiper home-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide" style="background:url(assets/img/home-slide-1.jpg) no-repeat">
            <div class="content">
               <span>Explorer, Découvrir, Voyager</span>
               <h3>Voyage à travers le monde</h3>
               <a href="views/destinations.php" class="btn">Découvrir plus</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(assets/img/home-slide-2.jpg) no-repeat">
            <div class="content">
               <span>Explorer, Découvrir, Voyager</span>
               <h3>Découvre de nouveaux endroits</h3>
               <a href="views/destinations.php" class="btn">Découvrir plus</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(assets/img/home-slide-3.jpg) no-repeat">
            <div class="content">
               <span>Explorer, Découvrir, Voyager</span>
               <h3>Rend ton voyage magique</h3>
               <a href="views/destinations.php" class="btn">Découvrir plus</a>
            </div>
         </div>
         
      </div>

      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

   </div>

</section>

<!-- Fin home -->

<!-- Début services  -->

<section class="services">

   <h1 class="heading-title"> Nos services </h1>

   <div class="box-container">

      <div class="box">
         <img src="assets/img/icon-1.png" alt="">
         <h3>Aventure</h3>
      </div>

      <div class="box">
         <img src="assets/img/icon-2.png" alt="">
         <h3>Tour guidé</h3>
      </div>

      <div class="box">
         <img src="assets/img/icon-3.png" alt="">
         <h3>Randonnée</h3>
      </div>

      <div class="box">
         <img src="assets/img/icon-4.png" alt="">
         <h3>Feu de camp</h3>
      </div>

      <div class="box">
         <img src="assets/img/icon-5.png" alt="">
         <h3>Off Road</h3>
      </div>

      <div class="box">
         <img src="assets/img/icon-6.png" alt="">
         <h3>Camping</h3>
      </div>

   </div>

</section>

<!-- Fin services -->

<!-- Début destinations  -->

<section class="home-packages">

   <h1 class="heading-title"> Nos destinations </h1>

   <div class="box-container">

      <div class="box">
         <div class="image">
            <img src="assets/img/img-1.jpg" alt="">
         </div>
         <div class="content">
            <h3>adventure & tour</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eos, sint!</p>
            <a href="views/destinations.php" class="btn">book now</a>
         </div>
      </div>

      <div class="box">
         <div class="image">
            <img src="assets/img/img-2.jpg" alt="">
         </div>
         <div class="content">
            <h3>adventure & tour</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eos, sint!</p>
            <a href="views/destinations.php" class="btn">book now</a>
         </div>
      </div>
      
      <div class="box">
         <div class="image">
            <img src="assets/img/img-3.jpg" alt="">
         </div>
         <div class="content">
            <h3>adventure & tour</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eos, sint!</p>
            <a href="views/destinations.php" class="btn">book now</a>
         </div>
      </div>

   </div>

   <div class="load-more"> <a href="views/destinations.php" class="btn">Voir plus</a> </div>

</section>

<!-- Fin destinations -->

<!-- Début voyages  -->

<section class="home-packages">

   <h1 class="heading-title"> Nos voyages </h1>

   <div class="box-container">

      <div class="box">
         <div class="image">
            <img src="assets/img/img-1.jpg" alt="">
         </div>
         <div class="content">
            <h3>adventure & tour</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eos, sint!</p>
            <a href="views/voyages.php" class="btn">book now</a>
         </div>
      </div>

      <div class="box">
         <div class="image">
            <img src="assets/img/img-2.jpg" alt="">
         </div>
         <div class="content">
            <h3>adventure & tour</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eos, sint!</p>
            <a href="views/voyages.php" class="btn">book now</a>
         </div>
      </div>
      
      <div class="box">
         <div class="image">
            <img src="assets/img/img-3.jpg" alt="">
         </div>
         <div class="content">
            <h3>adventure & tour</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eos, sint!</p>
            <a href="views/voyages.php" class="btn">book now</a>
         </div>
      </div>

   </div>

   <div class="load-more"> <a href="views/voyages.php" class="btn">Voir plus</a> </div>

</section>

<!-- Fin voyages -->

<?php
require_once 'views/layouts/footer.php';
?>