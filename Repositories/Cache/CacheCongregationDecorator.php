<?php

namespace Modules\Membership\Repositories\Cache;

use Modules\Membership\Repositories\CongregationRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCongregationDecorator extends BaseCacheDecorator implements CongregationRepository
{
    public function __construct(CongregationRepository $congregation)
    {
        parent::__construct();
        $this->entityName = 'membership.congregations';
        $this->repository = $congregation;
    }

    public function getItemsBy($params)
    {
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember(
                "{$this->locale}.{$this->entityName}.getItemBy",
                $this->cacheTime,
                function () use ($params) {
                    return $this->repository->getItemsBy($params);
                }
            );
    }

    /**
     * Get the read notification for the given filters
     * @param string $criteria
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getItem($criteria, $params)
    {
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember(
                "{$this->locale}.{$this->entityName}.getItem",
                $this->cacheTime,
                function () use ($criteria, $params) {
                    return $this->repository->getItem($criteria, $params);
                }
            );
    }

}
