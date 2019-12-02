<?php

namespace App\Service;

use App\Entity\Mayday;
use App\Filtering\Mayday\MaydayFilterDefinitionFactory;
use App\Pagination\Mayday\MaydayPagination;
use App\Pagination\PageRequestFactory;
use App\Repository\MaydayRepository;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MaydayService
 * @package App\Service
 */
class MaydayService
{
    /** @var MaydayRepository */
    private $maydayRepo;

    /**
     * @var MaydayPagination
     */
    private $maydayPagination;

    /**
     * MaydayService constructor.
     * @param MaydayRepository $maydayRepo
     */
    public function __construct(MaydayRepository $maydayRepo, MaydayPagination $maydayPagination)
    {
        $this->maydayRepo = $maydayRepo;
        $this->maydayPagination = $maydayPagination;
    }

    public function getMaydays(?Request $request)
    {
        $pageFromRequest = new PageRequestFactory();
        $page = $pageFromRequest->fromRequest($request);

        $maydayFilterDefinitionFactory = new MaydayFilterDefinitionFactory();
        $maydayFilterDefinition = $maydayFilterDefinitionFactory->factory($request);


        return $this->maydayPagination->paginate($page, $maydayFilterDefinition);
    }
}