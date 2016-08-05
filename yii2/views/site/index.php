<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

$this->title = 'Librorum';
?>
<div class="site-index">


    <div class="jumbotron">
        <h1>SISTEMA DE AUTOMAÇÃO DE BIBLIOTECA <strong>LIBRORUM</strong></h1>


    </div>


    <div class="body-content">

        <div class="container">


            <h3><p class="text-center">Desenvolvido no Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Norte
                </p></h3>


        </div>
        <div class="container">
            <hr>
        </div>
        <div class="container">
            <p class="row">
                <!-- -------  BEGIN  Busca de Empréstimo por RG -------------  -->
            <div class="container">
                <h4 >Pesquisa de Empréstimo pelo RG do Usuário</h4></div>


            <div class="input-group">


                <?=
                Html::input('text', 'rgusuario', null, ['class' => 'form-control',
                    'id' => 'rgusuario',
                    'placeholder' => 'Digite o RG do Usuário'])
                ?>


                <span class="input-group-btn">
                    <?=
                    Html::button('Pesquisar', ['class' => 'btn btn-primary',
                        'id' => 'btPesquisarPorRG'])
                    ?>
                </span>
            </div>

            <div id="result-messagem-busca-emprestimo-rg">
            </div>
            <table id="tableresult-rg" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>RG</th>
                        <th>Título</th>
                        <th>Data Empréstimo</th>
                        <th>Data Data de previsão da devolução</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="tbody-result-rg">

                </tbody>
            </table>



            <!-- -------  END  Busca de Empréstimo por RG -------------  -->
            </p>
            <?php
            $this->registerJsFile(\Yii::getAlias("@web") . '/js/js-busca-emprestimo.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
            ?>



            <p class="row">
                <!-- -------  BEGIN  Busca de Empréstimo por código exemplar -------------  -->
            <div class="container">
                <h4>Pesquisa de Empréstimo pelo Código do Exemplar</h4></div>

            <div class="input-group">


                <?=
                Html::input('text', 'codigoexemplar', null, ['class' => 'form-control',
                    'id' => 'codigoexemplar',
                    'placeholder' => 'Digite o código do exemplar'])
                ?>


                <span class="input-group-btn">
                    <?= Html::button('Pesquisar', ['class' => 'btn btn-primary', 'id' => 'btPesquisarExemplar']) ?>
                </span>
            </div>
            <div id="result-messagem-busca-emprestimo-exemplar">
            </div>
            <table id="tableresult-emprestimo-exemplar" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>RG</th>
                        <th>Título</th>
                        <th>Data Empréstimo</th>
                        <th>Data Data de previsão da devolução</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="tbody-result-emprestimo-exemplar">

                </tbody>
            </table>





            <!-- -------  END  de Empréstimo por código exemplar -------------  -->
            </p>


        </div>
    </div>
</div>
