<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acervo_exemplar".
 *
 * @property integer $idacervo_exemplar
 * @property integer $acervo_idacervo
 * @property string $codigo_livro
 *
 * @property Acervo $acervoIdacervo
 * @property Emprestimo[] $emprestimos
 */
class AcervoExemplar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acervo_exemplar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acervo_idacervo', 'codigo_livro'], 'required'],
            [['acervo_idacervo'], 'integer'],
            [['codigo_livro'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idacervo_exemplar' => Yii::t('app', 'Idacervo Exemplar'),
            'acervo_idacervo' => Yii::t('app', 'Acervo Idacervo'),
            'codigo_livro' => Yii::t('app', 'Codigo Livro'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcervoIdacervo()
    {
        return $this->hasOne(Acervo::className(), ['idacervo' => 'acervo_idacervo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmprestimos()
    {
        return $this->hasMany(Emprestimo::className(), ['acervo_exemplar_idacervo_exemplar' => 'idacervo_exemplar']);
    }
}
