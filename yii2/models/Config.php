<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property string $chave
 * @property string $valor
 *  * @property string $descricao
 *  * @property array $configuracoes
 */
class Config extends \yii\db\ActiveRecord
{

    private $configuracoes =[
        'dias_emprestimo'=>'Dias de Empréstimo',
        'nome_biblioteca'=>'Nome da Biblioteca',
        'max_qtd_exemplar_emprestimo'=>'Máximo de Exemplares Emprestados por Empréstimo',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * Retorna uma instância única de uma classe.
     *
     * @staticvar Singleton $instance A instância única dessa classe.
     *
     * @return Singleton A Instância única.
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chave', 'valor'], 'required'],
            [['chave'], 'string', 'max' => 45],
            [['valor'], 'string', 'max' => 255],
            [['descricao'], 'string',],
            [['chave'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'chave' => Yii::t('app', 'Nome da Configuração'),
            'valor' => Yii::t('app', 'Valor'),
            'descricao' => Yii::t('app', 'Descrição'),
        ];
    }

    public function getConfiguracoes() {
        return $this->configuracoes;
    }
}