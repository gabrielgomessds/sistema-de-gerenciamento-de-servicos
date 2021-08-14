<?php

class Paginas extends Controller{

    public function __construct()
    {
      $this->clienteModel = $this->model("Cliente");
    }

    public function index(){
        $this->view('paginas/admins/login');
    }
    public function infoServico(){
        $this->view('paginas/servicos/infoServico');
    }
    public function produtos(){
        $this->view('paginas/produtos/cadastrar');
    }
    public function servicos(){
        $this->view('paginas/servicos/cadastrar');
    }
    public function vendasRealizadas(){
        $this->view('paginas/vendas/vendasRealizadas');
    }

    public function admins(){
        $this->view('paginas/admins/cadastrar');
    }
   
}