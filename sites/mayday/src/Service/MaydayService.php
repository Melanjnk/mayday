<?php

namespace App\Service;

use App\Entity\Mayday;
use App\Repository\MaydayRepository;

/**
 * Class MaydayService
 * @package App\Service
 */
class MaydayService
{
    /** @var MaydayRepository */
    private $maydayRepo;

    /**
     * MaydayService constructor.
     * @param MaydayRepository $maydayRepo
     */
    public function __construct(MaydayRepository $maydayRepo)
    {
        $this->maydayRepo = $maydayRepo;
    }

    /**
     * @return Mayday[]
     */
    public function getMayday()
    {
        $mayday = $this->maydayRepo->findAll();

        $serializer = \JMS\Serializer\SerializerBuilder::create()
            ->setPropertyNamingStrategy(
                new \JMS\Serializer\Naming\SerializedNameAnnotationStrategy(
                    new \JMS\Serializer\Naming\CamelCaseNamingStrategy()
                )
            )
            ->build();

        return $serializer->toArray($mayday);
    }
}