<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
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
     * @Rest\Get("/article/list")
     */
    public function listAction()
    {
        $result = [
            'status' => $this::TYPE_RESPONSE_FAIL,
            'error' => '',
            'data' => []
        ];

        try{


            $manager = $this->getDoctrine()->getManager();
            $articles = $manager->getRepository('AppBundle:Article')->getArticleWithAuthorName();

            $result['status'] = $this::TYPE_RESPONSE_SUCCESS;
            $result['data'] = $articles;
        }catch(Exception $e)
        {
            $result['status'] = $this::TYPE_RESPONSE_FAIL;
            $result['error'] = 'Service not available';
        }

        return $result;
    }

    /**
     * @Rest\Get("/article/get/{id}")
     */
    public function getAction($id)
    {
        $result = [
            'status' => $this::TYPE_RESPONSE_FAIL,
            'error' => '',
            'data' => []
        ];

        try{
            $manager = $this->getDoctrine()->getManager();
            $article = $manager->getRepository('AppBundle:Article')->getArticleWithAuthorName($id);

            if($article)
            {
                $result['status'] = $this::TYPE_RESPONSE_SUCCESS;
                $result['data']  = $article;
            }else{
                $result['error'] = 'No article found';
            }
        }catch(Exception $e)
        {
            $result['status'] = $this::TYPE_RESPONSE_FAIL;
            $result['error'] = 'Service not available';
        }

        return $result;

    }

    /**
     * @Rest\Post("/article/create")
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

        $model = new Article();

        $author_id = $request->get('author_id');
        $title = $request->get('title');
        $url = $request->get('url');
        $content = $request->get('content');

        try{
            if(!empty($author_id))
            {
                /**
                 * Check if author_id exists, only save article when there is a author_id
                 */
                $author = $this->getDoctrine()
                    ->getRepository('AppBundle:Author')
                    ->find($author_id);

                if($author)
                {
                    /**
                     * Only save article when there is author
                     */

                    $model->setTitle($title);
                    $model->setAuthorId($author_id);
                    $model->setContent($content);
                    $model->setUrl($url);
                    $model->setCreatedAt(new \DateTime('now'));
                    $model->setUpdatedAt(new \DateTime('now'));
                    $model->setAuthor($author);

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
                            'title' => $model->getTitle(),
                            'author' => $author->getName(),
                            'summary' => $model->getContent(),
                            'url' => $model->getUrl(),
                            'createdAt' => $model->getCreatedAt()
                        ];
                        $result['status'] = $this::TYPE_RESPONSE_SUCCESS;
                        $result['data'] = $data;
                    }


                }else{
                    $result['error'] = 'No author found';
                }
            }else{
                $result['error'] = 'No author id found';
            }
        }catch(Exception $e)
        {
            /**
             * Todo need to log error
             */
            $result['status'] = $this::TYPE_RESPONSE_FAIL;
            $result['error'] = 'Service not available';
        }

        return $result;
    }

    /**
     * @Rest\Put("/article/update/{id}")
     * @param $id
     * @param Request $request
     * @return array
     */
    public function updateAction($id,Request $request)
    {
        $result = [
            'status' => $this::TYPE_RESPONSE_FAIL,
            'error' =>''
        ];


        try{
            $author_id = $request->get('author_id');
            $title = $request->get('title');
            $content = $request->get('content');
            $url = $request->get('url');


            $model = $this->getDoctrine()->getRepository('AppBundle:Article')->find($id);

            if($model)
            {


                if(!empty($author_id))
                {
                    $model->setAuthorId($author_id);
                }

                if(!empty($title))
                {
                    $model->setTitle($title);
                }
                if(!empty($content))
                {
                    $model->setContent($content);
                }
                if(!empty($url))
                {
                    $model->setUrl($url);
                }


                $validator = $this->get('validator');
                $errors = $validator->validate($model);

                $author = $this->getDoctrine()->getRepository('AppBundle:Author')->find($model->getAuthorId());
                if(count($errors)>0)
                {
                    /**
                     * If entity does not pass validation
                     */
                    $result['error'] = $errors;

                }elseif(!$author)
                {
                    $result['error'] = 'Author not found';
                }
                else{
                    $em = $this->getDoctrine()->getManager();
                    $em->flush();

                    $data = [
                        'title' => $model->getTitle(),
                        'summary' => $model->getContent(),
                        'url' => $model->getUrl(),
                        'createdAt' => $model->getCreatedAt()
                    ];
                    $result['status'] = $this::TYPE_RESPONSE_SUCCESS;
                    $result['data'] = $data;
                }

            }else{
                $result['error'] = 'No Article found';
            }
        }catch(Exception $e)
        {
            $result['status'] = $this::TYPE_RESPONSE_FAIL;
            $result['error'] = 'Service not available';
        }


        return $result;
    }

    /**
     * @Rest\Delete("/article/delete/{id}")
     */
    public function deleteAction($id)
    {
        $result = [
            'status' => $this::TYPE_RESPONSE_FAIL,
            'error' => '',
            'data' => []
        ];

        try{
            $em = $this->getDoctrine()->getManager();
            $article = $em->getRepository('AppBundle:Article')->find($id);

            if($article)
            {
                $em->remove($article);
                $em->flush();
                $result['status'] = $this::TYPE_RESPONSE_SUCCESS;

            }else{
                $result['error'] = 'No article found';
            }
        }catch(Exception $e)
        {
            $result['status'] = $this::TYPE_RESPONSE_FAIL;
            $result['error'] = 'Service not available';
        }

        return $result;

    }

}
