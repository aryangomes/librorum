<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoMaterialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Type Materials');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-material-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {model}', ['model' => Yii::t('app', 'Type Material')]), ['create'], ['class' => 'btn btn-success',
            'title'=>'Clique aqui para cadastrar um tipo de material',
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
                //'idtipo_material',
                'nome',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>