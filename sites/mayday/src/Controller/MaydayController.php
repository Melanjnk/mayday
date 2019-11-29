<?php

namespace App\Controller;

use App\Entity\Mayday;
use App\Repository\MaydayRepository;
use App\Service\MaydayService;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MaydayController
 * @package App\Controller
 */
class MaydayController extends AbstractController
{
    /** @var MaydayRepository */
    private $maydayRepo;

    /**
     * MaydayController constructor.
     * @param MaydayRepository $maydayRepo
     */
    public function __construct(MaydayRepository $maydayRepo)
    {
        $this->maydayRepo = $maydayRepo;
    }

    /**
     * @Route("/mayday", name="mayday")
     */
    public function index(MaydayService $maydayService)
    {
        $data = $maydayService->getMayday();

        return $this->json(['mayday' => $data]);
    }

    /**
     * @Route("/mayday/add", name="mayday_add")
     */
    public function add(EntityManagerInterface $manager){
        $mayday = new Mayday();
        $mayday->setMessage('Mars terraformation completed phase ' . 1);
        $mayday->setSort(1);
        $mayday->setCreatedAt(new \DateTime());
        $mayday->setSource('twitter');
        $manager->persist($mayday);
        $manager->flush();
    }

}
