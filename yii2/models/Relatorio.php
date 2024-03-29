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
            'idrelatorio' => Yii::t('app', 'Identificador do Relatório'),
            'tipo' => Yii::t('app', 'Tipo do Relatório'),
            'inicio_intervalo' => Yii::t('app', 'Início do Intervalo'),
            'fim_intervalo' => Yii::t('app', 'Fim do Intervalo'),
            'data_geracao' => Yii::t('app', 'Data de Geração'),
        ];
    }
}
