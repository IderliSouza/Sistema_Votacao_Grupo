<?php
/**
 * Created by PhpStorm.
 * User: junin
 * Date: 18/10/2018
 * Time: 16:05
 */
class item_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('item_model');
    }

    /**
     * Passa a tabela e pega todos os itens dela
     */
    public function buscarTodas() {
        $idReuniao = $this->input->post('idReuniao');
        $this->db->from('itempauta');
        $this->db->join('relator', 'itempauta.idRelator = relator.idRelator');
        $this->db->where('itempauta.idReuniao', $idReuniao);
        $this->db->select('*', 'relator.nomeRelator');
        return $this->db->get()->result_array();
    }

    public function buscarUmaPautaPorID($idItem) {
        $this->db->from('itempauta');
        $this->db->join('relator', 'itempauta.idRelator = relator.idRelator');
        $this->db->where('idItem', $idItem);
        $this->db->select('*', 'relator.nomeRelator');
        return $this->db->get()->result_array();
    }

    public function encaminharItemPauta() {

        $estadoVotacao = 1;
        $teste = $_POST['json'];
        $pegar = explode(',', $teste);
        $tipo = $pegar[0];
        $idItem = $pegar[1];
        $vencedor = null;
        $opcoes = array();
        for ($i = 2; $i < count($pegar); $i++) {
            array_push($opcoes, $pegar[$i]);
        }

        for ($j = 0; $j < count($opcoes) - 1; $j++) {
            $this->encaminharOpcoes($opcoes[$j], $idItem);
        }

        $data = array(
            'tipo' => $tipo,
            'vencedor' => $vencedor,
            'estadoVotacao' => $estadoVotacao,
            'idItem' => $idItem
        );
        $this->db->insert('votacao', $data);
    }

    public function encaminharOpcoes($opcao, $idItem) {
        $data = array(
            'descricao' => $opcao,
            'idItem' => $idItem
        );
        $this->db->insert('opcoesvoto', $data);
    }
    
    public function buscarItemPorReuniao($idReuniao) {
        $this->db->from('itempauta');
        $this->db->where('idReuniao =', $idReuniao);
        $this->db->select('*');
        return $this->db->get()->result_array();
    }
	public function buscarNomeItemPautaPorID($idItem) {
		$this->db->from('itempauta');
		$this->db->join('relator', 'itempauta.idRelator = relator.idRelator');
		$this->db->where('idItem', $idItem);
		$this->db->select('*');
		return $this->db->get()->result_array();
	}



}
