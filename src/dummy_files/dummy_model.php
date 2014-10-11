<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class D_U_M_M_Y_NAME_UC extends Eloquent {

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
