<?php
/**
 * Created by PhpStorm.
 * User: junin
 * Date: 18/10/2018
 * Time: 16:05
 */
class membro_model extends CI_Model {

    /**
     * metodo para registrar membro votante na reuniao
     */
    public function registrarReuniao() {
        $perfil_logado = $this->session->userdata('sessao');
        $membro = $this->membro_model->buscarMembroPorNome($perfil_logado);
        $idMembro = $membro[0]['idMembro'];
        $idReuniao = $this->input->post('idReuniao');
        $data = array(
            'idReuniao' => $idReuniao,
            'idMembro' => $idMembro,
            'estadoMembro' => '0'
        );
        $this->db->insert('membroreuniao', $data);
    }

    /**
     * metodo para verificar se membro esta registrado na reuniao
     * retorna true se estiver registrado
     * @return boolean
     */
    public function verificaRegistro() {
        $perfil_logado = $this->session->userdata('sessao');
        $membro = $this->membro_model->buscarMembroPorNome($perfil_logado);
        $idMembro = $membro[0]['idMembro'];
        $idReuniao = $this->input->post('idReuniao');

        $this->db->from('membroreuniao');
        $this->db->select('*');
        $MembrosRegistrados = $this->db->get()->result_array();
        $registrado = false;
        foreach ($MembrosRegistrados as $registro) :
            if ($idReuniao == $registro['idReuniao'] && $idMembro == $registro['idMembro']) {
                $registrado = true;
            }
        endforeach;
        return $registrado;
    }

    /**
     * metodo pra pegar todos os membros registrados no banco
     */
    public function buscarTodosMembros() {
        $this->db->from('membro');
        $this->db->select('*');
        return $this->db->get()->result_array();
    }

    /**
     * metodo para pegar todas as informacoes de um membro
     * pelo seu nome
     * @param string $nome
     * @return array de membros
     */
    public function buscarMembroPorNome($nome) {
        $this->db->from('membro');
        $this->db->where('nomeMembro =', $nome);
        $this->db->select('*');
        return $this->db->get()->result_array();
    }

    /**
     * metodo para pegar todas as informacoes de um membro
     * pelo seu id
     * @param int $idMembro
     * @return array de membros
     */
    public function buscarMembroPorId($idMembro) {
        $this->db->from('membro');
        $this->db->where('idMembro =', $idMembro);
        $this->db->select('*');
        return $this->db->get()->result_array();
    }

}
