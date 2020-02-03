<?php

/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 24/11/2018
 * Time: 10:25
 */
class votacao_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('votacao_model');
    }

    public function buscarOpVotos() {
        return $this->db->get("opcoesvoto")->result_array();
    }

    public function retornaVotoMembro($idOpcao) {
        return $this->db->get_where("voto", array(
                    "idOpcao" => $idOpcao
                ))->row_array();
    }

    /**
     * requer mudanças - salvando o voto do membro no banco
     */
    public function salvarVotoMembro($idMembro, $idOpcao) {

        $data = array(
            'idOpcao' => $idOpcao,
            'idMembro' => $idMembro
        );

        $this->db->insert('voto', $data);

        //$query =$this->db->insert('idMembro',$data);
        //$idOpcao = $this->input->post('idOpcao');
    }

    public function buscarOpcoesVotoPorItem($idItem) {
        $this->db->from('opcoesvoto');
        $this->db->where('idItem = ', $idItem);
        $this->db->select('*');
        return $this->db->get()->result_array();
    }

    public function buscaOpcaoVotoPorNome($nome, $idItem) {
		$this->db->from('opcoesvoto');
		$this->db->where('descricao =', $nome);
		$this->db->where('idItem =', $idItem);
		$this->db->select('*');
		return $this->db->get()->result_array();
    }
    public function buscarOpcoes($idItem){
		$this->db->from('opcoesvoto');
		$this->db->where('idItem =', $idItem);
		$this->db->select('*');
		return $this->db->get()->result_array();
	}

    public function buscarTodasOpcoesVoto() {
        $this->db->from('opcoesvoto');
        $this->db->select('*');
        return $this->db->get()->result_array();
    }
    
    public function deletarVotacaoPorIdItem($idItem) {
        $this->db->where('idItem', $idItem);
        $this->db->delete('votacao');
    }

    public function deletarVotacao($idVotacao) {
        $this->db->where('idVotacao', $idVotacao);
        $this->db->delete('votacao');
    }

    public function buscarMembrosQueVotaram($idItem){
		$this->db->from('voto');
		$this->db->join('opcoesvoto', 'voto.idOpcao = opcoesvoto.idOpcao');
		$this->db->where('opcoesvoto.idItem', $idItem);
		$this->db->select('*');
		return $this->db->get()->result_array();
	}

	public function buscarMembrosRegistrados($idItem){
		$this->db->from('membroreuniao');
		$this->db->join('itempauta', 'itempauta.idItem ='. $idItem);
		$this->db->where('membroreuniao.idReuniao = itempauta.idReuniao');
		$this->db->select('*');
		return $this->db->get()->result_array();
	}
//SELECT * from membroreuniao INNER JOIN itempauta on itempauta.idItem = 1 WHERE itempauta.idReuniao = membroreuniao.idReuniao
//SELECT * from voto INNER JOIN opcoesvoto on voto.idOpcao = opcoesvoto.idOpcao WHERE opcoesvoto.idItem = 1
}
