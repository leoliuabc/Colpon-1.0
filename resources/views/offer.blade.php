@extends('layouts.base')
@section('title', $offer->name)
@section('description', $offer->description)
@section('cssname','offer')
@section('canonical',url('/cupons/'.$store->id.'/'.$offer->id))
@section('content')
@include('layouts.header')
  <div class="breadcrumb-wrap container">
    <div class="breadcrumb-row">
        <ol class="breadcrumb">
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('/lojas/') }}">Lojas</a></li>
          <li><a href="{{ url('/lojas/'.$store->titleslug.'/'.$store->id) }}">{{$store->name}}</a></li>
          <li class="active">{{$offer->name}}</li>
        </ol>
      </div> <!-- /.breadcrumb-row -->
  </div> <!-- /.breadcrumb-wrap -->

  <div class="content container">
    <div class="offer-con">
      <div class="row">
        <div class="merchant col-sm-6">
          <div class="merchant-pic" monkey="top_go_merchant">
            <span class="pic">
              <img src="/images/Store-{{$store->id}}.png" alt="Pontofrio">
              <a href="{{$store->link}}" target="_blank" rel="nofollow">Ir para Pontofrio <i class="glyphicon glyphicon-export"></i></a>
            </span>
          </div><!-- /.merchant-pic -->
          <p class="more" monkey="view_all_offer">
            <a href="{{ url('/lojas/'.$store->titleslug.'/'.$store->id) }}" target="_blank">Veja todos os cupons »</a>
          </p>
        </div><!-- /.merchant -->
        <div class="offer-info stack-item col-sm-18">
          <h1 class="lead" monkey="offer_couponURL_title">
            <a class="title" href="{{$offer->link}}" target="_blank" rel="nofollow">{{$offer->name}}</a>
          </h1>
          <p class="border"></p>
            @if ($offer->type == 'C')
            <div class="code">
              <p class="code-row">
                <strong id="clipboard_text" class="code-text">{{$offer->code}}</strong>
                <button class="code-btn btn btn-info btn-lg" data-clipboard-target="clipboard_text" type="button" role="button">Copiar</button>
              </p>
              <p class="copy-tip" monkey="offer_couponURL">{{$offer->description}}<a href="{{$offer->link}}" target="_blank" rel="nofollow">na {{$store->name}}</a></p>
            </div>
            @else
            <p class="nocode">{{$offer->description}}<a href="{{$offer->link}}" target="_blank" rel="nofollow">na {{$store->name}}</a> </p>
            @endif
          <p class="rule">
            <em>Detalhes e exclusões:</em>
            <strong>
              <span>{{$offer->description}}</span>
            </strong>
          </p>
          <p class="other">
            <strong>Verificado: {{$offer->confirm_date}}</strong>
              &nbsp;&nbsp;&nbsp;▪&nbsp;&nbsp;&nbsp;
            <span class="end-time">Validade: {{$offer->ends}}</span>
          </p>
        </div> <!-- /.offer-info -->
      </div> <!-- /.row -->
    </div> <!-- /.offer-con -->
  </div> <!-- /.content -->


    <div class="offer-list container">
      <div class="row">
        <div class="col-sm-20 col-xs-24">
          <h2 class="block-title">Você também pode gostar dos cupons das lojas abaixo:</h2>
        </div>
      </div>
      <div class="row">
        <ul>
        @foreach ($top_offers as $top_offer)
          <li class="stack-item item col-md-6 col-sm-8 col-xs-12" data-link="{{$top_offer->link}}" data-title="{{$top_offer->name}}" data-code="{{$top_offer->code}}" data-type="$top_offer->type" data-img="/images/Store-{{$top_offer->store_id}}.png" data-name="{{$top_offer->store_name}}" data-id="{{$top_offer->id}}" data-rule="{{$top_offer->description}}" data-time-verify="{{$top_offer->confirm_date}}" data-time-expire="{{$top_offer->ends}}">
            <div class="stack-item-con">
              <a class="pic" href="{{ url('/lojas/'.$top_offer->store_titleslug.'/'.$top_offer->store_id) }}" title="Cupom de Desconto {{$top_offer->store_name}}" target="_blank">
                <img src="/images/Store-{{$top_offer->store_id}}.png" alt="Cupom de Desconto {{$top_offer->store_name}}">
              </a>
              <p class="offer-title">
                <a class="offer-title-con offer-popup" href="{{ url('/cupons/'.$top_offer->store_id.'/'.$top_offer->id) }}" title="Cupom de Desconto {{$top_offer->store_name}}" target="_blank">{{$top_offer->name}}</a>
                <span class="blank-empty"></span>
              </p>
              <p>
              @if ($top_offer->type =='C')
                <a class="offer-popup btn btn-info" href="{{ url('/cupons/'.$top_offer->store_id.'/'.$top_offer->id) }}" title="Cupom de {{$top_offer->store_name}}" target="_blank">Pegar cupom</a>
              @else
                <a class="offer-nocode offer-popup btn btn-info" href="{{ url('/cupons/'.$top_offer->store_id.'/'.$top_offer->id) }}" title="Cupom de Desconto {{$top_offer->store_name}}" target="_blank">Compre agora</a>
              @endif
              </p>
              <a class="more-offer" href="{{ url('/lojas/'.$top_offer->store_titleslug.'/'.$top_offer->store_id) }}">Veja todos os cupons »</a>
            </div>
          </li>
        @endforeach
        </ul>
      </div> <!-- /.row -->
    </div> <!-- /.offer-list -->



    <div class="merchant-list">
    <div class="container">
      <div class="row">
        <div class="col-sm-20 col-xs-24">
          <h2 class="block-title">Veja algumas de nossas principais lojas:</h2>
        </div>
      </div>
      <div class="row" monkey="merchant_list">
        <ul class="clearfix">
          @foreach ($top_stores as $top_store)
            <li>
              <div>
                <a href="{{ url('/lojas/'.$top_store->titleslug.'/'.$top_store->id) }}" title="Cupom de desconto {{$top_store->name}}">
                  <img src="/images/Store-{{$top_store->id}}.png" alt="Cupom de desconto {{$top_store->name}}">
                </a>
              </div>
            </li>
          @endforeach
        </ul>
      </div><!-- /.row -->
    </div><!-- /.container -->
  </div><!-- /.merchant-list -->

@endsection
