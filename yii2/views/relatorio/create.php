<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Relatorio */
/* @var $tiposRelatorio array */

$this->title = Yii::t('app', 'Create {model}', ['model'=> Yii::t('app', 'Relatório')]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Relatorios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatorio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tiposRelatorio'=>$tiposRelatorio,
    ]) ?>

</div>
