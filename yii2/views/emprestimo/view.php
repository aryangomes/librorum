<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Emprestimo */
/* @var $exemplaresEmprestados array */

$this->title = "Data do Empréstimo: " .
    date('d/m/Y H:i:s', strtotime($model->dataemprestimo));
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Loans'), 'url' => ['/emprestimo']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emprestimo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if (Yii::$app->session->has('mensagemSucesso')) {
        ?>
        <div class="alert alert-info">
            <?= Yii::$app->session->getFlash('mensagemSucesso') ?>
        </div>
        <?php
    }


    ?>
    <?=
    !(isset($model->datadevolucao)) ? Html::a(Yii::t('app', 'Cancelar o Empréstimo'), ['delete', 'id' => $model->idemprestimo], [
        'class' => 'btn btn-danger',
        'title'=>"Clique aqui para cancelar o Empréstimo",

        'data' => [
            'confirm' => Yii::t('app', 'Você deseja cancelar o empréstimo?'),
            'method' => 'post',
        ],
    ]) : ''
    ?>


    <?php
    Modal::begin([
        'header' => '<h2>Devolução</h2>',
        'toggleButton' => ['label' => isset($model->datadevolucao) ? 'Devolvido' : 'Fazer Devolução',
            'class' => 'btn btn-success',
            'disabled' => isset($model->datadevolucao) ? true : false,
            'title'=>"Clique aqui para fazer a devolução do Empréstimo",],
    ]);

    $form = ActiveForm::begin(['action' => ['devolucao', 'id' => $model->idemprestimo]]);
    ?>
    <!--  Devolução -->

    <div class="form-group">
        <?php
        //Definindo zona de tempo para o horário brasileiro
        date_default_timezone_set('America/Sao_Paulo');
        ?>
        <?=
        $form->field($model, 'datadevolucao')->textInput(['disabled' => true,
            'value' => isset($model->datadevolucao) ? date('d/m/Y H:i:s', strtotime($model->datadevolucao)) : date('d/m/Y H:i:s')])
        ?>


    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Confirmar devolução'), ['class' => 'btn-lg btn-block btn-info']) ?>
    </div>
    <div id="result-messagem-busca-usuario">


    </div>
    <?php
    ActiveForm::end();

    Modal::end();
    ?>
    <!--   Devolução  -->

    <!--   Renovação     -->
    <?php
    Modal::begin([
        'header' => '<h2>Renovar empréstimo</h2>',
        'toggleButton' => ['label' => 'Fazer Renovação de Empréstimo',
            'class' => 'btn btn-warning',
            'disabled' => isset($model->datadevolucao) ? true : false,
            'title'=>"Clique aqui para renovar o Empréstimo",],


    ]);

    $form = ActiveForm::begin(['action' => ['renovar', 'id' => $model->idemprestimo]]);
    ?>
    <div class="form-group">
        <?php
        //Definindo zona de tempo para o horário brasileiro
        date_default_timezone_set('America/Sao_Paulo');
        ?>
        <?=
        $form->field($model, 'dataprevisaodevolucao')->textInput(['disabled' => true,
            'value' => date('d/m/Y H:i:s', strtotime("+10 days", strtotime(date('Y-m-d H:i:s'))))])
        ?>

        <?=
        $form->field($model, 'dataprevisaodevolucao')->hiddenInput(
            ['value' => date('Y-m-d H:i:s', strtotime("+10 days", strtotime(date('Y-m-d H:i:s'))))]
        )->label(false)
        ?>


    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Confirmar renovação de empréstimo'), ['class' => 'btn-lg btn-block btn-info']) ?>
    </div>
    <div id="result-messagem-busca-usuario">


    </div>
    <?php
    ActiveForm::end();

    Modal::end();
    ?>
    <!--   Renovação  -->


    <!-- Gerar Comprovante Empréstimo-->
    <?php
    echo isset($model->datadevolucao) ? '' :
        Html::a('Gerar Comprovante de Empréstimo', ['gerar-comprovante-emprestimo',
            'id' => $model->idemprestimo], [
            'class' => 'btn btn-primary',
            'target' => '_blank',
            'data-toggle' => 'tooltip',
            'title' => 'Clique aqui para gerar o comprovante do empréstimo',
        ]);
    ?>
    <!-- Gerar Comprovante Empréstimo-->



    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idemprestimo',

            [
                'attribute'=>'dataemprestimo',
                'value'=> isset($model->dataemprestimo) ?
                        Yii::$app->formatter->asDate($model->dataemprestimo, 'dd/M/Y à\s HH:m') : null,

            ],

            [
                'attribute'=>'dataprevisaodevolucao',
                'value'=> isset($model->dataprevisaodevolucao) ?
                    Yii::$app->formatter->asDate($model->dataprevisaodevolucao, 'dd/M/Y') : null,

            ],

            [
                'attribute'=>'datadevolucao',
                'value'=> isset($model->datadevolucao) ?
                    Yii::$app->formatter->asDate($model->datadevolucao, 'dd/M/Y à\s HH:m') : 'Não devolvido',

            ],

            'usuario_nome',
            'usuario_rg',
          /*  'acervoExemplarIdacervoExemplar.acervoIdacervo.titulo',
            'acervoExemplarIdacervoExemplar.codigo_livro',*/
        ],
    ])
    ?>


    <h3>Exemplares emprestados</h3>
    <div class="table-responsive">

        <table class="table table-bordered">
            <thead>

            <tr>

                <th>Título</th>
                <th>Autor</th>
                <th>Código Exemplar</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($exemplaresEmprestados as $exemplar) {
                ?>

                <tr>
                    <td><?= $exemplar["acervoIdacervo"]->titulo ?> </td>
                    <td><?= $exemplar["acervoIdacervo"]->autor ?> </td>
                    <td><?= $exemplar->codigo_livro ?> </td>
                </tr>
                <?php
            }

            ?>
            </tbody>
        </table>
    </div>

    <?php
    if ($model->diasDiferenca > 0 && $model->datadevolucao == null) {
        ?>
        <div class="alert alert-info">
            O exemplar já está emprestado a <strong><?= number_format($model->diasDiferenca, 0) ?></strong> dia(s).
        </div>
        <?php
    } else if ($model->diasDiferenca == 0) {
        ?>
        <div class="alert alert-info">
            O exemplar foi emprestado hoje.
        </div>
        <?php
    }
    ?>

</div>