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
            <div class="form-group">
                <?= Html::activeLabel($model,'filtro') ?>
                <?= Html::activeCheckboxList($model, 'filtro', $filtros,
                    ['class' => 'form-control']) ?>

            </div>

            <div class="form-group">
                <?= Html::Label('Tipo Material') ?>
                <?= Html::activeDropDownList($model, 'tipoMaterial', $tiposMateriais,
                    ['class' => 'form-control']) ?>

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
        if (isset($resultado)) {
            ?>
            <!-- ------------- RESULTADO DA PESQUISA ----------------- -->
            <div class="container">
                <h3 class="row">Resultados da Pesquisa</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered ">
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Editora</th>
                        <th>Material</th>
                        <th>Categoria</th>
                        <th>Código do Livro</th>
                        <th>CDD</th>
                        <th>Disponibilidade</th>
                    </tr>

                    <?php

                    foreach ($resultado as $key => $res) {

                        foreach ($res[1] as $exemplar) {

                            foreach ($exemplar as $i => $e) {

                    ?>

                    <tr>
                        <td><?= $res[0]->titulo ?></td>

                        <td><?= $res[0]->autor ?></td>

                        <td><?= $res[0]->editora ?></td>

                        <td><?= $res[0]->tipoMaterialIdtipoMaterial->nome ?></td>

                        <td><?= $res[0]->categoriaAcervoIdcategoriaAcervo->categoria ?></td>

                        <td><?= $res[0]->cdd?></td>

                        <td><?= $e->codigo_livro ?></td>

                        <td><?= $e->esta_disponivel ? 'Disponível' : 'Não Disponível' ?> </td>

                        <?php


                             }
                            }

                        }

                        ?>
                    </tr>


                </table>
            </div>
            <!-- ------------- RESULTADO DA PESQUISA ----------------- -->
            <?php
        }

    }
    ?>
</div>