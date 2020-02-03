<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 09/11/2018
 * Time: 22:42
 */
?>

<html>
    <head>
        <title>Itens de Pauta</title>
        <?php include('template/head.php'); ?>
    </head>
    <body>
        <?php include('template/header.php'); ?>

        <p class="caminho"> » <b>Área</b>: Início » <b>Subárea</b>: Itens Pauta</p>

        <div id="corpo">
            <br>
            <div class="nome_tabela">
                Itens de Pauta
            </div>
            <table id="tabela_item" class="tg">
                <thead>
                    <tr>
                        <td class="tg-lrvc">Nome</td>
                        <td class="tg-lrvc">Descrição</td>
                        <td class="tg-lrvc">Relator</td>
                        <td class="tg-lrvc"></td>
                    </tr>
                </thead>

                <tr>
                    <?php foreach ($Item as $item) : ?>
                        <td name="nomeItem"><?= $item['nomeItem'] ?></td>
                        <td name="descricaoItem"><?= $item['descricaoItem'] ?></td>
                        <td name="relatorItem"><?= $item['nomeRelator'] ?></td>

                        <form action="abrir_item" method="post">
                            <input class="invisible" name="idItem" value="<?= $item['idItem'] ?>">
                            <td class="botao_responsivo">
                                <button class="bt_abrir_reuniao" name="btAbrir" type="submit">Abrir</button>
                            </td>
                        </form>                    
                </tr>
                <?php endforeach ?>
            </table>
        </div>
        <?php include('template/footer.php'); ?>
    </body>
</html>
