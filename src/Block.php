<?php

namespace Prehistorical\Landing;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Prehistorical\Landing\Stringfield;
use Prehistorical\Landing\Textfield;
use Prehistorical\Landing\Numb;
use Prehistorical\Landing\Bool;
use Prehistorical\Landing\Pdatetime;
use Prehistorical\Landing\Imageitem;

class Block extends Model
{
    protected $primaryKey = 'name';
    public $timestamps = false;
    protected static $unguarded = true;

    public function groups() {

        return $this->hasMany('Prehistorical\Landing\Group', 'block_name');

    }

    public function images() {

        return $this->hasMany('Prehistorical\Landing\Imageitem', 'block_name');

    }

    public function stringfields() {

        return $this->hasMany('Prehistorical\Landing\Stringfield', 'block_name');

    }

    public function textfields() {

        return $this->hasMany('Prehistorical\Landing\Textfield', 'block_name');

    }

    public function numbs() {

        return $this->hasMany('Prehistorical\Landing\Numb', 'block_name');

    }

    public function bools() {

        return $this->hasMany('Prehistorical\Landing\Bool', 'block_name');

    }

    public function pdatetimes() {

        return $this->hasMany('Prehistorical\Landing\Pdatetime', 'block_name');

    }

    public function saveBlock($dataobj)
    {
        $landing = config('landing');

        if(array_key_exists($this->name, $landing))
        {

            $blockstruct = $landing[$this->name];

            if(array_key_exists('title', $dataobj))
            {
                $this->title = $dataobj['title'];
            }

            foreach(['stringfields', 'textfields', 'numbs', 'images', 'bools', 'pdatetimes'] as $typename) {

                if(array_key_exists($typename, $dataobj) && array_key_exists($typename, $blockstruct)){

                    $data_fs = $dataobj[$typename];

                    foreach($blockstruct[$typename] as $fieldname)
                    {
                        if(array_key_exists($fieldname, $data_fs)){

                            if($typename == 'stringfields'){
                                $field = Stringfield::firstOrNew(['block_name'=>$this->name, 'name'=>$fieldname, 'group_id'=>0]);
                                $field->value = $data_fs[$fieldname];
                                $field->save();

                            }else if($typename == 'textfields'){
                                $field = Textfield::firstOrNew(['block_name'=>$this->name, 'name'=>$fieldname, 'group_id'=>0]);
                                $field->value = $data_fs[$fieldname];
                                $field->save();

                            }else if($typename == 'numbs'){
                                $field = Numb::firstOrNew(['block_name'=>$this->name, 'name'=>$fieldname, 'group_id'=>0]);
                                $field->value = $data_fs[$fieldname];
                                $field->save();

                            }else if($typename == 'bools'){
                                $field = Bool::firstOrNew(['block_name'=>$this->name, 'name'=>$fieldname, 'group_id'=>0]);
                                $field->value = $data_fs[$fieldname] == "true" ? true : false;
                                $field->save();

                            }else if($typename == 'pdatetimes'){
                                $field = Pdatetime::firstOrNew(['block_name'=>$this->name, 'name'=>$fieldname, 'group_id'=>0]);
                                $field->value = $data_fs[$fieldname];
                                $field->save();

                            }else if($typename == 'images'){
                                $field = Imageitem::firstOrNew(['block_name'=>$this->name, 'name'=>$fieldname, 'group_id'=>0]);

                                if(array_key_exists('alt', $data_fs[$fieldname])){
                                    $field->alt = $data_fs[$fieldname]['alt'];
                                }
                                if(array_key_exists('primary_link', $data_fs[$fieldname])){
                                    $field->primary_link = $data_fs[$fieldname]['primary_link'];
                                }
                                if(array_key_exists('secondary_link', $data_fs[$fieldname])){
                                    $field->secondary_link = $data_fs[$fieldname]['secondary_link'];
                                }
                                if(array_key_exists('icon_link', $data_fs[$fieldname])){
                                    $field->icon_link = $data_fs[$fieldname]['icon_link'];
                                }
                                if(array_key_exists('preview_link', $data_fs[$fieldname])){
                                    $field->preview_link = $data_fs[$fieldname]['preview_link'];
                                }

                                $field->save();

                            }
                        }
                    }
                }
            }

            $this->save();

            return 'OK';

        }else{
            return 'Key '.$this->name.' not found.';
        }

    }

