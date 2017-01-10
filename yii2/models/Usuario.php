<?php

namespace app\models;

use amnah\yii2\user\models\User;
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
 * @property integer $user_id
 * @property string $foto
 * @property string $imageFile
 * @property integer $situacao_usuario_idsituacao_usuario
 *
 * @property Emprestimo[] $emprestimos
 * @property SituacaoUsuario $situacaoUsuarioIdsituacaoUsuario 
 * @property User $user
 */
class Usuario extends \yii\db\ActiveRecord {

    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nome', 'rg', 'endereco', 'telefone',  'user_id',
            'situacao_usuario_idsituacao_usuario'], 'required'],
            [['user_id', 'situacao_usuario_idsituacao_usuario'], 'integer'],
            [['nome'], 'string', 'max' => 55],
           
            [['rg'], 'string', 'max' => 12],
            [['cpf', 'telefone'], 'string', 'max' => 14],
            [['cargo', 'reparticao'], 'string', 'max' => 45],
            [['endereco'], 'string', 'max' => 200],
            [['email'], 'string', 'max' => 150],
            [['foto'], 'string', 'max' => 300],
          //  [['email'], 'email'],
             [['nome','rg'], 'unique'],
            [['situacao_usuario_idsituacao_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => SituacaoUsuario::className(), 'targetAttribute' => ['situacao_usuario_idsituacao_usuario' => 'idsituacao_usuario']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['situacaoUsuarioIdsituacaoUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => SituacaoUsuario::className(), 'targetAttribute' => ['situacao_usuario_idsituacao_usuario' => 'idsituacao_usuario']],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'idusuario' => Yii::t('app', 'Idusuario'),
            'nome' => Yii::t('app', 'Nome do Usuário'),
            'rg' => Yii::t('app', 'Rg do Usuário'),
            'cpf' => Yii::t('app', 'Cpf do Usuário'),
            'cargo' => Yii::t('app', 'Cargo do Usuário'),
            'reparticao' => Yii::t('app', 'Repartição do Usuário'),
            'endereco' => Yii::t('app', 'Endereço do Usuário'),
            'telefone' => Yii::t('app', 'Telefone do Usuário'),
            'email' => Yii::t('app', 'Email do Usuário'),
            'user_id' => Yii::t('app', 'User ID'),
            'imageFile' => Yii::t('app', 'Foto do Usuário'),
            'situacaoUsuarioIdsituacaoUsuario' => yii::t('app', 'Situação Do Usuário'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmprestimos() {
        return $this->hasMany(Emprestimo::className(), ['usuario_idusuario' => 'idusuario', 'usuario_nome' => 'nome', 'usuario_rg' => 'rg']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getSituacaoUsuarioIdsituacaoUsuario() {
        return $this->hasOne(SituacaoUsuario::className(), ['idsituacao_usuario' => 'situacao_usuario_idsituacao_usuario']);
    }

    public function upload($nomeUsuario) {

        if ($this->imageFile != null) {
            $this->imageFile->saveAs($this->getPathLocal($nomeUsuario));
            return true;
        } else {
            return false;
        }
    }

    public function getPathWeb($nomeUsuario) {

        $nomeUsuario = strtolower(preg_replace('/\s+/', '', $nomeUsuario));
        return \Yii::getAlias("@web") . '/uploads/imgs/fotos-usuarios/' . $this->imageFile->baseName . $nomeUsuario . '.' . $this->imageFile->extension;
    }

    public function getPathLocal($nomeUsuario) {
        $nomeUsuario = strtolower(preg_replace('/\s+/', '', $nomeUsuario));
        return \Yii::getAlias("@webroot") . '/uploads/imgs/fotos-usuarios/' . $this->imageFile->baseName . $nomeUsuario . '.' . $this->imageFile->extension;
    }

    public function deleteFoto() {
        $path = \Yii::getAlias("@webroot") . substr($this->foto, strpos($this->foto, '/uploads/'));

        if (file_exists($path)) {
            @unlink($path);
        }
    }

    public function verificarPodeEmprestar() {
        $situacaoUsuario = SituacaoUsuario::findOne($this->situacao_usuario_idsituacao_usuario);
        if ($situacaoUsuario != null) {
            return $situacaoUsuario->pode_emprestar;
        }
    }

}
