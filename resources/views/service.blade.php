@include('include.header')

        <main class="fix">

            <section class="breadcrumb__area breadcrumb__bg position-relative" style="background-image: url('assets/images/bg/breadcrumb_bg.jpg');">

    

                <!-- Gradient Overlay -->

                <div class="breadcrumb-overlay position-absolute top-0 start-0 w-100 h-100"></div>

            

                <div class="container position-relative z-1">

                    <div class="row">

                        <div class="col-12">

                            <div class="breadcrumb__content">

                                <h1 class="title">Our Services</h1>

                                <nav class="breadcrumb">

                                    <span property="itemListElement" typeof="ListItem"><a href="{{ route('home') }}">Home</a></span>

                                    <span class="breadcrumb-separator"><i class="flaticon-right-arrow"></i></span>

                                    <span property="itemListElement" typeof="ListItem">Our Services</span>

                                </nav>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

       





            <section class="services__area fix">

                <div class="container">

                    

                    <div class="row gutter-24 justify-content-center">

                        

                        @foreach($services as $service)

                        <div class="col-xl-3 col-lg-4 col-sm-6">

                            <div class="services__item">

                                <div class="services__thumb-wrap">

                                    <div class="services__thumb"><img alt="img" loading="lazy" width="1000" height="560" decoding="async" data-nimg="1" style="color:transparent" src="{{ asset($service->image)}}"><a class="btn btn-two border-btn" href="{{ route('service.detail', $service->slug)}}">Read More<i class="fas fa-arrow-up" ></i></a></div>

                                    <div class="services__icon"><i class="flaticon-train"></i></div>

                                </div>

                                <div class="services__content">

                                    <h3 class="title"><a href="{{ route('service.detail', $service->slug)}}">{{ $service->title}}</a>

                                    </h3>

                                    <p>{{  \Illuminate\Support\Str::limit($service->description, 120) }}</p>

                                </div>

                            </div>

                        </div>

                        @endforeach

                       

                        

                    </div>

                

                   

                      

                </div>

                <div class="services__shape-wrap"><img alt="shape" loading="lazy" width="201" height="200" decoding="async" data-nimg="1" class="rotateme" style="color:transparent" src="assets/images/images/image0d9a.png"><img alt="shape" data-aos="fade-right" data-aos-delay="400" loading="lazy" width="191" height="192" decoding="async" data-nimg="1" style="color:transparent" src="assets/images/images/imageb916.png">

                </div>

            </section>

                  </main>

                 @include('include.footer')