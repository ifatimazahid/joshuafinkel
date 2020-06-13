<?php

namespace App\DataTables\Admin;

use App\Helper\Util;
use App\Models\Slot;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

/**
 * Class SlotDataTable
 * @package App\DataTables\Admin
 */
class SlotDataTable extends DataTable
{
    public $product_id = null;
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

//        $dataTable->editColumn('product_id', function (Slot $model) {
//            if ($model->product_slots)
//                return $model->product_slots->products->title;
//        });

        $dataTable->editColumn('date', function (Slot $model) {
            if ($model->slot_details)
                return $model->slot_details->date;
        });

        $dataTable->editColumn('time', function (Slot $model) {
            if ($model->slot_details)
                return $model->slot_details->time;
        });

        $dataTable->editColumn('price', function (Slot $model) {
            if ($model->slot_details)
                return $model->slot_details->price;
        });

        $dataTable->editColumn('description', function (Slot $model) {
            if ($model->slot_details)
                return $model->slot_details->description;
        });

        $dataTable->rawColumns(['product_id', 'date', 'time', 'price', 'description', 'action']);

        return $dataTable->addColumn('action', 'admin.slots.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Slot $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Slot $model)
    {
//        return $model->newQuery();
        $query = $model->newQuery();
        if (!is_null($this->product_id)) {
            $query->where('product_id', $this->product_id);
        }
        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $buttons = [];
        if (\Entrust::can('slots.create') || \Entrust::hasRole('super-admin')) {
            $buttons = ['create'];
        }
        $buttons = array_merge($buttons, [
            'export',
            'print',
            'reset',
            'reload',
        ]);
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '80px', 'printable' => false])
            ->parameters(array_merge(Util::getDataTableParams(), [
                'dom'     => 'Blfrtip',
                'order'   => [[0, 'desc']],
                'buttons' => $buttons,
            ]));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
//            'product_id' => ['title' => 'Products'],
            'title',
            'date',
            'time',
            'price',
            'description'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'slotsdatatable_' . time();
    }
}