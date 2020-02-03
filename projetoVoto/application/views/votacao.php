<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 24/11/2018
 * Time: 10:17
 */
?>

<html>
    <head>
        <title>Votação</title>
        <?php include('template/head.php'); ?>
    </head>
    <body>
        <?php include('template/header.php'); ?>

        <p class="caminho"> » <b>Área</b>: Início » <b>Subárea</b>: Reuniões » Item de Pauta <b>Ação</b>: Votar</p>

        <div id="corpo">
            <br>
            <div id="bloco_voto">
                <div id="voto_item">
                    <hr>
                    <h3>Votação do Item de Pauta: <?= $item['nomeItem'] ?>.</h3>
                    <hr>
                </div>
                <br>
                <form action="votar" method="POST">
                    <div id="opcoes_voto">
                        <?php
                        foreach ($opcoes as $opcao) :
                            ?>
                            <label class="container"><b><?= $opcao['descricao'] ?></b>
                                <input type="radio" name="opcaoVotada" value="<?= $opcao['descricao'] ?>">
                                <span class="checkmark"></span>
                            </label>
                        <?php endforeach ?>
                    </div>

                    </div>
                    <br>
                    <div id="bloco_botao">
                        <button id="bt_votar" type="submit" onclick="alert('Deseja realmente votar nesta opção?')">Votar
                        </button>
                    </div>
			<input class="invisible" name="idItem" value="<?= $idItem ?>">
			</form>
    </div>
    <?php include('template/footer.php'); ?>
</body>
</html>
