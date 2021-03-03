@extends('layouts.template')

@section('title')
    Berita
@endsection

@section('css')
@endsection

@section('content')
<main class="site-main">
<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="blog">
    <div class="container h-100">
      <div class="blog-banner">
        <div class="text-center">
          <h1>Berita LS</h1>
          <nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Berita LS</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ end banner area ================= -->


  <!--================Blog Categorie Area =================-->
  <section class="blog_categorie_area">
    <div class="container">
        <div class="row">
          <div class="col-sm-12">
              <div class="categories_post">
                  <img class="card-img rounded-0" src="{{asset('img/parallax.png')}}" alt="post">
                  <div class="categories_details">
                      <div class="categories_text">
                          <a href="single-blog.html">
                              <h3 class="text-light">PRESTASI LS SKINCARE</h3>
                          </a>
                          <div class="border_line"></div>
                          <p>DARI LS SKINCARE UNTUK WANITA INDONESIA</p>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
  </section>
  <!--================Blog Categorie Area =================-->

  <!--================Blog Area =================-->
  <section class="blog_area">
      <div class="container">
          <div class="row">
              <div class="col-lg-8">
                  <div class="blog_left_sidebar">
                      @forelse ($news as $row)
                        <article class="row blog_item">
                            <div class="col-md-3">
                                <div class="blog_info text-right">
                                    <ul class="blog_meta list">
                                        <li>
                                            <a href="#">{{ $row->sumber }}
                                                <i class="lnr lnr-user"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">{{ date('d M, Y', strtotime($row->created_at))}}
                                                <i class="lnr lnr-calendar-full"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <img src="{{ asset('storage/news/' . $row->image) }}" alt="{{ $row->title }}">
                                    <div class="blog_details">
                                        <a href="{{ $row->link }}" target="_blank" rel="{{ $row->title }}">
                                            <h2>{{ $row->title }}</h2>
                                        </a>
                                        <p>{{ $row->body }}</p>
                                        <a class="button button-blog" href="{{ $row->link }}" target="_blank" rel="{{ $row->title }}">Lihat Lebih</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                      @empty
                        <div class="col-md-12">
                            <h3 class="text-center">Tidak ada berita</h3>
                        </div>
                      @endforelse
                      {!! $news->links('pagination::customer') !!}
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="blog_right_sidebar">
                      <aside class="single_sidebar_widget search_widget">
                        <form action="{{ route('ls.news') }}" method="get">
                          <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Search Posts" value="{{ request()->q }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="lnr lnr-magnifier"></i>
                                    </button>
                                </span>
                          </div>
                        </form>
                          <!-- /input-group -->
                          <div class="br"></div>
                      </aside>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!--================Blog Area =================-->

</main>
@endsection

@section('js')
@endsection
