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
 *
 * @property Usuario $usuarioIdusuario
 * @property EmprestimoHasAcervoExemplar[] $emprestimoHasAcervoExemplars
 * @property AcervoExemplar[] $acervoExemplarIdacervoExemplars
 */
class Emprestimo extends \yii\db\ActiveRecord
{

    public $diasDiferenca;

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
            [['dataprevisaodevolucao', 'usuario_idusuario', 'usuario_nome', 'usuario_rg'], 'required'],
            [['usuario_idusuario'], 'integer'],
            [['usuario_nome'], 'string', 'max' => 55],
            [['usuario_rg'], 'string', 'max' => 12],
            [['usuario_idusuario', 'usuario_nome', 'usuario_rg'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario_idusuario' => 'idusuario', 'usuario_nome' => 'nome', 'usuario_rg' => 'rg']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idemprestimo' => Yii::t('app', 'Código do Empréstimo'),
            'usuario_nome' => Yii::t('app', 'Nome do Usuário'),
            'usuario_rg' => Yii::t('app', 'Rg do Usuário'),

            'usuario_idusuario' => Yii::t('app', 'Usuário'),
            'dataemprestimo' => Yii::t('app', 'Data do Empréstimo'),
            'dataprevisaodevolucao' => Yii::t('app', 'Data de previsão da devolução'),
            'datadevolucao' => Yii::t('app', 'Data da Devolução'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioIdusuario()
    {
        return $this->hasOne(Usuario::className(), ['idusuario' => 'usuario_idusuario', 'nome' => 'usuario_nome', 'rg' => 'usuario_rg']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmprestimoHasAcervoExemplars()
    {
        return $this->hasMany(EmprestimoHasAcervoExemplar::className(), ['emprestimo_idemprestimo' => 'idemprestimo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcervoExemplarIdacervoExemplars()
    {
        return $this->hasMany(AcervoExemplar::className(), ['idacervo_exemplar' => 'acervo_exemplar_idacervo_exemplar'])
            ->viaTable('emprestimo_has_acervo_exemplar', ['emprestimo_idemprestimo' => 'idemprestimo']);
    }

    /**
     * Retorna a quantidade de dias que um exemplar está emprestado
     */
    public function calcularDiasDeEmprestimo()
    {
        date_default_timezone_set('America/Recife');

        $this->diasDiferenca = 0;

        $dataDeEmprestimo = $this->dataemprestimo;

        if ($dataDeEmprestimo != null) {

            $dataDeEmprestimo = date('Y-m-d', strtotime($dataDeEmprestimo));

            $dataAtual = date('Y-m-d');

            $diasDiferenca = strtotime($dataAtual) - strtotime($dataDeEmprestimo);

            if ($diasDiferenca > 0) {

                $this->diasDiferenca = ($diasDiferenca / (60 * 60 * 24));
            } else {
                $this->diasDiferenca = 0;
            }
        }
    }
}
