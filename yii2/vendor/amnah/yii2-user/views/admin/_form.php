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
 */
use kartik\widgets\FileInput;
$url = \yii\helpers\Url::to(['lista-situacao']);
$module = $this->context->module;
$role = $module->model("Role");
?>

<div class="user-form">



    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL,
        'enableAjaxValidation' => true,'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?php echo Form::widget([
        'model'=>$usuario,
        'form'=>$form,
        'autoGenerateColumns' => true,
        'contentBefore' => '<legend class="text-info"><small>Dados Pessoais</small></legend>',
        'attributes'=>[
            // 2 column layout
            'nome'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app','Nome Para o Usuário'),'feedbackIcon' => [
                //'prefix' => 'fa fa-',
                'default' => 'user',
                'success' => 'user-plus',
                'error' => 'user-times',
                'defaultOptions' => ['class'=>'text-warning'],
            ],
            ],
            ],
            'rg'=>['type'=>Form::INPUT_TEXT,
                'options'=>['placeholder' => 'Digite o RG do Usuário']],
            'cpf'=>['type'=>Form::INPUT_WIDGET,'widgetClass' => MaskedInput::className(),
                'options'=>['mask' => ['999.999.999-99']]],
        ],
    ])
    ?>




    <?php echo Form::widget([
        'model'=>$usuario,
        'form'=>$form,
        'columns'=>2,
        'contentBefore' => '<legend class="text-info"><small>Contatos</small></legend>',
        'attributes'=>[
            // 2 column layout
            'telefone'=>['type'=>Form::INPUT_WIDGET,'widgetClass' => MaskedInput::className(), 'options'=>[
                'mask' => '(99)99999-9999'],
            ],

            'email'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app','Enter a valid email address...'),'feedbackIcon' => [
                //'prefix' => 'fa fa-',
                'feedbackIcon' => [
                    'default' => 'envelope',
                    'success' => 'ok',
                    'error' => 'exclamation-sign',
                    'defaultOptions' => ['class'=>'text-primary']

                ],
            ],
            ],
            ],
        ],

    ]); ?>


    <?php echo Form::widget([
        'model'=>$usuario,
        'form'=>$form,
        'columns'=>4,
        'contentBefore' => '<legend class="text-info"><small>Dados Diversos</small></legend>',
        'attributes'=>[
            'cargo'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app','Cargo do Usuário'),'maxlength' => true]],
            'reparticao'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app','Repartição do Usuário'),'maxlength' => true]],
            'endereco'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app','Endereço do Usuário'),'maxlength' => true]],

            'situacaoUsuarioIdsituacaoUsuario'=>['type'=>Form::INPUT_WIDGET,'widgetClass' => 'kartik\widgets\Select2','options' => ['pluginOptions' => [
                'placeholder' => Yii::t('app','Search for a Situação do usuário ...'),
                'allowClear' => true,
                'minimumInputLength' => 3,
                'language' => [
                    'errorLoading' => new JsExpression("function () { return '".Yii::t('app','Waiting for results...')."'; }"),
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
        'model'=>$user,
        'form'=>$form,
        'columns'=>3,
        'contentBefore' => '<legend class="text-info"><small>Dados Para Acesso Ao Sistema</small></legend>',
        'attributes'=>[
            // 2 column layout
            //'newPassword'=>['type'=>Form::INPUT_PASSWORD],

            'password'=>['type'=>Form::INPUT_PASSWORD, 'options'=>['value'=>'']],
            'role_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>['data' => $role::dropdown()]],


        ],



    ]); ?>











    <?php  $form->field($profile, 'full_name')->hiddenInput()->label(false); ?>

    <?php

    $this->registerJs("
        $('#usuario-nome').blur(function(){
            $('#profile-full_name').val($(this).val());
        });
    ");
    ?>









    <?=  $form->field($usuario, 'imageFile')->widget(FileInput::classname(), [

        'pluginOptions' => [
            //'uploadUrl' => url::to(['@web/upload/imagens']),


            // permite habilitar ou desabilitar o botão de upload
            'showUpload' => false,
            //'minImageWidth' => 900,
            //'minImageHeight' => 300,
            //'maxImageWidth' =>900,
            //'maxImageHeight' => 300

        ],


        'options' => ['accept' => 'image/jpeg, image/png'],

    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($user->isNewRecord ? Yii::t('user', 'Create') : Yii::t('user', 'Update'), ['class' => $user->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
