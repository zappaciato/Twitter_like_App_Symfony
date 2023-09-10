<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController {

    // public array $exampleArray = ['car', 'house', 'office'];
        public array $exampleArray = ['car', 'house', 'office'];
    #[Route('/1', name: 'app_index')]
    public function index () : Response {


        
        return $this->render(
            'test/index.html.twig',
            ['exampleArray' => $this->exampleArray]
        );
        // return new Response('Hi!!');

    }


}