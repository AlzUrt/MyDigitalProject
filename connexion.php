<?php 
    session_start(); // Démarrage de la session
    require_once 'config.php'; // On inclut la connexion à la base de données
    echo"<script>console.log('test')</script>"; 
    if(!empty($_POST['email']) && !empty($_POST['password'])) // Si il existe les champs email, password et qu'il sont pas vident
    {

        echo"<script>console.log('aaaaaaaaaaaaaaaaa')</script>"; 
        



        // Patch XSS
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        
        $email = strtolower($email); // email transformé en minuscule
        

        $str = "@";

        // On regarde si l'utilisateur est inscrit dans la table user
        $check = $bdd->prepare('SELECT pseudo, email, password, token FROM user WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();
        
        

        // Si > à 0 alors l'utilisateur existe
        if($row > 0)
        {
            // Si le mail est bon niveau format
            if(strpos($str, $email) !== true)
            {
                // Si le mot de passe est le bon
                if(password_verify($password, $data['password']))
                {
                    // On créer la session et on redirige sur landing.php
                    $_SESSION['user'] = $data['token'];
                    header('Location: landing.php');
                    die();
                }else{ 
                    echo"<script>console.log('aaaaaaaaaaaaaaaaa')</script>"; 
                    header('Location: index.php?login_err=already'); die(); 
                }
            }else{  
                echo"<script>console.log('aaaaaaaaaaaaaaaaa')</script>"; 
                header('Location: index.php?login_err=password'); die(); 
            }
        }else{ 
            echo"<script>console.log('aaaaaaaaaaaaaaaaa')</script>"; 
            header('Location: index.php?login_err=email'); die(); 
        }
    }else{ 
        echo"<script>console.log('bbbbbbbbb')</script>"; 
        header('Location: index.php'); die();
    } // si le formulaire est envoyé sans aucune données
