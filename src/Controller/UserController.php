<?php

require_once '../../src/Services/isConnected.php';
require_once '../../src/Table/Table.php';
require_once '../../src/Services/Alert.php';
require_once '../../src/Services/ValidationForm.php';

function isValid()
{

}

function getValues():array
{
    return $_POST;
}

function validName(string $table, string $where, string $name):bool{
    $IsValid = false;
    if (!Exist($table, $where, $name)){
        if (strlen($name) > 3){
            $IsValid = true;
        } else{
            alert('error', 'Votre identifiant est trop court');
        }
    } else{
        alert('error', 'Cet utilisateur existe déjà');
    }

    return $IsValid;
}

function validEmail(string $table, string $where, string $email):bool{
    $IsValid = false;

    if (!Exist($table, $where, $email)){
        if (strlen($email) > 6){
            $IsValid = true;
        } else{
            alert('error', 'Votre email est trop courte');
        }
    } else{
        alert('error', 'Cet email est déjà utilisée');
    }

    return $IsValid;
}

function validPassword(string|null $password,string|null $cpassword):bool{
    $IsValid = false;
    
    if ($password == $cpassword) {
        $uppercase = boolval(preg_match('/[A-Z]/', $password));
        $lowercase = boolval(preg_match('/[a-z]/', $password));
        $number = boolval(preg_match('/\d/', $password));
        if (strlen($password) > 3 && $uppercase && $lowercase && $number){
            $IsValid = true;
        } else{
            alert('error', 'Le MDP ne respecte pas les critères de sécurité');
        }
    } else{
        alert('error', 'Les MDP ne correspondent pas');
    }

    return $IsValid;
}

function checkName(string $new_name, string $old_name, int $edit_id):void
{
    if(isNotBlank($new_name)){
        if($old_name != $new_name){
            if (validName('USER', 'name', $new_name)){
                $data = [
                    'name' => $new_name
                ];
                update('USER', $data, $edit_id);
            }
        }
    } else{
        alert('error', 'Veuillez attribuer un nom valide à l\'utilisateur');
    }
}

function checkEmail(string $new_email, string $old_email, int $edit_id):void
{
    if(isNotBlank($new_email)){
        if($old_email != $new_email){
            if (validEmail('USER', 'email', $new_email)){
                $data = [
                    'email' => $new_email
                ];
                update('USER', $data, $edit_id);
            }
        }
    } else{
        alert('error', 'Veuillez attribuer un email valide à l\'utilisateur');
    }
}

function checkPassword(string $new_password, string $cpassword, $last_password, $old_password, int $edit_id):void
{
    if (isNotBlank($last_password)){
        if ($old_password == hash('sha256', $last_password)){
            if (isNotBlank($new_password) && isNotBlank($cpassword)){
                if (validPassword($new_password, $cpassword)){
                    $data = [
                        'password' => hash('sha256', $cpassword)
                    ];
                    update('USER', $data, $edit_id);
                }
            } else {
                alert('error', 'Veuillez indiquer le nouveau mdp');
            }
        } else{
            alert('error', "L'ancien mdp ne correspond pas à celui indiqué");
        }
    }else{
        if(isNotBlank($new_password)){
            alert('error', 'Entrez l\'ancien mdp pour pouvoir le modifier');
        }
    }
}