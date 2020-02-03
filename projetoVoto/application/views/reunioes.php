<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 08/11/2018
 * Time: 23:40
 */
?>

<html>
    <head>
        <title>Reuniões</title>
        <?php include('template/head.php'); ?>
    </head>
    <body>
        <?php include('template/header.php'); ?>

        <p class="caminho"> » <b>Área</b>: Início » <b>Subárea</b>: Reuniões</p>

        <div id="corpo">
            <br>
            <div class="nome_tabela">
                Reuniões
            </div>
            <table id="tabela_reuniao" class="tg">
                <thead>
                    <tr>
                        <td class="tg-lrvc">Nome</td>
                        <td class="tg-lrvc">Tipo</td>
                        <td class="tg-lrvc">Sala</td>
                        <td class="tg-lrvc">Comissão</td>
                        <td class="tg-lrvc">Data</td>
                        <td class="tg-lrvc">Hora Inicio</td>
                        <td class="tg-lrvc">Hora Fim</td>
                        <td class="tg-lrvc">Status</td>
                        <td class="tg-lrvc"></td>
                    </tr>
                </thead>

                <tr>

                    <?php
                    $perfil = $this->session->userdata('sessao');
                    date_default_timezone_set('America/Sao_Paulo');
                    $data = date('Y-m-d');
                    $hora = date("H:i", mktime(gmdate("H") - 2, gmdate("i")));
                    if (empty($Reuniao)) {
                        echo '<td colspan="9">Nenhuma reunião disponível.</td>';
                    } else {
                        foreach ($Reuniao as $reunioes) :
                        ?>
                        <td name="nomeReuniao"><?= $reunioes['nomeReuniao'] ?></td>
                        <td name="tipoReuniao"><?= $reunioes['tipoReuniao'] ?></td>
                        <td name="salaReuniao"><?= $reunioes['salaReuniao'] ?></td>
                        <td name="comissaoReuniao"><?= $reunioes['comissaoReuniao'] ?></td>
                        <td name="dataReuniao"><?= $reunioes['dataReuniao'] ?></td>
                        <td name="horaReuniao"><?= $reunioes['horaComecoReuniao'] ?></td>
                        <td name="horaReuniao"><?= $reunioes['horaFinalReuniao'] ?></td>
                        <?php
                        if ($reunioes['estadoReuniao'] == 0) {
                        echo '<td name="horaReuniao">Reunião Fechada</td>';
                    } else {
                    echo '<td name="horaReuniao">Reunião Aberta</td>';
                }
            
                ?>


                <form action="abrir_reuniao" method="post">
                    <input class="invisible" name="idReuniao" value="<?= $reunioes['idReuniao'] ?>">
                    <input class="invisible" name="perfil" value="<?= $perfil ?>">
                    <td class="botao_responsivo">
                <?php
                if ($data == $reunioes['dataReuniao']) {
                    if ($hora >= $reunioes['horaComecoReuniao'] && $hora <= $reunioes['horaFinalReuniao']) {
                        if ($reunioes['estadoReuniao'] == 1) {
                            echo '<button class="bt_entrar_reuniao" name="btAbrir" type="submit">Entrar</button>';
                        } else {
                            echo '<button class="bt_abrir_reuniao" name="btAbrir" type="submit">Abrir</button>';
                        }
                    } else {
                        echo '<button class="bt_desativado_reuniao" disabled="disabled" onclick="this.disabled=true" name="btAbrir" type="submit">Abrir</button>';
                    }
                } else {
                    echo '<button class="bt_desativado_reuniao" disabled="disabled" onclick="this.disabled=true" name="btAbrir" type="submit">Abrir</button>';
                }
                ?>
                    </td>
                </form> 
                </tr>

                    <?php endforeach ?>
                    <?php } ?>
            </table>
        </div>
<?php include('template/footer.php'); ?>
    </body>
</html>
