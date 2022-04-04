<?php

session_start();

require_once 'db.php';

if (isset($_POST['submit'])){

    $name = $_POST['name'];
    $password = hash('sha256', $_POST['password']);

    $vname = $pdo->query("SELECT id FROM `user` WHERE name = '$name'");

    if ($vname->rowCount() > 0){
        $vpassword = $pdo->query("SELECT id FROM `user` WHERE name = '$name' AND password = '$password'");
        if ($vpassword-> rowCount() > 0){
            $get_id = $vpassword->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id'] = $get_id['id'];
            $successes[] = 'Vous vous êtes bien connecté';
            header('location:../admin/options/index.php');
        } else{
            $password_errors[] = 'Le mot de passe est incorrecte';
        }
    } else{
        $name_errors[] = 'L\'identifiant est incorrecte';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JetLag</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/css/admin.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous" defer></script>
</head>
<body>
    
    <div class="box">

        <form action="" class="form-block" method="post">
            <h3><span>Identifiez</span>-vous</h3>

            <div class="form-group">
                <label for="name" id="label-name">Nom d'utilisateur</label>
                <input type="text" name="name" id="name">
            </div>

            <?php
                if (isset($name_errors)){
                    if (count($name_errors) > 0){
                        foreach($name_errors as $name_error){
                            echo '<p style="color: red;">'.$name_error.'</p>';
                        }
                        
                        echo '<style>#name{ border-bottom: 3px solid red!important; } #label-name{ color: red!important; }</style>';
                    }
                }
            ?>

            <div class="form-group">
                <label for="password" id="label-password">Mot de passe</label>
                <input type="password" name="password" id="password">
            </div>

            <?php
                if (isset($password_errors)){
                    if (count($password_errors) > 0){
                        foreach($password_errors as $password_error){
                            echo '<p style="color: red;">'.$password_error.'</p>';
                        }
                        
                        echo '<style>#password{ border-bottom: 3px solid red!important; } #label-password{ color: red!important; }</style>';
                    }
                }
            ?>

            <div class="form-group submit">
                <input type="submit" name="submit" value="LOGIN" class="btn">
            </div>

            <div class="password-lost">
                <a href="#">Mot de passe perdu ?</a>
            </div>
        </form>

    </div>


    <script>
        const inputs = document.querySelectorAll('input');

        for (let i = 0; i < inputs.length; i++){
            let field = inputs[i];

            field.addEventListener('input', (e) => {
                if(e.target.value != ""){
                    e.target.parentNode.classList.add('animation');
                }else if (e.target.value == ""){
                    e.target.parentNode.classList.remove('animation');
                }
            })
        }
    </script>

</body>
</html>