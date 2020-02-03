<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 08/11/2018
 * Time: 21:10
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Aguardo extends CI_Controller {

    public function index() {
        $this->load->helper('url');
        $this->load->view('aguardo');
    }

    public function aguardar_moderador() {
        $this->load->helper('url');
        $this->load->view('aguardo_moderador');
    }

}