    public function createGroupItem()
    {

        $dataArr = ['sorter'=>99, 'show'=>true, 'stringfields'=>[], 'textfields'=>[], 'numbs'=>[], 'bools'=>[], 'pdatetimes'=>[], 'images'=>[]];

        $blockname = $this->name;

        $groupstruct = config('landing')[$this->name]['group'];


        $newGroupItem = new \Prehistorical\Landing\Group();
        $newGroupItem->block_name = $blockname;
        $newGroupItem->save();

        $dataArr['id'] = $newGroupItem->id;

        if(array_key_exists('stringfields', $groupstruct))
        {
            foreach($groupstruct['stringfields'] as $fieldname)
            {
                $stringfield = Stringfield::create(['block_name'=>$blockname, 'name'=>$fieldname, 'group_id'=>$newGroupItem->id]);
                $newGroupItem->stringfields()->save($stringfield);
                $dataArr['stringfields'][$fieldname]='';
            }
        }

        if(array_key_exists('textfields', $groupstruct))
        {
            foreach($groupstruct['textfields'] as $fieldname)
            {
                $textfield = Textfield::firstOrNew(['block_name'=>$blockname, 'name'=>$fieldname, 'group_id'=>$newGroupItem->id]);
                $newGroupItem->textfields()->save($textfield);
                $dataArr['textfields'][$fieldname]='';
            }
        }

        if(array_key_exists('numbs', $groupstruct))
        {
            foreach($groupstruct['numbs'] as $fieldname)
            {
                $numb = Numb::firstOrNew(['block_name'=>$blockname, 'name'=>$fieldname, 'group_id'=>$newGroupItem->id]);
                $newGroupItem->numbs()->save($numb);
                $dataArr['numbs'][$fieldname]='';
            }
        }

        if(array_key_exists('bools', $groupstruct))
        {
            foreach($groupstruct['bools'] as $fieldname)
            {
                $boolitem = Bool::firstOrNew(['block_name'=>$blockname, 'name'=>$fieldname, 'group_id'=>$newGroupItem->id]);
                $newGroupItem->bools()->save($boolitem);
                $dataArr['bools'][$fieldname]='';
            }
        }

        if(array_key_exists('pdatetimes', $groupstruct))
        {
            foreach($groupstruct['pdatetimes'] as $fieldname)
            {
                $dtitem = Pdatetime::firstOrNew(['block_name'=>$blockname, 'name'=>$fieldname, 'group_id'=>$newGroupItem->id]);
                $dtitem->value = new \DateTime();
                $newGroupItem->pdatetimes()->save($dtitem);
                $dataArr['pdatetimes'][$fieldname]= $dtitem->value->format('d.m.Y H:i:s');

            }
        }

        if(array_key_exists('images', $groupstruct))
        {
            foreach($groupstruct['images'] as $fieldname)
            {
                $image = Imageitem::firstOrNew(['block_name'=>$blockname, 'name'=>$fieldname, 'group_id'=>$newGroupItem->id]);
                $newGroupItem->images()->save($image);
                $dataArr['images'][$fieldname]=[
                    'alt'=>'',
                    'primary_link'=>'',
                    'secondary_link'=>'',
                    'icon_link'=>'',
                    'preview_link'=>''
                ];
            }
        }

        $newGroupItem->save();

        return $dataArr;

    }

    public function getGroupItemsArray($addshow=false)
    {
        $dataArr = [];

        if($addshow)
        {
            $groups = \Prehistorical\Landing\Group::where('block_name','=',$this->name)->with(['stringfields', 'textfields', 'numbs', 'bools', 'pdatetimes', 'images'])->where('show', '=', true)->get();
        }
        else
        {
            $groups = \Prehistorical\Landing\Group::where('block_name','=',$this->name)->with(['stringfields', 'textfields', 'numbs', 'bools', 'pdatetimes', 'images'])->get();
        }

        foreach($groups as $item)
        {
            $dataArrItem = ['updated_at'=>$item->updated_at->timestamp, 'id'=>$item->id, 'sorter'=>$item->sorter, 'show'=>$item->show, 'stringfields'=>[], 'textfields'=>[], 'images'=>[], 'bools'=>[], 'pdatetimes'=>[], 'numbs'=>[]];

            $fields = & $dataArrItem['stringfields'];
            foreach($item->stringfields as $stringfield)
            {
                $fields[$stringfield->name] = $stringfield->value;
            }

            $fields = & $dataArrItem['textfields'];
            foreach($item->textfields as $textfield)
            {
                $fields[$textfield->name] = $textfield->value;
            }

            $fields = & $dataArrItem['images'];
            foreach($item->images as $image)
            {
                $fields[$image->name] = [
                    'alt'=>$image->alt,
                    'primary_link'=>$image->primary_link,
                    'secondary_link'=>$image->secondary_link,
                    'icon_link'=>$image->icon_link,
                    'preview_link'=>$image->preview_link
                ];
            }

            $fields = & $dataArrItem['bools'];
            foreach($item->bools as $boolitem)
            {
                $fields[$boolitem->name] = $boolitem->value;
            }

            $fields = & $dataArrItem['pdatetimes'];
            foreach($item->pdatetimes as $dtitem)
            {
                $fields[$dtitem->name] = $dtitem->value;
            }

            $fields = & $dataArrItem['numbs'];
            foreach($item->numbs as $numb)
            {
                $fields[$numb->name] = $numb->value;
            }

            $dataArr['id'.$item->id] = $dataArrItem;
        }

        return $dataArr;
    }

