<?php

namespace Botble\Stock\Tables;

use BaseHelper;
// use Botble\Stock\Enums\WithdrawStatusEnum;
use Botble\Stock\Repositories\Interfaces\WithdrawInterface;
use Botble\Table\Abstracts\TableAbstract;
use Html;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class WithdrawTable extends TableAbstract
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
     * WithdrawTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param WithdrawInterface $WithdrawRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, WithdrawInterface $WithdrawRepository)
    {
        parent::__construct($table, $urlGenerator);

        $this->repository = $WithdrawRepository;

        if (!Auth::user()->hasAnyPermission(['withdraw.edit', 'withdraw.destroy'])) {
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
            ->editColumn('id', function ($item) {
                if (!Auth::user()->hasPermission('withdraw.edit')) {
                    return $item->id;
                }
                return Html::link(route('withdraw.edit', $item->id), $item->id);
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('customer_id', function ($item) {      
                return ($item->customer) ? $item->customer->name  : '--';
             })
             ->editColumn('package_id', function ($item) {
                return ($item->package)  ? $item->package->name : '--';
             })
             ->editColumn('contract_id', function ($item) {
                return ($item->contract) ? $item->contract->name : '--';
             }) 
             ->editColumn('amount', function ($item) {
                return $item->amount;
            })
            ->editColumn('confirm_id', function ($item) {
                return $item->confirm_id;
            })
            ->editColumn('created_at', function ($item) {
                return $item->created_at;
            })
            ->editColumn('status', function ($item) {
                return $item->status->toHtml();
            })
            ->addColumn('operations', function ($item) {
                return $this->getOperations('withdraw.edit', 'withdraw.destroy', $item);
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
            'package',
            'contract',
            'customer'
        ])
        ->select([
            'id',
            'customer_id',
            'package_id',
            'contract_id',
            'amount',
            'confirm_id',
            'created_at',
            'status'
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
            
            'customer_id' => [
                'title' => 'T??n nh?? ?????u t??',
                'class' => 'text-start',
            ],
            'package_id' => [
                'title' => 'T??n g??i',
                'class' => 'text-start',
            ],
            'contract_id' => [
                'title' => 'T??n h???p ????ng',
                'class' => 'text-start',
            ],
            'amount' => [
                'title' => 'S??? ti???n',
                'class' => 'text-start',
            ],
            
            'confirm_id' => [
                'title' => 'Ng?????i ki???m duy???t',
                'class' => 'text-start',
            ],
            'created_at' => [
                'title' => 'Ng??y t???o',
                'class' => 'text-start',
            ],
            'status'     => [
                'title' => trans('core/base::tables.status'),
                'width' => '100px',
            ],
           
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function buttons()
    {
        // return $this->addCreateButton(route('Withdraw.create'), 'Withdraw.create');
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('withdraw.deletes'), 'withdraw.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'customer_id' => [
                'title' => 'T??n nh?? ?????u t??',
                'type'     => 'select-ajax',
                'validate' => 'required',
                'callback' => 'getCustomers',
            ],
            'Withdraw_code' => [
                'title' => 'M?? H???p ?????ng',
                'type'     => 'text',
            ],
            'first_buy_price' => [
                'title' => 'Gi?? tr??? h???p ?????ng(VND)',
                'type'     => 'text',
            ],
            'created_at' => [
                'title' => 'Ng??y giao d???ch',
                'type'  => 'date',
            ],
        ];
    }

}
