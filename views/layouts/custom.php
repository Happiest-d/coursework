<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
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
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
    </head>
    <body>
    <?php $this->beginBody() ?>

        <header id="header">
            <div class="container">

                <div id="logo" class="pull-left">
                    <a href="/">Coursework</a>
                </div>

                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li><?= Html::a('Queries', ['/'])?></li>
                        <li><?= Html::a('Admin pannel', ['/admin/default/index'])?></li>
                        <li><?= Html::a('Users', ['/rbac/default/index'])?></li>
                        <? if(Yii::$app->user->isGuest):?>
                                <li><a href="/rbac/user/login">Login</a></li>
                        <? endif; ?>
                        <? if(!Yii::$app->user->isGuest):?>
                            <li>
                            <?=Html::beginForm(['/rbac/user/logout'], 'post')?>
                            <?=Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->username . ')',
                                ['class' => 'btn btn-link logout nav-menu-login']
                            )?>
                            <?=Html::endForm()?>
                            </li>
                        <? endif; ?>
                    </ul>
                </nav><!-- #nav-menu-container -->
            </div>
        </header><!-- #header -->

        <!--==========================
          Hero Section
        ============================-->
        <section id="hero" >
            <div class="hero-container" >
                <style>
                    .content{
                        margin-top: 50px;
                    }

                    .filter-form{
                        color: white;
                    }

                    .wrap-table{
                        color: black;
                    }

                    .wrap-table thead{
                        color:white;
                    }

                    .table tbody{
                        background: white;
                        text-align: left;
                    }
                </style>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </section><!-- #hero -->

        <!--==========================
          Footer
        ============================-->
        <footer id="footer">
            <div class="footer-top">
                <div class="container">

                </div>
            </div>

            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong>Regna</strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!--
                      All the links in the footer should remain intact.
                      You can delete the links only if you purchased the pro version.
                      Licensing information: https://bootstrapmade.com/license/
                      Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Regna
                    -->
                    Bootstrap Templates by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>
        </footer><!-- #footer -->

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>