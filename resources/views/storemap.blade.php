@extends('layouts.base')
@section('title', 'Cupom de Desconto e Dinheiro de Volta')
@section('description', 'Cupom de desconto para economizar e ainda receber parte do dinheiro de volta é só no Colpon. Quer saber como? Acesse agora mesmo!')
@section('cssname','merchant-list')
@section('canonical',url('/lojas/'))
@section('content')
@include('layouts.header')
  <div class="content container">
    <div class="breadcrumb-row">
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">Top Lojas</li>
      </ol>
    </div> <!-- /.breadcrumb-row --> 
    <div class="nav-list">
      <ul>
        @foreach ($initials as $value)
        <li><a href="#grp-{{$value->initials}}">{{$value->initials}}</a></li>
        @endforeach
      </ul>
    </div> <!-- /.nav-list -->

    <div class="merchant-list">
      <ul>
        @foreach ($initials as $value)
        <li name="grp-{{$value->initials}}" id="grp-{{$value->initials}}" class="list-item row">
          <div class="title col-xs-4">
            <h3>{{$value->initials}}</h3>
          </div>
          <div class="con col-xs-20">
            <ul>
              @foreach ($stores as $store)
              @if ($value->initials == $store->initials)
              <li>
              <a href="{{ url('/lojas/'.$store->titleslug.'/'.$store->id) }}" target="_blank">{{$store->name}}</a>
              </li>
              @endif
              @endforeach
            </ul>
          </div>
        </li>
        @endforeach
      </ul>
    </div> <!-- /.merchant-list -->
  </div> <!-- /.container -->
@endsection
