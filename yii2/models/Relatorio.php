<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "relatorio".
 *
 * @property integer $idrelatorio
 * @property string $tipo
 * @property string $inicio_intervalo
 * @property string $fim_intervalo
 * @property string $data_geracao
 */
class Relatorio extends \yii\db\ActiveRecord
{

    public static $tiposRelatorio = [
        'emprestimos'=>'Quantidade de Empréstimo',
        'devolucoes'=>'Quantidade de Devoluções feitas',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relatorio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo', 'inicio_intervalo', 'fim_intervalo', 'data_geracao'], 'required'],
            [['inicio_intervalo', 'fim_intervalo', 'data_geracao'], 'safe'],
            [['tipo'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idrelatorio' => Yii::t('app', 'Idrelatorio'),
            'tipo' => Yii::t('app', 'Tipo'),
            'inicio_intervalo' => Yii::t('app', 'Inicio Intervalo'),
            'fim_intervalo' => Yii::t('app', 'Fim Intervalo'),
            'data_geracao' => Yii::t('app', 'Data Geracao'),
        ];
    }
}
