<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Emprestimo */

$this->title = $dadosEmprestimo->idemprestimo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Loans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emprestimo-view">
    <div class="row">
 
    <div class="col-sm-4"> 
        <h3 style="text-align: center"><?=$config->valor ?>
        </h3></div>
    
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Código do Empréstimo</th>
                    <th><?= $dadosEmprestimo->idemprestimo ?></th>

                </tr>
                <tr>
                    <th>Nome do Usuário</th>
                    <th><?= $dadosEmprestimo['usuarioIdusuario']->nome ?></th>
                </tr>
                <tr>
                    <th>Endereço do Usuário</th>
                    <th><?= $dadosEmprestimo['usuarioIdusuario']->endereco ?></th>
                </tr>
                 <tr>
                    <th>Cargo do Usuário</th>
                    <th><?= $dadosEmprestimo['usuarioIdusuario']->cargo ?></th>
                </tr>
                 <tr>
                    <th>Título do Exemplar</th>
                    <th><?= $dadosEmprestimo['acervoExemplarIdacervoExemplar']
        ['acervoIdacervo']->titulo?></th>
                </tr>
                
                 <tr>
                    <th>Autor do Exemplar</th>
                    <th><?= $dadosEmprestimo['acervoExemplarIdacervoExemplar']
        ['acervoIdacervo']->autor?></th>
                </tr>
                
                 <tr>
                    <th>Data do Empréstimo</th>
                    <th><?= date("d/m/Y H:i:s", strtotime
                            ( $dadosEmprestimo->dataemprestimo))?></th>
                </tr>
                
                  <tr>
                    <th>Data de Previsão do Empréstimo</th>
                    <th><?= date("d/m/Y", strtotime
                            ( $dadosEmprestimo->dataprevisaodevolucao))?></th>
                </tr>
                
            </thead>

        </table>


    </div>
</div>


</div>