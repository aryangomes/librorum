<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PessoaJuridica */

$this->title = Yii::t('app', 'Create {model}', ['model' => Yii::t('app', 'Legal Person')]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Legal People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pessoa-juridica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
