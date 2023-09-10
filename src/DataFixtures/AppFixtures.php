<?php

namespace App\DataFixtures;

use App\Entity\TweetPost;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        
        $tweetPost1 = new TweetPost();
        $tweetPost1->setTitle('Tweet Post Title First!');
        $tweetPost1->setText('This is the text of the TweetPost. It is a bit longer as it is the contect. Goodbye!');
        $tweetPost1->setPicture('./images/picture.jpg');
        $tweetPost1->setCreated(new DateTime());
        $manager->persist($tweetPost1);

        $tweetPost2 = new TweetPost();
        $tweetPost2->setTitle('Tweet Post Title Secont One!!');
        $tweetPost2->setText('This is the text of the Second One TweetPost. It is super long as it is the contect. See ya!');
        $tweetPost2->setPicture('./images/picture2.jpg');
        $tweetPost2->setCreated(new DateTime());
        $manager->persist($tweetPost2);

        $manager->flush();
    }
}
