<?php

/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 24/11/2018
 * Time: 10:25
 */
class votacao extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('votacao_model');
		$this->load->model('reuniao_model');
		$this->load->model('membro_model');
		$this->load->model('item_model');
		$this->load->model('voto_model');
	}

	public function index()
	{
		$this->load->view('votacao');
	}

	public function result()
	{
		$this->load->view('resultado');
	}

	/**
	 * id de estados de votação:
	 * 0: encerrada // 1: aberta // 2: cancelada
	 */
	public function votar()
	{
		$session_id = $this->session->userdata('sessao');
		$membro = $this->membro_model->buscarMembroPorNome($session_id);
		$idMembro = $membro[0]['idMembro'];
		$opcaoVotada = $this->input->post('opcaoVotada');
		$idItem = $this->input->post('idItem');
		$opcao_escolhida = $this->votacao_model->buscaOpcaoVotoPorNome($opcaoVotada, $idItem);
		$idOpcao = $opcao_escolhida[0]['idOpcao'];
		$this->votacao_model->salvarVotoMembro($idMembro, $idOpcao);
		$this->membro_votou();

		$this->load->view('aguardo');

	}

	public function membro_votou()
	{
		$arquivo = 'Arquivo/votos.txt';

		$html = 'true';

		$handle = fopen($arquivo, 'w+');

		$ler = fwrite($handle, $html);

		fclose($handle);
	}
	public function  votacao_acabou()
	{
		$arquivo = 'Arquivo/votos.txt';

		$html = 'false';

		$handle = fopen($arquivo, 'w+');

		$ler = fwrite($handle, $html);

		fclose($handle);
	}

	public function abrir_votacao()
	{
		$this->voltar_arquivo();
		$idItem = filter_input(INPUT_POST, 'idItem');
		$idReuniao = filter_input(INPUT_POST, 'idReuniao');
		$perfil_logado = $this->session->userdata('sessao');
		$membro = $this->membro_model->buscarMembroPorNome($perfil_logado);
		$idMembro = $membro[0]['idMembro'];
		$reuniao = $this->reuniao_model->buscarReuniaoPorMembroLogado($idMembro);
		$item = $this->item_model->buscarNomeItemPautaPorID($idItem);
		$opcoes = $this->votacao_model->buscarOpcoesVotoPorItem($idItem);
		$dados = array('item' => $item[0], 'opcoes' => $opcoes, 'idItem' => $idItem);

		$this->load->view('votacao', $dados);
	}

	public function voltar_arquivo()
	{
		$arquivo = 'Arquivo/arquivo.txt';
		$html = 'false';
		$handle = fopen($arquivo, 'w+');
		$ler = fwrite($handle, $html);
		fclose($handle);
	}


	public function votacao_finalizada()
	{
		$this->votacao_acabou();
		$idItem = filter_input(INPUT_POST, 'idItem');
		if (filter_input(INPUT_POST, 'cancelar_votacao') == 'Cancelar Votação') {


			$this->votacao_model->deletarVotacaoPorIdItem($idItem);

			$perfil_logado = $this->session->userdata('sessao');
			$membro = $this->membro_model->buscarMembroPorNome($perfil_logado);
			$idMembro = $membro[0]['idMembro'];
			$lista_reunioes = $this->reuniao_model->buscarReuniaoPorIdModerador($idMembro);
			$dados = array('Reuniao' => $lista_reunioes);
			$this->load->view('reunioes', $dados);

		} else if (filter_input(INPUT_POST, 'finalizar_votacao') == 'Finalizar Votação') {

			$listaVotos = $this->voto_model->buscarVotos($idItem);
			$listaMembros = $this->membro_model->buscarTodosMembros();
			$listaOpcoes = $this->votacao_model->buscarOpcoes($idItem);
			$listaVotosNomes = null;
			$listaVotosPorcentagem = null;
			$listaOficial = null;
			$cont = 0;
			foreach ($listaVotos as $voto) {
				foreach ($listaMembros as $membro) {
					if ($voto['idMembro'] === $membro['idMembro']) {
						$listaVotosNomes[$cont]['nomeMembro'] = $membro['nomeMembro'];
					}
				}

				foreach ($listaOpcoes as $opcao) {
					if ($voto['idOpcao'] === $opcao['idOpcao']) {
						$listaVotosNomes[$cont]['descricaoOpcao'] = $opcao['descricao'];
					}
				}
				$cont++;
			}
			$cont2 = 0;
			$nVotos = 0;
			foreach ($listaOpcoes as $opcao) {
				$listaVotosPorcentagem[$cont2]['descricaoOpcao'] = $opcao['descricao'];
				$listaVotosPorcentagem[$cont2]['porcentagem'] = 0;
				foreach ($listaVotos as $voto) {
					if ($opcao['idOpcao'] === $voto['idOpcao']) {
						$nVotos++;
						$listaVotosPorcentagem[$cont2]['descricaoOpcao'] = $opcao['descricao'];
						$listaVotosPorcentagem[$cont2]['porcentagem'] = $listaVotosPorcentagem[$cont2]['porcentagem'] + 1;
					}
				}
				$cont2++;
			}
			$cont3 = 0;
			foreach ($listaVotosPorcentagem as $opcaoPorcentagem) {
				$listaOficial[$cont3]['descricaoOpcao'] = $opcaoPorcentagem['descricaoOpcao'];
				$listaOficial[$cont3]['porcentagem'] = round(($opcaoPorcentagem['porcentagem'] / $nVotos) * 100, 2);
				$cont3++;
			}
			$vencedor = max(array_column($listaOficial, 'porcentagem'));
			foreach ($listaOficial as $valor) {
				if ($valor['porcentagem'] === $vencedor) {
					$vencedor = $valor['descricaoOpcao'];
				}
			}


			$dados = array('listaVoto' => $listaVotosNomes, 'listaOpcoes' => $listaOficial, 'opcaoVencedora' => $vencedor);

			$this->load->view('resultado', $dados);
		}
	}
}
