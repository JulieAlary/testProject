<?php
/**
 * By: Julie
 */

namespace App\Controller;

use App\Document\Post;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ODM\MongoDB\MongoDBException;

class PostController extends AbstractController
{
    /**
     * @param DocumentManager $dm
     * @return JsonResponse
     * @throws MongoDBException
     * @Route("/mongoTest", name="add")
     */
    public function create(DocumentManager $dm)
    {
        $post = new Post();
        $post->setTitle('Display');
        $post->setContent('Interactive');

        $dm->persist($post);
        $dm->flush();

        return new JsonResponse(array('Status' => 'OK', 'id' => $post->getId()));
    }

    /**
     * @param DocumentManager $dm
     * @return Response
     *  @Route("/posted/data", name="list_post")
     */
    public function list(DocumentManager $dm)
    {

        $posts = $dm->getRepository(Post::class)->findAll();

        return $this->render('post/list.html.twig', [
            'posts' => $posts
        ]);
    }
}
