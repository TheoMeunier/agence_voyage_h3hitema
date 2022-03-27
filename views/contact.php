<?php
require_once 'layouts/header.php';
?>

<div class="heading" style="background:url(../assets/img/header-bg-3.png) no-repeat">
   <h1>Contactez nous !</h1>
</div>

<!-- Début contact  -->

<section class="booking">

   <h1 class="heading-title">Formulaire</h1>

   <form action="" method="post" class="book-form">

      <div class="inputBox">
         <span>Nom :</span>
         <input type="text" class="champ" placeholder="Entrez votre nom" name="nom" required>
      </div>
      <div class="inputBox">
         <span>Email :</span>
         <input type="email" class="champ" placeholder="Entrez votre email" name="email" required>
      </div>
      <div class="inputBox">
         <span>Objet :</span>
         <input type="text" class="champ" placeholder="Objet de la demande" name="objet" required>
      </div>
      <div class="inputBox">
         <span>Message :</span>
         <textarea name="message" class="champ" placeholder="Votre message (500 caractères max)" style="resize: none;" rows="4" required></textarea>
      </div>

      <input type="submit" value="Envoyer" class="btn" name="submit">

   </form>

</section>

<!-- Fin contact -->

<?php
require_once 'layouts/footer.php';
?>