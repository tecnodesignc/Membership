<?php

namespace Modules\Membership\Repositories\Cache;

use Modules\Membership\Repositories\ProfileRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheProfileDecorator extends BaseCacheDecorator implements ProfileRepository
{
    public function __construct(ProfileRepository $profile)
    {
        parent::__construct();
        $this->entityName = 'membership.profiles';
        $this->repository = $profile;
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
