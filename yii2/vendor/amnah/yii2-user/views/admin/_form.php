<?php

use yii\helpers\Html;
use \yii\widgets\MaskedInput;
use kartik\form\ActiveForm;

/**
 * @var yii\web\View $this
 * @var amnah\yii2\user\Module $module
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\Profile $profile
 * @var amnah\yii2\user\models\Role $role
 * @var yii\widgets\ActiveForm $form
 */

$module = $this->context->module;
$role = $module->model("Role");
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($usuario, 'nome', [
        'feedbackIcon' => [
            //'prefix' => 'fa fa-',
            'default' => 'user',
            'success' => 'user-plus',
            'error' => 'user-times',
            'defaultOptions' => ['class'=>'text-warning']
        ]
    ])->textInput(['placeholder'=>'Enter username...']);

    ?>
    <?= $form->field($usuario, 'rg')->widget(MaskedInput::className(), [
        'mask' => ['99.999.999-9'],
    ]);?>

    <?=  $form->field($usuario, 'cpf')->widget(MaskedInput::className(), [
        'mask' => ['999.999.999-99'],
    ]); ?>

    <?= $form->field($usuario, 'cargo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($usuario, 'reparticao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($usuario, 'endereco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($usuario, 'telefone', [
        'feedbackIcon' => [
            //'prefix' => 'fa fa-',
            'default' => 'phone',
            'success' => 'check-circle',
            'error' => 'exclamation-circle',
        ]
    ])->widget(MaskedInput::className(), [
        'mask' => '(99)99999-9999'
    ]);?>

    <?= $form->field($usuario, 'email', [
        'feedbackIcon' => [
            'default' => 'envelope',
            'success' => 'ok',
            'error' => 'exclamation-sign',
            'defaultOptions' => ['class'=>'text-primary']
        ]
    ])->textInput(['placeholder'=>yii::t('app','Enter a valid email address...')]);
    ?>



    <?= $form->field($user, 'newPassword')->passwordInput() ?>

    <?= $form->field($profile, 'full_name')->hiddenInput()->label(false); ?>

    <?php

    $this->registerJs("
        $('#usuario-nome').blur(function(){
            $('#profile-full_name').val($(this).val());
        });
    ");
    ?>

    <?= $form->field($user, 'role_id')->dropDownList($role::dropdown()); ?>

    <?= $form->field($user, 'status')->dropDownList($user::statusDropdown()); ?>




    <?php // use checkbox for banned_at ?>
    <?php // convert `banned_at` to int so that the checkbox gets set properly ?>
    <?php $user->banned_at = $user->banned_at ? 1 : 0 ?>
    <?= Html::activeLabel($user, 'banned_at', ['label' => Yii::t('user', 'Banned')]); ?>
    <?= Html::activeCheckbox($user, 'banned_at'); ?>
    <?= Html::error($user, 'banned_at'); ?>

    <?= $form->field($user, 'banned_reason'); ?>

    <div class="form-group">
        <?= Html::submitButton($user->isNewRecord ? Yii::t('user', 'Create') : Yii::t('user', 'Update'), ['class' => $user->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
