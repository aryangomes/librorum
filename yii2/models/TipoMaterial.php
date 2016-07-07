<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_material".
 *
 * @property integer $idtipo_material
 * @property string $nome
 *
 * @property Acervo[] $acervos
 */
class TipoMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_material';
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
            'idtipo_material' => Yii::t('app', 'Idtipo Material'),
            'nome' => Yii::t('app', 'Nome'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcervos()
    {
        return $this->hasMany(Acervo::className(), ['tipo_material_idtipo_material' => 'idtipo_material']);
    }
}
