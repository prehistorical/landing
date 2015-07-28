<?php

namespace Prehistorical\Landing;

use App\Http\Controllers\Controller;
use Prehistorical\Landing\Block;
use Illuminate\Support\Facades\DB;

class CreateController extends Controller
{
    public function createGroupItem($block)
    {
        try {

            $block = Block::findOrFail($block);

            $item = $block->createGroupItem();

            $status = 'OK';

            $complhtml = view('back/blocks/groupitems/'.$block->name.'_groupitem', compact('item'))->render();

            return compact('status', 'complhtml');

        } catch(Exception $exception) {

            return ['status'=>('Что-то пошло не так. '.$exception->getMessage())];
        }

    }

    public function createInit()
    {

        try {

            //Очистим всё, если там что-то есть
            DB::table('blocks')->delete();
            DB::table('groups')->delete();
            DB::table('stringfields')->delete();
            DB::table('textfields')->delete();
            DB::table('bools')->delete();
            DB::table('datetimes')->delete();
            DB::table('numbs')->delete();
            DB::table('images')->delete();

            Block::initBlocks();
        } catch(Exception $exception) {

            return ['status'=>('Что-то пошло не так. '.$exception->getMessage())];
        }

        return ['status'=>'OK'];
    }

    public function createInitBlock($block_name)
    {
        try {
            Block::initBlocks($block_name);
        } catch(Exception $exception) {

            return ['status'=>('Что-то пошло не так. '.$exception->getMessage())];
        }

        return ['status'=>'OK'];
    }
}
