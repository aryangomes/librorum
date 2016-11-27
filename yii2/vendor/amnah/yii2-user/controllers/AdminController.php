<?php

namespace amnah\yii2\user\controllers;

use app\models\Usuario;
use Yii;
use amnah\yii2\user\models\User;
use amnah\yii2\user\models\UserToken;
use amnah\yii2\user\models\UserAuth;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use app\models\SituacaoUsuario;
use yii\db\Query;
use app\components\AccessFilter;

/**
 * AdminController implements the CRUD actions for User model.
 */
class AdminController extends Controller {

    /**
     * @var \amnah\yii2\user\Module
     * @inheritdoc
     */
    public $module;

    /**
     * @inheritdoc
     */
    public function init() {
        // check for admin permission (`tbl_role.can_admin`)
        // note: check for Yii::$app->user first because it doesn't exist in console commands (throws exception)
        if (!empty(Yii::$app->user) && !Yii::$app->user->can("admin")) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'autorizacao' => [
                'class' => AccessFilter::className(),
                'actions' => [

                    'index' => 'usuario',
                    'update' => 'usuario',
                    'delete' => 'usuario',
                    'create' => 'usuario',
                    'view' => 'usuario',
                    'lista-situacao' => 'usuario',
                    'resetar-senha' => 'usuario',
                    'create-ajax' => 'usuario',
                    'verifica-nome' => 'usuario',
                    'verifica-rg' => 'usuario',
                    'verifica-cpf' => 'usuario',
                ],
            ],
        ];
    }

    /**
     * List all User models
     * @return mixed
     */
    public function actionIndex() {
        /** @var \amnah\yii2\user\models\search\UserSearch $searchModel */
        $searchModel = $this->module->model("UserSearch");
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Display a single User model
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'user' => $this->findModel($id),
        ]);
    }

    /**
     * Create a new User model. If creation is successful, the browser will
     * be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        /** @var \amnah\yii2\user\models\User $user */
        /** @var \amnah\yii2\user\models\Profile $profile */
        $usuario = new Usuario();
        $user = $this->module->model("User");
        $user->setScenario("admin");
        $profile = $this->module->model("Profile");
        $user->role_id = 2;
        $user->status = 1;
        $post = Yii::$app->request->post();
        $userLoaded = $user->load($post);
        $profile->load($post);

        $mensagemSucesso = "Usuário cadastrado com sucesso";

        // validate for ajax request
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($user, $profile);
        }

        if ($userLoaded && $user->validate() && $profile->validate()) {

            $user->username = $post['Usuario']['nome'];
            $user->email = $post['Usuario']['rg'];
            $user->save(false);
            $profile->setUser($user->id)->save(false);

            if ($user->role_id == 1) {
                Yii::$app->db->createCommand(
                        "INSERT INTO auth_assignment
            (item_name, user_id ) 
            VALUES (:item, :iduser)", [
                    ':item' => 'admin',
                    ':iduser' => $user->id,
                ])->execute();
            }

            $usuario->nome = $post['Usuario']['nome'];
            $usuario->rg = $post['Usuario']['rg'];
            $usuario->cpf = $post['Usuario']['cpf'];
            $usuario->cargo = $post['Usuario']['cargo'];
            $usuario->reparticao = $post['Usuario']['reparticao'];
            $usuario->endereco = $post['Usuario']['endereco'];
            $usuario->telefone = $post['Usuario']['telefone'];
            $usuario->email = $post['Usuario']['email'];
            $usuario->situacao_usuario_idsituacao_usuario = $post['Usuario']['situacaoUsuarioIdsituacaoUsuario'];
            $usuario->user_id = $user->id;
            $usuario->imageFile = UploadedFile::getInstanceByName('Usuario[imageFile]');
            if ($usuario->imageFile != null) {

                $usuario->foto = $usuario->getPathWeb($usuario->nome);
            }


            if ($usuario->save()) {
                $usuario->upload($usuario->nome);
//                return $this->redirect(['view', 'id' => $user->id]);
                Yii::$app->session->setFlash('mensagemSucesso',$mensagemSucesso);
                return $this->redirect('create');
            }
        }

        // render
        return $this->render('create', compact('user', 'profile', 'usuario'));
    }

    /**
     * Update an existing User model. If update is successful, the browser
     * will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        // set up user and profile

        $user = $this->findModel($id);
        $user->setScenario("admin");
        $profile = $user->profile;

        $usuario = Usuario::find()->where(['user_id' => $id])->one();

        $post = Yii::$app->request->post();
        $userLoaded = $user->load($post);
        $profile->load($post);

        // validate for ajax request
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($user, $profile);
        }

        // load post data and validate
        if ($userLoaded && $user->validate() && $profile->validate()) {
            $user->username = $post['Usuario']['nome'];
            $user->email = $post['Usuario']['rg'];
            $user->save(false);
            $profile->setUser($user->id)->save(false);

            if ($usuario != null) {
                $usuario->nome = $post['Usuario']['nome'];
                $usuario->rg = $post['Usuario']['rg'];
                $usuario->cpf = $post['Usuario']['cpf'];
                $usuario->cargo = $post['Usuario']['cargo'];
                $usuario->reparticao = $post['Usuario']['reparticao'];
                $usuario->endereco = $post['Usuario']['endereco'];
                $usuario->telefone = $post['Usuario']['telefone'];
                $usuario->email = $post['Usuario']['email'];
                $usuario->situacao_usuario_idsituacao_usuario = $post['Usuario']['situacaoUsuarioIdsituacaoUsuario'];
                $usuario->imageFile = UploadedFile::getInstanceByName('Usuario[imageFile]');
                if ($usuario->imageFile != null) {
                    $usuario->deleteFoto();
                    $usuario->foto = $usuario->getPathWeb($usuario->nome);
                }


                if ($usuario->save()) {
                    $usuario->upload($usuario->nome);
                    return $this->redirect(['view', 'id' => $user->id]);
//                return $this->redirect(['/usuario/view', 'idusuario' => $usuario->idusuario, 'nome' => $usuario->nome, 'rg' => $usuario->rg]);
                }
            }
        }

        // render
        return $this->render('update', compact('user', 'profile', 'usuario'));
    }

    /**
     * Delete an existing User model. If deletion is successful, the browser
     * will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {

        $usuario = Usuario::find()->where(['user_id' => $id])->one();
        if ($usuario != null) {
            $usuario->deleteFoto();
        }
        // delete profile and userTokens first to handle foreign key constraint
        $user = $this->findModel($id);
        $profile = $user->profile;
        UserToken::deleteAll(['user_id' => $user->id]);
        UserAuth::deleteAll(['user_id' => $user->id]);
        $profile->delete();
        $user->delete();

        return $this->redirect(['index']);
    }

    public function actionListaSituacao($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('idsituacao_usuario AS id, situacao AS text')
                    ->from('situacao_usuario')
                    ->where(['like', 'situacao', $q])
                    ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => SituacaoUsuario::find($id)->situacao];
        }
        return $out;
    }

    /**
     * Find the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        /** @var \amnah\yii2\user\models\User $user */
        $user = $this->module->model("User");
        $user = $user::findOne($id);
        if ($user) {
            return $user;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionResetarSenha($id, $novaSenha) {
        $user = $this->findModel($id);
        if ($user != null) {
            $user->newPassword = $novaSenha;
            if ($user->save(false)) {
                echo Json::encode(true);
            } else {
                echo Json::encode(false);
            }
        } else {
            echo Json::encode(false);
        }
    }

    public function actionCreateAjax($nome, $rg, $cpf, $telefone, $email, $cargo, $reparticao, $endereco, $situacaousuario, $password) {
        /** @var \amnah\yii2\user\models\User $user */
        /** @var \amnah\yii2\user\models\Profile $profile */
        $usuario = new Usuario();
        $user = $this->module->model("User");
        $user->setScenario("admin");
        $profile = $this->module->model("Profile");
        $user->password = $password;
        $user->role_id = 2;
        $user->status = 1;


        if ($user->validate()) {
            $user->username = $nome;
            $user->email = $rg;
            $user->save(false);
            $profile->setUser($user->id)->save(false);

            $usuario->nome = $nome;
            $usuario->rg = $rg;
            $usuario->cpf = $cpf;
            $usuario->cargo = $cargo;
            $usuario->reparticao = $reparticao;
            $usuario->endereco = $endereco;
            $usuario->telefone = $telefone;
            $usuario->email = $email;
            $usuario->situacao_usuario_idsituacao_usuario = $situacaousuario;
            $usuario->user_id = $user->id;
            if ($usuario->save(false)) {
                $usuarioCadastrado = [$rg, $nome, $cpf, $cargo, $reparticao,
                    $usuario->idusuario, $usuario->user_id];
                echo Json::encode($usuarioCadastrado);
            } else {
                echo Json::encode(false);
            }
        } else {
            echo Json::encode(false);
        }
    }

    public function actionVerificaNome($nome) {
        $usuario = Usuario::find()->where(['nome' => $nome])->one();
        if ($usuario == null) {
            echo Json::encode(true);
        } else {
            echo Json::encode(false);
        }
    }

    public function actionVerificaRg($rg) {
        $usuario = Usuario::find()->where(['rg' => $rg])->one();
        if ($usuario == null) {
            echo Json::encode(true);
        } else {
            echo Json::encode(false);
        }
    }

    public function actionVerificaCpf($cpf) {
        $usuario = Usuario::find()->where(['cpf' => $cpf])->one();
        if ($usuario == null) {
            echo Json::encode(true);
        } else {
            echo Json::encode(false);
        }
    }

    /* public function actionUploadAjax($nomeUsuario) {
      $usuario = new Usuario();
      $usuario->imageFile = UploadedFile::getInstanceByName('Usuario[imageFile]');
      if ($usuario->imageFile != null) {

      $usuario->foto = $usuario->getPathWeb($nomeUsuario);
      if ($usuario->save()) {
      $usuario->upload($usuario->nome);
      return $this->redirect(['view', 'id' => $user->id]);
      //                return $this->redirect(['/usuario/view', 'idusuario' => $usuario->idusuario, 'nome' => $usuario->nome, 'rg' => $usuario->rg]);
      }
      echo Json::encode(true);
      }   else{
      echo Json::encode(false);
      }
      } */
}
