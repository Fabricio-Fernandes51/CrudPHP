<?php

class ListaDAO{
    
    public function create(Lista $lista) {
        try {
            $sql = "INSERT INTO lista (                   
                  autor,livro,paginas,finalizado)
                  VALUES (
                  :autor,:livro,:paginas,:finalizado)";

            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":autor", $lista->getAutor());
            $p_sql->bindValue(":livro", $lista->getLivro());
            $p_sql->bindValue(":paginas", $lista->getPaginas());
            $p_sql->bindValue(":finalizado", $lista->getFinalizado());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao Inserir lista <br>" . $e . '<br>';
        }
    }

    public function read() {
        try {
            $sql = "SELECT * FROM lista order by autor asc";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaLista($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
     
    public function update(Lista $lista) {
        try {
            $sql = "UPDATE lista set
                
                  autor=:autor,
                  livro=:livro,
                  paginas=:paginas,
                  finalizado=:finalizado                  
                                                                       
                  WHERE id = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":autor", $lista->getAutor());
            $p_sql->bindValue(":livro", $lista->getLivro());
            $p_sql->bindValue(":paginas", $lista->getPaginas());
            $p_sql->bindValue(":finalizado", $lista->getFinalizado());
            $p_sql->bindValue(":id", $lista->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }

    public function delete(Lista $lista) {
        try {
            $sql = "DELETE FROM lista WHERE id = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":id", $lista->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir lista<br> $e <br>";
        }
    }

    private function listaLista($row) {
        $lista = new Lista();
        $lista->setId($row['id']);
        $lista->setAutor($row['autor']);
        $lista->setLivro($row['livro']);
        $lista->setPaginas($row['paginas']);
        $lista->setFinalizado($row['finalizado']);

        return $lista;
    }
 }

 ?>