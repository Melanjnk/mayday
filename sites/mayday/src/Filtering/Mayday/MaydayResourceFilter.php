<?php


namespace App\Filtering\Mayday;


use App\Filtering\FilterDefinitionInterface;
use App\Filtering\ResourceFilterInterface;
use App\Repository\MaydayRepository;
use Doctrine\ORM\Query\Filter\SQLFilter;

class MaydayResourceFilter implements ResourceFilterInterface
{
    /** @var MaydayRepository */
    private $maydayRepository;

    /**
     * MaydayResourceFilter constructor.
     * @param MaydayRepository $maydayRepo
     */
    public function __construct(MaydayRepository $maydayRepository)
    {
        $this->maydayRepository = $maydayRepository;
    }

    /**
     * @param FilterDefinitionInterface $filter
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQuery(FilterDefinitionInterface $filter)
    {
        $query = $this->buildQuery($filter);

        return $query;
    }

    private function buildQuery(FilterDefinitionInterface $filter)
    {
        $builder = $this->maydayRepository->createQueryBuilder('mayday');

        if ($filter->getSource()) {
            $builder->andWhere('mayday.source = :source')
                ->setParameter('source', $filter->getSource());
        }

        return $builder;
    }
}