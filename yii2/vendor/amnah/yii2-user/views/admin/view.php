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

    <?php
    if (Yii::$app->session->has('mensagem')) {
        ?>
        <div class="alert alert-success">
            <?=   Yii::$app->session->getFlash('mensagem') ?>
        </div>
        <?php
    }


    ?>

    <p>
        <?= Html::a(Yii::t('user', 'Update'), ['update', 'id' => $user->id], ['class' => 'btn btn-primary',
            'title'=> 'Clique aqui para atualizar o usuário',
            'data-toggle'=>'tooltip']) ?>
        <?= Html::a('Visualizar Histórico de Empréstimos',
            \yii\helpers\Url::to(['/usuario/historico-emprestimo',
                'idUsuario'=>$user->id,
              ]),
            ['class'=>'btn btn-info',
                'title'=> 'Clique aqui para visualizar o histórico de empréstimo do usuário',
                'data-toggle'=>'tooltip']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $user,
        'attributes' => [
            'id',
            
            'username',
            
            [
                'attribute' => 'email',
                'label' => 'RG'
            ],
            
            'usuario.cpf',
            'usuario.email',
            'usuario.cargo',
            'usuario.reparticao',
            'usuario.endereco',
            'usuario.telefone',
            [
                'attribute' => 'usuario.situacaoUsuarioIdsituacaoUsuario.situacao',
                'label' => 'Situação do Usuário'
            ],
             [
                'attribute' => 'role.name',
                'label' => 'Tipo de Usuário'
            ],
            [
                'attribute' => 'usuario.foto',
//                'label' => Yii::t('user', 'FullName'),
                'format' => 'raw',
                'value' => isset($user->usuario->foto) ?
                        Html::img($user->usuario->foto, ['class' => 'img-responsive img-thumbnail',
                            'width' => 400]) : 'Não há foto'
            ,
            ],

            [
                'attribute'=>'created_at',
                'value'=> isset($user->created_at) ?
                    Yii::$app->formatter->asDate($user->created_at, 'dd/M/Y à\s HH:m') : null,

            ],

            [
                'attribute'=>'updated_at',
                'value'=> isset($user->updated_at) ?
                    Yii::$app->formatter->asDate($user->updated_at, 'dd/M/Y à\s HH:m') : null,

            ],

        ],
    ])
    ?>

</div>
