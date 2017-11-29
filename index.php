<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>TestBulko - 2017</title>
	<meta name="viewport" content="user-scalable=no, initial-scale = 1, minimum-scale = 1, maximum-scale = 1, width=device-width">
	<link rel="icon" type="image/vnd.microsoft.icon" href="http://www.bulko.net/templates/img/favicon.ico" />
	<link rel="shortcut icon" type="image/x-icon" href="http://www.bulko.net/templates/img/favicon.ico" />
	<link rel="stylesheet" href="https://cdn.bootcss.com/meyer-reset/2.0/reset.min.css">
	<link rel="stylesheet" href="./asset/css/styles.css">
</head>
<body>
	<header>
		<div class="wrapper">
			<a class="logo-bulko" href="http://www.bulko.net/" title="Logo Agence Bulko"><img src="./asset/img/logoBulko.png" alt="Logo Agence Bulko" ></a>
			<a class="logo-github" href="https://github.com/Bulko/test-dev-bulko/blob/master/README.md" title="Lire les consignes" target="_blank" rel="noopener">
				<img src="./asset/img/github-icon.png" alt="Logo github">README.md
			</a>
		</div>
	</header>
	<main>
		<!-- <div class="form-ok">Pour votre message de validation de formulaire</div> -->
		<!-- <div class="form-error">Pour votre message d'erreur</div> -->
		<form method="post" action="controlerformulaire.php" id="contact">
			<p>Contactez-nous</p>
			<div class="form-part-1">
				<div class="form-control">
					<input type="text" name="nom" placeholder="Nom"/>
					 <span id="msg_nom"></span>
				</div>
				<div class="form-control">
					<input type="email" name="email" placeholder="Email"/>
					<span id="msg_email"></span>
				</div>
				<div class="form-control">
					<input type="tel" name="tel" placeholder="Téléphone"/>
					<span id="msg_tel"></span>
				</div>
			</div>
			<div class="form-part-2">
				<div class="form-control">
					<textarea name="message" placeholder="Message"></textarea>
					 <span id="msg_message"></span>
				</div>
				<input type="submit" value="Envoyer" />
			</div>
		</form>
		<span id="msg_all"></span> 
	</main>
	<footer>
		<p>© Bulko - 2017<br>🦄  GLHF</p>
		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
    $(function(){
        $("#contact").submit(function(event){
            var nom        = $("#nom").val();
            var email      = $("#email").val();
            var tel        = $("#tel").val();
            var message    = $("#message").val();
            var dataString = nom + email + tel + message;
            var msg_all    = "Merci de remplir tous les champs";
            var msg_alert  = "Merci de remplir ce champs";

            if (dataString  == "") {
                $("#msg_all").html(msg_all);
            } else if (nom == "") {
                $("#msg_nom").html(msg_alert);
            } else if (sujet == "") {
                $("#msg_email").html(msg_alert);
            } else if (email == "") {
                $("#msg_tel").html(msg_alert);
            } else if (message == "") {
                $("#msg_message").html(msg_alert);
            } else {
                $.ajax({
                    type : "POST",
                    url: $(this).attr("action"),
                    data: $(this).serialize(),
                    success : function() {
                        $("#contact").html("<p>Formulaire bien envoyé</p>");
                    },
                    error: function() {
                        $("#contact").html("<p>Erreur d'appel, le formulaire ne peut pas fonctionner</p>");
                    }
                });
            }

            return false;
        });
    });
</script>
	</footer>
</body>
</html>