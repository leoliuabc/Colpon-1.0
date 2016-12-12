  <div class="header">
    <div class="header-container container">
      <div class="row">
        <div class="site-logo col-lg-5 col-xs-12">
          <a href="{{ url('/') }}" rel="nofollow">
            <img src="/img/logo-white-186x74.png" alt="Colpon">
          </a>
        </div> <!-- /.site-logo -->
      </div><!-- /.row -->

      <div class="row site-search">
        <div class="col-md-16 col-md-offset-4">
          <h2>Procure sua loja favorita</h2>
          <form class="form-inline" action="/search" method="GET">
            <div class="form-group">
              <input name="q" class="form-control q E-search-input" placeholder="Submarino, Netshoes, AliExpress…" type="text">
            </div>
            <button type="submit" class="btn btn-default glyphicon glyphicon-search"></button>
          </form>
        </div>
      </div><!-- /.site-search -->
      <div class="row">
        <div class="index-dropdown col-md-16 col-md-offset-4">
          <ul class="bigNav hidden-xs clearfix">
            <li class="nav-list"><a class="nav-sort" href="{{ url('/lojas/') }}">Lojas</a></li>
            <li class="nav-list"><a class="nav-sort" href="{{ url('/cupons/') }}">Cupons</a></li>
          </ul><!-- /.nav -->
        </div>
      </div>  
    </div><!-- /.container -->
  </div>  <!-- /.header -->
