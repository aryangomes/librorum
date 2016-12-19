<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoAquisicaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Type Acquisition');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-aquisicao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {model}', ['model' => Yii::t('app', 'Type Acquisition')]), ['create'], ['class' => 'btn btn-success',
            'title'=>'Clique aqui para cadastrar um tipo de aquisição',
            'data-toggle'=>"tooltip"]) ?>
    </p>
    <div class="table-responsive">
        <?php Pjax::begin(); ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'idtipo_aquisicao',
                'nome',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>