    public static function  getBlocksDisplayArray($addshow=false, $block_name='')
    {
        if($block_name!=''){
            $blocks = Block::where('name', '=', $block_name)->with([
                'stringfields'=>function($query){
                    $query->where('group_id','=',0);
                },
                'textfields'=>function($query){
                        $query->where('group_id','=',0);
                    },
                'numbs'=>function($query){
                        $query->where('group_id','=',0);
                    },
                'bools'=>function($query){
                        $query->where('group_id','=',0);
                    },
                'pdatetimes'=>function($query){
                        $query->where('group_id','=',0);
                    },
                'images'=>function($query){
                        $query->where('group_id','=',0);
                    }
            ])->get();
        }else{
            $blocks = Block::with([
                'stringfields'=>function($query){
                        $query->where('group_id','=',0);
                    },
                'textfields'=>function($query){
                        $query->where('group_id','=',0);
                    },
                'numbs'=>function($query){
                        $query->where('group_id','=',0);
                    },
                'bools'=>function($query){
                        $query->where('group_id','=',0);
                    },
                'pdatetimes'=>function($query){
                        $query->where('group_id','=',0);
                    },
                'images'=>function($query){
                        $query->where('group_id','=',0);
                    }
            ])->get();
        }


        $dataArr = [];

        foreach($blocks as $block)
        {
            $dataArr[$block->name] = ['title'=>$block->title, 'stringfields'=>[], 'textfields'=>[], 'images'=>[], 'bools'=>[], 'pdatetimes'=>[], 'numbs'=>[]];

            $block_strfs = & $dataArr[$block->name]['stringfields'];
            foreach($block->stringfields as $stringfield)
            {
                $block_strfs[$stringfield->name] = $stringfield->value;
            }

            $block_textfs = & $dataArr[$block->name]['textfields'];
            foreach($block->textfields as $textfield)
            {
                $block_textfs[$textfield->name] = $textfield->value;
            }

            $block_images = & $dataArr[$block->name]['images'];
            foreach($block->images as $image)
            {
                $block_images[$image->name] = [
                    'alt'=>$image->alt,
                    'primary_link'=>$image->primary_link,
                    'secondary_link'=>$image->secondary_link,
                    'icon_link'=>$image->icon_link,
                    'preview_link'=>$image->preview_link
                ];
            }

            $block_bools = & $dataArr[$block->name]['bools'];
            foreach($block->bools as $boolitem)
            {
                $block_bools[$boolitem->name] = $boolitem->value;
            }

            $block_pdatetimes = & $dataArr[$block->name]['pdatetimes'];
            foreach($block->pdatetimes as $dtitem)
            {
                $block_pdatetimes[$dtitem->name] = $dtitem->value;
            }

            $block_numbs = & $dataArr[$block->name]['numbs'];
            foreach($block->numbs as $numb)
            {
                $block_numbs[$numb->name] = $numb->value;
            }

            $dataArr[$block->name]['group'] = $block->getGroupItemsArray($addshow);

        }

        return $dataArr;
    }

    //Создание структуры блоков лэндинга из конфига
    public static function initBlocks($block_name='')
    {
        if($block_name==''){
            //Создаем поля по структуре
            $landing = config('landing');
        }else{
            $landing = [$block_name=>config('landing')[$block_name]];
        }

        foreach($landing as $blockname => $blockstruct)
        {
            $newBlock = static::find($blockname);

            if(!$newBlock)
            {

                $newBlock = new static;
                $newBlock->name = $blockname;

                if(array_key_exists('title', $blockstruct))
                {
                    $newBlock->title = $blockstruct['title'];
                }

                if(array_key_exists('stringfields', $blockstruct))
                {
                    foreach($blockstruct['stringfields'] as $fieldname)
                    {
                        $stringfield = Stringfield::firstOrCreate(['block_name'=>$blockname, 'name'=>$fieldname]);
                    }
                }

                if(array_key_exists('textfields', $blockstruct))
                {
                    foreach($blockstruct['textfields'] as $fieldname)
                    {
                        $textfield = Textfield::firstOrCreate(['block_name'=>$blockname, 'name'=>$fieldname]);
                    }
                }

                if(array_key_exists('numbs', $blockstruct))
                {
                    foreach($blockstruct['numbs'] as $fieldname)
                    {
                        $numb = Numb::firstOrCreate(['block_name'=>$blockname, 'name'=>$fieldname]);
                    }
                }

                if(array_key_exists('bools', $blockstruct))
                {
                    foreach($blockstruct['bools'] as $fieldname)
                    {
                        $boolitem = Bool::firstOrCreate(['block_name'=>$blockname, 'name'=>$fieldname]);
                    }
                }

                if(array_key_exists('pdatetimes', $blockstruct))
                {
                    foreach($blockstruct['pdatetimes'] as $fieldname)
                    {
                        $dtitem = Pdatetime::firstOrCreate(['block_name'=>$blockname, 'name'=>$fieldname]);
                    }
                }

                if(array_key_exists('images', $blockstruct))
                {
                    foreach($blockstruct['images'] as $fieldname)
                    {
                        $image = Imageitem::firstOrCreate(['block_name'=>$blockname, 'name'=>$fieldname]);
                    }
                }

                $newBlock->save();

            }
        }

        return 'OK';
    }
}
