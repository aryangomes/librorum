<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pessoa_juridica".
 *
 * @property string $cnpj
 * @property integer $pessoa_idpessoa
 *
 * @property Pessoa $pessoaIdpessoa
 */
class PessoaJuridica extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pessoa_juridica';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pessoa_idpessoa'], 'required'],
            [['pessoa_idpessoa'], 'integer'],
            [['cnpj'], 'string', 'max' => 18]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cnpj' => Yii::t('app', 'Cnpj'),
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