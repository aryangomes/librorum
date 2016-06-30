<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AquisicaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Aquisicaos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aquisicao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Aquisicao'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idaquisicao',
            'preco',
            'quantidade',
            'tipo_aquisicao_idtipo_aquisicao',
            'pessoa_idpessoa',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>