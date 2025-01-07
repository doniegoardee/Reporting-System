<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Reporting System</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->

    <link rel="shortcut icon" href="{{ asset('image/logo.jpg') }}" type="image/x-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">


</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top p-2">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="/image/logo.jpg" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h2 class="sitename">Reporting System</h2>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>

                    <li><a href="#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            {{-- <a class="btn-getstarted" href="{{ route('login') }}">Get Started</a> --}}
            {{-- @if (Route::has('login'))
                <div>
                    @auth
                        @if (auth()->user()->role == 'user')
                            <a href="{{ route('home.user') }}" class="btn-getstarted">Get Started</a>
                        @elseif(auth()->user()->role == 'admin-2')
                            <a href="{{ route('admin-2.index') }}" class="btn-getstarted">Get Started</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn-getstarted">Get Started</a>
                    @endauth
                </div>
            @endif --}}
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel"
                data-bs-interval="5000">

                <div class="carousel-item active">
                    <img src="image/sample.jpg" alt="">
                    <div class="carousel-container">
                        <h2 class="text-center">Incident Reporting Buguey Cagayan</h2>
                        <p class="text-center">Empowering Buguey, Cagayan with safer communities. Report incidents
                            quickly, track progress
                            seamlessly, and foster accountability. Together, we create a more secure tomorrow.</p>
                        @if (Route::has('login'))
                            <div>
                                @auth
                                    @if (auth()->user()->role == 'user')
                                        <a href="{{ route('home.user') }}" class="btn-get-started">Get Started</a>
                                    @elseif(auth()->user()->role == 'admin-2')
                                        <a href="{{ route('admin-2.index') }}" class="btn-get-started">Get Started</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn-get-started">Get Started</a>
                                @endauth
                            </div>
                        @endif
                    </div>
                </div><!-- End Carousel Item -->

                <div class="carousel-item">
                    <img src="image/sample3.jpg" alt="">
                    <div class="carousel-container">
                        <h2>Incident Reporting Buguey Cagayan</h2>
                        <p>Incident Reporting Buguey Cagayan – your voice for change and safety. Submit reports with
                            ease and ensure swift resolutions. Building trust, one incident at a time.</p>
                        @if (Route::has('login'))
                            <div>
                                @auth
                                    @if (auth()->user()->role == 'user')
                                        <a href="{{ route('home.user') }}" class="btn-get-started">Get Started</a>
                                    @elseif(auth()->user()->role == 'admin-2')
                                        <a href="{{ route('admin-2.index') }}" class="btn-get-started">Get Started</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn-get-started">Get Started</a>
                                @endauth
                            </div>
                        @endif
                    </div>
                </div><!-- End Carousel Item -->

                <div class="carousel-item">
                    <img src="image/sample2.jpg" alt="">
                    <div class="carousel-container">
                        <h2>Incident Reporting Buguey Cagayan</h2>
                        <p>Your safety, our priority in Buguey, Cagayan. A simple platform to report, resolve, and
                            improve. Strengthening communities through transparency and action.</p>
                        @if (Route::has('login'))
                            <div>
                                @auth
                                    @if (auth()->user()->role == 'user')
                                        <a href="{{ route('home.user') }}" class="btn-get-started">Get Started</a>
                                    @elseif(auth()->user()->role == 'admin-2')
                                        <a href="{{ route('admin-2.index') }}" class="btn-get-started">Get Started</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn-get-started">Get Started</a>
                                @endauth
                            </div>
                        @endif
                    </div>
                </div><!-- End Carousel Item -->

                <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                </a>

                <ol class="carousel-indicators"></ol>

            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>About</h2>
                <p>Incident Reporting Buguey Cagayan is a dedicated platform designed to enhance the safety and security of the Buguey community. It empowers residents to report incidents efficiently, ensuring prompt attention and resolution by local authorities. With features like detailed reporting, progress tracking, and real-time notifications, the system fosters transparency and accountability. Our mission is to create a more secure and united community where every voice is heard and every concern is addressed. Together, we can make Buguey, Cagayan, a safer place for everyone.</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-3">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <img src="/images/reporting.jpg" width="600px" height="600px" alt="" class="img-fluid">
                    </div>

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="about-content ps-0 ps-lg-3">
                            <h3>Our Vision for a Safer Buguey</h3>
                            <p class="fst-italic">
                                Our platform is built to ensure that incidents are reported and resolved in a timely manner, fostering trust between the community and local authorities.
                            </p>
                            <ul>
                                <li>
                                    <i class="bi bi-clipboard-data"></i>
                                    <div>
                                        <h4>Real-time Reporting</h4>
                                        <p>Submit incidents directly from your mobile or computer and receive instant updates on the status of your report.</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle"></i>
                                    <div>
                                        <h4>Progress Tracking</h4>
                                        <p>Track the resolution of your reports and ensure that action is being taken to address the issues raised.</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="bi bi-bell"></i>
                                    <div>
                                        <h4>Real-time Notifications</h4>
                                        <p>Stay informed about updates to your reports with instant notifications, ensuring you never miss important developments.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->


        <!-- Services Section -->
        <section id="services" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Our Services</h2>
                <p>Efficient and user-friendly solutions for managing incidents and improving safety in your community</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row g-5">

                    <!-- Service Item 1: Incident Reporting -->
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item item-cyan position-relative">
                            <i class="bi bi-pencil-square icon"></i>
                            <div>
                                <h3>Simple Incident Reporting</h3>
                                <p>Easily report incidents like theft, vandalism, and disturbances with a simple online form. Your reports are instantly logged into the system for quick processing.</p>
                                <a href="service-details.html" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <!-- Service Item 2: Real-Time Notifications -->
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item item-orange position-relative">
                            <i class="bi bi-bell icon"></i>
                            <div>
                                <h3>Real-Time Notifications</h3>
                                <p>Stay informed with real-time updates on the status of your incident report. Receive notifications for new updates, approvals, and resolutions.</p>
                                <a href="service-details.html" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <!-- Service Item 3: Admin Dashboard -->
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item item-teal position-relative">
                            <i class="bi bi-bar-chart icon"></i>
                            <div>
                                <h3>Admin Dashboard</h3>
                                <p>Our powerful admin dashboard allows you to easily manage and track reported incidents, analyze trends, and resolve issues efficiently.</p>
                                <a href="service-details.html" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <!-- Service Item 4: Chatbot Assistance -->
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item item-red position-relative">
                            <i class="bi bi-chat-dots icon"></i>
                            <div>
                                <h3>24/7 Chatbot Assistance</h3>
                                <p>Our chatbot is available 24/7 to assist with filing incident reports, answering questions, and guiding you through the process seamlessly.</p>
                                <a href="service-details.html" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <!-- Service Item 5: Incident Follow-Up -->
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="service-item item-indigo position-relative">
                            <i class="bi bi-calendar-check icon"></i>
                            <div>
                                <h3>Incident Follow-Up</h3>
                                <p>Track the progress of your reported incidents, from submission to resolution. Receive updates on status changes and any further actions needed.</p>
                                <a href="service-details.html" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <!-- Service Item 6: Secure Data Management -->
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="service-item item-pink position-relative">
                            <i class="bi bi-shield-lock icon"></i>
                            <div>
                                <h3>Secure Data Management</h3>
                                <p>Ensure the privacy and safety of your data. Our system employs top-level security protocols to safeguard your incident reports and personal information.</p>
                                <a href="service-details.html" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section><!-- /Services Section -->


        <!-- Features Section -->
        <section id="features" class="features section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Features</h2>
                <p>Discover the key features of our Online Incident Reporting System that make it easy, efficient, and accessible for everyone.</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4 justify-content-between features-item">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <img src="/images/report.png" width="300px" height="300px" class="img-fluid" alt="Incident Reporting">
                    </div>

                    <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="content">
                            <h3>Easy Incident Reporting</h3>
                            <p>
                                Our system allows users to easily report incidents, providing details such as incident type, location, and severity. The simple, user-friendly interface ensures a quick and efficient reporting process.
                            </p>
                            <a href="#" class="btn more-btn">Learn More</a>
                        </div>
                    </div>

                </div><!-- Features Item -->

                <div class="row gy-4 justify-content-between features-item">

                    <div class="col-lg-5 d-flex align-items-center order-2 order-lg-1" data-aos="fade-up"
                        data-aos-delay="100">

                        <div class="content">
                            <h3>Real-Time Notifications & Status Tracking</h3>
                            <p>
                                Stay informed with real-time notifications and track the status of your incident reports. Whether your report is pending, resolved, or closed, you'll receive updates to keep you in the loop.
                            </p>
                            <ul>
                                <li><i class="bi bi-bell flex-shrink-0"></i> Notifications on status updates.</li>
                                <li><i class="bi bi-file-earmark-check flex-shrink-0"></i> Easily track report status from dashboard.</li>
                                <li><i class="bi bi-geo-alt flex-shrink-0"></i> Location-based incident tracking.</li>
                            </ul>
                            <p></p>
                            <a href="#" class="btn more-btn">Learn More</a>
                        </div>

                    </div>

                    <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
                        <img src="/images/notif.jpg" width="630px" height="300px" class="img-fluid" alt="Tracking Reports">
                    </div>

                </div><!-- Features Item -->

                <div class="row gy-4 justify-content-between features-item">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <img src="images/bot.png" width="300px" height="300px" class="img-fluid" alt="Chatbot Support">
                    </div>

                    <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="content">
                            <h3>Chatbot Assistance</h3>
                            <p>
                                Get instant support with our AI-powered chatbot. The chatbot is available 24/7 to help guide you through the incident reporting process, answer questions, and provide immediate assistance.
                            </p>
                            <a href="#" class="btn more-btn">Learn More</a>
                        </div>
                    </div>

                </div><!-- Features Item -->

            </div>

        </section><!-- /Features Section -->
        <!-- /Features Section -->

        <!-- Why Us Section -->
        {{-- <section id="why-us" class="why-us section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Why Us</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-item">
                            <span>01</span>
                            <h4><a href="" class="stretched-link">Lorem Ipsum</a></h4>
                            <p>Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero
                                placeat</p>
                        </div>
                    </div><!-- Card Item -->

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-item">
                            <span>02</span>
                            <h4><a href="" class="stretched-link">Repellat Nihil</a></h4>
                            <p>Dolorem est fugiat occaecati voluptate velit esse. Dicta veritatis dolor quod et vel dire
                                leno para dest</p>
                        </div>
                    </div><!-- Card Item -->

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-item">
                            <span>03</span>
                            <h4><a href="" class="stretched-link">Ad ad velit qui</a></h4>
                            <p>Molestiae officiis omnis illo asperiores. Aut doloribus vitae sunt debitis quo vel nam
                                quis</p>
                        </div>
                    </div><!-- Card Item -->

                </div>

            </div>

        </section><!-- /Why Us Section --> --}}

        <!-- Portfolio Section -->
        {{-- <section id="portfolio" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Report Incident</h2>
            </div><!-- End Section Title -->

            <div class="container">

                <form action="{{ route('store') }}" method="post" style="border:.1px solid black; padding:15px 15px 15px; border-radius:5px" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="incidenttype" class="form-label">Incident Type</label>
                        <select class="form-select" name="subject_type" id="incidenttype" required>
                            <option value="" disabled selected>Select an incident type</option>
                            @foreach ($incident as $incidenttype)
                                <option value="{{ $incidenttype->name }}">{{ $incidenttype->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <select class="form-select" name="location" id="location" required>
                            <option value="" disabled selected>Select a location</option>
                            @foreach ($barangay as $barangay)
                                <option value="{{ $barangay->barangay }}">{{ $barangay->barangay }}</option>
                            @endforeach
                        </select>
                    </div>

                    <p>Additional Details</p>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="severity" class="form-label">Severity</label>
                            <select class="form-select" name="severity" id="severity">
                                <option value="" disabled selected>Select severity</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="num_affected" class="form-label">Number of People Affected</label>
                            <input type="number" class="form-control" id="num_affected" name="num_affected" min="0">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact Info</label>
                        <input type="tel" name="contact" class="form-control" id="contact" required>
                    </div>

                    <button type="submit" class="btn btn-primary ms-auto">Submit</button>
                </form>


            </div>

        </section><!-- /Portfolio Section --> --}}

        <!-- Faq Section -->
        <section id="faq" class="faq section light-background">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="content px-xl-5">
                            <h3><span>Frequently Asked </span><strong>Questions</strong></h3>
                            <p>
                                Find answers to common questions regarding our Online Incident Reporting System.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">

                        <div class="faq-container">
                            <div class="faq-item faq-active">
                                <h3><span class="num">1.</span> <span>How do I report an incident?</span></h3>
                                <div class="faq-content">
                                    <p>To report an incident, simply log in to your account, navigate to the "Create Report" section, and fill out the required details including the type, location, and description of the incident. Once submitted, your report will be reviewed by the admin.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3><span class="num">2.</span> <span>What types of incidents can I report?</span></h3>
                                <div class="faq-content">
                                    <p>Our system allows you to report various types of incidents such as theft, vandalism, public disturbance, and more. You can select the incident type from a dynamic list when submitting your report.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3><span class="num">3.</span> <span>How can I track the status of my report?</span></h3>
                                <div class="faq-content">
                                    <p>Once your report is submitted, you can log into your dashboard to check the status of your report. The status will update as the report progresses through stages like 'Pending', 'Resolved', or 'Closed'. Notifications will also be sent for status updates.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3><span class="num">4.</span> <span>Can I edit or update my report after submission?</span></h3>
                                <div class="faq-content">
                                    <p>Yes, you can edit your report as long as it has not been marked as "Resolved" or "Closed." If the report is still in the "Pending" state, you can update the details or add additional information.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3><span class="num">5.</span> <span>How do I know if my report has been resolved?</span></h3>
                                <div class="faq-content">
                                    <p>When your report is resolved, you will receive a notification and can see the updated status in your report details. Additionally, once the report is marked as "Closed," you can no longer make changes to it.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                        </div>

                    </div>
                </div>

            </div>

        </section><!-- /Faq Section -->


        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Contact</h2>
                <p>Feel free to reach out to us for any inquiries, assistance, or feedback.
                    Our team is here to help and ensure your questions are addressed promptly.
                    Contact us through the form below or via the provided channels, and we'll
                    respond as soon as possible.Feel free to reach out to us for any inquiries,
                    assistance, or feedback. Our team is here to help and ensure your questions
                    are addressed promptly. Contact us through the form below or via the provided channels,
                    and we'll respond as soon as possible.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-6">

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="200">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3>Address</h3>
                                    <p>Centro pob. Municipality of Buguey</p>
                                    <p>Cetro Buguey Cagayan</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="300">
                                    <i class="bi bi-telephone"></i>
                                    <h3>Call Us</h3>
                                    <p>+1 5589 55488 55</p>
                                    <p>+1 6678 254445 41</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="400">
                                    <i class="bi bi-envelope"></i>
                                    <h3>Email Us</h3>
                                    <p>info@example.com</p>
                                    <p>contact@example.com</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="500">
                                    <i class="bi bi-clock"></i>
                                    <h3>Open Hours</h3>
                                    <p>Monday - Friday</p>
                                    <p>9:00AM - 05:00PM</p>
                                </div>
                            </div><!-- End Info Item -->

                        </div>

                    </div>

                    {{-- <div class="col-lg-6">
                        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                            data-aos-delay="200">
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Your Name" required="">
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Your Email" required="">
                                </div>

                                <div class="col-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject"
                                        required="">
                                </div>

                                <div class="col-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                </div>

                                <div class="col-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit">Send Message</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form --> --}}

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer dark-background">

        {{-- <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <h4>Join Our Newsletter</h4>
                        <p>Subscribe to our newsletter and stay updated on new features and improvements to our reporting system!</p>
                        <form action="forms/newsletter.php" method="post" class="php-email-form">
                            <div class="newsletter-form"><input type="email" name="email"><input type="submit"
                                    value="Subscribe"></div>
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">LGU Municipality of Buguey</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Centro, Buguey, Cagayan</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                        <p><strong>Email:</strong> <span>info@example.com</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">About Us</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Incident Reporting</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of Service</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Incident Reporting</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Report Analysis</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Report Management</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">User Support</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p>Stay connected with us for the latest updates and improvements on our system.</p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">LGU Municipality of Buguey</strong> <span>All Rights Reserved</span></p>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
