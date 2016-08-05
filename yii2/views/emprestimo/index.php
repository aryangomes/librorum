<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmprestimoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Loans');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emprestimo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {model}', ['model' => Yii::t('app', 'Loan')]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
        <?php Pjax::begin(); ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
//            'idemprestimo',
                [
                    'label' => 'Empréstimo',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a('Visualizar Empréstimo', ['view', 'id' => $model->idemprestimo]);
                    }
                        ],
                        'dataemprestimo:datetime',
                        'dataprevisaodevolucao:date',
                        'datadevolucao:datetime',
                        'usuarioIdusuario.nome',
                    // 'usuario_nome',
                    // 'usuario_rg',
                    // 'acervo_exemplar_idacervo_exemplar',
//            ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
                ?>
                <?php Pjax::end(); ?>

    </div>
</div>