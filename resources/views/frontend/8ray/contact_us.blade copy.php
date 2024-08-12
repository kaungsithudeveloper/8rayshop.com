@extends('frontend.8ray.layout.layout')

@section('8ray')

<main class="main">

    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('8ray.frontend') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> Contact
                </div>
            </div>
        </div>
        <div class="page-content pt-50">
            <section class="container mb-50">
                <div class="row">
                    <div class="col-md-12">
                        <div class="map-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d401.4155380580269!2d96.12945916397243!3d16.829842709567394!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c194c9ad607547%3A0x88ce8c9fad1b0ddb!2s8Ray!5e0!3m2!1sen!2sus!4v1719654022720!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </section>
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="mb-50">
                            <div class="row mb-60">
                                <div class="col-md-6 mt-30">
                                    <h4 class="mb-15 text-brand">8Ray (Main)</h4>
                                    No.49, Moe Sandar Street, Kamayut Township<br />
                                    11041, Yamgon<br />
                                    <abbr title="Phone">Phone:</abbr> 09450127303, 09450127304<br />
                                    <abbr title="Email">Email: </abbr>8rayshop@gmail.com<br />
                                </div>
                                <div class="col-md-6 mt-30">
                                    <h4 class="mb-15 text-brand">8Ray (Gamone Pwint)</h4>
                                    No.49, Moe Sandar Street, Kamayut Township<br />
                                    11041, Yamgon<br />
                                    <abbr title="Phone">Phone:</abbr> 09450127303, 09450127304<br />
                                    <abbr title="Email">Email: </abbr>8rayshop@gmail.com<br />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="contact-from-area padding-20-row-col">
                                        <h5 class="text-brand mb-10">Contact form</h5>
                                        <h2 class="mb-10">Drop Us a Line</h2>
                                        <p class="text-muted mb-30 font-sm">Your email address will not be published. Required fields are marked *</p>
                                        <form class="contact-form-style mt-30" id="contact-form" action="#" method="post">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input name="name" placeholder="First Name" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input name="email" placeholder="Your Email" type="email" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input name="telephone" placeholder="Your Phone" type="tel" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input name="subject" placeholder="Subject" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="textarea-style mb-30">
                                                        <textarea name="message" placeholder="Message"></textarea>
                                                    </div>
                                                    <button class="submit submit-auto-width" type="submit">Send message</button>
                                                </div>
                                            </div>
                                        </form>
                                        <p class="form-messege"></p>
                                    </div>
                                </div>

                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>

</main>

@endsection
