<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Comments;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        //Creation de 3 catégories via faker 
        for ($i=1; $i < 3; $i++) 
        { 
           $category = new Category;
           $category->setTitle($faker->sentence()); 
           
           $manager->persist($category);
           
           // Creation de 3 user random    
           for ($j=1; $j <3 ; $j++) 
           { 
               $user = new User;
               $user -> setEMAIL($faker->email())
                     -> setUSERNAME($faker-> name())
                     -> setPASSWORD($faker -> password());

               $manager->persist($user);


                //création entre 4 et 6 produit par catégories 
                for ($k=1; $k <=mt_rand(4,6) ; $k++) 
                { 
                    $product = new Product;
                    $content = '<p>'.join('</p><p>', $faker->paragraphs(5)).'</p';

                    $product->setNAME($faker->sentence())
                            ->setDESCRIPTION($content)
                            ->setIMAGE($faker->imageUrl())
                            ->setPRICE($faker->randomFloat())
                            ->setCategoryId($category)
                            ->setUserId($user);
                    
                    $manager->persist($product);

                }
           }
        }
        $manager->flush();
    
    }
}
