<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoMaterial */

$this->title = Yii::t('app', 'Create {model}', ['model' => Yii::t('app', 'Type Material')]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Materials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-material-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
