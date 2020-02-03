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

class Servidor extends CI_Controller
{

	public function index()
	{
		$arquivo = 'Arquivo/arquivo.txt';

		$handle = fopen( $arquivo, 'r' );

		$ler = fread( $handle, filesize($arquivo) );


		header('Content-Type: text/event-stream');
		header('Cache-Control: no-cache');


		echo "data: {$ler}\n\n";
		flush();
		fclose($handle);
	}


}
