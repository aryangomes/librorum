<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $idusuario
 * @property string $nome
 * @property string $rg
 * @property string $cpf
 * @property string $cargo
 * @property string $reparticao
 * @property string $endereco
 * @property string $telefone
 * @property string $email
 *
 * @property Emprestimo[] $emprestimos
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'rg', 'endereco', 'telefone', 'email'], 'required'],
            [['nome'], 'string', 'max' => 55],
            [['rg', 'cpf'], 'string', 'max' => 11],
            [['cargo', 'reparticao'], 'string', 'max' => 45],
            [['endereco'], 'string', 'max' => 200],
            [['telefone'], 'string', 'max' => 12],
            [['email'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idusuario' => Yii::t('app', 'Idusuario'),
            'nome' => Yii::t('app', 'Nome'),
            'rg' => Yii::t('app', 'Rg'),
            'cpf' => Yii::t('app', 'Cpf'),
            'cargo' => Yii::t('app', 'Cargo'),
            'reparticao' => Yii::t('app', 'Reparticao'),
            'endereco' => Yii::t('app', 'Endereco'),
            'telefone' => Yii::t('app', 'Telefone'),
            'email' => Yii::t('app', 'Email'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmprestimos()
    {
        return $this->hasMany(Emprestimo::className(), ['usuario_idusuario' => 'idusuario', 'usuario_nome' => 'nome', 'usuario_rg' => 'rg']);
    }
}
