@include('include.header')
<style>
    /* Remove unwanted hover border / overlay on blog detail images */
.blog-details-area .services__thumb img,
.blog-details-area .rc-post-thumb img {
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
    transition: none !important;
}

/* Prevent hover color overlay */
.blog-details-area .services__thumb::before,
.blog-details-area .services__thumb::after,
.blog-details-area .rc-post-thumb::before,
.blog-details-area .rc-post-thumb::after {
    display: none !important;
}

/* Disable image hover transform if any */
.blog-details-area .services__thumb:hover img,
.blog-details-area .rc-post-thumb:hover img {
    transform: none !important;
    filter: none !important;
    box-shadow: none !important;
}

</style>
<main class="fix">
    <section class="breadcrumb__area breadcrumb__bg position-relative"
        style="background-image: url('assets/images/bg/breadcrumb_bg.jpg');">

        <!-- Gradient Overlay -->
        <div class="breadcrumb-overlay position-absolute top-0 start-0 w-100 h-100"></div>

        <div class="container position-relative z-1">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h1 class="title">Blog Detail</h1>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem"><a
                                    href="{{ route('home') }}">Home</a></span>
                            <span class="breadcrumb-separator"><i class="flaticon-right-arrow"></i></span>
                            <span property="itemListElement" typeof="ListItem">Blog Detail</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="blog-details-area section-py-120 blog-detailresponsive">
        <div class="container">
            <div class="row">

                <div class="col-lg-4">
                    <aside class="blog-sidebar">
                       
                      
                        <div class="blog-widget">
                            <h4 class="widget-title">Latest Post</h4>
                            @foreach($latestBlogs as $latestBlog)
                            <div class="rc-post-item">
                                <div class="rc-post-thumb"><a href="{{ route('blog.details', $latestBlog->id ) }}"><img alt="img"
                                            loading="lazy" width="392" height="260" decoding="async"
                                            data-nimg="1" style="color:transparent"
                                            src="{{ asset($latestBlog->image) }}"></a>
                                </div>
                                <div class="rc-post-content"><span class="date"><i
                                            class="flaticon-calendar"></i> {{ \Carbon\Carbon::parse($latestBlog->created_at)->format('d M, Y') }}</span>
                                    <h4 class="title"><a href="{{ route('blog.details', $latestBlog->id ) }}">{{ $latestBlog->title }}</a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </aside>
                </div>
                 <div class="col-lg-8">
                    <div class="row">
                
                <div class="">
                    <div class="services__item">
                        <div class="services__thumb-wrap">
                            <div class="services__thumb">
                                <img alt="img" loading="lazy" width="1000" height="560" decoding="async" src="{{ asset($blog->image)}}">
                                
                            </div>
                            <div class="services__icon"><i class="flaticon-train"></i></div>
                        </div>
                        <div class="services__content">
                            <h3 class="title"><a href="{{ route('blog.details', $blog->id ) }}">{{ $blog->title }}</a></h3>
                            <span class="date">
                                <i class="flaticon-calendar"></i>
                                {{ \Carbon\Carbon::parse($blog->created_at)->format('d M, Y') }}
                            </span>
                            <ul class="service-info d-flex flex-wrap mb-2">
                                <p>{{ $blog->content }}</p>
                            </ul>
                        </div>
                    </div>
                </div>
               
            </div>
            
            </div>
            </div>
        </div>
    </section>




</main>
@include('include.footer')