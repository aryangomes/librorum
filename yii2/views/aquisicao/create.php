<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Aquisicao */

$this->title = Yii::t('app', 'Create {model}', ['model' => Yii::t('app', 'Acquisition')]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acquisitions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aquisicao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
