<?php
/**
 * Created by PhpStorm.
 * User: junin
 * Date: 18/10/2018
 * Time: 16:05
 */
class reuniao_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('reuniao_model');
    }

    /**
     * Passa a tabela e pega todos os itens dela
     */
    public function buscarTodas() {
        return $this->db->get("Reuniao")->result_array();
    }

    public function retorna($idReuniao) {
        return $this->db->get_where("reuniao", array(
                    "idReuniao" => $idReuniao
                ))->row_array();
    }

    public function abrirReuniao() {
        $idReuniao = $this->input->post('idReuniao');
        $this->db->set('estadoReuniao', '1');
        $this->db->where('idReuniao', $idReuniao);
        $this->db->update('Reuniao');
    }

    public function buscarTodasAbertas() {
        $data = date('Y-m-d');
        $hora = date("H:i", mktime(gmdate("H") - 2, gmdate("i")));
        $this->db->from('reuniao');
        $this->db->where('estadoReuniao', 1);
        $this->db->select('*');
        return $this->db->get()->result_array();
    }

    /**
     * metodo para pegar todas as reunioes de um moderador
     * pelo id do moderador
     * @param type $idModerador
     * @return type
     */
    public function buscarReuniaoPorIdModerador($idModerador) {
        $this->db->from('reuniao');
        $this->db->where('idModerador =', $idModerador);
        $this->db->select('*');
        return $this->db->get()->result_array();
    }
    
    public function buscarReuniaoPorMembroLogado($idMembro) {
        $this->db->from('membroreuniao');
        $this->db->where('idMembro =', $idMembro);
        $this->db->select('*');
        return $this->db->get()->result_array();
        
    }

}
