<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class D_U_M_M_Y_NAME_UC extends Eloquent {

    /**
     * Rules used for validation. Accessed by D_U_M_M_Y_NAME_UC::$rules['ruleName']
     * @var array
     */
    public static $rules = array(
        'create' => [],
        'update' => [],
    );

    use SoftDeletingTrait;
    protected $dates    = ['deleted_at'];
    protected $table    = "DU_M_M_Y_NAME_LCs";
    protected $guarded  = ['id'];
    protected $hidden   = ['created_at', 'deleted_at', 'updated_at'];
    protected $fillable = [];

    protected $rules = [
//        'email'    => 'required|email|unique:users'
    ];

}
