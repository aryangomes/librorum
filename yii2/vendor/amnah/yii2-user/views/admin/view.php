<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var amnah\yii2\user\models\User $user
 */
$this->title = "Informações Sobre o Usuário: " . $user->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('user', 'Update'), ['update', 'id' => $user->id], ['class' => 'btn btn-primary']) ?>
        <?php /*
        Html::a(Yii::t('user', 'Delete'), ['delete', 'id' => $user->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('user', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])*/
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $user,
        'attributes' => [
            'id',
            'role.name',
            [
                'attribute' => 'email',
                'label' => 'RG'
            ],
            'username',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'usuario.situacaoUsuarioIdsituacaoUsuario.situacao',
                'label' => 'Situação do Usuário'
            ],
            [
                'attribute' => 'usuario.foto',
//                'label' => Yii::t('user', 'FullName'),
                'format' => 'raw',
                'value' => isset($user->usuario->foto) ?
                Html::img($user->usuario->foto,
                        ['class'=>'img-responsive img-thumbnail',
                            'width'=>400]) : 'Não há foto'
            ,
            ],
        ],
    ])
    ?>

</div>
