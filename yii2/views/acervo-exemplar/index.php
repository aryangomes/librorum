<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AcervoExemplarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Samples');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acervo-exemplar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?php // Html::a(Yii::t('app', 'Catalog {model}', ['model' => Yii::t('app', 'Sample')]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
        <?php Pjax::begin(); ?>    <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute'=> 'acervoIdacervo.titulo',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a($model->acervoIdacervo->titulo, ['view', 'id' =>
                            $model->idacervo_exemplar]);
                    }
                ],

                'codigo_livro',
                [
                    'attribute' => 'esta_disponivel',
                    'value' => function ($model) {
                        return $model->esta_disponivel ?
                                'Disponível' : 'Não disponível';

                    },
                    'filter'=>['0'=>'Não disponível','1'=>'Disponível'],
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>

    </div>
</div>
