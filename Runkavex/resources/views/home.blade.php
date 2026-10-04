<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Runkavex Capital - Unlock the Power of Your Finance" />
    <meta property="og:image" content="{{ asset('brand/logo.png') }}" />
    <meta name="theme-color" content="#16C79A" />
    <link rel="shortcut icon" href="{{ asset('brand/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" type="image/png" href="{{ asset('brand/icon.png') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('brand/icon_128.png') }}" />
    <title>Runkavex Capital - Your Trusted Partner in Crypto Investments</title>

    <!-- Google Fonts Css-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fustat:wght@200..800&display=swap" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="{{ asset('theme/assets/home/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/assets/home/css/slicknav.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/assets/home/css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/assets/home/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/assets/home/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/assets/home/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/assets/home/css/mousecursor.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/assets/home/css/custom.css') }}" rel="stylesheet">

    </head>
<body>

    <!-- Preloader Start -->
    <div class="preloader">
        <div class="loading-container">
            <div class="loading"></div>
            <div id="loading-icon"><img src="{{ asset('brand/icon_64.png') }}" alt=""></div>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- Header Start -->
    <header class="main-header">
        <div class="header-sticky">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="/">
                        <img src="{{ asset('brand/logo.png') }}" alt="Runkavex Capital" style="max-width: 150px; max-height: 56px; width: auto; height: auto; object-fit: contain;">
                    </a>
                    <div class="collapse navbar-collapse main-menu">
                        <div class="nav-menu-wrapper">
                            <ul class="navbar-nav mr-auto" id="menu">
                                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="/about">About Us</a></li>
                                <li class="nav-item"><a class="nav-link" href="/careers">Services</a></li>
                                <li class="nav-item"><a class="nav-link" href="/markets">Investment Options</a></li>
                                <li class="nav-item"><a class="nav-link" href="/legal-docs">FAQs</a></li>
                                <li class="nav-item"><a class="nav-link" href="mailto:support@runkavexcapital.com">Contact Us</a></li>
                                <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                                <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                            </ul>
                        </div>
                        <div class="header-social-box d-inline-flex">
                            <div class="header-btn">
                                <button class="btn btn-popup" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                    <img src="{{ asset('theme/assets/home/images/header-btn-dot.svg') }}" alt="">
                                </button>
                                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight">
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    <div class="offcanvas-body">
                                        <div class="header-contact-box">
                                            <div class="icon-box">
                                                <img src="{{ asset('theme/assets/home/images/icon-mail.svg') }}" alt="">
                                            </div>
                                            <div class="header-contact-box-content">
                                                <h3>email</h3>
                                                <p>support@runkavexcapital.com</p>
                                            </div>
                                        </div>
                                        <div class="header-contact-box">
                                            <div class="icon-box">
                                                <img src="{{ asset('theme/assets/home/images/icon-location.svg') }}" alt="">
                                            </div>
                                            <div class="header-contact-box-content">
                                                <h3>address</h3>
                                                <p>United Kingdom</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="navbar-toggle"></div>
                </div>
            </nav>
            <div class="responsive-menu"></div>
        </div>
    </header>
    <!-- Header End -->

    <!-- Hero Section Start -->
    <div class="hero">
        <div class="hero-bg-video">
            <video id="myVideo" loop muted autoplay playsinline>
                <source src="{{ asset('theme/assets/home/videos/artistic-video.mp4') }}" type="video/mp4">
            </video>
            <script>
                const video = document.querySelector('#myVideo');
                window.addEventListener('load', () => { video.play(); });
                video.addEventListener('click', () => { if (video.muted) video.muted = false; });
            </script>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero-content">
                        <div class="section-title">
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{!! \App\Models\PageSection::where('key', 'home_hero_title')->value('content') ?: 'Your Trusted Partner in <span style="color: #16C79A">Crypto Investments</span>' !!}</h2>
                        </div>
                        <div class="hero-content-body">
                            <div class="hero-content-video">
                                <div class="learn-more-circle">
                                    <img src="{{ asset('theme/assets/home/images/learn-more-circle.svg') }}" alt="Learn More">
                                </div>
                            </div>
                            <div class="hero-video-content wow fadeInUp">
                                <p>{!! \App\Models\PageSection::where('key', 'home_hero_subtitle')->value('content') ?: 'At Runkavex Capital, we empower your financial growth by offering tailored investment solutions across diverse markets. From cryptocurrency and forex trading to real estate, agriculture, and energy investments, we provide the tools and expertise to help you achieve your financial goals.' !!}</p>
                            </div>
                        </div>
                        <div class="hero-btn wow fadeInUp" data-wow-delay="0.25s">
                            <a href="/register" class="btn-default">Get Started</a>
                            <a href="/login" class="btn-default">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section End -->

    <!-- TradingView Ticker Tape BEGIN -->
    <div class="tradingview-widget-container">
        <div class="tradingview-widget-container__widget"></div>
        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
        {
            "symbols": [
                { "proName": "FOREXCOM:SPXUSD", "title": "S&P 500 Index" },
                { "proName": "FOREXCOM:NSXUSD", "title": "US 100 Cash CFD" },
                { "proName": "FX_IDC:EURUSD", "title": "EUR to USD" },
                { "proName": "BITSTAMP:BTCUSD", "title": "Bitcoin" },
                { "proName": "BITSTAMP:ETHUSD", "title": "Ethereum" }
            ],
            "showSymbolLogo": true,
            "isTransparent": true,
            "displayMode": "adaptive",
            "colorTheme": "dark",
            "locale": "en"
        }
        </script>
    </div>
    <!-- TradingView Ticker Tape END -->

    <!-- About Section Start -->
    <div class="about-agency pb-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-image">
                        <div class="about-img">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('theme/assets/home/images/about-hand.webp') }}" alt="Investment">
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-us-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">About Us</h3>
                            <h4 class="text-anime-style-2" data-cursor="-opaque">Your Trusted Partner in <span style="color: #16C79A">Building Wealth</span></h4>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">
                                {!! \App\Models\PageSection::where('key', 'about_text')->value('content') ?: 'Runkavex Capital is a leading innovator in energy infrastructure and Bitcoin mining, with operations across Europe. Since launch in 2020, we are a vertically integrated operator around the globe, making us one of the largest Bitcoin miners.' !!}
                            </p>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">
                                Listed on the NASDAQ and Toronto Stock Exchange, Runkavex Capital is SOC 2 Type 2 compliant and dedicated to achieving carbon neutrality by 2025. We provide cutting-edge technologies and high-performance computing solutions to power the industries of tomorrow.
                            </p>
                            <a href="/about" class="btn-default">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Section End -->

    <!-- Crypto Chart -->
    <div class="our-clients pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tradingview-widget-container">
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                        {
                            "symbol": "COINBASE:USDTUSD",
                            "width": "100%",
                            "height": "350",
                            "locale": "en",
                            "dateRange": "12M",
                            "colorTheme": "dark",
                            "trendLineColor": "rgba(22, 199, 154, 1)",
                            "underLineColor": "rgba(22, 199, 154, 0.3)",
                            "underLineBottomColor": "rgba(22, 199, 154, 0)",
                            "isTransparent": true,
                            "autosize": true,
                            "largeChartUrl": ""
                        }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Crypto Chart End -->

    <!-- Why Choose Us Section Start -->
    <div class="why-choose-us">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-7">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">why choose us</h3>
                        <h4 class="text-anime-style-2" data-cursor="-opaque">Expertise for <span style="color: #16C79A">your financial</span> growth journey</h4>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="section-title-content wow fadeInUp" data-wow-delay="0.25s">
                        <p>Our dedicated team is committed to understanding your unique financial goals, ensuring that we provide tailored investment strategies that deliver results. With a focus on integrity and transparency, we guide you every step of the way.</p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="why-choose-content">
                        <div class="why-choose-item active wow fadeInUp">
                            <h3>Proven Track Record</h3>
                            <p>With years of experience in the investment industry, we have a proven track record of delivering consistent returns and helping clients achieve their financial goals.</p>
                        </div>
                        <div class="why-choose-item wow fadeInUp" data-wow-delay="0.25s">
                            <h3>Tailored Investment Strategies</h3>
                            <p>We create customized investment plans that align with your financial objectives, risk tolerance, and long-term aspirations.</p>
                        </div>
                        <div class="why-choose-item wow fadeInUp" data-wow-delay="0.5s">
                            <h3>Transparency & Integrity</h3>
                            <p>We prioritize transparency in all our dealings, ensuring you have complete visibility into your investments and the strategies we employ.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="why-choose-image">
                        <figure class="image-anime reveal">
                            <img src="{{ asset('theme/assets/home/images/why-choose.webp') }}" alt="Investment Expertise">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Why Choose Us Section End -->

    <!-- How It Works Section Start -->
    <div class="how-it-work">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-7">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">how it works</h3>
                        <h4 class="text-anime-style-2" data-cursor="-opaque">Our simple <span style="color: #16C79A">process</span> for profitable investing</h4>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="section-title-content wow fadeInUp" data-wow-delay="0.25s">
                        <p>With just a few simple steps, you can start earning consistent returns through our trusted investment platform designed for maximum profitability.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="work-process-item wow fadeInUp">
                        <div class="work-process-header">
                            <div class="work-process-title"><h3>Register & Fund</h3></div>
                            <div class="work-process-btn">
                                <a href="/register" class="readmore-btn"><img src="{{ asset('theme/assets/home/images/arrow-white.svg') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="work-process-content">
                            <p>Create an account on our platform and fund your wallet using your preferred payment method. Start small or invest big — the choice is yours!</p>
                        </div>
                        <div class="work-process-body">
                            <div class="work-process-no">
                                <h3>step</h3>
                                <h2>01</h2>
                            </div>
                            <div class="work-process-icon-box">
                                <img src="{{ asset('theme/assets/home/images/icon-work-process-1.svg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="work-process-item wow fadeInUp" data-wow-delay="0.25s">
                        <div class="work-process-header">
                            <div class="work-process-title"><h3>Select a Plan</h3></div>
                            <div class="work-process-btn">
                                <a href="/login" class="readmore-btn"><img src="{{ asset('theme/assets/home/images/arrow-white.svg') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="work-process-content">
                            <p>Choose an investment plan that matches your financial goals. Each plan offers varying levels of returns and durations to suit your preferences.</p>
                        </div>
                        <div class="work-process-body">
                            <div class="work-process-no">
                                <h3>step</h3>
                                <h2>02</h2>
                            </div>
                            <div class="work-process-icon-box">
                                <img src="{{ asset('theme/assets/home/images/icon-work-process-2.svg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="work-process-item wow fadeInUp" data-wow-delay="0.5s">
                        <div class="work-process-header">
                            <div class="work-process-title"><h3>Earn & Withdraw</h3></div>
                            <div class="work-process-btn">
                                <a href="/login" class="readmore-btn"><img src="{{ asset('theme/assets/home/images/arrow-white.svg') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="work-process-content">
                            <p>Watch your earnings grow daily! Withdraw your profits at any time or reinvest for even higher returns. Your success is our priority.</p>
                        </div>
                        <div class="work-process-body">
                            <div class="work-process-no">
                                <h3>step</h3>
                                <h2>03</h2>
                            </div>
                            <div class="work-process-icon-box">
                                <img src="{{ asset('theme/assets/home/images/icon-work-process-3.svg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- How It Works Section End -->

    <!-- Footer Start -->
    <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="about-footer">
                            <div class="footer-logo">
                        <img src="{{ asset('brand/logo.png') }}" alt="Runkavex Capital" style="max-width: 150px; max-height: 56px; width: auto; height: auto; object-fit: contain;">
                            </div>
                            <div class="footer-contact-box">
                                <div class="footer-contact-item">
                                    <div class="icon-box">
                                        <img src="{{ asset('theme/assets/home/images/icon-location.svg') }}" alt="">
                                    </div>
                                    <div class="footer-contact-content">
                                        <p>5a Ack Lane East, Bramhall, Stockport, Cheshire, United Kingdom, SK7 2BE</p>
                                    </div>
                                </div>
                                <div class="footer-contact-item">
                                    <div class="icon-box">
                                        <img src="{{ asset('theme/assets/home/images/icon-mail.svg') }}" alt="">
                                    </div>
                                    <div class="footer-contact-content">
                                        <p>support@runkavexcapital.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6">
                        <div class="footer-links">
                            <h3>Company</h3>
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><a href="/about">About Us</a></li>
                                <li><a href="/careers">Our Services</a></li>
                                <li><a href="/markets">Investment Options</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6">
                        <div class="footer-links">
                            <h3>Resources</h3>
                            <ul>
                                <li><a href="/legal-docs">FAQs</a></li>
                                <li><a href="mailto:support@runkavexcapital.com">Contact Us</a></li>
                                <li><a href="/legal-docs">Legal Docs</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer-copyright">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="footer-copyright-text">
                                <p>&copy; 2026 Runkavex Capital. All Rights Reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Theme JS -->
    <script src="{{ asset('theme/assets/home/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/validator.min.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/isotope.min.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/parallaxie.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/gsap.min.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/magiccursor.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/SplitText.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/jquery.mb.YTPlayer.min.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/typed.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/wow.js') }}"></script>
    <script src="{{ asset('theme/assets/home/js/function.js') }}"></script>

    <div class="gtranslate_wrapper"></div>
    <script>
        window.gtranslateSettings = {
            default_language: "en",
            alt_flags:{"en":"usa"},
            wrapper_selector: ".gtranslate_wrapper",
            flag_style: "3d",
        };
    </script>
    <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

</body>
</html>