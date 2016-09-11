<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acervo_exemplar".
 *
 * @property integer $idacervo_exemplar
 * @property integer $acervo_idacervo
 * @property string $codigo_livro
 * @property integer $esta_disponivel
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
            [['acervo_idacervo', 'codigo_livro', 'esta_disponivel'], 'required'],
            [['acervo_idacervo', 'esta_disponivel'], 'integer'],
            [['codigo_livro'], 'string', 'max' => 45],
            [['acervo_idacervo'], 'exist', 'skipOnError' => true, 'targetClass' => Acervo::className(), 'targetAttribute' => ['acervo_idacervo' => 'idacervo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idacervo_exemplar' => 'Idacervo Exemplar',
            'acervo_idacervo' => 'Título Exemplar',
            'codigo_livro' => 'Código Exemplar',
            'esta_disponivel' => 'Disponibilidade',
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
    
    public static function verificaCodigoLivroExiste($codigo) {
        $exemplar = AcervoExemplar::find()
                ->where([
                    'codigo_livro'=>$codigo
                ])->one();

        if($exemplar == null){
            return false;
        }else{
            return true;
        }
    }
}
