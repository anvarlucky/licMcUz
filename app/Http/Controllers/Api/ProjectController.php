<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ForApiController;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends ForApiController
{
    public function index1($inn=null)
    {
        return $this->responseSuccess(Project::select('id','organization_name as license_name','mid as ariza_number','organization_address as address','organization_phone as phone_number',
            'organization_account_number as account_number','organization_email as e_adress','organization_inn as tin','organization_director as fio_director',
        'licence_number as license_number','licence_given_date as license_date','difficulty_category as complexity_category','license_direction as type_of_activity',
            'cause as license_edit_asos_date')->where('organization_inn',$inn)->paginate(10));
    }

    public function index(Request $request)
    {
        if($request->inn)
        return $this->responseSuccess(Project::select('id as send_id','organization_name as license_name','mid as ariza_number','organization_address as address','organization_phone as phone_number',
            'organization_account_number as account_number','organization_email as e_adress','organization_inn as tin','organization_director as fio_director',
            'licence_number as license_number','licence_given_date as license_date','difficulty_category as complexity_category','license_direction as type_of_activity',
            'cause as license_edit_asos_date','cause as license_end_asos_date')->where('organization_inn',$request->inn)->get());
        else{
            return $this->responseSuccess(Project::select('id as send_id','organization_name as license_name','mid as ariza_number','organization_address as address','organization_phone as phone_number',
                'organization_account_number as account_number','organization_email as e_adress','organization_inn as tin','organization_director as fio_director',
                'licence_number as license_number','licence_given_date as license_date','difficulty_category as complexity_category','license_direction as type_of_activity',
                'cause as license_edit_asos_date','cause as license_end_asos_date')->where('status_gnk',null)->paginate(10));
        }
    }
    public function all($sum=null)
    {
        if($sum==null)
        {
            return $this->responseSuccess(Project::select('*')->get());
        }
        return $this->responseSuccess(Project::select('*')->paginate($sum));
    }
}
