<?php

namespace App\DataFixtures;

use App\Entity\Apto\User;
use App\Entity\Apto\UserSettings;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public const SUPER_USER_REFERENCE = 'super-user';
    public const ADMIN_USER_REFERENCE = 'admin-user';
    public const USER_REFERENCE = 'user';

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        //create a new super admin fixture
        $suserAdmin = new User();
        $suserAdmin->setUsername('super');
        $password = $this->hasher->hashPassword($suserAdmin, 'apassword28');
        $suserAdmin->setPassword($password);
        $suserAdmin->setIsVerified(true);
        $suserAdmin->setRoles(['ROLE_SUPER_ADMIN']);

        $manager->persist($suserAdmin);

        //create a new super settings fixture
        $superSettings = new UserSettings();
        $superSettings->setUser($suserAdmin);
        $superSettings->setFirstName('Super');
        $superSettings->setLastName('Admin');
        $superSettings->setTel('555-555-5555');
        $superSettings->setEmail('super@admin.com');

        $manager->persist($superSettings);

        //create a new admin fixture
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $password = $this->hasher->hashPassword($userAdmin, 'apassword28');
        $userAdmin->setPassword($password);
        $userAdmin->setIsVerified(true);
        $userAdmin->setRoles(['ROLE_ADMIN']);

        $manager->persist($userAdmin);

        //create a new admin settings fixture
        $adminSettings = new UserSettings();
        $adminSettings->setUser($userAdmin);
        $adminSettings->setFirstName('Admin');
        $adminSettings->setLastName('Admin');
        $adminSettings->setTel('555-555-5555');
        $adminSettings->setEmail('admin@admin.com');

        $manager->persist($adminSettings);

        //create a new user fixture
        $user = new User();
        $user->setUsername('user');
        $password = $this->hasher->hashPassword($user, 'apassword28');
        $user->setPassword($password);
        $user->setIsVerified(true);

        $manager->persist($user);

        //create a new user settings fixture
        $userSettings = new UserSettings();
        $userSettings->setUser($user);
        $userSettings->setFirstName('User');
        $userSettings->setLastName('User');
        $userSettings->setTel('555-555-5555');
        $userSettings->setEmail('user@user.com');

        $manager->persist($userSettings);

        //save the fixtures
        $manager->flush();

        // other fixtures can get this object using the UserFixtures::{TheReference} constant
        $this->addReference(self::SUPER_USER_REFERENCE, $suserAdmin);
        $this->addReference(self::ADMIN_USER_REFERENCE, $userAdmin);
        $this->addReference(self::USER_REFERENCE, $user);
    }
}
