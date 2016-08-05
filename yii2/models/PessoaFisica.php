<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pessoa_fisica".
 *
 * @property string $cpf
 * @property integer $pessoa_idpessoa
 *
 * @property Pessoa $pessoaIdpessoa
 */
class PessoaFisica extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pessoa_fisica';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pessoa_idpessoa'], 'required'],
            [['pessoa_idpessoa'], 'integer'],
            [['cpf'], 'string', 'max' => 14]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cpf' => Yii::t('app', 'Cpf'),
            'pessoa_idpessoa' => Yii::t('app', 'Pessoa Idpessoa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPessoaIdpessoa()
    {
        return $this->hasOne(Pessoa::className(), ['idpessoa' => 'pessoa_idpessoa']);
    }
}