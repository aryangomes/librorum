<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Acervo */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acervos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acervo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idacervo], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idacervo], [
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
//            'idacervo',
            'titulo',
            'autor',
            'editora',
            [
               'attribute'=> 'tipoMaterialIdtipoMaterial.nome',
               'label'=>'Tipo de Material',
            ],
            'categoriaAcervoIdcategoriaAcervo.categoria',
            'cdd',
            'chamada',
//            'aquisicaoIdaquisicao.tipoAquisicaoIdtipoAquisicao.nome',
            
        ],
    ])
    ?>

</div>

<?php
if (count($acervoExemplares) > 0) {
    ?>
<p class="row"><h1>Exemplares</h1></p>
    <table class="table table-striped table-bordered detail-view">
        <thead>
            <tr>
                <th>Código do Exemplar</th>
                <th>Disponibilidade</th>

            </tr>
        </thead>
        <tbody id="tbody-result-rg">
            <?php
            foreach ($acervoExemplares as $exemplar) {
                ?>
            <tr>
                <td><?= $exemplar->codigo_livro ?></td>
                <td><?= $exemplar->esta_disponivel ? 'Disponível':'Não Disponível' ?></td>
            </tr>
        <?php
    }
    ?>
        </tbody>
    </table>

    <?php
}
?>