@extends('layouts.base')
<?php $title = 'Cupom de Desconto '.$store->name.': 25% Desconto'; ?>
<?php $description = 'Cupom de Desconto '.$store->name.' válido para '.date("m-Y").'. Além disso, receba de volta parte do valor da compra. Grátis!'; ?>
@section('title', $title)
@section('description', $description)
@section('cssname','merchant')
@section('canonical',url('/lojas/'.$store->titleslug.'/'.$store->id))
@section('content')
@include('layouts.header')
	<div class="breadcrumb-wrap container">
    <div class="breadcrumb-row">
        <ol class="breadcrumb">
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('/lojas/') }}">Lojas</a></li>
          <li class="active">{{$store->name}}</li>
        </ol>
      </div> <!-- /.breadcrumb-row -->
  </div> <!-- /.breadcrumb-wrap -->
  <div class="container">
    <div class="row">
      <div class="content-main container col-md-19 col-md-push-5">
        <div class="merchant-title">
          <h1>
            Cupom de Desconto <strong>{{$store->name}}</strong> 
          </h1>
        </div>
        <div class="merchant-offer">
            @foreach ($store->offers as $offer)
            @if ($offer->status == '1')
            <div class="stack-item row" data-link="{{$offer->link}}" data-title="{{$offer->name}}" data-code="{{$offer->code}}" data-type="$offer->type" data-img="/images/Store-{{$store->id}}.png" data-name="{{$store->name}}" data-id="{{$offer->id}}" data-rule="{{$offer->description}}" data-time-verify="{{$offer->confirm_date}}" data-time-expire="{{$offer->ends}}">
                <div class="offer-con clearfix row">
                  <div class="offer-info col-md-5 col-xs-11 ">
                    @if ($offer->type == 'C')
                    <p class="show-discount">
                      <a class="offer-popup" href="#{{$offer->id}}" target="_blank">
                        <strong class="glyphicon glyphicon-tags"></strong>
                          <span>Códigos</span>
                      </a>
                    </p>
                    @else
                    <p class="show-normal">
                      <a class="offer-popup">
                        <strong class="glyphicon glyphicon-tags"></strong>
                          <span>oferta</span>
                      </a>
                    </p>
                    @endif
                    <p class="offer-status offer-status-"></p>
                  </div>
                  <div class="offer-btn col-md-7 col-md-push-12 col-xs-13">
                    <p class="end-time">{{$offer->ends}}</p>
                      @if ($offer->type == 'C')
                      <a class="offer-popup move-btn" href="#{{$offer->id}}" target="_blank">
                        <span class="move-btn-bottom">{{$offer->code}}</span>
                        <span class="move-btn-cover">Pegar cupom <i class="move-corner"></i></span>
                      </a>
                      <button class="move-btn-bottom open-code hidden" type="button">{{$offer->code}}</button>
                      @else
                      <a class="offer-popup offer-nocode btn btn-info" href="#{{$offer->id}}" target="_blank">Compre agora</a>
                      @endif
                  </div>
                  <div class="offer-title col-md-12 col-md-pull-7 col-xs-24">
                    <p class="verify">Verificado: {{$offer->confirm_date}}</p>
                    <h3>
                      <a class="offer-popup" href="#{{$offer->id}}" target="_blank">{{$offer->name}}</a>
                    </h3>
                    <div class="discountRule showMore">
                        <p>{{$offer->description}}</p>
                      <span><i></i></span>
                    </div>   
                  </div>
                </div> <!-- /.offer-con --> 
                <div class="clearfix row">
                  <div class="col-sm-5 col-xs-12">
                  </div>
                  <div class="col-sm-7 col-sm-push-12 col-xs-12">
                    <a class="view-detail offer-popup" href="{{ url('/cupons/'.$store->id.'/'.$offer->id) }}" target="_blank">Ver mais detalhes</a>
                  </div>
                  <div class="offer-favorite col-sm-12 col-sm-pull-7 col-xs-24">
                  </div>  <!-- /.offer-favorite-->  
                </div> <!-- /.row --> 
              </div><!-- /.stack-item -->
              @endif
              @endforeach
        </div><!-- /.merchant-offer -->
        
          <div class="recommend">
            <h2>Melhores ofertas e cupons das categorias mais populares:</h2>
              @foreach ($top_offers as $top_offer)
              <div class="stack-item row" data-link="{{$top_offer->link}}" data-title="{{$top_offer->name}}" data-code="{{$top_offer->code}}" data-type="$top_offer->type" data-img="/images/Store-{{$top_offer->store_id}}.png" data-name="{{$top_offer->store_name}}" data-id="{{$top_offer->id}}" data-rule="{{$top_offer->description}}" data-time-verify="{{$top_offer->confirm_date}}" data-time-expire="{{$top_offer->ends}}">
                <div class="offer-con clearfix row">
                  <div class="offer-info col-md-5  col-xs-11">
                    <a class="offer-popup" href="{{ url('/lojas/'.$top_offer->store_titleslug.'/'.$top_offer->store_id) }}" title="Cupom de Desconto {{$top_offer->store_name}}" target="_blank">
                      <img src="/images/Store-{{$top_offer->store_id}}.png" alt="Cupom de Desconto {{$top_offer->store_name}}">
                    </a>
                  </div><!-- /.offer-info -->
                  <div class="offer-btn col-md-7 col-md-push-12 col-xs-13">
                    <p class="end-time">{{$top_offer->ends}}</p>
                    @if ($top_offer->type == 'C')
                    <a class="offer-popup move-btn" href="#{{$top_offer->id}}" target="_blank">
                        <span class="move-btn-bottom">{{$top_offer->code}}</span>
                        <span class="move-btn-cover">Pegar cupom <i class="move-corner"></i></span>
                      </a>
                    @else
                    <a class="offer-popup offer-nocode btn btn-info" href="{{ url('/lojas/'.$top_offer->store_titleslug.'/'.$top_offer->store_id) }}" target="_blank">Compre agora</a>
                    @endif
                  </div>
                  <div class="offer-title col-md-12 col-md-pull-7 col-xs-24">
                    <h3>
                      <a class="offer-popup" href="{{ url('/lojas/'.$top_offer->store_titleslug.'/'.$top_offer->store_id) }}" target="_blank">{{$top_offer->name}}</a>
                    </h3>
                    <div class="discountRule showMore">
                      
                        <p>{{$top_offer->description}}</p>  
                      
                      <span><i></i></span>
                    </div>   
                  </div>
                </div><!-- /.offer-con -->  
              </div><!-- /.stack-item -->
              @endforeach
          </div><!-- /.recommend -->  
      </div><!-- /.content-main -->

      <div class="content-side col-md-5 col-md-pull-19">
        <div class="merchant-pic" monkey="top_go_merchant">
          <span>
            <img src="/images/Store-{{$store->id}}.png" alt="Cupom de Desconto {{$store->name}}">
            @if (strstr($store->link,'http'))
            <a href="{{$store->link}}" target="_blank" rel="nofollow">Ir para {{$store->name}} <i class="glyphicon glyphicon-export"></i></a>
            @else
            <a href="http://{{$store->link}}" target="_blank" rel="nofollow">Ir para {{$store->name}} <i class="glyphicon glyphicon-export"></i></a>
            @endif
          </span>
        </div>
        <div class="merchant-des" monkey="merchant_intro">
          <h3 class="title">Sobre {{$store->name}}</h3>
          <div class="merchant-intro">
              <div class="summary">{{$store->description}}</div>
          </div>
        </div><!-- /.merchant-intro -->
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
