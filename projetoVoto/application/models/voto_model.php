<?php

/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 09/12/2018
 * Time: 10:25
 */
class voto_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('voto_model');
    }

    public function buscarTodosVotos() {
        $this->db->from('voto');
        $this->db->select('*');
        return $this->db->get()->result_array();
    }
	public function buscarVotos($idItem) {
		$this->db->from('voto');
		$this->db->join('opcoesvoto', 'voto.idOpcao = opcoesvoto.idOpcao');
		$this->db->where('opcoesvoto.idItem', $idItem);
		$this->db->select('*');
		return $this->db->get()->result_array();
	}

	public function buscarTodosVotosDoItem($idItem) {
		$this->db->from('voto');
		$this->db->join('opcoesvoto', 'voto.idOpcao = opcoesvoto.idOpcao');
		$this->db->join('membro', 'voto.idMembro = membro.idMembro');
		$this->db->where('opcoesvoto.idItem', $idItem);
		$this->db->select('*');
		return $this->db->get()->result_array();
	}
	public function buscarUmaVotacaoPorIdItem($idItem) {
		$this->db->from('votacao');
		$this->db->where('idItem', $idItem);
		$this->db->select('*');
		return $this->db->get()->result_array();
	}
}
