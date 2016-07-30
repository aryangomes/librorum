<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\db\Query;
use yii\bootstrap\Modal;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */

$this->title = 'Busca no Acervo';
?>
<div class="busca-index">

    <div class="container">
        <h2 class="row">Pesquisa no Acervo</h2>
    </div>

    <div class="bs-example">
        <form class="" id="w1" action="/librorum/yii2/web/busca/busca-acervo" method="get">
            <div class="form-group input-group input-group-lg">
                <input type="text" name="acervo" class="form-control" placeholder="Buscar Material">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Pesquisar</button>
                </span>
            </div>
        </form>
    </div>

    <?php
    if (Yii::$app->session->hasFlash('buscaAcervo')) {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-danger',
            ],
            'body' => Yii::$app->session->getFlash('buscaAcervo'),
        ]);
    } else {
        ?>
        <?php
        if (isset($exemplares)) {
            ?>
            <!-- ------------- RESULTADO DA PESQUISA ----------------- -->
            <div class="container">
                <h3 class="row">Resultados da Pesquisa</h3>
            </div>

            <table class="table table-striped table-bordered table-responsive"> 
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Editora</th>
                    <th>Material</th>
                    <th>Categoria</th>
                    <th>Chamada</th>
                    <th>Código do Livro</th>
                    <th>Disponibilidade</th>
                </tr>

                <?php
                if (isset($exemplares)) {
                    foreach ($exemplares as $result) {
                        ?>
                        <tr>
                            <td><?= $acervo->titulo ?></td>
                            <td><?= $acervo->autor ?></td>
                            <td><?= $acervo->editora ?></td>
                            <td><?= $acervo->tipoMaterialIdtipoMaterial->nome ?></td>
                            <td><?= $acervo->categoriaAcervoIdcategoriaAcervo->categoria ?></td>
                            <td><?= $acervo->chamada ?></td>
                            <td><?= $result->codigo_livro ?></td>
                            <td><?= $result->esta_disponivel ? 'Disponível' : 'Não Disponível' ?> </td>
                            <?php
                        }
                    }
                    ?>
                </tr>
            </table>
            <!-- ------------- RESULTADO DA PESQUISA ----------------- -->
            <?php
        }
    }
    ?>
</div>