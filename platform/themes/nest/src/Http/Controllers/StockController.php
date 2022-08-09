<?php


namespace Theme\Nest\Http\Controllers;


use Botble\Base\Http\Controllers\BaseController;
use Botble\Stock\Repositories\Interfaces\CPCategoryInterface;
use Theme;

class StockController extends BaseController
{

    protected $category;

    public function __construct(CPCategoryInterface $category)
    {
        $this->category = $category;
    }

    public function getIndexStock(){
        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add(__('Danh mục đầu tư'), route('public.cp-category'));
        $listCategory = $this->category->getModel()
            ->where('status', 'published')
            ->orderBy('sort_order', 'asc')->get();
        return view('plugins/stock::themes.cp-category', compact('listCategory'));
    }
}