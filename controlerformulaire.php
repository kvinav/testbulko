<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

    $bdd = new PDO('mysql:host=localhost;dbname=testbulko;charset=utf8', 'root', 'root');
    $bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

include('messages.php');
include('managermessages.php');

$message = new Messages();

$managermessages = new ManagerMessages($bdd);

//AJOUT BDD
if (isset($_POST['email']) && isset($_POST['tel']))
  {
  	if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $_POST['email']) && preg_match('#^0[0-9]{9}#', $_POST['tel'])) 
  	{
    
    // Si l'email et le numero de telephone sont valides, on ajoute a la BDD
  	$message->setNom(mysql_real_escape_string($_POST['nom']));
  	$message->setEmail(mysql_real_escape_string($_POST['email']));
  	$message->setTel(is_numeric($_POST['tel']));
  	$message->setMessage(mysql_real_escape_string($_POST['message']));
  
  	$managermessages->add($message);
  
 	
 //Soumission formulaire AJAX
 header('Content-Type: text/html; charset=utf-8');

    //Vérification des données avant l'envoi de mail
    
    if ( (isset($_POST["email"])) && (strlen(trim($_POST["email"])) > 0) && (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) ) 
    {
        $email = stripslashes(strip_tags($_POST["email"]));
    } 
    elseif (empty($_POST["email"])) 
    {
        echo "Merci d'écrire une adresse email <br />";
        $email = "";
    } 
    else 
    {
        echo "Email invalide :(<br />";
        $email = "";
    }

    if ( (isset($_POST["tel"])) && (strlen(trim($_POST["tel"])) > 0) ) 
    {
        $message = stripslashes(strip_tags($_POST["tel"]));
    } 
    else 
    {
        echo "Merci d'écrire un numéro de téléphone<br />";
        $message = "";
    }

    // Envoi du mail a info@bulko.net
    
    $ip           = $_SERVER["REMOTE_ADDR"];
    $hostname     = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
    $destinataire = "info@bulko.net";
    $objet        = "[Site Web] " . $sujet;
    $contenu      = "Nom de l'expéditeur : " . $nom . "\r\n";
    $contenu     .= $message . "\r\n\n";
    $contenu     .= "Adresse IP de l'expéditeur : " . $ip . "\r\n";
    $contenu     .= "DLSAM : " . $hostname;

    $headers  = "CC: " . $email . " \r\n"; // ici l'expediteur du mail
    $headers .= "Content-Type: text/plain; charset=\"ISO-8859-1\"; DelSp=\"Yes\"; format=flowed /r/n";
    $headers .= "Content-Disposition: inline \r\n";
    $headers .= "Content-Transfer-Encoding: 7bit \r\n";
    $headers .= "MIME-Version: 1.0";

    
    if ( (empty($nom)) && (empty($tel)) && (empty($email)) && (!filter_var($email, FILTER_VALIDATE_EMAIL)) && (empty($message)) ) 
    {
        echo 'echec :( <br /><a href="index.php">Retour au formulaire</a>';
    } 
    else 
    {
        // ENCAPSULATION DES DONNEES 
        mail($destinataire, $objet, utf8_decode($contenu), $headers);
        echo 'Formulaire envoyé';
    }

    header('Location: index.php');

	}

	 else
 	 {
 	 	echo "Mauvais format pour l'email ou le numero de telephone";
 	 }

 else
 {
 	echo "Veuillez rentrer un email et un numéro de téléphone";
 
 }

