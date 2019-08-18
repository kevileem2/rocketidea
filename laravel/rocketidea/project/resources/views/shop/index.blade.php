@extends('layout')


@section("title",'Shop')

@section('content')
<div class="container">
    <h1>Shop</h1>
    <div class="row">
        @foreach($shop as $shop_item)
        <div class="col-12 col-sm-6 col-md-4">
        <form action="{{Route('shop.payment')}}" method="post">
                @csrf
                <div class="card shop-container {{$shop_item->type}}">
                    <div class="card-body">
                        <input type="hidden" name="total" value="{{ $shop_item->total }}" />
                        <h5 class="card-title">{{$shop_item->total}} RP's</h5>
                        <p class="card-text">cost: {{$shop_item->real_cost_euro}} euro</p>
                        <button class="btn primary-button" type="submit">Buy</button>
                    </div>
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection