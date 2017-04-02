<?php $view->extend('::base.html.twig') ?>

<?php $view['slots']->set('title', 'AppBundle:Article:list') ?>

<?php $view['slots']->start('body') ?>
    <h1>Welcome to the Article:list page</h1>
<?php $view['slots']->stop() ?>
