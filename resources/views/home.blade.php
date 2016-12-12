@extends('layouts.base')
@section('title', 'Cupom de Desconto e Dinheiro de Volta')
@section('description', 'Cupom de desconto para economizar e ainda receber parte do dinheiro de volta é só no Colpon. Quer saber como? Acesse agora mesmo!')
@section('cssname','index')
@section('canonical',url('/'))
@section('content')
@include('layouts.homeheader')
	<div class="merchant-list">
		<div class="container">
			<div class="title">
      </div>
			<div class="row">
				<ul>
            @foreach ($top_stores as $key=>$top_store)
            @if ($key<=10)
            <li>
              <div>
                <a href="{{ url('/lojas/'.$top_store->titleslug.'/'.$top_store->id) }}" title="Cupom de desconto {{$top_store->name}}">
                  <img src="/images/Store-{{$top_store->id}}.png" alt="Cupom de desconto {{$top_store->name}}">
                </a>
              </div>
            </li>
            @endif
            @endforeach
          <li class="more-merchant">
            <div>
              <a href="{{ url('/lojas/') }}">
                <i class="glyphicon glyphicon-menu-right"></i>
                <span>Mais Lojas</span>
              </a>
            </div>
          </li>
				</ul>
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.merchant-list -->

	<div class="offer-list">
		<div class="container">
			<div class="row">
				<div class="col-sm-20 col-xs-24">
					<h1 class="block-title">Os melhores cupons de descontos e ofertas online</h1>
				</div>
				<div class="more-sort-offer col-sm-4 col-xs-24">
					<a href="{{ url('/top/') }}" target="_blank">Mais cupons »</a>
				</div>
			</div>
			<div class="row">
				<ul>
          @foreach ($top_offers as $top_offer)
          <li class="offer-item stack-item col-md-6 col-sm-8 col-xs-12" data-link="{{$top_offer->link}}" data-title="{{$top_offer->name}}" data-code="{{$top_offer->code}}" data-type="$top_offer->type" data-img="/images/Store-{{$top_offer->store_id}}.png" data-name="{{$top_offer->store_name}}" data-id="{{$top_offer->id}}" data-rule="{{$top_offer->description}}" data-time-verify="{{$top_offer->confirm_date}}" data-time-expire="{{$top_offer->ends}}">
            <div class="stack-item-con">
              <a class="pic" href="{{ url('/lojas/'.$top_offer->store_titleslug.'/'.$top_offer->store_id) }}" title="Cupom de Desconto {{$top_offer->store_name}}" target="_blank">
                <img src="/images/Store-{{$top_offer->store_id}}.png" alt="Cupom de Desconto {{$top_offer->store_name}}">
              </a>
              <p class="offer-title">
                <a class="offer-title-con offer-popup" href="#{{$top_offer->id}}" title="Cupom de Desconto {{$top_offer->store_name}}" target="_blank">{{$top_offer->name}}</a>
              </p>
              <p>
                @if ($top_offer->type == 'D')
                <a class="offer-nocode offer-popup btn btn-info" href="#{{$top_offer->id}}" title="Cupom de Desconto {{$top_offer->store_name}}" target="_blank">Compre agora</a>
                @else
                <a class="offer-popup btn btn-info" href="#{{$top_offer->id}}" title="Cupom de Desconto {{$top_offer->store_name}}" target="_blank">Pegar cupom</a>
                @endif
              </p>
              <a class="more-offer" href="{{ url('/lojas/'.$top_offer->store_titleslug.'/'.$top_offer->store_id) }}">Veja todos os cupons »</a>
            </div>
          </li>
          @endforeach
				</ul>
			</div><!-- /.row -->
      <div class="offer-list-more row">
        <div class="col-sm-8 col-sm-offset-8" monkey="more-recommend-offer2">
          <a class="btn btn-default" href="{{ url('/cupons/') }}">Mais cupons</a>
        </div>
      </div><!-- /.offer-list-more -->
		</div><!-- /.container -->
	</div><!-- /.offer-list -->
@endsection
