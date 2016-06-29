<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Acervo */

$this->title = Yii::t('app', 'Create Acervo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acervos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acervo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
