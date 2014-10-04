<?php
namespace App\Repositories;

use Validator;

/**
 * Class AbstractEloquentRepository
 * @package \Illuminate\Database\
 */
abstract class AbstractEloquentRepository {

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @var array
     */
    protected $rules=array();

    /**
     * Make a new instance of the entity to query on
     *
     * @param array|string $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function make(array $with = array())
    {
        return $this->model->with($with);
    }
    /**
     * Return all entities
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }
    /**
     * Find an entity by id
     *
     * @param int $id
     * @param array|string $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getById($id, array $with = array())
    {
        if(!empty($with))
        {
            $query = $this->make($with);
            return $query->find($id);
        }
        else {
            return $this->model->find($id);
        }
    }
    /**
     * Find many entities by key value
     *
     * @param string $key
     * @param string $operand
     * @param string $value
     * @param array|string $with
     * @return \Illuminate\Database\Eloquent\Model[]
     */
    public function getAllBy($key, $operand, $value, array $with = array())
    {
        if(!empty($with))
        {
            return $this->make($with)->where($key, $operand, $value)->get();
        }
        else
        {
            return $this->model->where($key, $operand, $value)->get();
        }

    }
    /**
     * Find a single entity by key value
     *
     * @param string $key
     * @param string $operand
     * @param string $value
     * @param array|string $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getFirstBy($key, $operand, $value, array $with = array())
    {
        if(!empty($with))
        {
            return $this->make($with)->where($key, $operand, $value)->first();
        }
        else
        {
            return $this->model->where($key, $operand, $value)->first();
        }

    }
    /**
     * Get Results by Page
     *
     * @param int $page
     * @param int $limit
     * @param array|string $with
     * @return \StdClass Object with $items and $totalItems for pagination
     */
    public function getByPage($page = 1, $limit = 10, array $with = array())
    {
        $result             = new StdClass;
        $result->page       = $page;
        $result->limit      = $limit;
        $result->totalItems = 0;
        $result->items      = array();
        $query = $this->make($with);
        $model = $query->skip($limit * ($page - 1))
            ->take($limit)
            ->get();
        $result->totalItems = $this->model->count();
        $result->items      = $model->all();
        return $result;
    }

    /**
     * @param array $input
     * @return static
     */
    public function create($input)
    {
        return $this->model->create($input);
    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->model->save();
    }

    /**
     * @param array $input
     * @param array $criteria
     * @return static|bool
     */
    public function createOrFail($input, $criteria)
    {
        $object = $this->model->where($criteria)->get();

        if($object->isEmpty())
        {
            return $this->create($input);
        }
        else
        {
            return false;
        }
    }

    /**
     * @param array $input
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function fill($input)
    {
        return $this->model->fill($input);
    }

    /**
     * @param $input
     * @return $this
     */
    public function fillAndSave($input)
    {
        $this->fill($input);
        return $this->save();
    }

    /**
     * @param array $input
     * @return bool
     */
    public function validate($input)
    {
        $validator = Validator::make($input, $this->rules);
        if($validator->fails())
        {
            return $validator->messages();
        }
        else
        {
            return true;
        }
    }

    /**
     * @param $input
     * @return bool|array
     */
    public function validateAndCreate($input)
    {
        $messages = $this->validate($input);
        if($messages===true)
        {
            $this->create($input);
            return true;
        }
        else{
            return $messages;
        }
    }


}