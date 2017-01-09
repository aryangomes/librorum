<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var amnah\yii2\user\Module $module
 * @var amnah\yii2\user\models\search\UserSearch $searchModel
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\Role $role
 */
$module = $this->context->module;
$user = $module->model("User");
$role = $module->model("Role");

$this->title = Yii::t('user', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?=
        Html::a(Yii::t('user', 'Create {modelClass}', [
            'modelClass' => Yii::t('user', 'User')
        ]), ['create'], ['class' => 'btn btn-success',
            'title' => 'Clique aqui para cadastrar um usuário',
            'data-toggle' => "tooltip"])
        ?>
    </p>
    <div class="table-responsive">
        <?php \yii\widgets\Pjax::begin(); ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
//            'id',
                [
                    'attribute' => 'profile.full_name',
                    'label' => Yii::t('user', 'Full Name'),
                    'format' => 'raw',
                    'value' => function ($model) {

                        return Html::a($model->username, ['view', 'id' => $model->id]);
                    },
                ],
                'usuario.rg',
                'usuario.email',

                [
                    'attribute' => 'role_id',
                    'label' => Yii::t('user', 'Role'),
                    'filter' => $role::dropdown(),
                    'value' => function ($model, $index, $dataColumn) use ($role) {
                        $roleDropdown = $role::dropdown();
                        return $roleDropdown[$model->role_id];
                    },
                ],
                'usuario.situacaoUsuarioIdsituacaoUsuario.situacao',
                [
                    'attribute' => 'created_at',
                    'value' => function ($model) {
                        return isset($model->created_at) ?
                            Yii::$app->formatter->asDate($model->created_at, 'dd/M/Y à\s HH:m') : null;
                    },
                ],

                // 'username',
                // 'password',
                // 'auth_key',
                // 'access_token',
                // 'logged_in_ip',
                // 'logged_in_at',
                // 'created_ip',
                // 'updated_at',
                // 'banned_at',
                // 'banned_reason',
//            ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
</div>
