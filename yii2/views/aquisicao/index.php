<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AquisicaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Acquisitions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aquisicao-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <div class="table-responsive">
        <?php Pjax::begin(); ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'tipoAquisicaoIdtipoAquisicao.nome',
                'preco',
                'quantidade',
                'pessoaIdpessoa.nome',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>
