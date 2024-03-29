<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Acervo */

$this->title = Yii::t('app', 'Catalog {model}', ['model'=> Yii::t('app', 'Collection')]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Collections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acervo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'aquisicao' => $aquisicao,
        'pessoa' => $pessoa,
        'pessoaFisica' => $pessoaFisica,
        'pessoaJuridica' => $pessoaJuridica,
        'tiposPessoa'=>$tiposPessoa,
    ]) ?>

</div>
