<?php

namespace App\Admin\Controllers;

use App\Models\Disc;
use App\Models\DiscFormat;
use App\Models\Studio;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Storage;

class DiscController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Disc';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Disc());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('slug', __('Slug'));
        // $grid->column('description', __('Description'));
        $grid->column('price', __('£'));
        $grid->column('disc_format_id', __('Format'))
            ->display(function () {
                return $this->discFormat->name;
            });
        $grid->column('studio_id', __('Studio'))
            ->display(function () {
                return $this->studio->name;
            });
        $grid->column('category_id', __('Category'))
            ->display(function () {
                return $this->category->name;
            });
        $grid->column('available_qty', __('Qty'));
        // $grid->column('released_date', __('Released date'));
        // $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Disc::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('images', __('Images'))->as(function($images) {
            $output = '';
            foreach($images as $ii => $image) {
                $output .= '<img src="'.url('uploads/'.$image->path).'" style="width:30%;">';
            }
            return $output;
        })->unescape();
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('description', __('Description'));
        $show->field('price', __('Price'));
        $show->field('discFormat', __('Format'))->as(function($format) {
            return $format->name;
        });
        $show->field('studio', __('Sudio'))->as(function($studio) {
            return $studio->name;
        });
        $show->field('category', __('Category'))->as(function($category) {
            return $category->name;
        });
        $show->field('available_qty', __('Qty'));
        $show->field('released_date', __('Released date'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Disc());

        $form->text('name', __('Name'));
        $form->text('slug', __('Slug'));
        $form->multipleFile('images','Images')->pathColumn('path')->removable();
        $form->textarea('description', __('Description'));
        $form->decimal('price', __('Price'));
        $form->select('disc_format_id', __('Format'))
            ->options(DiscFormat::all()->pluck('name', 'id'))
            ->rules('required');        
        $form->select('studio_id', __('Studio'))
            ->options(Studio::all()->pluck('name', 'id'))
            ->rules('required');                
        $form->select('category_id', __('Category'))
            ->options(Category::all()->pluck('name', 'id'))
            ->rules('required');   
        $form->number('available_qty', __('Available qty'));
        $form->datetime('released_date', __('Released date'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
