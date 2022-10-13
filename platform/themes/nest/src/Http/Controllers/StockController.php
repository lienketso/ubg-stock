<?php


namespace Theme\Nest\Http\Controllers;


use Botble\Base\Http\Controllers\BaseController;
use Botble\Stock\Repositories\Interfaces\ContractInterface;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Ecommerce\Repositories\Interfaces\CustomerInterface;
use Theme;

class StockController extends BaseController
{

    protected $contract;
    protected $customerRepository;

    public function __construct(ContractInterface $contract, CustomerInterface $customerRepository)
    {
        $this->contract = $contract;
        $this->customerRepository = $customerRepository;
    }

    public function getIndexStock(
        BaseHttpResponse $response,
    ){
       
        if (!auth('customer')->check()) {
            return $response->setNextUrl(route('customer.login'));
        }
        $user =  auth('customer')->user();
    
        $model =  $this->contract->getModel();
        $totalContract = $model->where('presenter_id','=', $user->affiliation_id)->get()->count();
        $paidContract = $model->where([['presenter_id','=', $user->affiliation_id],['status', '=', 'active']])->get()->count();
        $signedContract = $model->where([['presenter_id','=', $user->affiliation_id],['status', '=', 'signed']])->get()->count();
        $expiredContract = $model->where([['presenter_id','=', $user->affiliation_id],['status', '=', 'expired']])->get()->count();
        $sumContract = $model->where([['presenter_id','=', $user->affiliation_id],['status', '=', 'expired']])
                        ->orWhere([['presenter_id','=', $user->affiliation_id],['status', '=', 'active']])->sum('first_buy_price');


        return view('plugins/stock::themes.cp-category', compact('totalContract', 'paidContract', 'signedContract', 'expiredContract', 'sumContract'));
    }

    public function getAllContract($status, BaseHttpResponse $response
    ){
        if (!auth('customer')->check()) {
            return $response->setNextUrl(route('customer.login'));
        }
        $user =  auth('customer')->user();
    
        $model =  $this->contract->getModel();
        if($status == 'paid' || $status == 'unpaid'){
            $contracts = $model->where([['presenter_id','=', $user->affiliation_id],['contract_paid_status','=',$status]])->with(['customer'])->paginate(30);

        }elseif($status == 'expired'){
            $contracts = $model->where([['presenter_id','=', $user->affiliation_id],['status','=',$status]])->with(['customer'])->paginate(30);
        } else{
            $contracts = $model->where('presenter_id','=', $user->affiliation_id)->with(['customer'])->paginate(30);
        }
        //  dd($contracts);
        return view('plugins/stock::themes.list-contract', compact('contracts'));
    }

    public function detailContract($id, BaseHttpResponse $response
    ){
        if (!auth('customer')->check()) {
            return $response->setNextUrl(route('customer.login'));
        }
        $user =  auth('customer')->user();
        $contract = $this->contract->getFirstBy([
            'id'                 => $id,
            'presenter_id'       => $user->affiliation_id
        ]);

        if (!$contract) {
            return $response->setNextUrl(route('public.index'));
        }

        $customer = $this->customerRepository->findById($contract->customer_id);
       
        return view('plugins/stock::themes.detail-contract', compact('contract', 'customer'));
    }

    

  
}