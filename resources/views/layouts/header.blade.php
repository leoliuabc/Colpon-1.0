  <div class="header">
    <div class="container">
      <div class="row">
        <div class="site-logo col-lg-5 col-xs-12">
          <a href="{{ url('/') }}" rel="nofollow">
            <img class="img-responsive" src="/img/logo-blue-186x74.png" alt="Culpon">
          </a>
        </div> <!-- /.site-logo -->
      </div><!-- /.row -->
      <div class="row">
        <div class="top-search site-search col-md-16 col-md-offset-4 col-xs-24">
          <form class="form-inline" action="/search" method="GET">
            <div class="form-group">
              <input name="q" class="form-control q E-search-input" placeholder="Submarino, Netshoes, AliExpress…" type="text">
            </div>
            <button type="submit" class="btn btn-default glyphicon glyphicon-search"></button>
          </form>
        </div>
      </div><!-- /.row -->
      <ul class="bigNav hidden-xs clearfix">
        <li class="nav-list"><a class="nav-sort" href="{{ url('/lojas/') }}">Lojas</a></li>
        <li class="nav-list"><a class="nav-sort" href="{{ url('/cupons/') }}">Cupons</a></li>
      </ul><!-- /.nav -->
    </div><!-- /.container -->
  </div> <!-- /.header -->