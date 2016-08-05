<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pessoa".
 *
 * @property integer $idpessoa
 * @property string $nome
 *
 * @property Aquisicao[] $aquisicaos
 * @property PessoaFisica $pessoaFisica
 * @property PessoaJuridica $pessoaJuridica
 */
class Pessoa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pessoa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idpessoa' => Yii::t('app', 'Id Pessoa'),
            'nome' => Yii::t('app', 'Nome da Pessoa/Empresa/Orgão de origem do Material'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAquisicaos()
    {
        return $this->hasMany(Aquisicao::className(), ['pessoa_idpessoa' => 'idpessoa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPessoaFisica()
    {
        return $this->hasOne(PessoaFisica::className(), ['pessoa_idpessoa' => 'idpessoa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPessoaJuridica()
    {
        return $this->hasOne(PessoaJuridica::className(), ['pessoa_idpessoa' => 'idpessoa']);
    }
}
