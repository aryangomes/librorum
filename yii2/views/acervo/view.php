<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use kartik\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Acervo */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acervos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acervo-view">

    <?php
    if (Yii::$app->session->hasFlash('erro')) {
        ?>
        <script>
alert(<?= Yii::$app->session->getFlash('erro')?>)
        </script>
    <?php
        echo \yii\bootstrap\Alert::widget([
            'options' => [
                'class' => 'alert-danger',
            ],
            'body' => Yii::$app->session->getFlash('erro'),
        ]);
    }else   if (Yii::$app->session->has('mensagem')) {
    ?>
        <div class="alert alert-success">
            <?=   Yii::$app->session->getFlash('mensagem') ?>
        </div>
        <?php
    }

    ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idacervo], ['class' => 'btn btn-primary',
            'title'=>'Clique aqui para atualizar o acervo',]) ?>
        <?=
        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idacervo], [
            'class' => 'btn btn-danger',
            'title'=>'Clique aqui para excluir um acervo',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>

        <!--   Renovação     -->
        <?php
        Modal::begin([
            'header' => '<h2>Gerar novo código de exemplares</h2>',
            'toggleButton' => ['label' => 'Gerar novo código de exemplares',
                'class' => 'btn btn-warning',
                'title'=>'Clique aqui para gerar novos códigos para os exemplares do acervo',
               ],
        ]);

        $form = ActiveForm::begin([
            'action' => ['gerar-novo-codigo-exemplares',
            'id' => $model->idacervo]]);

        $model->catalogarAcervoExistente= 0;
        ?>
    <div class="form-group">

        <?=
        $form->field($model, 'catalogarAcervoExistente')->dropDownList(
            ['1' => 'Acervo Existente', '0' => 'Novo Acervo'
            ],
            ['prompt' =>'Selecione...'])
        ?>

        <?=
        $form->field($model, 'codigoInicio')->textInput([
            'type'=>'number','min'=>0,'step'=>1])
        ?>

        <?=
        $form->field($model, 'codigoFim')->textInput([
            'type'=>'number','min'=>0,'step'=>1])
        ?>

        <?=
        $form->field($model, 'quantidadeExemplar')->textInput([
            'type'=>'number','min'=>0,'step'=>1])
        ?>



    </div>
    <div class="form-group">
        <?= Html::Button(Yii::t('app', 'Gerar novo código'),
            ['class' => 'btn-lg btn-block btn-info','id'=>'btGerarNovoCodigoExemplar']) ?>
    </div>
    <div id="result-messagem-busca-usuario">


    </div>
    <?php
    ActiveForm::end();

    Modal::end();
    ?>
    <!--   Renovação  -->

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

//            'aquisicaoIdaquisicao.tipoAquisicaoIdtipoAquisicao.nome',
            
        ],
    ])
    ?>

</div>

<?php
$this->registerJsFile(\Yii::getAlias("@web") . '/js/js-acervo-view.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

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


