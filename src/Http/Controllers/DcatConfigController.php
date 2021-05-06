<?php

namespace Willhill\DcatConfig\Http\Controllers;

use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Routing\Controller;
use Willhill\DcatConfig\Models\DcatConfig;

class DcatConfigController extends AdminController
{
    // public function index(Content $content)
    // {
    //     return $content
    //         ->title('Title')
    //         ->description('Description')
    //         ->body($this->grid());
    // }
    protected function grid()
    {
        $grid = new Grid(new DcatConfig());
        $grid->id('ID')->sortable();
        $grid->column('name','键名')->editable();
        $grid->column('value', '键值')->editable();
        $grid->column('description', '说明');
        $grid->disableViewButton();
        // $grid->disableToolbar();
        $grid->enableDialogCreate();
        $grid->quickCreate(function (Grid\Tools\QuickCreate $create) {
            $create->text('name', '键名');
            $create->text('value', '键值');
            $create->text('description', '说明');
        });
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('name');
            $filter->like('value');
        });

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new DcatConfig());

        $form->display('id', 'ID');
        $form->text('name', '键')->rules('required');
        if (config('admin.extensions.config.valueEmptyStringAllowed', false)) {
            $form->text('value', '值');
        } else {
            $form->text('value','值')->rules('required');
        }
        $form->textarea('description', '说明');

        $form->display('created_at');
        $form->display('updated_at');

        return $form;
    }
}
