<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pessoa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idpessoa], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idpessoa], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idpessoa',
            'nome',
            [
                'attribute' => 'pessoaFisica.cpf',
                'visible' => $model->pessoaFisica['cpf'] != null ? true : false,
            ],
            [
                'attribute' => 'pessoaJuridica.cnpj',
                'visible' => $model->pessoaJuridica['cnpj'] != null ?
                        true : false,
            ],
        ],
    ])
    ?>

</div>

<div class="pessoa-index">
    <h3>Aquisições</h3>
    <?php
    if (count($aquisicoes) > 0) {
        ?>
        <table class="table table-striped table-bordered detail-view">
            <thead>
            <th>Título</th>
            <th>Quantidade</th>
              <th>Tipo de Aquisição</th>
            </thead>
            <tbody>
                <?php
                foreach ($aquisicoes as $aquisicao) {
                    ?>
                <tr>
                    <td><?php
                    if(count($aquisicao['acervos']) > 0){
                    echo $aquisicao['acervos'][0]->titulo;
                    } ?></td>
                      <td><?= $aquisicao->quantidade ?></td>
                       <td><?= $aquisicao['tipoAquisicaoIdtipoAquisicao']->nome ?></td>
                </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    <?php
}
?>
</div>