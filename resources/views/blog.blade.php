@include('include.header')

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

                        <div class="blog-widget widget_search">

                            <div class="sidebar-search-form">

                                <form id="blog-search-form">

                                    <input type="text" id="blog-search-input" placeholder="Search here">

                                    <button type="submit">

                                        <i class="flaticon-search"></i>

                                    </button>

                                </form>

                            </div>

                        </div>

                        <div class="blog-widget">

                            <div class="d-flex justify-content-between align-items-center mb-4">

                                <h4 class="widget-title mb-0">Categories</h4>

                                <a href="{{ route('blog') }}"> <u> All </u></a>

                            </div>

                            <div class="shop-cat-list">

                                <ul class="list-wrap">

                                    @foreach($categories as $cat)

                                    <li class="{{ (isset($category) && $category == $cat) ? 'active' : '' }}">

                                        <a href="{{ route('blog', $cat) }}">

                                            {{ $cat }} <span>({{ $categoryCounts[$cat] ?? 0 }})</span>

                                        </a>

                                    </li>

                                    @endforeach

                                </ul>

                            </div>



                        </div>

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

                        @foreach($blogs as $blog)

                        <div class="col-xl-6 col-lg-6 col-sm-6">

                            <div class="services__item">

                                <div class="services__thumb-wrap">

                                    <div class="services__thumb">

                                        <img alt="img" loading="lazy" width="1000" height="560" decoding="async" style="color:transparent" src="{{ asset($blog->image)}}">

                                        <a class="btn btn-two border-btn" href="{{ route('blog.details', $blog->id ) }}">Read More<i class="fas fa-arrow-up"></i></a>

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

                                        <p>{{ \Illuminate\Support\Str::limit($blog->content, 100) }}</p>

                                    </ul>

                                </div>

                            </div>

                        </div>

                        @endforeach



                    </div>



                </div>

            </div>

        </div>

    </section>









</main>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {

        $('#blog-search-form').on('submit', function(e) {

            e.preventDefault(); // prevent page reload

            let keyword = $('#blog-search-input').val();



            $.ajax({

                url: "{{ route('blog.search') }}", // route for search

                type: "GET",

                data: {
                    keyword: keyword
                },

                success: function(response) {

                    // Clear old blogs

                    let blogContainer = $('.blog-details-area .row .col-lg-8 .row');

                    blogContainer.empty();



                    if (response.blogs.length > 0) {

                        $.each(response.blogs, function(index, blog) {

                            let imageUrl = "{{ asset('') }}" + blog.image;

                            let blogHtml = `

                        <div class="col-xl-6 col-lg-6 col-sm-6">

                            <div class="services__item">

                                <div class="services__thumb-wrap">

                                    <div class="services__thumb">

                                        <img alt="img" loading="lazy" width="1000" height="560" decoding="async" style="color:transparent" src="${imageUrl}">

                                        <a class="btn btn-two border-btn" href="/UAT/public/blog-detail/${blog.id}">Read More<i class="fas fa-arrow-up"></i></a>

                                    </div>

                                    <div class="services__icon"><i class="flaticon-train"></i></div>

                                </div>

                                <div class="services__content">

                                    <h3 class="title"><a href="/UAT/public/blog-detail/${blog.id}">${blog.title}</a></h3>

                                    <span class="date"><i class="flaticon-calendar"></i> ${blog.created_at}</span>

                                    <ul class="service-info d-flex flex-wrap mb-2">

                                        <p>${blog.content_short}</p>

                                    </ul>

                                </div>

                            </div>

                        </div>`;

                            blogContainer.append(blogHtml);

                        });

                    } else {

                        blogContainer.append('<p>No blogs found for this search.</p>');

                    }

                },

                error: function() {

                    alert('Something went wrong!');

                }

            });

        });

    });
</script>

@include('include.footer')