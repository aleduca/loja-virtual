<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ProdutoModel;
use App\Repositories\Admin\ProdutosRepository;

class AdminCapaProdutoController extends BaseController{
    
    public function index($args){

        $id = filter_var($args[0],FILTER_SANITIZE_NUMBER_INT);

        $produto = new ProdutoModel;
        $produtoEncontrado = $produto->find('id',$id);
        
        $dados = [
            'titulo' => 'Nova capa para o curso',
            'produto' => $produtoEncontrado
        ];
        
        $template = $this->twig->loadTemplate('admin_alterar_capa_curso.html');
        
        $template->display($dados);   
    }

    public function store(){
        $id = filter_input(INPUT_POST,'id_produto',FILTER_SANITIZE_NUMBER_INT);

        $foto = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];

        $produto = new ProdutoModel;
        $produtoEncontrado = $produto->find('id',$id);

        $pasta = 'assets/images/produtos';

        @unlink($pasta.DIRECTORY_SEPARATOR.$produtoEncontrado->produto_capa);

        $updated = move_uploaded_file($temp, $pasta.DIRECTORY_SEPARATOR.$foto);

        $produtosRepository = new ProdutosRepository;
        $produtosRepository->atualizarCapa($pasta.DIRECTORY_SEPARATOR.$foto,$id);
      
        if($updated){
            echo 'updated';
        } 
    }

}