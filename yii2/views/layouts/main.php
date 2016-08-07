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
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div id="wrapper">
            <?php
            /*  NavBar::begin([
              'brandLabel' => 'Librorum',
              'brandUrl' => Yii::$app->homeUrl,
              'options' => [
              'class' => 'navbar-inverse navbar-fixed-top',
              ],
              ]);
              echo Nav::widget([
              'options' => ['class' => 'navbar-nav navbar-right'],
              'items' => [

              ['label' => 'Busca no Acervo', 'url' => ['/busca']],
              Yii::$app->user->can("admin") ? ['label' => 'Acervo', 'items' => [
              ['label' => 'Acervo', 'url' => ['/acervo']],
              ['label' => 'Exemplares', 'url' => ['/acervo-exemplar']],
              ['label' => 'Categoria do Acervo', 'url' => ['/categoria-acervo']],
              ['label' => 'Tipo de Material', 'url' => ['/tipo-material']],
              '<li class="divider"></li>',
              ['label' => 'Aquisição', 'url' => ['/aquisicao']],
              ['label' => 'Tipo de Aquisição', 'url' => ['/tipo-aquisicao']],
              ['label' => 'Pessoa Aquisição', 'url' => ['/pessoa']],
              ]
              ] : '',
              /*   Yii::$app->user->can("admin") ?    ['label'=>'Aquisição', 'items' => [
              ['label' => 'Aquisição', 'url' => ['/aquisicao']],
              ['label' => 'Tipo de Aquisição', 'url' => ['/tipo-aquisicao']],
              ['label' => 'Pessoa', 'url' => ['/pessoa']],

              ]
              ]   : '',
              Yii::$app->user->can("admin") ? ['label' => 'Empréstimo', 'url' => ['/emprestimo']] : '',
              Yii::$app->user->can("admin") ?
              ['label' => 'Usuário', 'items' => [
              ['label' => 'Usuário', 'url' => ['/user/admin']],
              ['label' => 'Situação do Usuário', 'url' => ['/situacao-usuario']],
              ]
              ] : '',

              Yii::$app->user->can("admin") ? ['label' => 'Configurações', 'url' => ['/config/']] : '',
              ['label' => 'Sobre', 'url' => ['/site/about']],
              Yii::$app->user->isGuest ?
              ['label' => 'Login', 'url' => ['/user/login']] :
              [
              'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
              'url' => ['/user/logout'],
              'linkOptions' => ['data-method' => 'post']
              ],
              ],
              ]);
              NavBar::end(); */
            ?>



            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= Url::toRoute('/site') ?>">Librorum</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">

                            <li>
                                <?php
                                if (Yii::$app->user->isGuest) {
                                    ?>
                                    <a href="<?= Url::toRoute('/user/login') ?>"><i class="fa fa-bar-chart-o fa-fw"></i>Logar</a>

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
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">

                            <li>
                                <a href="<?= Url::toRoute('/site') ?>"><i class="fa fa-dashboard fa-fw"></i> Início</a>
                            </li>
                            <li>
                                <a href="<?= Url::toRoute('/busca') ?>"><i class="fa fa-bar-chart-o fa-fw"></i> Busca no Acervo</a>

                            </li>


                               <?php 
                               if(  Yii::$app->user->can("admin")){
                                   
                               
                               ?>
                            <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Acervo<span class="fa arrow"></span></a>
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
                               if(  Yii::$app->user->can("admin")){
                                   
                               
                               ?>
                            <li>
                                <a href="#"><i class="fa fa-wrench fa-fw"></i>Usuário<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?= Url::toRoute('/user/admin') ?>">Usuário</a>
                                    </li>
                                    <li>
                                        <a href="<?= Url::toRoute('/situacao-usuario') ?>">Situação do Usuário</a>
                                    </li>

                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                              <?php } ?>
                            <li>
                                <a href="<?= Url::toRoute('/site/about') ?>"><i class="fa fa-table fa-fw"></i> Sobre</a>
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
