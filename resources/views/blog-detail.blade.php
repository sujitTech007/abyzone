@include('include.header')



<section class="blog-details-page py-5">

    <div class="container">

        <div class="row g-4 g-lg-5">

            {{-- =========================================
                SIDEBAR
            ========================================== --}}
            <div class="col-lg-4 col-xl-3">

                <aside class="blog-sidebar">

                    <div class="blog-widget">

                        <h4 class="widget-title mb-4">
                            Latest Post
                        </h4>

                        @foreach($latestBlogs as $latestBlog)

                            <div class="latest-post-item d-flex gap-3 mb-3">

                                {{-- Image --}}
                                <a
                                    href="{{ route('blog.details', $latestBlog->id) }}"
                                    class="latest-post-image flex-shrink-0">

                                    <img
                                        src="{{ asset($latestBlog->image) }}"
                                        alt="{{ $latestBlog->title }}"
                                        loading="lazy">
                                </a>


                                {{-- Content --}}
                                <div class="latest-post-content">

                                    <span class="latest-post-date">
                                        <i class="far fa-calendar-alt me-1"></i>

                                        {{ \Carbon\Carbon::parse($latestBlog->created_at)->format('d M, Y') }}
                                    </span>

                                    <h5 class="latest-post-title mb-0">

                                        <a href="{{ route('blog.details', $latestBlog->id) }}">
                                            {{ $latestBlog->title }}
                                        </a>

                                    </h5>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </aside>

            </div>


            {{-- =========================================
                BLOG DETAIL
            ========================================== --}}
            <div class="col-lg-8 col-xl-9">

                <article class="blog-detail-card">

                    {{-- Featured Image --}}
                    <div class="blog-detail-image-wrapper">

                        <img
                            src="{{ asset($blog->image) }}"
                            alt="{{ $blog->title }}"
                            class="w-100 h-100 object-fit-cover"
                            loading="lazy">

                    </div>


                    {{-- Blog Content --}}
                    <div class="blog-detail-body">

                        {{-- Meta --}}
                        <div class="blog-meta fs-10 mb-3">

                            <span>
                                <i class="far fa-calendar-alt me-1"></i>

                                {{ \Carbon\Carbon::parse($blog->created_at)->format('d M, Y') }}
                            </span>

                            <span class="ms-3">
                                <i class="far fa-clock me-1"></i>
                                5 Min Read
                            </span>

                        </div>


                        {{-- Title --}}
                        <h1 class="blog-detail-title">

                            {{ $blog->title }}

                        </h1>


                        {{-- Content --}}
                        <p class="blog-detail-content">

                            {!! $blog->content !!}

                        </p>

                    </div>

                </article>

            </div>

        </div>

    </div>

</section>

@include('include.footer')