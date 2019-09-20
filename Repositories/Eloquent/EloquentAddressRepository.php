<?php

namespace Modules\Membership\Repositories\Eloquent;

use Modules\Membership\Repositories\AddressRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentAddressRepository extends EloquentBaseRepository implements AddressRepository
{

    /**
     * @inheritdoc
     */
    public function find($id)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->find($id);
        }

        return $this->model->find($id);
    }

    /**
     * @inheritdoc
     */
    public function all()
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->orderBy('created_at', 'DESC')->get();
        }

        return $this->model->orderBy('created_at', 'DESC')->get();
    }


    /**
     * Standard Api Method
     * Create a iblog post
     * @param  array $data
     * @return Entity
     */
    public function create($data)
    {
        $query = $this->model->create($data);
        $query->relations()->sync(array_get($data, 'relations', []));
        event(new EntityWasCreated($query, $data));
        //$entity->setTags(array_get($data, 'tags', []));
        return $query;
    }
    /**
     * Update a resource
     * @param $entity
     * @param  array $data
     * @return mixed
     */
    public function update($entity, $data)
    {
        $entity->update($data);
        $entity->relations()->sync(array_get($data, 'relations', []));
        event(new EntityWasUpdated($entity, $data));
        //$entity->setTags(array_get($data, 'tags', []));
        return $entity;
    }
    public function destroy($model)
    {
        //$model->untag();
        event(new EntityWasDeleted($model->id, get_class($model)));
        return $model->delete();
    }
    /**
     * Standard Api Method
     * @param bool $params
     * @return mixed
     */
    public function getItemsBy($params = false)
    {
        /*-- initialize query --*/
        $query = $this->model->query();

        /*-- relationships --*/
        if (in_array('*', $params->include)) {

            $query->with(['translations']);

        } else {

            $includeDefault = ['translations'];

            if (isset($params->include)){

                $includeDefault = array_merge($includeDefault, $params->include);
            }

            $query->with($includeDefault);
        }

        /*-- filters --*/
        if (isset($params->filter)) {

            $filter = $params->filter;

            if(isset($filter->relations)){

                $relations=is_array($filter->relations)?$filter->relations:[$filter->relations];
                $query->whereHas('relations',function ($q) use($relations){
                    $q->whereIn('relation_id',$relations);
                });

            }
            if (isset($filter->search)) {

                $criterion = $filter->search;
                $param = explode(' ', $criterion);

                $query->where(function ($query) use ($param) {

                    foreach ($param as $index => $word) {
                        $query->orWhere('title', 'like', "%" . $word . "%");
                    }

                });
            }

            //Filter by date
            if (isset($filter->date)) {

                $date = $filter->date;
                $date->field = $date->field ?? 'created_at';

                if (isset($date->from))
                    $query->whereDate($date->field, '>=', $date->from);
                if (isset($date->to))
                    $query->whereDate($date->field, '<=', $date->to);
            }

            //Order by
            if (isset($filter->order)) {

                $orderByField = $filter->order->field ?? 'created_at';

                $orderWay = $filter->order->way ?? 'desc';

                $query->orderBy($orderByField, $orderWay);

            }
        }

        /*-- fields --*/
        if (isset($params->fields) && count($params->fields))
            $query->select($params->fields);

        /*-- request --*/
        if (isset($params->page) && $params->page) {

            return $query->paginate($params->take);

        } else {

            $params->take ? $query->take($params->take) : false;

            return $query->get();
        }
    }

    /**
     * Standard Api Method
     * @param $criteria
     * @param bool $params
     * @return mixed
     */
    public function getItem($criteria, $params = false)
    {
        
        $query = $this->model->query();

        /*--- relationships ---*/
        if (in_array('*', $params->include)) {
            $query->with(['translations']);
        } else {
            $includeDefault = [];
            if (isset($params->include))
                $includeDefault = array_merge($includeDefault, $params->include);
            $query->with($includeDefault);
        }

        /*--- filter ---*/
        if (isset($params->filter)) {
            $filter = $params->filter;
            if (isset($filter->field))
                $field = $filter->field;
            
            $translatedAttributes = $this->model->translatedAttributes;
           
            if (isset($field) && in_array($field, $translatedAttributes))//Filter by slug
                $query->whereHas('translations', function ($query) use ($criteria, $filter, $field) {
                    $query->where('locale', $filter->locale)
                        ->where($field, $criteria);
                });
            else
               
                $query->where($field ?? 'id', $criteria);
        }

        /*-- Fields ---*/
        if (isset($params->fields) && count($params->fields))
            $query->select($params->fields);

        /*-- Request ---*/
        return $query->first();
    }

}
