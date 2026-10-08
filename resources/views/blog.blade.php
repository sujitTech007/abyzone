@include('include.header')
<section class="hero inner-hero">

        <div class="container">

            <div class="hero-content p-0">

                <div class="eyebrow">
                    Our Blog 
                </div>

                <h1>
                    Logistics Insights
        <br>
        <span>That Move Business Forward</span>
                </h1>

                <p class="hero-description text-white">
                    Stay ahead with expert advice, industry insights, and the latest trends
        in warehousing, fulfillment, transportation, and supply chain solutions.
                </p>

               
            </div>

        </div>

    </section>



<section class="py-5 blog-page">
    <div class="container">
        <div class="row g-4 g-lg-5">

            {{-- =========================
                SIDEBAR
            ========================== --}}
            <div class="col-lg-4 col-xl-3">
                <aside class="blog-sidebar">

                    {{-- Search --}}
                    <div class="blog-widget mb-4">
                        <h4 class="widget-title">Search</h4>

                        <div class="sidebar-search-form mt-2">
                            <form id="blog-search-form">
                                <div class="input-group">
                                    <input
                                        type="text"
                                        id="blog-search-input"
                                        class="form-control"
                                        placeholder="Search here"
                                        autocomplete="off">

                                    <button
                                        type="submit"
                                        class="btn theme_btn">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                    {{-- Categories --}}
                    <div class="blog-widget mb-4">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="widget-title mb-0">
                                Categories
                            </h4>

                            <a href="{{ route('blog') }}" class="blog-all-link">
                                <u>All</u>
                            </a>
                        </div>

                        <div class="shop-cat-list">
                            <ul class="list-wrap list-unstyled mb-0">

                                @foreach($categories as $cat)

                                    <li class="{{ (isset($category) && $category == $cat) ? 'active' : '' }}">
                                        <a href="{{ route('blog', $cat) }}"
                                           class="d-flex justify-content-between align-items-center">

                                            <span>{{ $cat }}</span>

                                            <span class="category-count">
                                                ({{ $categoryCounts[$cat] ?? 0 }})
                                            </span>

                                        </a>
                                    </li>

                                @endforeach

                            </ul>
                        </div>

                    </div>


                    {{-- Latest Posts --}}
                    <div class="blog-widget">

                        <h4 class="widget-title mb-4">
                            Latest Post
                        </h4>

                        @foreach($latestBlogs as $latestBlog)

                            <div class="latest-post-item d-flex gap-3 mb-3">

                                <a
                                    href="{{ route('blog.details', $latestBlog->id) }}"
                                    class="latest-post-image flex-shrink-0">

                                    <img
                                        src="{{ asset($latestBlog->image) }}"
                                        alt="{{ $latestBlog->title }}"
                                        loading="lazy">
                                </a>

                                <div class="latest-post-content">

                                    <span class="latest-post-date fs-10">
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


            {{-- =========================
                BLOG LIST
            ========================== --}}
            <div class="col-lg-8 col-xl-9">

                <div id="blog-container" class="row g-4">

                    @foreach($blogs as $blog)

                        <div class="col-md-4">

                            <article class="blog-card h-100">

                                {{-- Image --}}
                                <div class="blog-image-wrapper">

                                    <a href="{{ route('blog.details', $blog->id) }}">
                                        <img
                                            src="{{ asset($blog->image) }}"
                                            alt="{{ $blog->title }}"
                                            class="blog-image"
                                            loading="lazy">
                                    </a>

                                    <div class="blog-date">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        {{ \Carbon\Carbon::parse($blog->created_at)->format('d M, Y') }}
                                    </div>

                                </div>


                                {{-- Content --}}
                                <div class="blog-card-body">

                                    <div class="blog-meta">
                                        <span>
                                            <i class="far fa-clock me-1"></i>
                                            5 Min Read
                                        </span>
                                    </div>

                                    <h3 class="blog-card-title">
                                        <a href="{{ route('blog.details', $blog->id) }}">
                                            {{ $blog->title }}
                                        </a>
                                    </h3>

                                    <p class="blog-excerpt">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 120) }}
                                    </p>

                                    <a
                                        href="{{ route('blog.details', $blog->id) }}"
                                        class="blog-read-more">

                                        Read More

                                        <span>
                                            <i class="fas fa-arrow-right"></i>
                                        </span>

                                    </a>

                                </div>

                            </article>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    $('#blog-search-form').on('submit', function (e) {

        e.preventDefault();

        let keyword = $('#blog-search-input').val().trim();

        let blogContainer = $('#blog-container');

        // Empty search par normal page reload
        if (keyword === '') {
            window.location.href = "{{ route('blog') }}";
            return;
        }

        // Optional loading
        blogContainer.html(`
            <div class="col-12 text-center py-5">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `);

        $.ajax({

            url: "{{ route('blog.search') }}",

            type: "GET",

            data: {
                keyword: keyword
            },

            success: function (response) {

                blogContainer.empty();

                if (response.blogs && response.blogs.length > 0) {

                    $.each(response.blogs, function (index, blog) {

                        let imageUrl = "{{ asset('') }}" + blog.image;

                        let detailUrl = "{{ url('/blog-detail') }}/" + blog.id;

                        let createdDate = formatDate(blog.created_at);

                        let content = blog.content_short
                            ? blog.content_short
                            : '';

                        let blogHtml = `

                            <div class="col-md-6">

                                <article class="blog-card h-100">

                                    <div class="blog-image-wrapper">

                                        <a href="${detailUrl}">
                                            <img
                                                src="${imageUrl}"
                                                alt="${escapeHtml(blog.title)}"
                                                class="blog-image"
                                                loading="lazy">
                                        </a>

                                        <div class="blog-date">
                                            <i class="far fa-calendar-alt me-1"></i>
                                            ${createdDate}
                                        </div>

                                    </div>

                                    <div class="blog-card-body">

                                        <div class="blog-meta">
                                            <span>
                                                <i class="far fa-clock me-1"></i>
                                                5 Min Read
                                            </span>
                                        </div>

                                        <h3 class="blog-card-title">
                                            <a href="${detailUrl}">
                                                ${escapeHtml(blog.title)}
                                            </a>
                                        </h3>

                                        <p class="blog-excerpt">
                                            ${escapeHtml(content)}
                                        </p>

                                        <a
                                            href="${detailUrl}"
                                            class="blog-read-more">

                                            Read More

                                            <span>
                                                <i class="fas fa-arrow-right"></i>
                                            </span>

                                        </a>

                                    </div>

                                </article>

                            </div>

                        `;

                        blogContainer.append(blogHtml);
                    });

                } else {

                    blogContainer.html(`
                        <div class="col-12">
                            <div class="text-center py-5">
                                <h4>No blogs found</h4>
                                <p class="text-muted mb-0">
                                    No blogs found for "${escapeHtml(keyword)}".
                                </p>
                            </div>
                        </div>
                    `);
                }
            },

            error: function () {

                blogContainer.html(`
                    <div class="col-12">
                        <div class="alert alert-danger">
                            Something went wrong. Please try again.
                        </div>
                    </div>
                `);
            }
        });
    });


    // Format date
    function formatDate(dateString) {

        if (!dateString) {
            return '';
        }

        let date = new Date(dateString);

        if (isNaN(date.getTime())) {
            return dateString;
        }

        let day = String(date.getDate()).padStart(2, '0');

        let monthNames = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];

        let month = monthNames[date.getMonth()];

        let year = date.getFullYear();

        return `${day} ${month}, ${year}`;
    }


    // Prevent HTML injection in AJAX response
    function escapeHtml(text) {

        if (!text) {
            return '';
        }

        return $('<div>').text(text).html();
    }

});
</script>

@include('include.footer')