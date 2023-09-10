<?php

namespace App\Controller;

use DateTime;
use App\Entity\TweetPost;
use App\Repository\TweetPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TweetPostController extends AbstractController
{
    #[Route('/tweetposts/{limit<\d+>?3}', name: 'app_tweet_posts')]
    public function index(TweetPostRepository $tweetPosts): Response
    {
        $allTweetPosts = $tweetPosts->findAll();

        return $this->render('tweet_post/index.html.twig', [
            'allTweetPosts' => $allTweetPosts,
        ]);
    }

    #[Route('/tweetpost/{id<\d+>}', name: 'app_tweet_post')]
    public function showOne(TweetPostRepository $tweetPosts, int $id) : Response {

        $tweetPost = $tweetPosts->find($id);

        return $this->render('tweet_post/showOne.html.twig', [
            'tweetPost' => $tweetPost,
        ]);

    }

    #[Route('/tweetpost/add', name: 'app_tweet_post_add', priority: 2)]
// added priority so it doesn't get confused with other similar routes in case I use composer require sensio/framework-extra-bundle
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {   
        $tweetPostForm = new TweetPost();
        $tweetPostForm = $this->createFormBuilder($tweetPostForm)
            ->add('title')
            ->add('text')
            ->add('submit', SubmitType::class, ['label' => 'SAVE'])
            ->getForm();

        $tweetPostForm->handleRequest($request); // prepare the data from the request and match them with createFromBulder fields including validation;

        if($tweetPostForm->isSubmitted() && $tweetPostForm->isValid()) {
            
            $newTweetPost = $tweetPostForm->getData(); //get the data from the form
            $newTweetPost->setPicture('../images/picture.jpg');
            $newTweetPost->setCreated(new DateTime());
            $entityManager->persist($newTweetPost);
            $entityManager->flush();

            //add a flash message
            //redirect to a different page;
        }
        return $this->renderForm('tweet_post/add.html.twig',
                [
                    'form' => $tweetPostForm,
                ]
                );
        
        }

        #[Route('/tweetpost/remove/{id}', name: 'app_tweet_post_remove', priority: 1)]
        public function remove(EntityManagerInterface $entityManager, TweetPostRepository $tweetPosts, int $id) : Response 
        {
            $foundTweet = $tweetPosts->find($id);
            $entityManager->remove($foundTweet);
            $entityManager->flush();

        return $this->render('tweet_post/index.html.twig', [
            'allTweetPosts' => $foundTweet,
        ]);

        }

}
