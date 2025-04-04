<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Role;
use App\Enum\Entity\RoleEnum;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher,
    ) {
    }

    public function load(ObjectManager $manager): void
    {

        // 1 Role 
        $adminRole = new Role();
        $adminRole
            ->setCode(RoleEnum::ADMIN->value)
            ->setLabel('Admin');
        $manager->persist($adminRole);

        $userRole = new Role();
        $userRole
            ->setCode(RoleEnum::USER->value)
            ->setLabel('User');
        $manager->persist($userRole);


        // 2. User
        $admin = new User();
        $admin
            ->setName('Raph')
            ->setEmail('raphael.danjard@hotmail.com')
            ->setRole($adminRole)
            ->setPassword(
                $this->userPasswordHasher->hashPassword(
                    user: $admin, plainPassword:'azerty'
                    )
                );
        $manager->persist($admin);
        
        
        // 3. Go
        $manager->flush();
    }

}