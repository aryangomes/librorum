<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_aquisicao".
 *
 * @property integer $idtipo_aquisicao
 * @property string $nome
 *
 * @property Aquisicao[] $aquisicaos
 */
class TipoAquisicao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_aquisicao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtipo_aquisicao' => Yii::t('app', 'Idtipo Aquisicao'),
            'nome' => Yii::t('app', 'Nome'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAquisicaos()
    {
        return $this->hasMany(Aquisicao::className(), ['tipo_aquisicao_idtipo_aquisicao' => 'idtipo_aquisicao']);
    }
}
