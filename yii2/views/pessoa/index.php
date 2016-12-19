<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PessoaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'People');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pessoa-index">

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
                'nome',
                [
                    'attribute' => 'pessoaFisica.cpf',
                    'value' => function ($model) {

                        return $model->pessoaFisica['cpf'] != null ?
                                $model->pessoaFisica['cpf'] : '';
                    }
                ],
                [
                    'attribute' => 'pessoaJuridica.cnpj',
                    'value' => function ($model) {

                        return $model->pessoaJuridica['cnpj'] != null ?
                                $model->pessoaJuridica['cnpj'] : '';
                    }
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>