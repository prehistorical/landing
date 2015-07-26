<?php

namespace Prehistorical\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

use Prehistorical\Landing\Group;

class DeleteController extends Controller
{
    public function deleteGroupItem($id){
        try {

            $gritem = Group::findOrFail($id);
            $gritem->deleteGroupItem();

            return ['status'=>'OK'];

        } catch(Exception $exception) {
            return ['status'=>('Что-то пошло не так. '.$exception->getMessage())];
        }

    }
}
