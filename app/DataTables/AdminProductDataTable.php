<?php

namespace App\DataTables;

use App\Models\Product;

use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AdminProductDataTable extends DataTable
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
                ->editColumn('created_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i a'); return $formatedDate; })
                ->addColumn('seller_id',function (Product $product) {
                    return $product->Seller->name;})
                ->addColumn('section_id',function (Product $product) {
                    return ($product->Section)?$product->Section->title: '';})
                ->addColumn('sub_section_id',function (Product $product) {
                    return ($product->SubSection)?$product->SubSection->title: '';})
                ->addColumn('stars', 'admin.banko.product_request.parts.stars')
//                ->addColumn('status', 'admin.banko.product_request.parts.status')
                ->addColumn('action', 'admin.banko.product_request.parts.action')
                ->rawColumns(['action', 'image','stars']);
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
        $key = $this->key;
        return $model->newQuery()->where('status',$key)->orderBy('created_at','desc');
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
            Column::make('seller_id')->name('Seller.name')->title('اسم التاجر'),
            Column::make('section_id')->name('Section.title')->title('القسم الرئيسي'),
            Column::make('sub_section_id')->name('SubSection.title')->title('القسم الفرعي'),
            Column::make('name')->title('اسم المنتج'),
            Column::make('price')->title('السعر'),
            Column::make('quantity')->title('الكمية'),
            Column::make('created_at')->title('تاريخ الانشاء'),
            Column::make('stars')->title('الظهور في الرئيسية'),
            Column::make('action')->title('تفاصيل المنتج'),
//            Column::make('status')->title('الموافقه على نشر المنتج'),
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
