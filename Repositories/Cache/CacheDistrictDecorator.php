<?php

namespace Modules\Membership\Repositories\Cache;

use Modules\Membership\Repositories\DistrictRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheDistrictDecorator extends BaseCacheDecorator implements DistrictRepository
{
    public function __construct(DistrictRepository $district)
    {
        parent::__construct();
        $this->entityName = 'membership.districts';
        $this->repository = $district;
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
