<?php

namespace Prehistorical\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class DeleteController extends Controller
{
    public function deleteGroupItem() {

        try {

            return ['status'=>'OK'];

        } catch(Exception $exception) {

            return ['status'=>('Что-то пошло не так. '.$exception->getMessage())];
        }

    }
}
