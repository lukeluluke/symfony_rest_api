<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Article;
use AppBundle\Entity\Author;


class ArticleController extends FOSRestController
{
    const TYPE_RESPONSE_SUCCESS = 'success';
    const TYPE_RESPONSE_FAIL = 'fail';

    /**
     * @Rest\Post("/author/create")
     */
    public function listAction()
    {
        return $this->render('AppBundle:Article:list.html.php', array(
            // ...
        ));
    }

    /**
     * @Rest\Get("/article/get/{id}")
     */
    public function getAction()
    {
        return $this->render('AppBundle:Article:get.html.php', array(
            // ...
        ));
    }

    /**
     * @Rest\Post("/article/create")
     */
    public function createAction()
    {
        return $this->render('AppBundle:Article:create.html.php', array(
            // ...
        ));
    }

    /**
     *  @Rest\Put("/article/update/{id}")
     */
    public function updateAction()
    {
        return $this->render('AppBundle:Article:update.html.php', array(
            // ...
        ));
    }

    /**
     * @Rest\Delete("/article/delete/{id}")
     */
    public function deleteAction()
    {
        return $this->render('AppBundle:Article:delete.html.php', array(
            // ...
        ));
    }

}
