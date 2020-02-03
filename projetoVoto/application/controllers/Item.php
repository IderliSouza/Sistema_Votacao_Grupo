<?php

/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 09/11/2018
 * Time: 22:30
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Item extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('item_model');
		$this->load->model('voto_model');
		$this->load->model('votacao_model');
    }

    public function index() {
        $lista = $this->item_model->buscarTodas();
        $dados = array('Item' => $lista);
        $this->load->view('itens_pauta', $dados);
    }

    /*
     * metodo para pegar item de pauta selecionado
     * e abrir a tela de encaminhamento
     */
    public function abrir_item() {
		$idItem = $this->input->post('idItem');
        $itemSelecionado = $this->item_model->buscarUmaPautaPorID($idItem);
        $dados = array('Item' => $itemSelecionado);
        $this->load->view('encaminhamento', $dados);
    }

    public function encaminhar_item() {
		$teste = $_POST['json'];
		$pegar = explode(',', $teste);
		$idItem = $pegar[1];
		$votantes = $this->votacao_model->buscarMembrosQueVotaram($idItem);
		$registrados = $this->votacao_model->buscarMembrosRegistrados($idItem);
		if(count($votantes) === count($registrados)){
			$lista_votos = $this->voto_model->buscarTodosVotosDoItem($idItem);
			$dados = array('Voto' => $lista_votos, 'id'=>$idItem, 'finalizado' => 'true');
			$this->load->view('aguardo_moderador', $dados);
		}
		$item = $this->voto_model->buscarUmaVotacaoPorIdItem($idItem);
		if(empty($item)){
			$this->item_model->encaminharItemPauta();
			$this->set_Id($idItem);
		}
		$lista_votos = $this->voto_model->buscarTodosVotosDoItem($idItem);
		$dados = array('Voto' => $lista_votos, 'id'=>$idItem, 'finalizado' => 'false');
		$this->load->view('aguardo_moderador', $dados);
    }

    public function set_Id($idItem) {
        $arquivo = 'Arquivo/arquivo.txt';
        $html = $idItem;
        $handle = fopen($arquivo, 'w+');
        $ler = fwrite($handle, $html);
        fclose($handle);
    }

}
