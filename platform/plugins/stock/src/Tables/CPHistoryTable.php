<?php

namespace Botble\Stock\Tables;

use BaseHelper;

// use Botble\Stock\Enums\CPHistoryStatusEnum;
use Botble\Stock\Repositories\Interfaces\CPHistoryInterface;
use Botble\Ecommerce\Repositories\Interfaces\CustomerInterface;
use Botble\Table\Abstracts\TableAbstract;
use Html;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class CPHistoryTable extends TableAbstract
{

    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $hasFilter = true;

    /**
     * CPHistoryTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param CPHistoryInterface $CPHistoryRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, CPHistoryInterface $CPHistoryRepository)
    {
        parent::__construct($table, $urlGenerator);

        $this->repository = $CPHistoryRepository;

        if (!Auth::user()->hasAnyPermission(['cphistory.edit', 'cphistory.destroy'])) {
            $this->hasOperations = false;
            $this->hasActions = false;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function ajax()
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('contract_code', function ($item) {
                if (!Auth::user()->hasPermission('cphistory.edit')) {
                    return $item->contract_code;
                }
                return Html::link(route('cphistory.edit', $item->id), $item->contract_code);
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('customer_id', function ($item) {
                return (isset($item->customer)) ? $item->customer->name : '--';
            })
            ->editColumn('amount', function ($item) {
                return format_price($item->amount);
            })
            ->editColumn('amount_xu', function ($item) {
                return number_format($item->amount_xu).'xu';
            })
            ->editColumn('created_at', function ($item) {
                return $item->created_at;
            })
            // ->editColumn('status', function ($item) {
            //     return $item->status->toHtml();
            // })
            ->addColumn('operations', function ($item) {
                return $this->getOperations('cphistory.edit', 'cphistory.destroy', $item);
            });

        return $this->toJson($data);
    }

    /**
     * {@inheritDoc}
     */
    public function query()
    {
        $query = $this->repository->getModel()
            ->with([
                'contract',
                'customer'
            ])
            ->select([
                'id',
                'customer_id',
                'contract_code',
                'package_id',
                'amount',
                'amount_xu',
                'created_at',
            ]);

        return $this->applyScopes($query);
    }

    /**
     * {@inheritDoc}
     */
    public function columns()
    {
        return [
            'id' => [
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'contract_code' => [
                'title' => 'M?? H???p ?????ng',
                'class' => 'text-start',
            ],
            'customer_id' => [
                'title' => 'T??n nh?? ?????u t??',
                'class' => 'text-start',
            ],
            'amount' => [
                'title' => 'Ti???n l??i(VND)',
                'class' => 'text-start',
            ],
            'amount_xu' => [
                'title' => 'Ti???n l??i(xu)',
                'class' => 'text-start',
            ],
            'created_at' => [
                'title' => 'Ng??y tr??? l??i',
                'class' => 'text-start',
            ]

        ];
    }

    /**
     * {@inheritDoc}
     */
    public function buttons()
    {
        // return $this->addCreateButton(route('CPHistory.create'), 'CPHistory.create');
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('cphistory.deletes'), 'cphistory.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'customer_id' => [
                'title' => 'T??n nh?? ?????u t??',
                'type' => 'select-ajax',
                'validate' => 'required',
                'callback' => 'getCustomers',
            ],
            'cphistory_code' => [
                'title' => 'M?? H???p ?????ng',
                'type' => 'text',
            ],
            'amount' => [
                'title' => 'S??? ti???n l??i(VND)',
                'type' => 'text',
            ],
            'amount_xu' => [
                'title' => 'S??? ti???n l??i(Xu)',
                'type' => 'text',
            ],
            'created_at' => [
                'title' => 'Ng??y tr??? l??i',
                'type' => 'date',
            ],
        ];
    }

}
