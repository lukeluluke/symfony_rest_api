<?php $view->extend('::base.html.twig') ?>

<?php $view['slots']->set('title', 'AppBundle:Article:get') ?>

<?php $view['slots']->start('body') ?>
    <h1>Welcome to the Article:get page</h1>
<?php $view['slots']->stop() ?>
