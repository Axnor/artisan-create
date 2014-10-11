<?php
namespace Repositories\D_U_M_M_Y_NAME;

use App\Repositories\AbstractEloquentRepository;
use D_U_M_M_Y_NAME;

class EloquentD_U_M_M_Y_NAMERepository extends AbstractEloquentRepository implements D_U_M_M_Y_NAMERepository {

    /**
     * Constructor
     */
    public function __construct(D_U_M_M_Y_NAME $model)
    {
        $this->model = $model;
    }
}