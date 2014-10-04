<?php
namespace App\Repositories\D_U_M_M_Y_NAME;

use App\Repositories\AbstractEloquentRepository;
use D_U_M_M_Y_NAME;

class EloquentD_U_M_M_Y_NAMERepository extends AbstractEloquentRepository implements D_U_M_M_Y_NAMERepository {

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @var array
     */
    protected $rules;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->model = new D_U_M_M_Y_NAME();
        $this->rules = $this->model->rules;
    }
}