<?php

use framework\core\View;

$view = new View();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sport</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Custom CSS-->
        <?= $view->registerCss() ?>
        <!--javascript-->
        <?= $view->registerJs() ?>

    </head>
    <body>

        <section id="content">
            <div class="main">
                <?= View::getBlock('index/header')?>
                
                <?= $content ?>
            </div>
            <?= View::getBlock('site/index',['id'=>'12'])?>
        </section>

    </body>
</html>

