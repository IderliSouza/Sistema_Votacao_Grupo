<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 22/11/2018
 * Time: 19:47
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

            <div class="nome_tabela">
                Membros Votantes
            </div>
            <table id="tabela_aguardo_moderador" class="tg">
                <thead>
                    <tr>
                        <td class="tg-lrvc">Nome do Membro</td>
                        <td class="tg-lrvc">Voto</td>
                    </tr>
                </thead>

				<?php foreach ($Voto as $voto) : ?>
					<tr>
						<td><?= $voto['nomeMembro'] ?></td>
						<td><?= $voto['descricao'] ?></td>
					</tr>
				<?php endforeach; ?>

            </table>

            <br>
            <form action="resultado_votacao" method="POST" >
                <input class="invisible" name="idItem" value="<?php echo $id ?>">
				<input class="invisible" name="finalizado" id="finalizado" value="<?php echo $finalizado?>">
                <div id="bloco_aguardo_moderador">
                    <input type="submit" name="cancelar_votacao" id="bt_cancelar_votacao" value="Cancelar Votação"/>

                    <input type="submit" name="finalizar_votacao" id="bt_finalizar_votacao" value="Finalizar Votação"/>

                </div>
            </form>
        </div>

        <?php include('template/footer.php'); ?>

    </body>
	<script>
		var finalizado =  document.getElementById('finalizado').value;
		if(finalizado === 'true'){
			document.getElementById('bt_finalizar_votacao').click();
		}
		var time = 2000;
		if(typeof(EventSource) !== "undefined") {
			var source = new EventSource("votos_servidor");
			source.onmessage = function(event) {
				if(event.data ==='true'){
					setTimeout(function () {
						location.reload();
					}, time+time+1000);
				}
			};
		} else {
			document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
		}
	</script>
</html>
