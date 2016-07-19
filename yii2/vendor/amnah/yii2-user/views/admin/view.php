<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var amnah\yii2\user\models\User $user
 */

$this->title = "Informações Sobre o Usuário: ".$user->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('user', 'Update'), ['update', 'id' => $user->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('user', 'Delete'), ['delete', 'id' => $user->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('user', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $user,
        'attributes' => [
            'id',
            'role_id',
            'status',
            'email',
            'username',
            'profile.full_name',
            'password',
            'auth_key',
            'access_token',
            'logged_in_ip',
            'logged_in_at',
            'created_ip',
            'created_at',
            'updated_at',
            'banned_at',
            'banned_reason',
            'usuario.situacaoUsuarioIdsituacaoUsuario.situacao',
            [
                'attribute' => 'usuario.foto',
//                'label' => Yii::t('user', 'FullName'),
                'format' => 'raw',
                'value' => isset($user->usuario->foto) ? Html::img($user->usuario->foto) : 'Não há foto'
                ,
            ],
        ],
    ]) ?>

</div>
