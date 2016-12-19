<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SituacaoUsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Situacao Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="situacao-usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {model}', ['model' => Yii::t('app', 'Situacao Usuarios')]), ['create'], ['class' => 'btn btn-success',
            'title'=>'Clique aqui para cadastrar uma situação do usuário',
            'data-toggle'=>"tooltip"]) ?>
    </p>
    <div class="table-responsive">
        <?php Pjax::begin(); ?>    <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],


                'situacao',
                [
                    'attribute' => 'pode_emprestar',
                    'value' => function ($model) {
                        return $model->pode_emprestar ?
                            'Pode' : 'Não Pode';
                    },
                    'filter' => ['1' => 'Pode', '0' => 'Não Pode'],
                ],
                ['class' => 'yii\grid\ActionColumn'],

            ],


        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>
