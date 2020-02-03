<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 29/11/2018
 * Time: 19:02
 */
?>
<html>
    <head>
        <title>Resultado da Votação</title>
        <?php include('template/head.php'); ?>
    </head>
    <body>

        <?php include('template/header.php'); ?>

        <p class="caminho">  » <b>Área</b>: Início » Reuniões » Item de Pauta » Encaminhamento <b>Ação</b>: Resultado</p>

        <div id="corpo">

            <br>

            <div id="bloco_resultado">
                <hr>
                <h3>Opção Vencedora: <?php echo $opcaoVencedora?></h3>
                <hr>
            </div>

            <br>

            <div class="nome_tabela">
                Votos
            </div>
            <table id="tabela_votos" class="tg">
                <thead>
                    <tr>
                        <td class="tg-lrvc">Votantes</td>
                        <td class="tg-lrvc">Opção de Voto Escolhida</td>
                    </tr>
                </thead>
                <?php foreach ($listaVoto as $voto) : ?>
                    <tr>
                        <td><?= $voto['nomeMembro'] ?></td>
                        <td><?= $voto['descricaoOpcao'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <br>

            <div class="nome_tabela">
                Resultado Analítico
            </div>
            <table id="tabela_resultado" class="tg">
                <thead>
                    <tr>
                        <td class="tg-lrvc">Opção de Voto</td>
                        <td class="tg-lrvc">Porcentagem de Votos</td>
                    </tr>
                </thead>

                <?php foreach ($listaOpcoes as $opcao) : ?>
                    <tr>
                        <td><?= $opcao['descricaoOpcao'] ?></td>
                        <td><?= $opcao['porcentagem'] ?>%</td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>

        <?php include('template/footer.php'); ?>
    </body>
</html>
