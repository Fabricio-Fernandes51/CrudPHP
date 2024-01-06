<?php
include_once "./app/conexao/Conexao.php";
include_once "./app/dao/LivrosDAO.php";
include_once "./app/model/Livros.php";

//instancia as classes
$livros = new Lista();
$listadao = new ListaDAO();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>CRUD Simples PHP</title>
    <style>
        .row {
            padding: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-dark">
        <div class="container navbar-dark">
            <a class="navbar-brand " href="#">
                Lista de livros
            </a>
        </div>
    </nav>
    <div class="container">
        <form action="app/controller/LivrosController.php" method="POST">
            <div class="row">
                <div class="col-md-3">
                    <label>Autor</label>
                    <input type="text" name="autor" value="" autofocus class="form-control" require />
                </div>
                <div class="col-md-3">
                    <label>Nome do livro</label>
                    <input type="text" name="livro" value="" class="form-control" require />
                </div>
                <div class="col-md-2">
                    <label>Numero de paginas</label>
                    <input type="number" name="paginas" value="" class="form-control" require />
                </div>
                <div class="col-md-2">
                      <label>Lido</label>
                      <select name="finalizado" class="form-control">
                        <option value="S">Sim</option>
                        <option value="N">Não</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <br>
                    <button class="btn btn-primary mt-2" type="submit" name="cadastrar">Adicionar</button>
                </div>
            </div>
        </form>
        <hr>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Numero</th>
                        <th>Autor</th>
                        <th>Nome do livro</th>
                        <th>Paginas</th>
                        <th>Finalizado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listadao->read() as $lista) : ?>
                        <tr>
                            <td><?= $lista->getId() ?></td>
                            <td><?= $lista->getAutor() ?></td>
                            <td><?= $lista->getLivro() ?></td>
                            <td><?= $lista->getPaginas() ?></td>
                            <td><?= $lista->getFinalizado() ?></td>
                            <td class="text-center">
                                <button class="btn  btn-warning btn-sm" data-toggle="modal" data-target="#editar><?= $lista->getId() ?>">
                                    Editar
                                </button>
                                <a href="app/controller/LivrosController.php?del=<?= $lista->getId() ?>">
                                    <button class="btn  btn-danger btn-sm" type="button">Excluir</button>
                                </a>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="editar><?= $lista->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="app/controller/LivrosController.php" method="POST">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>Autor</label>
                                                    <input type="text" name="autor" value="<?= $lista->getAutor() ?>" class="form-control" require />
                                                </div>
                                                <div class="col-md-7">
                                                    <label>Livro</label>
                                                    <input type="text" name="livro" value="<?= $lista->getLivro() ?>" class="form-control" require />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Paginas</label>
                                                    <input type="number" name="paginas" value="<?= $lista->getPaginas() ?>" class="form-control" require />
                                                </div>
                                                <div class="col-md-3">
                                                <label>Sexo</label>
                                                    <select name="finalizado" class="form-control">
                                                        <?php if ($lista->getFinalizado() == 'S') : ?>
                                                            <option value="S">Sim</option>
                                                            <option value="N">Não</option>
                                                        <?php else : ?>
                                                            <option value="S">Sim</option>
                                                            <option value="N">Não</option>
                                                        <?php endif ?>
                                                    </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <br>
                                                    <input type="hidden" name="id" value="<?= $lista->getId() ?>" />
                                                    <button class="btn btn-primary" type="submit" name="editar">Cadastrar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>