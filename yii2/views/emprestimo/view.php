<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use kartik\widgets\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Emprestimo */

$this->title = $model->idemprestimo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Emprestimos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emprestimo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idemprestimo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancelar'), ['delete', 'id' => $model->idemprestimo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>

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
