<?php

namespace Modules\Membership\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface ProfessionRepository extends BaseRepository
{
    /**
     * Get all the read Professions for the given filters
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getItemsBy($params);

    /**
     * Get the read Profession for the given filters
     * @param string $criteria
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getItem($criteria, $params);
}
