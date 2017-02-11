<?php
/* @var $this yii\web\View */
/* @var $emprestimosDoDiaAtual array */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

$this->title = 'Librorum';
//Setando a data para o fuso do Brasil
date_default_timezone_set('America/Recife');
?>
<div>


    <div class="row text-center">
        <h1>SISTEMA DE AUTOMAÇÃO DE BIBLIOTECA <strong>LIBRORUM</strong></h1>


    </div>


    <div>

        <div>


            <h3><p class="text-center">Desenvolvido no Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande
                    do Norte
                </p></h3>


        </div>
        <div>
            <hr>
        </div>
        <div>
            <p class="row">

                <?php
                if (isset($mensagem) && !empty($mensagem)) {
                ?>
            <div class="alert alert-success">
                <?= $mensagem ?>
            </div>
            <?php
            }


            ?>

            <!-- -------  BEGIN  Busca de Empréstimo por RG -------------  -->
            <div class="container">
                <h4>Pesquisa de Empréstimo pelo RG do Usuário</h4></div>


            <div class="input-group">


                <?=
                Html::input('text', 'rgusuario', null, ['class' => 'form-control',
                    'id' => 'rgusuario',
                    'placeholder' => 'Digite o RG do Usuário'])
                ?>


                <span class="input-group-btn">
                    <?=
                    Html::button('Pesquisar', ['class' => 'btn btn-primary',
                        'id' => 'btPesquisarPorRG',
                        'title' => 'Clique aqui para pesquisar',
                        'data-toggle' => "tooltip"])
                    ?>
                </span>
            </div>

            <div id="result-messagem-busca-emprestimo-rg">
            </div>
            <div class="table-responsive">
                <table id="tableresult-rg" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>RG</th>
                        <th>Data Empréstimo</th>
                        <th>Data Data de previsão da devolução</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody id="tbody-result-rg">

                    </tbody>
                </table>
            </div>

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
                    <?= Html::button('Pesquisar', ['class' => 'btn btn-primary', 'id' => 'btPesquisarExemplar',
                        'title' => 'Clique aqui para pesquisar',
                        'data-toggle' => "tooltip"]) ?>
                </span>
            </div>
            <div id="result-messagem-busca-emprestimo-exemplar">
            </div>
            <div class="table-responsive">
                <table id="tableresult-emprestimo-exemplar" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>RG</th>
                        <th>Data Empréstimo</th>
                        <th>Data Data de previsão da devolução</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody id="tbody-result-emprestimo-exemplar">

                    </tbody>
                </table>
            </div>

            <!-- -------  END  de Empréstimo por código exemplar -------------  -->
            </p>


        </div>


        <!-- ------------- BEGIN MODAL EMPRESTIMO VIEW ------------- -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Data do Empréstimo: <span class="view-dataemprestimo"></span></h4>
                    </div>
                    <div class="modal-body">
                        <div class="emprestimo-view">


                            <a id="view-btncancelar" class="btn btn-danger" href=""
                               data-confirm="Você deseja cancelar o empréstimo?"
                               title="Clique aqui para cancelar o Empréstimo"
                               data-toggle="tooltip"
                               data-method="post">Cancelar</a>

                            <button type="button" class="btn btn-success"
                                    title="Clique aqui para fazer a devolução do Empréstimo"

                                    data-toggle="modal" data-target="#w0">Fazer
                                Devolução
                            </button>
                            <div id="w0" class="fade modal" role="dialog" tabindex="-1">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                ×
                                            </button>
                                            <h2>Devolução</h2>
                                        </div>
                                        <div class="modal-body">
                                            <form id="w1" action=""
                                                  method="post">
                                                <input type="hidden" name="_csrf"
                                                       value="dWdoV2J5dzkXHw8GFhhCVQErImUSTR1UEjcnMhovHVtMEB0bKAsfUw==">
                                                <!--  Devolução -->

                                                <div class="form-group">
                                                    <div class="form-group field-emprestimo-datadevolucao">
                                                        <label class="control-label" for="emprestimo-datadevolucao">Data
                                                            da Devolução</label>
                                                        <input type="text" id="emprestimo-datadevolucao"
                                                               class="form-control" name="Emprestimo[datadevolucao]"
                                                               value="<?= date('d/m/Y H:i') ?>" disabled="">

                                                        <div class="help-block"></div>
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn-lg btn-block btn-info">Confirmar
                                                        devolução
                                                    </button>
                                                </div>
                                                <div id="result-messagem-busca-usuario">


                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>    <!--   Devolução  -->

                            <!--   Renovação     -->
                            <button type="button" class="btn btn-warning"
                                    title="Clique aqui para renovar o Empréstimo"

                                    data-toggle="modal" data-target="#w2">Fazer
                                Renovação de Empréstimo
                            </button>
                            <div id="w2" class="fade modal" role="dialog" tabindex="-1">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                ×
                                            </button>
                                            <h2>Renovar empréstimo</h2>
                                        </div>
                                        <div class="modal-body">
                                            <form id="view-formrenovar"
                                                  action="" method="post">
                                                <input type="hidden" name="_csrf"
                                                       value="dWdoV2J5dzkXHw8GFhhCVQErImUSTR1UEjcnMhovHVtMEB0bKAsfUw==">
                                                <div class="form-group">
                                                    <div
                                                        class="form-group field-emprestimo-dataprevisaodevolucao required">
                                                        <label class="control-label"
                                                               for="emprestimo-dataprevisaodevolucao">Data de previsão
                                                            da devolução</label>
                                                        <input type="text" id="emprestimo-dataprevisaodevolucaolabel"
                                                               class="form-control"

                                                               value="" disabled="">

                                                        <div class="help-block"></div>
                                                    </div>
                                                    <div
                                                        class="form-group field-emprestimo-dataprevisaodevolucao required">

                                                        <input type="hidden" id="emprestimo-dataprevisaodevolucao"
                                                               class="form-control"
                                                               name="Emprestimo[dataprevisaodevolucao]"
                                                               value="2016-12-18 22:08:58">

                                                        <div class="help-block"></div>
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn-lg btn-block btn-info">Confirmar
                                                        renovação de empréstimo
                                                    </button>
                                                </div>
                                                <div id="result-messagem-busca-usuario">


                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>    <!--   Renovação  -->


                            <!-- Gerar Comprovante Empréstimo-->
                            <a id="view-gerarcomprovanteemprestimo" class="btn btn-primary"
                               href=""
                               title="Clique aqui para gerar o comprovante do empréstimo" target="_blank"
                               data-toggle="tooltip">Gerar Comprovante de Empréstimo</a>
                            <!-- Gerar Comprovante Empréstimo-->


                            <p></p>
                            <table id="w4" class="table table-striped table-bordered detail-view">
                                <tbody>
                                <tr>
                                    <th>Código do Empréstimo</th>
                                    <td><span class="view-idemprestimo"></span></td>
                                </tr>
                                <tr>
                                    <th>Data do Empréstimo</th>
                                    <td><span class="view-dataemprestimo"></span></td>
                                </tr>
                                <tr>
                                    <th>Data de previsão da devolução</th>
                                    <td><span class="view-dataprevisaoemprestimo"></span></td>
                                </tr>
                                <tr>
                                    <th>Data da Devolução</th>
                                    <td><span class="view-datadevolucaoemprestimo"></span></td>
                                </tr>
                                <tr>
                                    <th>Nome do Usuário</th>
                                    <td><span class="view-emprestimousuario"></span></td>
                                </tr>
                                <tr>
                                    <th>Rg do Usuário</th>
                                    <td><span class="view-rgusuarioemprestimo"></span></td>
                                </tr>
                                </tbody>
                            </table>

                            <h3>Exemplares emprestados</h3>
                            <div class="table-responsive">

                                <table class="table table-bordered">
                                    <thead>

                                    <tr>

                                        <th>Título</th>
                                        <th>Autor</th>
                                        <th>Código Exemplar</th>
                                    </tr>
                                    </thead>
                                    <tbody id="view-exemplaresemprestados">

                                    </tbody>
                                </table>
                            </div>

                            <div class="alert alert-info">
                                <span class="view-avisoemprestimo"></span>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>

            </div>
        </div>


        <!-- ------------- END MODAL EMPRESTIMO VIEW ------------- -->
        <?php
        if ((count($emprestimosDoDiaAtual) > 0) && (Yii::$app->user->can("admin"))) {

            ?>
            <h3>Empréstimo com previsão de devolução no dia <?= date('d/m/Y') ?> </h3>
            <div class="table-responsive">

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>RG</th>
                        <th>Data Empréstimo</th>
                        <th>Data Data de previsão da devolução</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach ($emprestimosDoDiaAtual as $emprestimo) {

                        ?>
                        <tr>
                            <td><?= $emprestimo['usuarioIdusuario']->nome ?></td>
                            <td><?= $emprestimo['usuarioIdusuario']->rg ?></td>
                            <td><?= Yii::$app->formatter->asDate($emprestimo->dataemprestimo, 'dd/M/Y') ?></td>
                            <td><?= Yii::$app->formatter->asDate($emprestimo->dataprevisaodevolucao, 'dd/M/Y') ?></td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"
                                        onclick="carregarDadosModalEmprestimo(<?= $emprestimo->idemprestimo ?>)">
                                    Visualizar detalhes do Empréstimo
                                    <span class="glyphicon glyphicon-search">
                            </span></button>
                            </td>
                        </tr>
                        <?php

                    }
                    ?>
                    </tbody>
                </table>

            </div>

            <?php
        }

        ?>
    </div>

</div>
