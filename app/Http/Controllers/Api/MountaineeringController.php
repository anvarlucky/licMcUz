<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ForApiController;
use App\Models\Mountaineering;
use Illuminate\Http\Request;

class MountaineeringController extends ForApiController
{
    public function index1($inn=null)
    {
        return $this->responseSuccess(Mountaineering::select('id','organization_name as license_name','organization_address as address','organization_phone as phone_number',
            'organization_account_number as account_number','organization_email as e_adress','organization_inn as tin','organization_director as fio_director',
            'licence_number as license_number','licence_given_date as license_date','difficulty_category as complexity_category','license_direction as type_of_activity')
            ->where('organization_inn',$inn)->paginate(10));
    }
    public function index(Request $request)
    {
        if($request->inn)
        return $this->responseSuccess(Mountaineering::select('id as send_id','organization_name as license_name','organization_address as address','organization_phone as phone_number',
            'organization_account_number as account_number','organization_email as e_adress','organization_inn as tin','organization_director as fio_director',
            'licence_number as license_number','licence_given_date as license_date','difficulty_category as complexity_category','license_direction as type_of_activity')
            ->where('organization_inn',$request->inn)->get());
        else{
            $mountaineering = Mountaineering::select('id as send_id','organization_name as license_name','organization_address as address','organization_phone as phone_number',
                'organization_account_number as account_number','organization_email as e_adress','organization_inn as tin','organization_director as fio_director',
                'licence_number as license_number','licence_given_date as license_date','end_date as license_term','license_direction as type_of_activity')->get();
            return $this->responseSuccess($mountaineering);
            /*foreach ($mountaineering as $mount){
                $request->send_id = $mount->send_id;

            }*/
        }
    }

    public function all($sum=null,$cat)
    {
        if($sum==null)
        {
            return $this->responseSuccess(Mountaineering::select('*')->where('type_of_activity1',$cat));
        }
        return $this->responseSuccess(Mountaineering::select('*')->where('type_of_activity1',$cat)->paginate($sum));
    }
}
