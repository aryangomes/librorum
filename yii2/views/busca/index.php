<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\db\Query;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
 
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="container">
    <h2>Pesquisa no Acervo</h2>
    </div>

    <div class="modal-body">
        <form id="w1" action="/librorum/yii2/web/busca/busca-acervo" method="get">
            <fieldset class="form-group">
                <div class="col-lg-10">
                    <div class="input-group input-group-lg">
                        <input type="text" name="acervo" class="form-control" placeholder="Buscar Material">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="submit">Pesquisar</button>
                        </span>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    <div class="modal-body">
    <h3>Resultados da Pesquisa</h3>
    </div>
    <center>            
        <table class="table"> 
            <tr> 
                <th>Título</th>
                <th>Chamada</th>
                <th>Material</th>
            </tr>
<?php
    if(isset($query)){
        foreach ($query as $acervo) {
?>
            <tr>
                <td><?= $acervo->titulo ?></td>
                 <td><?= $acervo->chamada ?></td>
                 <td><?= $acervo->tipoMaterialIdtipoMaterial->nome ?></td>
            <tr>
<?php
        }
    }
?>           
        </table>
    </center>
</div>