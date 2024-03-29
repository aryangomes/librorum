<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CategoriaAcervo */

$this->title = $model->categoria;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Category Collection'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-acervo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idcategoria_acervo], ['class' => 'btn btn-primary',
            'title'=> 'Clique aqui para atualizar a categoria do acervo',]) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idcategoria_acervo], [
            'class' => 'btn btn-danger',
            'title'=> 'Clique aqui para excluir a categoria do acervo',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idcategoria_acervo',
            'categoria',
        ],
    ]) ?>

</div>
