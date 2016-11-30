<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "emprestimo_has_acervo_exemplar".
 *
 * @property integer $emprestimo_idemprestimo
 * @property integer $acervo_exemplar_idacervo_exemplar
 *
 * @property AcervoExemplar $acervoExemplarIdacervoExemplar
 * @property Emprestimo $emprestimoIdemprestimo
 */
class EmprestimoHasAcervoExemplar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emprestimo_has_acervo_exemplar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emprestimo_idemprestimo', 'acervo_exemplar_idacervo_exemplar'], 'required'],
            [['emprestimo_idemprestimo', 'acervo_exemplar_idacervo_exemplar'], 'integer'],
            [['acervo_exemplar_idacervo_exemplar'], 'exist', 'skipOnError' => true, 'targetClass' => AcervoExemplar::className(), 'targetAttribute' => ['acervo_exemplar_idacervo_exemplar' => 'idacervo_exemplar']],
            [['emprestimo_idemprestimo'], 'exist', 'skipOnError' => true, 'targetClass' => Emprestimo::className(), 'targetAttribute' => ['emprestimo_idemprestimo' => 'idemprestimo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'emprestimo_idemprestimo' => Yii::t('app', 'Emprestimo Idemprestimo'),
            'acervo_exemplar_idacervo_exemplar' => Yii::t('app', 'Acervo Exemplar Idacervo Exemplar'),
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
    public function getEmprestimoIdemprestimo()
    {
        return $this->hasOne(Emprestimo::className(), ['idemprestimo' => 'emprestimo_idemprestimo']);
    }
}
