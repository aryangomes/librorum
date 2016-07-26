<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property string $chave
 * @property string $valor
 *  * @property array $configuracoes
 */
class Config extends \yii\db\ActiveRecord
{
    
     private $configuracoes =[
         'dias_emprestimo'=>'Dias de Empréstimo',
            'nome_biblioteca'=>'Nome da Biblioteca'
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
        ];
    }
    
    public function getConfiguracoes() {
        return $this->configuracoes;
    }
}
