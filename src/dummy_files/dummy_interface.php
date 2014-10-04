<?php
namespace App\Repositories\D_U_M_M_Y_NAME;

interface D_U_M_M_Y_NAMERepository{

    /**
     * Return all entities
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * Find an entity by id
     *
     * @param int $id
     * @param array|string $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getById($id, array $with = array());

    /**
     * @param $key
     * @param $value
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getFirstBy($key, $operand, $value, array $with = array());

    /**
     * Find many entities by key value
     *
     * @param string $key
     * @param string $value
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model[]
     */
    public function getAllBy($key, $operand, $value, array $with = array());

    /**
     * Get Results by Page
     *
     * @param int $page
     * @param int $limit
     * @param array|string $with
     * @return \StdClass Object with $items and $totalItems for pagination
     */
    public function getByPage($page = 1, $limit = 10, array $with = array());

    /**
     * @param array $input
     * @return static
     */
    public function create($input);

    /**
     * @return bool
     */
    public function save();

    /**
     * @param array $input
     * @param array $criteria
     * @return static|bool
     */
    public function createOrFail($input, $criteria);

    /**
     * @param array $input
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function fill($input);

    /**
     * @param $input
     * @return $this
     */
    public function fillAndSave($input);

    /**
     * @param array $input
     * @return bool
     */
    public function validate($input);

    /**
     * @param $input
     * @return $this|bool
     */
    public function validateAndCreate($input);
}