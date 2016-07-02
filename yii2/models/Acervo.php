<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acervo".
 *
 * @property integer $idacervo
 * @property string $cdd
 * @property string $autor
 * @property string $titulo
 * @property string $editora
 * @property string $tipo_material
 * @property string $chamada
 * @property integer $aquisicao_idaquisicao
 *
 * @property Aquisicao $aquisicaoIdaquisicao
 * @property AcervoExemplar[] $acervoExemplars
 */
class Acervo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acervo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cdd', 'autor', 'titulo', 'editora', 'tipo_material', 'chamada', 'aquisicao_idaquisicao'], 'required'],
            [['aquisicao_idaquisicao'], 'integer'],
            [['cdd', 'tipo_material', 'chamada'], 'string', 'max' => 45],
            [['autor', 'titulo', 'editora'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idacervo' => Yii::t('app', 'Idacervo'),
            'cdd' => Yii::t('app', 'Cdd'),
            'autor' => Yii::t('app', 'Autor'),
            'titulo' => Yii::t('app', 'Título'),
            'editora' => Yii::t('app', 'Editora'),
            'tipo_material' => Yii::t('app', 'Tipo de Material'),
            'chamada' => Yii::t('app', 'Chamada'),
            'aquisicao_idaquisicao' => Yii::t('app', 'Aquisição'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAquisicaoIdaquisicao()
    {
        return $this->hasOne(Aquisicao::className(), ['idaquisicao' => 'aquisicao_idaquisicao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcervoExemplars()
    {
        return $this->hasMany(AcervoExemplar::className(), ['acervo_idacervo' => 'idacervo']);
    }
}