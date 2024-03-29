<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AcervoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Collections');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acervo-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php
    if (Yii::$app->session->has('mensagem')) {
        ?>
        <div class="alert alert-success">
            <?=   Yii::$app->session->getFlash('mensagem') ?>
        </div>
        <?php
    }


    ?>

    <p>
<?= Html::a(Yii::t('app', 'Catalog {model}', ['model' => Yii::t('app', 'Collection')]), ['create'], ['class' => 'btn btn-success',
    'title'=>'Clique aqui para cadastrar um acervo',
    'data-toggle'=>"tooltip"]) ?>
    </p>



    <div class="table-responsive">
        <?php Pjax::begin(); ?>    <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'idacervo',

                [
                    'attribute'=>'titulo',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a($model->titulo, ['view', 'id' => $model->idacervo]);
                    }
                ],
                'autor',
                'editora',
                [
                   'attribute'=> 'tipoMaterialIdtipoMaterial.nome',
                   'label'=>'Tipo de Material',
                ],
                'categoriaAcervoIdcategoriaAcervo.categoria',
                'cdd',
          
                // 'aquisicao_idaquisicao',
                // 'tipo_material_idtipo_material',
                // 'categoria_acervo_idcategorial_acervo',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>
