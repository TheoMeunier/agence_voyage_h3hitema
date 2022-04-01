<?php
require_once 'layouts/header.php';
?>

<div class="heading" style="background:url(/assets/img/header-bg-3.png) no-repeat">
   <h1>Contactez nous !</h1>
</div>

<section class="booking">

   <h1 class="heading-title">Nous contacter</h1>

   <form action="" method="post" class="book-form">

      <div class="inputBox">
         <span>Nom & Prenom :</span>
         <input type="text" class="champ" name="name" required>
      </div>
      <div class="inputBox">
         <span>Email :</span>
         <input type="email" class="champ" name="email" required>
      </div>
      <div class="inputBox">
         <span>Message :</span>
         <textarea name="content" class="champ"  style="resize: none;" rows="4" required></textarea>
      </div>

       <button type="submit" class="btn" name="submit">Envoyer</button>
   </form>

</section>

<?php
require_once 'layouts/footer.php';
?>