<?php

namespace App\Controller;

use App\Repository\TweetPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TweetPostController extends AbstractController
{
    #[Route('/tweetposts/{limit</d+>?3}', name: 'app_tweet_posts')]
    public function index(TweetPostRepository $tweetPosts): Response
    {
        $allTweetPosts = $tweetPosts->findAll();

        return $this->render('tweet_post/index.html.twig', [
            'allTweetPosts' => $allTweetPosts,
        ]);
    }

    #[Route('/tweetpost/{id}', name: 'app_tweet_post')]
    public function showOne(TweetPostRepository $tweetPosts, int $id) : Response {

        $tweetPost = $tweetPosts->find($id);

        return $this->render('tweet_post/showOne.html.twig', [
            'tweetPost' => $tweetPost,
        ]);

    }

}
