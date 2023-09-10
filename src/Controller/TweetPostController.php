<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TweetPostController extends AbstractController
{
    #[Route('/tweetposts', name: 'app_tweet_posts')]
    public function index(): Response
    {   
        return $this->render('tweet_post/index.html.twig', [
            'controller_name' => 'TweetPostController',
        ]);
    }
//parameter validation
    #[Route('/tweetpost/{id</d+>}', name: 'app_tweet_post')]
    public function showOne($id) : Response {

        $e = "it works sobof a bitch!";
        return $this->render('tweet_post/index.html.twig', [
            'someVariable' => $e
        ]);

    }


}
 