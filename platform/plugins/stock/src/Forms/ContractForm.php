<?php

namespace Botble\Stock\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Stock\Enums\ContractStatusEnum;
use Botble\Stock\Enums\ContractPaymentStatusEnum;

use Botble\Stock\Http\Requests\ContractRequest;
use Botble\Stock\Models\Contract;

class ContractForm extends FormAbstract
{
    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $selectedCustomer = $this->data['customer'];
        $presenter = $this->data['presenter'];
       
        $this
            ->setupModel(new Contract)
            ->setValidatorClass(ContractRequest::class)
            ->withCustomFields()
            ->add('contract_hard_code', 'text', [
                'label'      => 'Mã hợp đồng',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                    'disabled'      => true
                ],
            ])
            ->add('contract_code', 'text', [
                'label'      => 'Mã tham chiếu',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                    'disabled'      => true
                ],
            ])    
            
            ->add('file_contract', 'mediaFile', [
                'label'      => 'File hợp đồng',
                'label_attr' => ['class' => 'control-label'],
            ])

            ->add('address', 'text', [
                'label'      => 'Địa chỉ',
                'label_attr' => ['class' => 'control-label'],
            ])

            ->add('area', 'text', [
                'label'      => 'Khu vực',
                'label_attr' => ['class' => 'control-label'],
            ])

           
            ->add('customer', 'html', [
                'html' => view('plugins/stock::withdrawals.customer-info', [
                    'selectedCustomer' => $selectedCustomer,
                    'title'    => __('Thông tin nhà đầu tư'),
                ])->render(),
            ])
            ->add('customer_info', 'html', [
                'html' => view('plugins/stock::withdrawals.bank-info-2', [
                    'customer_info' => $this->model->customer_info,
                    'title'    => __('Thông tin nhà đầu tư'),
                ])->render(),
            ])

            ->add('bankInfo', 'html', [
                'html' => view('plugins/stock::withdrawals.bank-info', [
                    'bankInfo' => $selectedCustomer->collaborator_bank_info,
                    'title'    => __('Thông tin ngân hàng'),
                ])->render(),
            ])

            ->add('commission_info', 'html', [
                'html' => view('plugins/stock::forms.partials.commission_info', [
                    'commission' => $this->model->commission,
                    'title'    => __('Thông tin tỷ lệ hoa hồng'),
                ])->render(),
            ])
            
            ->add('status', 'customSelect', [
                'label'      => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'class' => 'form-control select-full',
                ],
                'choices'    => ContractStatusEnum::labels(),
            ])


            ->add('presenter_id', 'html', [
                'label'      => 'Người giới thiệu',
                'html' => view('plugins/stock::withdrawals.presenter-select', [
                    'data' => $presenter,
                    'title'    => __('Người giới thiệu'),
                ])->render(),
            ])

            ->add('contract_paid_status', 'customSelect', [
                'label'      => 'Trạng thái thanh toán',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'class' => 'form-control select-full',
                ],
                'choices'    => ContractPaymentStatusEnum::labels(),
            ])
            ->setBreakFieldPoint('status');
    }
}