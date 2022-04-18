<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        {
            return datatables()
                ->eloquent($query)
                ->editColumn('image', '<img class="img-thumbnail" src="{{$image_path}}" style="height: 75px; width: 75px;">')
                ->addColumn('status', 'seller.dashboard.products.parts.status')
                ->addColumn('section_id',function (Product $product) {
                    return ($product->Section)?$product->Section->title: '';})
                ->addColumn('sub_section_id',function (Product $product) {
                    return ($product->SubSection)?$product->SubSection->title: '';})
                ->addColumn('action', 'seller.dashboard.products.parts.action')
                ->rawColumns(['action', 'image','status']);
        }
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery()->orderBy('created_at','desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->lengthMenu(
                [
                    [10, 25, 50, -1],
                    ['10 صـفوف', '25 صـف', '50 صـف', 'كل الصـفوف']
                ])
            ->parameters([
                'language' => ['url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json']
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('image')->title('الصورة'),
            Column::make('name')->title('الاسم'),
            Column::make('section_id')->name('Section.title')->title('القسم الرئيسي'),
            Column::make('sub_section_id')->name('SubSection.title')->title('القسم الفرعي'),
            Column::make('price')->title('السعر'),
            Column::make('quantity')->title('الكمية'),
            Column::make('status')->title('حالة طلب نشر المنتج'),
            Column::make('action')->title('الاجرائات'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Product_' . date('YmdHis');
    }
}
