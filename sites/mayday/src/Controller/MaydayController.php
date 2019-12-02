<?php

namespace App\Controller;

use App\Entity\Mayday;
use App\Filtering\Mayday\MaydayFilterDefinitionFactory;
use App\Pagination\Mayday\MaydayPagination;
use App\Pagination\PageRequestFactory;
use App\Repository\MaydayRepository;
use App\Service\MaydayService;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use JMS\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Operation;
use Hateoas\Representation\PaginatedRepresentation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Rest\Route("/api/v1")
 *
 * Class MaydayController
 * @package App\Controller
 */
class MaydayController extends AbstractController
{
    /**
     * @Rest\View(statusCode=200)
     * @Route("/mayday", name="maydays")
     *
     *
     * @param MaydayService $maydayService
     * @param Request $request
     * @return PaginatedRepresentation
     */
    public function index(MaydayService $maydayService, Request $request)
    {
        return $maydayService->getMaydays($request);
    }

    /**
     * @Route("/mayday/{mayday}/", name="view_mayday")
     * @param Mayday $mayday
     */
    public function mayday(?Mayday $mayday)
    {
        return $mayday;
    }
}
