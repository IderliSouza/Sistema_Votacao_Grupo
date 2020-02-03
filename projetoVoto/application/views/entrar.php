<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 10/11/2018
 * Time: 09:46
 */
?>

<html>
    <head>
        <title>Login</title>
        <?php include('template/head.php'); ?>
    </head>
    <body>
        <?php include('template/header.php'); ?>
        <br>

        <div id="corpo">
            <br>

            <div id="bloco_login">
                <h4>Faça seu Login!</h4>
                <hr>

                <p>Perfil:</p>

                <form action="home" method="post">
                    <div id="bloco_select_perfil" >
                        <input type="text" name="nome_perfil" placeholder="Usuário">
                    </div>
                    <button type="submit" class="bt_logar">Entrar</button>
                </form>
                <br>
                <br>

            </div>


        </div>
        <?php include('template/footer.php'); ?>
    </body>
</html>
