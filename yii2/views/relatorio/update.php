<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Relatorio */
/* @var $tiposRelatorio array */

$this->title ='Relatório de ' . $model->tipo . ' de ' .
    Yii::$app->formatter->asDate($model->inicio_intervalo, 'dd/M/Y') . ' até ' .
    Yii::$app->formatter->asDate($model->fim_intervalo, 'dd/M/Y');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Relatórios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title , 'url' => ['view', 'id' => $model->idrelatorio]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="relatorio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tiposRelatorio'=>$tiposRelatorio,
    ]) ?>

</div>
