<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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

        <div class="wrap">
            <?php
            NavBar::begin([
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
                      ]   : '', */
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
            NavBar::end();
            ?>

            <div class="container">
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
