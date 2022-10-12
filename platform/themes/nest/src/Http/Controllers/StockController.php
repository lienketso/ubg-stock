<?php


namespace Theme\Nest\Http\Controllers;


use Botble\Base\Http\Controllers\BaseController;
use Botble\Stock\Repositories\Interfaces\ContractInterface;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Theme;

class StockController extends BaseController
{

    protected $contract;

    public function __construct(ContractInterface $contract)
    {
        $this->contract = $contract;
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
        dd($status);
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

  
}