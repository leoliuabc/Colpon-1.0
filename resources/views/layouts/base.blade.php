<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Colpon</title>
    <meta name="description" content="@yield('description')">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" media="all">
<link rel="stylesheet" type="text/css" href="/css/base.css" media="all">
<link rel="stylesheet" type="text/css" href="/css/@yield('cssname').css" media="all">
<link rel="canonical" href="@yield('canonical')" />
</head>
<body>
@yield('content')
  <div class="footer">
    <div class="container">
      <div class="row">
        <div class="quick-link col-sm-12 col-md-6 col-md-push-6">
          <h4>Links rápidos:</h4>
          <ul class="clearfix">
            <li><a href="/">Home</a></li>
            <li><a href="/cupons">Cupons</a></li>
            <li><a href="/lojas">Lojas</a></li>
          </ul>
        </div>
        <div class="quick-link col-sm-12 col-md-6 col-md-push-6">
          <h4>Temas especiais:</h4>
          <ul class="clearfix">
            <li><a href="#">Dia das Mães</a></li>
            <li><a href="#">Dia dos Namorados</a></li>
            <li><a href="#">Chrome Extensão</a></li>
          </ul>
        </div>
        <div class="bottom-fb col-xs-12 col-xs-push-12 col-sm-12 col-sm-push-12 col-md-6 col-md-push-6">
          <div class="fb-like-box-wrap">
          </div>
        </div>
        <div class="site-des col-xs-12 col-xs-pull-12 col-sm-12 col-sm-pull-12 col-md-6 col-md-pull-18">
          <p>
            <img class="img-responsive" src="/img/logo-white-186x74.png" alt="Colpon">
          </p>
          <p class="des">Colpon é um amigo do bolso, pegue descontos e ganhe cashbacks sem precisar sair do sofá.</p>
        </div>
      </div><!-- /.row -->
      <div class="row bottom">
          <p>© Copyright 2015-<?php echo date('Y'); ?>. Todos os direitos reservados.</p>
      </div><!-- /.bottom -->
    </div><!-- /.container -->
  </div><!-- /.footer -->
  <!--offerPopup-->
  <div class="modal" id="offerPopup" tabindex="-1" role="dialog" aria-labelledby="offerPopupLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <div class="code">
            <p class="code-row">
              <strong id="clipboard_text" class="code-text"></strong>
              <button class="code-btn btn btn-info btn-lg" data-clipboard-target="clipboard_text" type="button" role="button">Copiar</button>
            </p>
            <p class="copy-tip">Copie este código e cole no carrinho de compras do site <a class="merchant-link" href="#" target="_blank" rel="nofollow">na Colpon</a></p>
          </div><!-- /.code -->
          <div class="nocode">
            <p>Desconto ativado! Entre aqui para obter o desconto <a class="merchant-link" href="#" target="_blank" rel="nofllow">na Colpon</a></p>
          </div> <!-- /.nocode -->
          <div class="mer_logo">
            <p class="pic-title">
              <a class="merchant-link" href="#" target="_blank" rel="nofollow">
                <img src="" alt="">
              </a>
              <span></span>
              <strong class="offer-title lead">
                <a class="merchant-link con" href="#" target="_blank" rel="nofollow"></a>
              </strong>
            </p>
            <p class="rule">
              <em>Detalhes e exclusões: &nbsp;&nbsp;</em>
              <strong><span></span></strong>
            </p>
            <div class="offer-favorite" data-id="">
              <p class="info">
                <strong class="like-percent">100% Sucesso</strong> 
                <strong class="verify">Verificado </strong>
                <strong class="expire"></strong>
              </p>
              <div class="vote-popup">
                <p class="lead">Obrigado pelo feedback!</p>
                <p>Cada voto ajuda a outros consumidores.</p>
                <button type="button" class="close"><span aria-hidden="true">×</span></button>
              </div>
            </div>
          </div>
        </div><!-- /.modal-header -->
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /#offerPopup -->
  <script src="/js/ZeroClipboard.js"></script>
  <script src="/js/copymain.js"></script>
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/base-response.js"></script>
  <script type="text/javascript">
  $(function(){
      var popID = conf.locationHash,targetItem,top,noHost;
      if(popID&&popID!='_=_'){
        targetItem = $('.stack-item[data-id='+popID+']'); 
        if(targetItem.length){
          setTimeout(function(){  
            top = targetItem.offset().top -200;
            $('body,html').animate({scrollTop:top+'px'},300);
            conf.popup.offerPopup(targetItem);      
            $('#offerPopup').modal('show');     
          },50);  
          targetItem.find('.move-btn').addClass('hidden');
          targetItem.find('.open-code').removeClass('hidden');
        }
      }
    });
    $('.offer-popup').click(function(event){   
      var me = $(this),
          obj = me.parents('.stack-item'),
          monkey = '';
      monkey = me.parents("[monkey]").attr('monkey') || 'other';  
      conf.popup.init(obj,monkey);
    });
    $('.stack-item .discountRule').click(function(){
      $(this).toggleClass('showMore');
    });
  </script>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-5X9HR4"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5X9HR4');</script>
<!-- End Google Tag Manager -->
</body>
</html>
