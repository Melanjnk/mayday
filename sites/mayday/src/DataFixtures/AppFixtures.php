<?php

namespace App\DataFixtures;

use App\Entity\Mayday;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        // create 20 maydays! Bam!
        for ($i = 0; $i < 20; $i++) {
            $mayday = new Mayday();
            $mayday->setMessage('Mars terraformation completed phase ' . $i);
            $mayday->setSort($i);
            $mayday->setCreatedAt(new \DateTime());
            $mayday->setSource('twitter');
            $manager->persist($mayday);
        }

        $manager->flush();

    }
}
