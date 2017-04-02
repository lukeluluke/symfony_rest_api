<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Author;

class AuthorController extends FOSRestController
{

    const TYPE_RESPONSE_SUCCESS = 'success';
    const TYPE_RESPONSE_FAIL = 'fail';


    /**
     * @Rest\Post("/author/create")
     */
    public function createAction()
    {
        return $this->render('AppBundle:Author:create.html.php', array(
            // ...
        ));
    }

}
