<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 08/11/2018
 * Time: 21:07
 */
?>

<html>
    <head>
        <title>Aguardando</title>
        <?php include('template/head.php'); ?>
    </head>
    <body>
	<div id="result"></div>
	<?php include('template/header.php'); ?>

        <p class="caminho"> » <b>Área</b>: Início » <b>Subárea</b>: Reuniões » <b>Ação</b>: Aguardando</p>

        <div id="corpo">
            <br>
            <h1 class="titulo_maximo">Aguardando uma votação iniciar.</h1>
        </div>

        <?php include('template/footer.php'); ?>
	<form action="iniciar_voto" method="post">
		<input class="invisible" id="idItem" name="idItem">
		<button type="submit" class="invisible" id="botao_invisivel"></button>
	</form>

	</body>


	<script>
		if(typeof(EventSource) !== "undefined") {
			var source = new EventSource("servidor");
			source.onmessage = function(event) {
				if(event.data !== 'false'){
					document.getElementById('idItem').value = event.data;
					if(window.confirm('A votação foi iniciada!')){
						document.getElementById('botao_invisivel').click();
					}
				}
			};
		} else {
			document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
		}
	</script>
</html>
