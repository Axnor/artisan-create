<?php
namespace Modules\M_O_D_U_L_E_NAME;

use App\Models\D_U_M_M_Y_NAME\D_U_M_M_Y_NAMERepository as D_U_M_M_Y_NAMERepository;

class D_U_M_M_Y_NAMEController extends \BaseController {

    public function __construct(D_U_M_M_Y_NAMERepository $DU_M_M_Y_NAME_LC)
    {
        $this->DU_M_M_Y_NAME_LC = $DU_M_M_Y_NAME_LC;
    }

    /**
     * @return \Response
     */
    public function index()
    {
        return $this->DU_M_M_Y_NAME_LC->all();
    }
}