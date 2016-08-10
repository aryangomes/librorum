<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Emprestimo */

$this->title = "Empréstimo da data: " .
        date('d/m/Y H:i:s', strtotime($model->dataemprestimo));
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Loans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emprestimo-view">

    <h1><?= Html::encode($this->title) ?></h1>

        <?=
        !(isset($model->datadevolucao)) ? Html::a(Yii::t('app', 'Cancelar'), ['delete', 'id' => $model->idemprestimo], [
                    'class' => 'btn btn-danger',
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
                'disabled' => isset($model->datadevolucao) ? true : false],
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
            'disabled' => isset($model->datadevolucao) ? true : false],
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
                [ 'value' => date('Y-m-d H:i:s', strtotime("+10 days", strtotime(date('Y-m-d H:i:s'))))]
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
        'dataemprestimo:datetime',
        'dataprevisaodevolucao:date',
        'datadevolucao:datetime',
      
        'usuario_nome',
        'usuario_rg',
        'acervoExemplarIdacervoExemplar.acervoIdacervo.titulo',
        'acervoExemplarIdacervoExemplar.codigo_livro',
    ],
])
?>

<?php
if ($model->diasDiferenca > 0 && $model->datadevolucao == null) {
    ?>
    <div class="alert alert-info">
        O exemplar já está emprestado a <strong><?= $model->diasDiferenca ?></strong> dia(s) .
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