<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
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
     * @param Request $request
     * @return array
     */
    public function createAction(Request $request)
    {
        $result = [
            'status' => $this::TYPE_RESPONSE_FAIL,
            'error' =>'',
            'data' =>[]
        ];
        $model = new Author();
        $name = $request->get('name');
        try{
            if(!empty($name))
            {
                /**
                 * Check if author name exists, only save author when there is an author name
                 */

                $model->setName($name);


                $validator = $this->get('validator');
                $errors = $validator->validate($model);

                if(count($errors)>0)
                {
                    /**
                     * If entity does not pass validation
                     */
                    $result['error'] = $errors;
                }else{
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($model);
                    $em->flush();

                    $data = [
                        'id' => $model->getId(),
                        'name' => $model->getName()
                    ];
                    $result['status'] = $this::TYPE_RESPONSE_SUCCESS;
                    $result['data'] = $data;
                }
            }else{
                $result['error'] = 'Author name is required';

            }
        }catch(Exception $e)
        {
            /**
             * Todo need to log error
             */
        }

        return $result;

    }

}
