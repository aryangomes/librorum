<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property string $chave
 * @property string $valor
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chave', 'valor'], 'required'],
            [['chave'], 'string', 'max' => 45],
            [['valor'], 'string', 'max' => 255],
            [['chave'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'chave' => Yii::t('app', 'Nome da Configuração'),
            'valor' => Yii::t('app', 'Valor'),
        ];
    }
}
