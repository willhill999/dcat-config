<?php

namespace Willhill\DcatConfig\Http\Controllers;

use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Willhill\DcatConfig\Models\DcatConfig;

class DcatConfigController extends AdminController
{
    protected function grid()
    {
        $grid = new Grid(new DcatConfig());
        $grid->id('ID')->sortable();
        $grid->column('title','标题');
        $grid->column('name','键名');
        $grid->column('value', '键值')->width(240);
        $grid->column('description', '说明');
        $grid->disableViewButton();
        $grid->enableDialogCreate();
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('name');
            $filter->like('value');
        });
        return $grid;
    }

    protected function form()
    {
        return Form::make(new DcatConfig(), function(Form $form){
            $form->hidden('id', 'ID');
            $form->text('title', '标题')->rules('required');
            $form->text('name', '键')->rules('required');
            if($form->isEditing()){
                $optArr = [];
                if($form->model()->option){
                    $options = explode("\r\n",$form->model()->option);
                    foreach($options as $option){
                        $opt = explode(":", $option);
                        $optArr[$opt[0]] = $opt[1];
                    }
                }
                switch($form->model()->type){
                    case 1:
                        $form->switch('value', '值');
                    break;
                    case 2:
                        $form->select('value', '值')->options($optArr);
                    break;
                    case 3:
                        $form->multipleSelect('value', '值')->options($optArr);
                    break;
                    case 4:
                        $form->radio('value', '值')->options($optArr);
                    break;
                    case 5:
                        $form->checkbox('value', '值')->options($optArr);
                    break;
                    case 6:
                        $form->textarea('value', '值');
                    break;
                    case 7:
                        $form->time('value', '值');
                    break;
                    case 8:
                        $form->date('value', '值');
                    break;
                    case 9:
                        $form->datetime('value', '值');
                    break;
                    default:
                        $form->text('value', '值');
                };
            }else{
                $form->select('type')->options([
                    0 => '文本',
                    1 => '开关',
                    2 => '下拉单选',
                    3 => '下拉多选',
                    4 => '单选',
                    5 => '多选',
                    6 => '长文本',
                    7 => '时间',
                    8 => '日期',
                    9 => '时间日期',
                    // 8 => '图片'
                ])
                ->default(0)->help('配置项类型选择后不可更改,请在添加后设置配置项的值');
            }
            $form->textarea('option', '选项')->placeholder("选项数据,配合选择类型使用,示例如下:\r\napple:苹果\r\nfacebook:脸书\r\ntesla:特斯拉")->rules('required_if:type,2,3,4,5')->default("")->help("每行一条选项数据,键值用:分隔");
            $form->textarea('description', '说明');
        })->saving(function(Form $form){

        });
    }
}
