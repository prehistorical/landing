<?php

namespace Prehistorical\Landing;

use Prehistorical\Landing\Block;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;

class SaveController extends Controller
{

    public function saveBlock()
    {

        if(Request::has('entity'))
        {
            $dataobj = Request::all();

            if($dataobj['entity'] == 'block')
            {
                try {

                    $block = Block::firstOrCreate(['name'=>$dataobj['block']]);

                    $result = $block->saveBlock($dataobj);

                    return ['status'=>$result];

                } catch(Exception $exception) {
                    return ['status'=>('Что-то пошло не так. '.$exception->getMessage())];
                }
            } else {
                return ['status'=>'Имя сохраняемой сущности не равно block ('.$dataobj['entity'].').'];
            }

        } else {

            return ['status'=>'Не хватает параметров для сохранения.'];

        }

    }

    public function saveGroupItem()
    {

        if(Request::has('entity') && Request::has('block') && Request::has('id'))
        {
            $dataobj = Request::all();

            if($dataobj['entity'] == 'groupitem')
            {
                try {
                    $groupitem = \App\Group::findOrFail($dataobj['id']);

                    $result = $groupitem->saveGroupItem($dataobj);

                    return ['status'=>$result];

                } catch(Exception $exception) {
                    return ['status'=>('Что-то пошло не так. '.$exception->getMessage())];
                }
            } else {
                return ['status'=>'Имя сохраняемой сущности не равно group ('.$dataobj['entity'].').'];
            }

        } else {

            return ['status'=>'Не хватает параметров для сохранения.'];

        }

    }

}
