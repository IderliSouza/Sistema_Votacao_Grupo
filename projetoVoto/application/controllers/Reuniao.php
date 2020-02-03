<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Reuniao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('reuniao_model');
        $this->load->model('membro_model');
        $this->load->model('item_model');
    }

    /**
     * metodo verifica se o membro logado eh moderador de alguma reuniao
     * caso nao seja vai para tela com as reunioes abertas
     * caso seja vai para tela com as reunioes em que eh moderador
     */
    public function redirecionar_reunioes() {
        $session_id = $this->session->userdata('sessao');
        $membro = $this->membro_model->buscarMembroPorNome($session_id);
        $membro_id = $membro[0]['idMembro'];
        $lista_reunioes = $this->reuniao_model->buscarReuniaoPorIdModerador($membro_id);
        if (empty($lista_reunioes)) {
            $lista_reunioes = $this->reuniao_model->buscarTodasAbertas();
        }
        $dados = array('Reuniao' => $lista_reunioes);
        $this->load->view('reunioes', $dados);
    }

    /**
     * metodo para abrir reuniao
     * caso o perfil logado seja moderador abre a reuniao para votacao
     * caso seja membro votante se registra na reuniao
     * e aguarda uma votacao iniciar
     */
    public function abrir_reuniao() {
        $session_id = $this->session->userdata('sessao');
        $membro = $this->membro_model->buscarMembroPorNome($session_id);
        $membro_id = $membro[0]['idMembro'];
        $lista_reunioes = $this->reuniao_model->buscarReuniaoPorIdModerador($membro_id);
        if (empty($lista_reunioes)) {
            $registrado = $this->membro_model->verificaRegistro();
            if ($registrado == false) {
                $this->membro_model->registrarReuniao();
            }
            $this->load->view('aguardo');
        } else {
            $this->reuniao_model->abrirReuniao();
            $lista_itens = $this->item_model->buscarTodas();
            $dados = array('Item' => $lista_itens);
            $this->load->view('itens_pauta', $dados);
        }
    }

}
