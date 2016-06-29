<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "emprestimo".
 *
 * @property integer $idemprestimo
 * @property string $dataemprestimo
 * @property string $dataprevisaodevolucao
 * @property string $datadevolucao
 * @property integer $usuario_idusuario
 * @property string $usuario_nome
 * @property string $usuario_rg
 * @property integer $acervo_exemplar_idacervo_exemplar
 *
 * @property AcervoExemplar $acervoExemplarIdacervoExemplar
 * @property Usuario $usuarioIdusuario
 */
class Emprestimo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emprestimo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dataemprestimo', 'dataprevisaodevolucao', 'datadevolucao'], 'safe'],
            [['dataprevisaodevolucao', 'usuario_idusuario', 'usuario_nome', 'usuario_rg', 'acervo_exemplar_idacervo_exemplar'], 'required'],
            [['usuario_idusuario', 'acervo_exemplar_idacervo_exemplar'], 'integer'],
            [['usuario_nome'], 'string', 'max' => 55],
            [['usuario_rg'], 'string', 'max' => 11]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idemprestimo' => Yii::t('app', 'Idemprestimo'),
            'usuario_nome' => Yii::t('app', 'Nome do Usuário'),
            'usuario_rg' => Yii::t('app', 'Rg do Usuário'),
            'acervo_exemplar_idacervo_exemplar' => Yii::t('app', 'Acervo Exemplar Idacervo Exemplar'),
            'usuario_idusuario' => Yii::t('app', 'Usuário'),
            'dataemprestimo' => Yii::t('app', 'Data do Empréstimo'),
            'dataprevisaodevolucao' => Yii::t('app', 'Data de previsão da devolução'),
            'datadevolucao' => Yii::t('app', 'Data da Devolução'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcervoExemplarIdacervoExemplar()
    {
        return $this->hasOne(AcervoExemplar::className(), ['idacervo_exemplar' => 'acervo_exemplar_idacervo_exemplar']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioIdusuario()
    {
        return $this->hasOne(Usuario::className(), ['idusuario' => 'usuario_idusuario', 'nome' => 'usuario_nome', 'rg' => 'usuario_rg']);
    }
}
