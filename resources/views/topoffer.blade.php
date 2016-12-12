@extends('layouts.base')
@section('title', 'Cupom de Desconto e Dinheiro de Volta')
@section('description', 'Cupom de desconto para economizar e ainda receber parte do dinheiro de volta é só no Colpon. Quer saber como? Acesse agora mesmo!')
@section('cssname','merchant')
@section('canonical',url('/cupons/'))
@section('content')
@include('layouts.header')
	<div class="breadcrumb-wrap container">
    <div class="breadcrumb-row">
        <ol class="breadcrumb">
          <li><a href="{{ url('/') }}">Home</a></li>
          <li class="active">Top Offers</li>
        </ol>
      </div> <!-- /.breadcrumb-row -->
  </div> <!-- /.breadcrumb-wrap -->
  <div class="container">
    <div class="row">
      <div class="content-main container col-md-19 col-md-push-5">
        <div class="merchant-offer">
          @foreach ($top_offers as $top_offer)
          <div class="stack-item row" data-link="{{$top_offer->link}}" data-title="{{$top_offer->name}}" data-code="{{$top_offer->code}}" data-type="$top_offer->type" data-img="/images/Store-{{$top_offer->store_id}}.png" data-name="{{$top_offer->store_name}}" data-id="{{$top_offer->id}}" data-rule="{{$top_offer->description}}" data-time-verify="{{$top_offer->confirm_date}}" data-time-expire="{{$top_offer->ends}}">
              <div class="offer-con clearfix row">
                <div class="offer-info col-md-5 col-xs-11">
                <a href="{{ url('/loja/'.$top_offer->store_titleslug.'/'.$top_offer->store_id) }}" title="Cupom de Desconto {{$top_offer->store_name}}" target="_blank">
                  <img src="/images/Store-{{$top_offer->store_id}}.png" alt="Cupom de Desconto {{$top_offer->store_name}}">
                </a>
              </div><!-- /.offer-info -->
              <div class="offer-btn col-md-7 col-md-push-12 col-xs-13">
                <p class="end-time">{{$top_offer->ends}}</p>
                @if ($top_offer->type == 'C')
                <a class="offer-popup move-btn" href="#{{$top_offer->id}}" target="_blank">
                  <span class="move-btn-bottom">{{$top_offer->code}}</span>
                  <span class="move-btn-cover">Pegar cupom<i class="move-corner"></i></span>
                </a>
                <button class="move-btn-bottom open-code hidden" type="button">{{$top_offer->code}}</button>
                @else
                <a class="offer-popup offer-nocode btn btn-info" href="#{{$top_offer->id}}" target="_blank">Compre agora</a>
                @endif
              </div>
              <div class="offer-title col-md-12 col-md-pull-7 col-xs-24">
                <h3>
                  <a class="offer-popup" href="#{{$top_offer->id}}" target="_blank">{{$top_offer->name}}</a>
                </h3>
                <div class="discountRule showMore">
                    <p>{{$top_offer->description}}o</p>  
                  <span><i></i></span>
                </div>   
              </div>
            </div>
            </div><!-- /.stack-item -->
            @endforeach
        </div>  <!-- end -->
      </div><!-- /.content-main -->
      <div class="content-side col-md-5 col-md-pull-19">
        <dl monkey="hot_merchant">
          <dt class="title">As lojas mais populares:</dt>     
            @foreach ($top_stores as $top_store)
            <dd><a href="{{ url('/lojas/'.$top_store->titleslug.'/'.$top_store->id) }}">{{$top_store->name}}</a></dd>
            @endforeach   
        </dl>    
      </div><!-- /.content-side -->
    </div><!-- /.row -->
  </div><!-- /.container -->
@endsection
