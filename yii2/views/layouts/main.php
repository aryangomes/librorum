<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortout icon" href="<?= Url::to('@web/css/img/logotipo-librorum.png'); ?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= Url::toRoute('/site') ?>">
                <img src="<?= Url::to('@web/css/img/logotipo-librorum.png'); ?>">
            </a>
        </div>
        <!-- /.navbar-header -->


        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li>
                        <a href="<?= Url::toRoute('/site') ?>"><i class="fa fa-home  fa-fw"></i> Início</a>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute('/busca') ?>"><i class="fa fa-search fa-fw"></i> Busca no Acervo</a>

                    </li>


                    <?php
                    if (Yii::$app->user->can("admin")) {
                        ?>

                        <li>
                            <a href="#"><i class="fa fa-bolt fa-fw"></i><strong>Acesso Rápido</strong> <span
                                    class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Url::toRoute('/acervo/create') ?>">Catalogar Acervo</a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/emprestimo/create') ?>">Cadastrar Empréstimo</a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/user/admin/create') ?>">Cadastrar Usuário</a>
                                </li>

                                <li>
                                    <a href="<?= Url::toRoute('/user/admin/') ?>">Lista de Usuários</a>
                                </li>

                                <li>
                                    <a href="<?= Url::toRoute('/emprestimo/emprestimos-sem-devolucao') ?>">Empréstimos sem Devolução</a>
                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <?php
                        if (Yii::$app->user->can("admin")) {
                            ?>

                            <li>
                                <a href="<?= Url::toRoute('/emprestimo') ?>"><i
                                        class="glyphicon glyphicon-education"></i> Empréstimos</a>

                            </li>
                        <?php } ?>
                        <li>
                            <a href="#"><i class="fa fa-book fa-fw"></i> Acervo<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Url::toRoute('/acervo') ?>">Acervo</a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/acervo-exemplar') ?>">Exemplares</a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/categoria-acervo') ?>">Categoria do Acervo</a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/tipo-material') ?>">Tipo de Material</a>
                                </li>
                                <li>
                                    <a href="#">Aquisição <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">

                                        <li>
                                            <a href="<?= Url::toRoute('/aquisicao') ?>">Aquisição</a>
                                        </li>
                                        <li>
                                            <a href="<?= Url::toRoute('/tipo-aquisicao') ?>">Tipo de Aquisição</a>
                                        </li>
                                        <li>
                                            <a href="<?= Url::toRoute('/pessoa') ?>">Pessoa Aquisição</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    <?php } ?>

                    <?php
                    if (Yii::$app->user->can("admin")) {
                        ?>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i>Usuário<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Url::toRoute('/user/admin') ?>">Lista de Usuários</a>
                                </li>

                                <li>
                                    <a href="<?= Url::toRoute('/user/admin/lista-suspensos') ?>">Lista de Usuários
                                        Suspensos</a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/situacao-usuario') ?>">Situação do Usuário</a>
                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    <?php } ?>

                    <li>
                        <?php
                        if (!Yii::$app->user->isGuest) {
                            ?>
                            <a href="<?= Url::toRoute('/user/account') ?>"><i class="fa fa-user">

                                </i> Conta do Usuário</a>

                            <?php
                        }
                        ?>
                    </li>

                    <?php
                    if (Yii::$app->user->can("admin")) {
                        ?>

                        <li>
                            <a href="<?= Url::toRoute('/config') ?>"><i class="glyphicon glyphicon-cog"></i>
                                Configurações</a>

                        </li>

                        <li>
                            <a href="<?= Url::toRoute('/relatorio') ?>"><i class="glyphicon glyphicon-list-alt"></i>
                                Relatórios</a>

                        </li>
                    <?php } ?>
                    <li>
                        <a href="<?= Url::toRoute('/site/about') ?>"><i class="fa fa-info-circle fa-fw"></i> Sobre</a>
                    </li>

                    <li>
                        <?php
                        if (Yii::$app->user->isGuest) {
                            ?>
                            <a href="<?= Url::toRoute('/user/login') ?>"><i class="fa fa-sign-in fa-fw"></i>Logar</a>

                            <?php
                        } else {
                            ?>
                            <a href="<?= Url::toRoute('/user/logout') ?>" data-method='POST'><i
                                    class="fa fa-fw fa-power-off"></i> Sair</a>
                            <?php
                        }
                        ?>
                    </li>

                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <?=
        Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])
        ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">

        <p class="pull-left">&copy; Librorum <?= date('Y') ?></p>
        <div class="pull-right">

            <ul>
                Apoio:
                <li style=" display: inline-block;padding-right: 10px">
                    <a href="http://focoempresarial.com.br/" target="_blank">
                        <?= Html::img(\Yii::getAlias("@web") . '/uploads/imgs/foco_logo.png', ['width' => 70, 'class' => "img-responsive"]) ?>
                    </a>
                </li>


                <li style=" display: inline-block;">
                    <a href="http://portal.ifrn.edu.br/" target="_blank">
                        <?= Html::img(\Yii::getAlias("@web") . '/uploads/imgs/logo_ifrn.png', ['width' => 70, 'class' => "img-responsive"]) ?>
                    </a>
                </li>

            </ul>


        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
