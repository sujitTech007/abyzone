@include('include.header')

        <main class="fix">

            <section class="breadcrumb__area breadcrumb__bg position-relative" style="background-image: url('assets/images/bg/breadcrumb_bg.jpg');">

    

                <!-- Gradient Overlay -->

                <div class="breadcrumb-overlay position-absolute top-0 start-0 w-100 h-100"></div>

            

                <div class="container position-relative z-1">

                    <div class="row">

                        <div class="col-12">

                            <div class="breadcrumb__content">

                                <h1 class="title">Contact Us</h1>

                                <nav class="breadcrumb">

                                    <span property="itemListElement" typeof="ListItem"><a href="{{ route('home') }}">Home</a></span>

                                    <span class="breadcrumb-separator"><i class="flaticon-right-arrow"></i></span>

                                    <span property="itemListElement" typeof="ListItem">Contact Us</span>

                                </nav>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

       



            <section class="contact__area section-py-120">

                <div class="container">

                    

                    

                    <div class="row">

                        <div class="col-12">

                            <div class="contact__form-wrap">

                                <h2 class="title">Get in Touch</h2>

                                <div class="row contact-section">

                                    <!-- LEFT: Form (6 cols = half width) -->

                                  

                                    <div class="col-lg-6">



                                      <form class="contact__form" id="contact-form" method="POST" action="{{ route('contact.store') }}">

                                          @csrf



                                        <div class="row g-3">

                                            <div class="col-12">

                                                <h2 class="title contact-heading">Let’s connect constellations</h2>

                                                <p class="contact-p">We’re Here to Help with Your Warehousing and Fulfillment Needs</p>

                                            </div>

                                            </div>

                                        <div class="row g-3">

                                            <div class="col-12">

                                              <div class="form-grp">

                                                <input type="text" placeholder="Name" name="name">

                                              </div>

                                            </div>

                                           

                                            <div class="col-12">

                                              <div class="form-grp">

                                                <input type="email" placeholder="E-mail" name="email">

                                              </div>

                                            </div>

                                            <div class="col-12">

                                              <div class="form-grp">

                                                <input type="number" placeholder="Phone" name="phone">

                                              </div>

                                            </div>

                                            <!-- subject also in two-column split -->

                                            

                                          </div>

                                        <!-- comments full width under -->

                                        <div class="form-grp mt-3">

                                          <textarea name="message" placeholder="Message"></textarea>

                                        </div>

                                        <button type="submit" class="btn red-btn mt-3 w-100 text-center justify-content-center">

                                            Submit

                                            

                                          </button>

                                      </form>

                                    </div>

                                  

                                    <!-- RIGHT: Image (6 cols = half width) -->

                                    <div class="col-lg-6 d-flex align-items-center justify-content-center">

                                      <img src="assets/images/images/contactform-img.png" alt="Contact Visual" class="img-fluid rounded">

                                    </div>

                                  </div>

                                  

                                <p class="ajax-response mb-0"></p>

                            </div>

                        </div>

                    </div>





                </div>



                <!-- <div class="container-fluid">

                    <div class="row">

                        <div class="col-12">

                            <div class="contact-map contact-map-two"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d48409.69813174607!2d-74.05163325136718!3d40.68264649999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25bae694479a3%3A0xb9949385da52e69e!2sBarclays%20Center!5e0!3m2!1sen!2sbd!4v1684309529719!5m2!1sen!2sbd" style="border:0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>

                        </div>

                    </div>

                </div> -->

            </section>

                  </main>

                  @include('include.footer')