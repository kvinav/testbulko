<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

    $bdd = new PDO('mysql:host=localhost;dbname=testbulko;charset=utf8', 'root', 'root');
    $bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

include('messages.php');
include('managermessages.php');

$message = new Messages();

$managermessages = new ManagerMessages($bdd);


if (isset($_POST['email']) && isset($_POST['tel']))
  {
  	if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $_POST['email']) && preg_match('#^0[0-9]#', $_POST['tel'])) 
  	{
    
    // Si l'email et le numero de telephone sont valides, on ajoute a la BDD
  	$message->setNom($_POST['nom']);
  	$message->setEmail($_POST['email']);
  	$message->setTel($_POST['tel']);
  	$message->setMessage($_POST['message']);
  
  	$managermessages->add($message);
  	
  	//Envoi du mail
  	$to = "info@bulko.net";
    $nom = "$_POST['nom']";
    $email = "$_POST['email']";

    $message="$_POST['message']";

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

    mail($to, $nom, $email, $message, $headers);

    echo "Votre email a été envoyé avec succès.";


    }

    else 

    {
    

    echo "L'adresse email et le numéro de téléphones n'ont pas le bon format";

	}

  }

else

  {
    echo "L'adresse mail et le numéro de téléphone sont obligatoires";
  }