<?php
class Lista{
    
    private $id;
    private $autor;
    private $livro;
    private $paginas;
    private $finalizado;
    
    function getId() {
        return $this->id;
    }

    function getAutor() {
        return $this->autor;
    }

    function getLivro() {
        return $this->livro;
    }

    function getPaginas() {
        return $this->paginas;
    }

    function getFinalizado() {
        return $this->finalizado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAutor($autor) {
        $this->autor = $autor;
    }

    function setLivro($livro) {
        $this->livro = $livro;
    }

    function setPaginas($paginas) {
        $this->paginas = $paginas;
    }

    function setFinalizado($finalizado) {
        $this->finalizado = $finalizado;
    }
}