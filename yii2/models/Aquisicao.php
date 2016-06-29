<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aquisicao".
 *
 * @property integer $idaquisicao
 * @property string $preco
 * @property string $quantidade
 * @property integer $tipo_aquisicao_idtipo_aquisicao
 * @property integer $pessoa_idpessoa
 *
 * @property Acervo[] $acervos
 * @property Pessoa $pessoaIdpessoa
 * @property TipoAquisicao $tipoAquisicaoIdtipoAquisicao
 */
class Aquisicao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aquisicao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quantidade', 'tipo_aquisicao_idtipo_aquisicao', 'pessoa_idpessoa'], 'required'],
            [['tipo_aquisicao_idtipo_aquisicao', 'pessoa_idpessoa'], 'integer'],
            [['preco', 'quantidade'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idaquisicao' => Yii::t('app', 'Idaquisicao'),
            'preco' => Yii::t('app', 'Preco'),
            'quantidade' => Yii::t('app', 'Quantidade'),
            'tipo_aquisicao_idtipo_aquisicao' => Yii::t('app', 'Tipo Aquisicao Idtipo Aquisicao'),
            'pessoa_idpessoa' => Yii::t('app', 'Pessoa Idpessoa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcervos()
    {
        return $this->hasMany(Acervo::className(), ['aquisicao_idaquisicao' => 'idaquisicao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPessoaIdpessoa()
    {
        return $this->hasOne(Pessoa::className(), ['idpessoa' => 'pessoa_idpessoa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoAquisicaoIdtipoAquisicao()
    {
        return $this->hasOne(TipoAquisicao::className(), ['idtipo_aquisicao' => 'tipo_aquisicao_idtipo_aquisicao']);
    }
}
