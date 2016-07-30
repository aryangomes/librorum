<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria_acervo".
 *
 * @property integer $idcategoria_acervo
 * @property string $categoria
 *
 * @property Acervo[] $acervos
 */
class CategoriaAcervo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria_acervo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoria'], 'required'],
            [['categoria'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcategoria_acervo' => Yii::t('app', 'Idcategoria Acervo'),
            'categoria' => Yii::t('app', 'Categoria'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcervos()
    {
        return $this->hasMany(Acervo::className(), ['categoria_acervo_idcategoria_acervo' => 'idcategoria_acervo']);
    }
}
