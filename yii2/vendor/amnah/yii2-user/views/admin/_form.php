<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\widgets\MaskedInput;
use yii\web\JsExpression;
/**
 * @var yii\web\View $this
 * @var amnah\yii2\user\Module $module
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\Profile $profile
 * @var amnah\yii2\user\models\Role $role
 * @var yii\widgets\ActiveForm $form
 * @var \app\models\Usuario $usuario
 */
use kartik\widgets\FileInput;

$url = \yii\helpers\Url::to(['lista-situacao']);
$module = $this->context->module;
$role = $module->model("Role");
?>

<div class="user-form">

    <?php
    if (Yii::$app->session->has('mensagem')) {
        ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('mensagem') ?>
        </div>
        <?php
    }


    ?>

    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL,
        'enableAjaxValidation' => true, 'options' => ['enctype' => 'multipart/form-data'],
    ]);
    ?>

    <?php
    echo Form::widget([
        'model' => $usuario,
        'form' => $form,
        'autoGenerateColumns' => true,
        'contentBefore' => '<legend class="text-info"><small>Dados Pessoais</small></legend>',
        'attributes' => [
            // 2 column layout
            'nome' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => yii::t('app', 'Nome Para o Usuário'), 'feedbackIcon' => [
                //'prefix' => 'fa fa-',
                'default' => 'user',
                'success' => 'user-plus',
                'error' => 'user-times',
                'defaultOptions' => ['class' => 'text-warning'],
            ],
            ],
            ],
            'rg' => ['type' => Form::INPUT_TEXT,
                'options' => ['placeholder' => 'Digite o RG do Usuário(Somente números: 000000000',
                    'type'=>'number','maxlength'=>'12']],
            'cpf' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => MaskedInput::className(),
                'options' => ['mask' => ['999.999.999-99']]],
        ],
    ])
    ?>

    <div id="validacao-usuario"></div>


    <?php
    echo Form::widget([
        'model' => $usuario,
        'form' => $form,
        'columns' => 2,
        'contentBefore' => '<legend class="text-info"><small>Contatos</small></legend>',
        'attributes' => [
            // 2 column layout
            'telefone' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => MaskedInput::className(), 'options' => [
                'mask' => '(99)99999-9999'],
            ],
            'email' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => yii::t('app', 'Digite o email...'), 'feedbackIcon' => [
                //'prefix' => 'fa fa-',
                'feedbackIcon' => [
                    'default' => 'envelope',
                    'success' => 'ok',
                    'error' => 'exclamation-sign',
                    'defaultOptions' => ['class' => 'text-primary']
                ],
            ],
            ],
            ],
        ],
    ]);
    ?>


    <?php
    echo Form::widget([
        'model' => $usuario,
        'form' => $form,
        'columns' => 4,
        'contentBefore' => '<legend class="text-info"><small>Dados Diversos</small></legend>',
        'attributes' => [
            'cargo' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => yii::t('app', 'Cargo do Usuário'), 'maxlength' => true]],
            'reparticao' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => yii::t('app', 'Repartição do Usuário'), 'maxlength' => true]],
            'endereco' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => yii::t('app', 'Endereço do Usuário'), 'maxlength' => true]],
            'situacaoUsuarioIdsituacaoUsuario' => ['type' => Form::INPUT_WIDGET,
                'widgetClass' => 'kartik\widgets\Select2',

                'options' => [
                    'initValueText' => isset($usuario->situacao_usuario_idsituacao_usuario) ? app\models\SituacaoUsuario::findOne
                    ($usuario->situacao_usuario_idsituacao_usuario)->situacao : '',
                    'pluginOptions' => [
                        'placeholder' => Yii::t('app', 'Search for a Situação do usuário ...'),
                        'allowClear' => true,

                        'minimumInputLength' => 3,
                        'language' => [
                            'errorLoading' => new JsExpression("function () { return '" . Yii::t('app', 'Waiting for results...') . "'; }"),
                            "noResults" => new JsExpression("function () { return '" . Yii::t('app', 'No results...') . "'; }"),
                            "inputTooShort" => new JsExpression("function () { return '" . Yii::t('app', 'Please enter 3 or more characters...') . "'; }"),
                        ],
                        'ajax' => [
                            'url' => $url,
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ],
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function(situacao) { return situacao.text; }'),
                        'templateSelection' => new JsExpression('function (situacao) { return situacao.text; }'),
                    ],
                ],
            ],
        ],


    ]); ?>


    <?php echo Form::widget([
        'model' => $user,
        'form' => $form,
        'columns' => 3,
        'contentBefore' => '<legend class="text-info"><small>Dados Para Acesso Ao Sistema</small></legend>',
        'attributes' => [
            // 2 column layout
            //'newPassword'=>['type'=>Form::INPUT_PASSWORD],


            'password' => ['type' => Form::INPUT_PASSWORD, 'options' => [
                'value' => !$user->isNewRecord ? $user->password : '',
                'disabled' => !$user->isNewRecord ? true : false,
           'placeholder'=>'Digite a senha do Usuário...']
            ],
            'password_repeat' => ['type' => Form::INPUT_PASSWORD, 'options' => [
                'value' => !$user->isNewRecord ? $user->password : '',
                'disabled' => !$user->isNewRecord ? true : false,
                'placeholder'=>'Confirme a senha do Usuário...']
               ],
            'role_id' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => ['data' => $role::dropdown()]],


        ],
    ]);
    ?>

    <?php $form->field($profile, 'full_name')->hiddenInput()->label(false); ?>


    <?=
    $form->field($usuario, 'imageFile')->widget(FileInput::classname(), [

        'pluginOptions' => [
            //'uploadUrl' => url::to(['@web/upload/imagens']),
            // permite habilitar ou desabilitar o botão de upload
            'showUpload' => false,
            'browseLabel' => 'Carregar Foto...',

        ],
        'options' => ['accept' => 'image/jpeg, image/png',
            'title' => 'Clique aqui para carregar uma foto',
            'data-toggle' => "tooltip"],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($user->isNewRecord ? Yii::t('user', 'Create') : Yii::t('user', 'Update'), ['class' => $user->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'title' => $user->isNewRecord ? 'Clique aqui para cadastrar um usuário' : 'Clique aqui para atualizar o usuário',
            'data-toggle' => "tooltip"]) ?>
        <?=
        Html::Button('Alterar Senha do Usuário', ['class' => 'btn btn-warning',
            'id' => 'btAlterarSenhaDoUsuário',
            'disabled' => $user->isNewRecord ? true : false,
            'title' => 'Clique aqui para habilitar a alteraração a senha do usuário',
            'data-toggle' => "tooltip"])
        ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php
    $this->registerJsFile(\Yii::getAlias("@web") . '/js/js-user-form.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
    ?>
</div>
