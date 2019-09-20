<?php

namespace Modules\Membership\Repositories\Cache;

use Modules\Membership\Repositories\CommitteeRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCommitteeDecorator extends BaseCacheDecorator implements CommitteeRepository
{
    public function __construct(CommitteeRepository $committee)
    {
        parent::__construct();
        $this->entityName = 'membership.committees';
        $this->repository = $committee;
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
