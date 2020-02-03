<?php

/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 10/11/2018
 * Time: 09:48
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('reuniao_model');
        $this->load->model('membro_model');
    }

    public function index() {
        $this->load->view('entrar');
    }

    /**
     * metodo para verificar se o usuario digitado existe
     * caso nao exista mostra uma mensagem de erro
     * caso exista abre a pagina inicio e cria uma sessao
     */
    public function logar() {
        $perfil = $this->input->post('nome_perfil');
        $membro = $this->membro_model->buscarMembroPorNome($perfil);

        if (empty($membro)) {
            $this->load->view('entrar');
            echo '<div style="'
            . 'background-color: red; '
            . 'color: white; '
            . 'text-align: center; '
            . 'padding: 5px 0;'
            . 'font-weight: bolder;">Este usuário não existe!</div>';
        } else {
            $this->session->set_userdata('sessao', $perfil);
            $this->load->view('inicio');
        }
    }

    /**
     * metodo pra voltar pra tela de login
     * encerra a sessao atual
     */
    public function deslogar() {
        $this->session->unset_userdata('sessao');
        $this->load->view('entrar');
    }

    /**
     * metodo para redirecionar para tela de inicio
     */
    public function inicio() {
        $this->load->view('inicio');
    }

}
