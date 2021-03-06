<?php

namespace App\DataTables;

use App\Models\Order;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
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
                ->addColumn('user_name', function (Order $order) {
                    return ($order->User) ? $order->User->name : '';
                })
                ->addColumn('product_name', function (Order $order) {
                    return ($order->Product) ? $order->Product->name : '';
                })
//                ->addColumn('product_image', function (Order $order) {
//                    return ($order->Product) ? $order->Product->image : '';
//                })
//                ->addColumn('product_image', 'seller.dashboard.order.parts.product_image')
                ->addColumn('approval_btn', 'seller.dashboard.order.parts.approval_btn')
                ->addColumn('status', 'seller.dashboard.order.parts.status')
                ->addColumn('action', 'seller.dashboard.order.parts.action')
                ->rawColumns(['action','status','image','approval_btn']);
        }
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        return $model->newQuery()->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('order-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->lengthMenu(
                [
                    [10, 25, 50, -1],
                    ['10 ??????????', '25 ??????', '50 ??????', '???? ??????????????']
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
//            Column::make('product_image')->title('???????? ????????????'),
//            Column::make('product_image')->title('???????? ????????????'),
            Column::make('product_name')->title('?????? ????????????'),
            Column::make('user_name')->title('?????? ????????????????'),
            Column::make('installment_type')->title('?????? ??????????????'),
            Column::make('price')->title('?????? ???????????? ???????? ??????????'),
            Column::make('total')->title('?????? ???????????? ??????????????'),
            Column::make('status')->title('???????? ??????????'),
            Column::make('approval_btn')->title('????????????????'),
            Column::make('action')->title('???????????? ??????????'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Order_' . date('YmdHis');
    }
}
