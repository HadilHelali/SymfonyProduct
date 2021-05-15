<?php
namespace App\DataFixtures;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // after installing facker from fzaninotto
        $faker = factory::create();
        for ($i =0; $i<20;  $i++) {
            $product = new Product();
            $product->setCatalogue("Product$i");
            // Add to facker
            $product->setPrice($faker->numberBetween(5,500));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
