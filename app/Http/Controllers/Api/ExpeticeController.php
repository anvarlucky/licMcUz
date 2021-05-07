<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ForApiController;
use App\Models\Expertice;

class ExpeticeController extends ForApiController
{
    public function index($inn=null)
    {
        return $this->responseSuccess(Expertice::select('id','organization_name as license_name','mid as ariza_number','organization_address as address','organization_phone as phone_number',
            'organization_account_number as account_number','organization_email as e_adress','organization_inn as tin','organization_director as fio_director',
            'licence_number as license_number','licence_given_date as license_date','difficulty_category as complexity_category','license_direction as type_of_activity',
            'cause as license_edit_asos_date')->where('organization_inn',$inn)->paginate(10));
    }
    public function all($sum=null)
    {
        if($sum==null)
        {
            return $this->responseSuccess(Expertice::select('*')->get());
        }
        return $this->responseSuccess(Expertice::select('*')->paginate($sum));
    }

    public function allExpertice()
    {
        $expertice = Expertice::select('*')->get();
        return $this->responseSuccess($expertice);
    }
}
