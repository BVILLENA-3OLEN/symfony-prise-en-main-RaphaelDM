<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Post;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $facker = \Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post
                ->setTitle($facker->realTextBetween(10, 50))
                ->setAuthor($facker->name())
                ->setContent($facker->realText())
                ->setPublishedAt(\DateTimeImmutable::createFromMutable($facker->dateTimeBetween('-20 days', '+5 days')));
            $manager->persist($post);
        }
        $manager->flush();
    }
}
