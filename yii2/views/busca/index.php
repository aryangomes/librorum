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
    <h2 class="row">Pesquisa no Acervo</h2>
    </div>

    <div class="bs-example">
        <form class="" id="w1" action="/librorum/yii2/web/busca/busca-acervo" method="get">
            <div class="form-group input-group input-group-lg">
                <input type="text" name="acervo" class="form-control" placeholder="Buscar Material">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Pesquisar</button>
                </span>
            </div>
        </form>
    </div>

    <div class="container">
    <h3 class="row">Resultados da Pesquisa</h3>
    </div>

    <table class="table table-striped table-bordered table-responsive"> 
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Editora</th>
            <th>Material</th>
            <th>Categoria</th>
            <th>Chamada</th>
            <th>Código do Livro</th>
            <th>Disponibilidade</th>
        </tr>

<?php
    if(isset($exemplares)){
        foreach ($exemplares as $result) {
?>
        <tr>
            <td><?= $acervo->titulo ?></td>
            <td><?= $acervo->autor ?></td>
            <td><?= $acervo->editora ?></td>
            <td><?= $acervo->tipoMaterialIdtipoMaterial->nome ?></td>
            <td><?= $acervo->categoriaAcervoIdcategoriaAcervo->categoria ?></td>
            <td><?= $acervo->chamada ?></td>
            <td><?= $result->codigo_livro ?></td>
            <td><?= $result->esta_disponivel ? 'Disponível' : 'Não Disponível' ?> </td>
<?php
        }
    }
?>
        </tr>
    </table>
</div>