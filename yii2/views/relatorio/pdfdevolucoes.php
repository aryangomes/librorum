<?php


/* @var $this yii\web\View */
/* @var $dados array */
/* @var $title mixed */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Loans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emprestimo-view">
    <div class="row">

        <div class="col-sm-4">
            <h3 style="text-align: center"><?= $title ?>
            </h3></div>

    </div>
    <div>
        <?php
        if(count($dados[0]) > 0){


        ?>
        <table class="table table-responsive table-bordered">
            <thead>
            <tr>
                <th>Data</th>
                <th>Quantidade</th>
            </tr>
            </thead>
            <tbody>
            <?php

            for ($i = 0; $i < count($dados[0]); $i++) {
                ?>
                <tr>
                    <td><?= $dados[0][$i] ?></td>
                    <td><?= $dados[1][$i] ?></td>
                </tr>
                <?php
            }

            ?>
            </tbody>
        </table>

        <?php
        }
        else{
        ?>
        <h4 class="text-center">Não há registros para esse período</h4>
        <?php
        }
        ?>
    </div>
</div>


</div>