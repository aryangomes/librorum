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
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Catalog {model}', ['model' => Yii::t('app', 'Sample')]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        
            'acervoIdacervo.titulo',
            'codigo_livro',
           [
               'attribute'=>  'esta_disponivel',
              
               'value'=>  function ($model){
                return $model->esta_disponivel?
                        'Disponível':'Não disponível';
               }
           ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
