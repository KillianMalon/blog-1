<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Contact extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $contact = new \App\Entity\Contact();
        $contact->setName('Malon');
        $contact->setFirstname('Killian');
        $contact->setAge('19');
        $contact->setNewsletter(true);
        $manager->persist($contact);
        $manager->flush();

    }
}
