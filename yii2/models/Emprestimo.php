<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "emprestimo".
 *
 * @property integer $idemprestimo
 * @property integer $usuario_idusuario
 * @property integer $acervo_idacervo
 * @property string $dataemprestimo
 * @property string $dataprevisaodevolucao
 * @property string $datadevolucao
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
            [['usuario_idusuario', 'acervo_idacervo'], 'integer'],
            [['dataemprestimo', 'dataprevisaodevolucao', 'datadevolucao'], 'safe'],
            [['dataprevisaodevolucao'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idemprestimo' => Yii::t('app', 'Idemprestimo'),
            'usuario_idusuario' => Yii::t('app', 'Usuario Idusuario'),
            'acervo_idacervo' => Yii::t('app', 'Acervo Idacervo'),
            'dataemprestimo' => Yii::t('app', 'Dataemprestimo'),
            'dataprevisaodevolucao' => Yii::t('app', 'Dataprevisaodevolucao'),
            'datadevolucao' => Yii::t('app', 'Datadevolucao'),
        ];
    }
}
