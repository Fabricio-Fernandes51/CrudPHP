<?php
include_once "../conexao/Conexao.php";
include_once "../model/Livros.php";
include_once "../dao/LivrosDAO.php";

$lista = new Lista();
$listadao = new ListaDAO();

$d = filter_input_array(INPUT_POST);

//Cadastrar
if(isset($_POST['cadastrar'])){

    $lista->setAutor($d['autor']);
    $lista->setLivro($d['livro']);
    $lista->setPaginas($d['paginas']);
    $lista->setFinalizado($d['finalizado']);

    $listadao->create($lista);

    header("Location: ../../");
} 
// Editar
else if(isset($_POST['editar'])){

    $lista->setAutor($d['autor']);
    $lista->setLivro($d['livro']);
    $lista->setPaginas($d['paginas']);
    $lista->setFinalizado($d['finalizado']);
    $lista->setId($d['id']);

    $listadao->update($lista);

    header("Location: ../../");
}
// Deletar
else if(isset($_GET['del'])){

    $lista->setId($_GET['del']);

    $listadao->delete($lista);

    header("Location: ../../");
}else{
    header("Location: ../../");
}