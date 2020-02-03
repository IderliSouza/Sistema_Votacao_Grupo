<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 08/11/2018
 * Time: 23:06
 */
?>

<div id="container">
    <header>
        <img id="img_header" style="padding-top: 5px;" width="100%" src="<?php echo base_url('img/uni.jpg'); ?>"/>
        <div class="topnav" id="myTopnav">

            <?php
            $session_id = $this->session->userdata('sessao');
            if (!empty($session_id)) {
                echo '<a href="' . base_url('inicio') . '">INÍCIO ›</a>';
                echo '<a href="' . base_url('reunioes') . '">REUNIÕES ›</a>';
                echo '<a href="' . base_url('abrir_votacao') . '">VOTAR ›</a>';
                echo '<a href="' . base_url('login') . '" class="perfil_responsivo">SAIR ›</a>';
                echo '<a href="#" class="perfil_responsivo">' . strtoupper($session_id) . ' ›</a>';
            } else {
                echo '<a href="#">INÍCIO ›</a>';
                echo '<a href="#">REUNIÕES ›</a>';
                echo '<a href="#" class="perfil_responsivo">SAIR ›</a>';
            }
            ?>            
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </header>
 