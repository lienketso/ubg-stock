@extends('plugins/stock::themes.layouts.master')
@section('content')

<main class="cp-wrapper main" id="main">
    <div class="container">
        <h1 class="overview-title text-center">Danh sách hợp đồng</h1>  
       <table class="table-contract table table-bordered">
            <thead>
                <th class="col">#</th>
                <th class="col">SĐT</th>
                <th class="col">Mã HĐ</th>
            </thead>
            <tbody>
                @foreach ( $contracts as $key => $contract)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td><a href="{{route('public.detail-contract', $contract->id)}}">{{$contract->customer->phone}}</a></td>
                        <td><a href="{{route('public.detail-contract', $contract->id)}}">{{$contract->contract_code}}</a></td>
                    </tr> 
                @endforeach
                
            </tbody>
       </table>
       {{ $contracts->links() }}
</main>

@endsection

