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
 * @property string $chamada
 * @property integer $aquisicao_idaquisicao
 * @property integer $tipo_material_idtipo_material
 * @property integer $categoria_acervo_idcategoria_acervo
 *
 * @property Aquisicao $aquisicaoIdaquisicao
 * @property TipoMaterial $tipoMaterialIdtipoMaterial
 * @property CategoriaAcervo $categoriaAcervoIdcategoriaAcervo
 * @property AcervoExemplar[] $acervoExemplars
 */
class Acervo extends \yii\db\ActiveRecord
{
    public $quantidadeExemplar;
    public $catalogarAcervoExistente;
    
    public $codigoInicio;
    public $codigoFim;
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
            [['cdd', 'autor', 'titulo', 'editora', 'chamada', 'aquisicao_idaquisicao', 'tipo_material_idtipo_material', 'categoria_acervo_idcategoria_acervo'], 'required'],
            [['aquisicao_idaquisicao', 'tipo_material_idtipo_material', 'categoria_acervo_idcategoria_acervo'], 'integer'],
            [['cdd', 'chamada'], 'string', 'max' => 45],
            [['autor', 'titulo', 'editora'], 'string', 'max' => 100],
            [['aquisicao_idaquisicao'], 'exist', 'skipOnError' => true, 'targetClass' => Aquisicao::className(), 'targetAttribute' => ['aquisicao_idaquisicao' => 'idaquisicao']],
            [['tipo_material_idtipo_material'], 'exist', 'skipOnError' => true, 'targetClass' => TipoMaterial::className(), 'targetAttribute' => ['tipo_material_idtipo_material' => 'idtipo_material']],
            [['categoria_acervo_idcategoria_acervo'], 'exist', 'skipOnError' => true, 'targetClass' => CategoriaAcervo::className(), 'targetAttribute' => ['categoria_acervo_idcategoria_acervo' => 'idcategoria_acervo']],
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
            'autor' => Yii::t('app', 'Autor(es)'),
            'titulo' => Yii::t('app', 'Título'),
            'editora' => Yii::t('app', 'Editora'),
            'chamada' => Yii::t('app', 'Chamada'),
            'aquisicao_idaquisicao' => Yii::t('app', 'Aquisição'),
            'tipo_material_idtipo_material' => Yii::t('app', 'Tipo do Material'),
            'categoria_acervo_idcategoria_acervo' => Yii::t('app', 'Categoria'),
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
    public function getTipoMaterialIdtipoMaterial()
    {
        return $this->hasOne(TipoMaterial::className(), ['idtipo_material' => 'tipo_material_idtipo_material']);
    }

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getCategoriaAcervoIdcategoriaAcervo() 
    { 
        return $this->hasOne(CategoriaAcervo::className(), ['idcategoria_acervo' => 'categoria_acervo_idcategoria_acervo']);
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcervoExemplars()
    {
        return $this->hasMany(AcervoExemplar::className(), ['acervo_idacervo' => 'idacervo']);
    }
}
