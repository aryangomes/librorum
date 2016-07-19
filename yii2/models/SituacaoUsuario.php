<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "situacao_usuario".
 *
 * @property integer $idsituacao_usuario
 * @property string $situacao
 * @property integer $pode_emprestar
 *
 * @property Usuario[] $usuarios
 */
class SituacaoUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'situacao_usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['situacao', 'pode_emprestar'], 'required'],
            [['pode_emprestar'], 'integer'],
            [['situacao'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idsituacao_usuario' => Yii::t('app', 'Idsituacao Usuario'),
            'situacao' => Yii::t('app', 'Situacao'),
            'pode_emprestar' => Yii::t('app', 'Pode Emprestar'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['situacao_usuario_idsituacao_usuario' => 'idsituacao_usuario']);
    }
    
      public static function situacaoUsuarioDropDown(){
        $situacoesUsuario = self::find()->all();
        if($situacoesUsuario != null){
            return \yii\helpers\ArrayHelper::map($situacoesUsuario, 'idsituacao_usuario', 'pode_emprestar');
        }
    }
}
