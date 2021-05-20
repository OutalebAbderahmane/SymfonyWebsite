<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Category;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create(); //generating fake data to be inserted in Our database
        
        // creating fake user names 
        $users = [];

        for ($i=0; $i<50; $i++){
            $user = new User();
            $user->setUsername('user'.$i);
            $user->setFirstname('userf'.$i);
            $user->setLastname('userf'.$i);
            $user->setEmail('user'.$i.'@gmail.com');
            $user->setPassword('user'.$i);
            $user->setCreatedAt(new \DateTime());
            $manager->persist($user);
            $users[] = $user;
        }

        // creating categories
        $categories = [];

        //for loop to insert fake categories 
        for ($i=0; $i<10; $i++){
            $category = new Category();
            $category->setTitle('category'.$i);
            $category->setDescription('Category description');
            $category->setImage($faker->imageUrl());
            $manager->persist($category);
            $categories[] = $category;
        }

        //Creating articles
        //inserting fake articles
        for ($i=0; $i < 100; $i++) { 
            $article = new Article();
            $article->setTitle('article'.$i);
            $article->setContent('Article Content');
            $article->setImage($faker->imageUrl());
            $article->setCreatedAt(new \DateTime());
            $article->addCategory($categories[$faker->numberBetween(0,9)]);
            $article->setAuthor($users[$faker->numberBetween(0,49)]);

            $manager->persist($article);

        }

        $manager->flush();
    }
}
