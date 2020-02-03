<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 05/11/2018
 * Time: 16:47
 */
?>

<html>
    <head>
        <title>Encaminhamento</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jqueryui.js"></script>
        <?php include('template/head.php'); ?>
    </head>

    <body>
        <?php include('template/header.php'); ?>

        <p class="caminho"> » <b>Área</b>: Início » <b>Subárea</b>: Reuniões » Item de Pauta » Encaminhamento</p>

        <div id="corpo">
            <br>

            <form name="formSubmit" action="encaminhar" method="post">

                <div id="bloco_encaminhamento">

                    <form name="formEnter" onkeypress="addCampoComEnter()">
                        <div id="texto_encaminhamento">
                            <?php foreach ($Item as $item) : ?>
                                <p><b>Nome do Item:</b> <?= $item['nomeItem'] ?></p>
                                <p><b>Relator do Item:</b> <?= $item['nomeRelator'] ?></p>
                                <p><b>Descrição do Item:</b> <?= $item['descricaoItem'] ?></p>
                            <?php endforeach ?>
                        </div>

                        <div id="bloco_opcao_encaminhamento">
                            <input type="radio" id="simples" name="tipoEncaminhamento" checked="True">
                            <label for="simples">Encaminhamento Simples</label>
                            <span id="opcao_encaminhamento">
                                <input type="radio" id="customizado" name="tipoEncaminhamento">
                                <label for="customizado">Encaminhamento Customizado</label>
                            </span>
                            <br>
                        </div>

                        <div id="bloco_simples">
                            <ol>
                                <li><input readonly="true" class="campo" value="Abstenção"/></li>
                                <li><input readonly="true" class="campo" value="Favorável"/></li>
                                <li><input readonly="true" class="campo" value="Contrário"/></li>
                            </ol>
                        </div>

                        <div id="bloco_customizado">
                            <ol id="lista_campos">
                                <li><input readonly="true" class="campo" value="Abstenção"/>
                                    <button style="background-color: white; cursor: default" disabled class="bt_remover_campo">x
                                    </button>
                                </li>
                                <li><input type="text" class="campo"/>
                                    <button style="background-color: white; cursor: default" disabled class="bt_remover_campo">x
                                    </button>
                                </li>
                            </ol>
                            <div id="bloco_add_campo"><a href="#" id="add_campo">Adicionar novas opções de voto</a></div>

                        </div>
                        <br>
                    </form>

                    <button id="bt_encaminhar_votacao" type="submit" onclick="pegarJson()">Encaminhar Votação</button>
                    <input class="invisible" id="jsonVot" name="json">
                    </form>
                </div>
        </div>
        <script>
            function pegarOpcoes() {
                var el;
                var opcoes;
                if (document.getElementById('simples').checked === true) {
                    el = document.getElementById('bloco_simples');
                    opcoes = el.children[0].getElementsByClassName('campo');

                } else {
                    el = document.getElementById('bloco_customizado');
                    opcoes = el.children[0].getElementsByClassName('campo');
                }
                return opcoes;
            }

            function pegarJson() {
                var opcoes = pegarOpcoes();
                var tipoVotacao = 'personalizado';
                var idItem = <?= $item['idItem'] ?>;
                if (opcoes.item(1).value === 'Favorável') {
                    tipoVotacao = 'simples';
                }

                var text = tipoVotacao + ',';
                text += idItem + ',';
                for (var i = 0; i < opcoes.length - 1; i++) {
                    text += opcoes.item(i).value + ',';
                }
                i = i++;
                text += opcoes.item(i).value + ',';


                document.getElementById('jsonVot').value = text;
                teste = document.getElementById('jsonVot').value;

            }
        </script>
        <?php include('template/footer.php'); ?>
    </body>
</html>

