<?php

namespace App\Controller;

use App\Repository\MaydayRepository;
use App\Service\MaydayService;
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
}
