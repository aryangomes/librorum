<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Emprestimo */

$this->title = $model->idemprestimo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Emprestimos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emprestimo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= !(isset($model->datadevolucao)) ?  Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idemprestimo],
            ['class' => 'btn btn-primary']) : ''?>
        <?= !(isset($model->datadevolucao)) ?  Html::a(Yii::t('app', 'Cancelar'), ['delete', 'id' => $model->idemprestimo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) : ''?>

        <!--   Devolução     -->
        <?php
        Modal::begin([
            'header' =>  '<h2>Devolução</h2>',
            'toggleButton' => ['label' =>isset($model->datadevolucao) ? 'Devolvido': 'Fazer Devolução',
                'class' => 'btn btn-info',
                'disabled'=>isset($model->datadevolucao) ? true:false],

        ]);

        $form = ActiveForm::begin(['action' =>['devolucao' , 'id'=>$model->idemprestimo]]);

        ?>
    <div class="form-group">
        <?php

        //Definindo zona de tempo para o horário brasileiro
        date_default_timezone_set('America/Sao_Paulo');


        ?>
        <?= $form->field($model, 'datadevolucao')->textInput(['disabled' => true,
            'value'=> isset($model->datadevolucao) ? date('d/m/Y H:i:s',
                strtotime($model->datadevolucao)) :date('d/m/Y H:i:s')]) ?>

        <?= $form->field($model, 'datadevolucao')->hiddenInput(
            [  'value'=> isset($model->datadevolucao) ? date('d/m/Y H:i:s',
                strtotime($model->datadevolucao)) :date('d/m/Y H:i:s')]
        )->label(false) ?>



    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Confirmar devolução') , ['class' => 'btn-lg btn-block btn-info']) ?>
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
        'header' =>  '<h2>Renovar empréstimo</h2>',
        'toggleButton' => ['label' => 'Fazer Renovação de Empréstimo',
            'class' => 'btn btn-info',
            'disabled'=>isset($model->datadevolucao) ? true:false],

    ]);

    $form = ActiveForm::begin(['action' =>['renovar' , 'id'=>$model->idemprestimo]]);

    ?>
    <div class="form-group">
        <?php

        //Definindo zona de tempo para o horário brasileiro
        date_default_timezone_set('America/Sao_Paulo');


        ?>
        <?= $form->field($model, 'dataprevisaodevolucao')->textInput(['disabled' => true,
            'value'=> date('d/m/Y H:i:s', strtotime("+10 days",strtotime(date('Y-m-d H:i:s')))) ]) ?>

        <?= $form->field($model, 'dataprevisaodevolucao')->hiddenInput(
            [    'value'=> date('Y-m-d H:i:s', strtotime("+10 days",strtotime(date('Y-m-d H:i:s')))) ]
        )->label(false) ?>



    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Confirmar renovação de empréstimo') , ['class' => 'btn-lg btn-block btn-info']) ?>
    </div>
    <div id="result-messagem-busca-usuario">


    </div>
    <?php
    ActiveForm::end();

    Modal::end();
    ?>
    <!--   Renovação  -->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idemprestimo',
            'dataemprestimo',
            'dataprevisaodevolucao',
            'datadevolucao',
            'usuario_idusuario',
            'usuario_nome',
            'usuario_rg',
            'acervo_exemplar_idacervo_exemplar',
        ],
    ]) ?>

</div>