<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class D_U_M_M_Y_NAME_UC extends Eloquent {

    use SoftDeletingTrait;
    protected $dates = ['deleted_at'];
    protected $table = "DU_M_M_Y_NAME_LCs";
    protected $guarded = array('id');
    protected $hidden = array('created_at', 'deleted_at', 'updated_at');
    protected $fillable = array();

    protected $rules = array(
        'name' => 'required',
        'password' => 'required|min:8',
        'email' => 'required|email|unique:users'
    );

}
