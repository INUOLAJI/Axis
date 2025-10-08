<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyBiz</title>
  <meta name="description" content="MyBiz provides modern business solutions including web development, UI/UX design, and marketing services.">
<meta name="keywords" content="business, web development, UI/UX, marketing, MyBiz">
<meta name="author" content="MyBiz">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <!-- Custom CSS -->
<style>
/* Preloader overlay */
#preloader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: white; /* or any color */
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

/* Loader animation */
.loader {
  border: 6px solid #f3f3f3;
  border-top: 6px solid #3498db; /* blue color */
  border-radius: 50%;
  width: 60px;
  height: 60px;
  animation: spin 1s linear infinite;
}

/* Spin animation */
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

  /* Hero section styling */
  .hero {
    position: relative;
    background: url('https://bootstrapmade.com/demo/templates/Axis/assets/img/hero-bg.jpg') center/cover no-repeat;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
  }

  /* Overlay for better contrast */
  .hero::before {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.6);
  }

  /* Content on top of overlay */
  .hero .container {
    position: relative;
    z-index: 1;
  }

  .hero h1 {
    font-size: 3.5rem;
    font-weight: 700;
  }

  .hero p {
    font-size: 1.2rem;
    margin: 20px 0;
  }

  .btn-primary {
    background-color: #0d6efd;
    border: none;
  }

  .btn-primary:hover {
    background-color: #0b5ed7;
  }
  img{
    margin-top: 50px;
  }
      .filter-section {
      text-align: center;
      margin-bottom: 30px;
    }

    .filter-btn {
      padding: 10px 25px;
      background: #007bff;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      transition: background 0.3s ease;
    }

    .filter-btn:hover {
      background: #0056b3;
    }

    .card-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      margin-top: 20px;
    }

    .card {
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      text-align: center;
      transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 10px 16px rgba(0,0,0,0.2);
    }

    .card i {
      font-size: 40px;
      color: #007bff;
      margin-bottom: 15px;
      transition: transform 0.3s ease;
    }

    .card:hover i {
      transform: scale(1.2);
    }

    .card h3 {
      margin: 10px 0;
      font-size: 18px;
      color: #333;
    }

    .card p {
      font-size: 14px;
      color: #555;
    }
    .modal.fade .modal-dialog {
  transform: translateY(-50px);
  transition: transform 0.3s ease-out, opacity 0.3s ease-out;
}

.modal.fade.show .modal-dialog {
  transform: translateY(0);
}
html {
  scroll-behavior: smooth;
}
.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 25px rgba(0,0,0,0.15);
  transition: all 0.3s ease;
}



/*  */

/* Show only one carousel item at a time on small screens */
@media (max-width: 480px) {
  .carousel-item {
    flex: 0 0 100%;
    max-width: 100%;
  }

  .carousel-inner {
    display: flex;
    flex-wrap: nowrap;
    overflow: hidden;
  }
    #testimonials .col-lg-4 {
    flex: 0 0 100%;
    max-width: 100%;
  }
}


</style>

</head>
<body>

<div id="preloader" class="d-flex justify-content-center align-items-center">
  <div class="spinner-border text-primary" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>

  <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">MyBiz</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                <?php if(!isset($_SESSION['uid'])):?>
                <li class="nav-item ms-lg-3 py-2 py-lg-0 mb-2 d-grid"> 
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                </li>
                <li class="nav-item ms-lg-2 py-2 py-lg-0 d-grid">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#signupModal" id="signupBtn">
                        Sign Up
                    </button>
                </li>
                <!-- <li class="nav-item ms-lg-2 py-2 py-lg-0 d-grid">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal" id="logoutBtn">
                        logout
                    </button>
                </li> -->
                <?php endif; ?>
                <?php if(isset($_SESSION['uid'])): ?>
  <li class="nav-item ms-lg-2 py-2 py-lg-0 d-grid">
    <form method="post" action="logout.php" style="display:inline;">
      <button type="submit" class="btn btn-danger" id="logoutBtn">Logout</button>
    </form>
  </li>
<?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<section class="hero d-flex align-items-center" style="height: 100vh; background-color: #f8f9fa;">
  <div class="container">
    <div class="row align-items-center">
      <!-- Text content -->
      <div class="col-lg-6 col-md-12 text-center text-lg-start">
        <h1 class="fw-bold mb-3">Welcome to MyBiz</h1>
        <p class="lead mb-4">We help you grow your business with creative digital solutions tailored to your needs.</p>
        <a href="#" class="btn btn-primary btn-lg">Get Started</a>
      </div>

      <!-- Image beside text -->
      <div class="col-lg-6 col-md-12 text-center mt-4 mt-lg-0">
        <img src="IMAGES/about-square-10.webp" 
             class="img-fluid rounded shadow" 
             alt="Business illustration">
      </div>
    </div>
  </div>
</section>

<!-- About Section -->
<section id="about" class="py-5"  data-aos="fade-up">
  <div class="container">
    <div class="row align-items-center">
      <!-- Text Content -->
      <div class="col-lg-6">
        <h2 class="fw-bold mb-3">About Us</h2>
        <p class="lead mb-4">
          MyBiz is a modern business platform designed to help companies grow online. 
          We combine creativity, technology, and strategy to deliver results that matter.
        </p>
        <p>
          Our team of professionals provides top-notch digital solutions that make your brand stand out. 
          Whether you need a stunning website, smart branding, or effective marketing strategies — we’ve got you covered.
        </p>
        <a href="#" class="btn btn-outline-primary mt-3">Learn More</a>
      </div>

      <!-- Image -->
      <div class="col-lg-6 text-center mt-4 mt-lg-0">
        <img src="IMAGES/about-square-12.webp" 
             class="img-fluid rounded shadow" 
             alt="About MyBiz">
      </div>
    </div>
  </div>
</section>

<!-- Services Section -->
<section id="services" class="py-5 bg-light" data-aos="fade-up">
  <div class="container text-center">
    <h2 class="fw-bold mb-5">Our Services</h2>
    <div class="row g-4">
      <!-- Service 1 -->
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow h-100 p-4 service-card">
          <div class="card-body">
            <div class="icon mb-3 text-primary">
              <i class="bi bi-laptop fs-1"></i>
            </div>
            <h5 class="card-title fw-bold">Web Design</h5>
            <p class="card-text">
              We create stunning, responsive websites that bring your brand to life online.
            </p>
          </div>
        </div>
      </div>

      <!-- Service 2 -->
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow h-100 p-4 service-card">
          <div class="card-body">
            <div class="icon mb-3 text-primary">
              <i class="bi bi-bar-chart-line fs-1"></i>
            </div>
            <h5 class="card-title fw-bold">Digital Marketing</h5>
            <p class="card-text">
              We help your business reach the right audience with smart marketing strategies.
            </p>
          </div>
        </div>
      </div>

      <!-- Service 3 -->
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow h-100 p-4 service-card">
          <div class="card-body">
            <div class="icon mb-3 text-primary">
              <i class="bi bi-phone fs-1"></i>
            </div>
            <h5 class="card-title fw-bold">App Development</h5>
            <p class="card-text">
              We build powerful mobile apps that deliver seamless user experiences.
            </p>
          </div>
        </div>
      </div>

      <!-- Service 4 -->
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow h-100 p-4 service-card">
          <div class="card-body">
            <div class="icon mb-3 text-primary">
              <i class="bi bi-globe2 fs-1"></i>
            </div>
            <h5 class="card-title fw-bold">SEO Optimization</h5>
            <p class="card-text">
              Improve your website’s visibility and rank higher on search engines with our SEO solutions.
            </p>
          </div>
        </div>
      </div>

      <!-- Service 5 -->
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow h-100 p-4 service-card">
          <div class="card-body">
            <div class="icon mb-3 text-primary">
              <i class="bi bi-people fs-1"></i>
            </div>
            <h5 class="card-title fw-bold">Consulting</h5>
            <p class="card-text">
              Get expert advice to scale your business and make the right strategic decisions.
            </p>
          </div>
        </div>
      </div>

      <!-- Service 6 -->
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow h-100 p-4 service-card">
          <div class="card-body">
            <div class="icon mb-3 text-primary">
              <i class="bi bi-lightbulb fs-1"></i>
            </div>
            <h5 class="card-title fw-bold">Brand Strategy</h5>
            <p class="card-text">
              Build a strong, recognizable brand that connects with your audience and drives loyalty.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Add or keep this CSS -->
<style>
  .service-card {
    transition: all 0.4s ease;
    cursor: pointer;
  }

  .service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  }

  .service-card .icon {
    transition: all 0.4s ease;
  }

  .service-card:hover .icon {
    color: #0d6efd;
    transform: translateY(-5px) scale(1.2);
  }
</style>


<!-- Portfolio / Services Extended Section -->
<section id="portfolio" class="py-5 bg-light" data-aos="fade-up">
  <div class="container text-center">
    <h2 class="fw-bold mb-5">Our Portfolio</h2>

    <!-- Filter Buttons -->
    <div class="mb-4">
      <button class="btn btn-outline-primary mx-2 active">All</button>
      <button class="btn btn-outline-primary mx-2">Web</button>
      <button class="btn btn-outline-primary mx-2">App</button>
      <button class="btn btn-outline-primary mx-2">Design</button>
    </div>

    <!-- Cards Grid -->
    <div class="row g-4 justify-content-center">
      <!-- Card 1 -->
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow h-100 p-4 text-center transition-card">
          <div class="mb-3 text-primary">
            <i class="bi bi-laptop fs-1"></i>
          </div>
          <h5 class="card-title fw-bold">Web Design</h5>
          <p class="card-text">
            Creating stunning, responsive websites that tell your brand’s story.
          </p>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow h-100 p-4 text-center transition-card">
          <div class="mb-3 text-primary">
            <i class="bi bi-phone fs-1"></i>
          </div>
          <h5 class="card-title fw-bold">App Development</h5>
          <p class="card-text">
            Building user-friendly mobile apps with a seamless experience.
          </p>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow h-100 p-4 text-center transition-card">
          <div class="mb-3 text-primary">
            <i class="bi bi-bar-chart-line fs-1"></i>
          </div>
          <h5 class="card-title fw-bold">Marketing Strategy</h5>
          <p class="card-text">
            Helping your business grow with data-driven digital strategies.
          </p>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow h-100 p-4 text-center transition-card">
          <div class="mb-3 text-primary">
            <i class="bi bi-lightbulb fs-1"></i>
          </div>
          <h5 class="card-title fw-bold">Creative Design</h5>
          <p class="card-text">
            Crafting visually appealing designs to elevate your brand.
          </p>
        </div>
      </div>

      <!-- Card 5 -->
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow h-100 p-4 text-center transition-card">
          <div class="mb-3 text-primary">
            <i class="bi bi-shop fs-1"></i>
          </div>
          <h5 class="card-title fw-bold">E-Commerce</h5>
          <p class="card-text">
            Building secure online stores to help your business scale fast.
          </p>
        </div>
      </div>

      <!-- Card 6 -->
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow h-100 p-4 text-center transition-card">
          <div class="mb-3 text-primary">
            <i class="bi bi-gear fs-1"></i>
          </div>
          <h5 class="card-title fw-bold">Maintenance</h5>
          <p class="card-text">
            Keeping your website and apps updated and performing smoothly.
          </p>
        </div>
      </div>

      <!-- Extra Row (2 Cards)
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow h-100 p-4 text-center transition-card">
          <div class="mb-3 text-primary">
            <i class="bi bi-globe fs-1"></i>
          </div>
          <h5 class="card-title fw-bold">Global Reach</h5>
          <p class="card-text">
            Expanding your business worldwide through smart strategies and partnerships.
          </p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow h-100 p-4 text-center transition-card">
          <div class="mb-3 text-primary">
            <i class="bi bi-people fs-1"></i>
          </div>
          <h5 class="card-title fw-bold">Team Collaboration</h5>
          <p class="card-text">
            Bringing your team together with innovative tools for seamless communication.
          </p>
        </div>
      </div> -->
    </div>
  </div>
</section>
<!-- Team Section -->
<section id="team" class="py-5" data-aos="fade-up">
  <div class="container text-center">
    <h2 class="fw-bold mb-5">Our Team</h2>
    <div class="row g-4">
      
      <!-- Team Member 1 -->
      <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm team-card">
          <img src="IMAGES/person-f-8.webp" class="card-img-top" alt="Team Member">
          <div class="card-body">
            <h5 class="card-title fw-bold">John Doe</h5>
            <p class="card-text text-muted mb-2">Chief Executive Officer</p>
            <p class="small text-secondary">
              John leads the company’s vision and growth strategy with more than 10 years of business experience.
            </p>
            <div class="social-links">
              <a href="#" class="text-dark mx-2"><i class="bi bi-twitter"></i></a>
              <a href="#" class="text-dark mx-2"><i class="bi bi-facebook"></i></a>
              <a href="#" class="text-dark mx-2"><i class="bi bi-linkedin"></i></a>
              <a href="#" class="text-dark mx-2"><i class="bi bi-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>

      <!-- Team Member 2 -->
      <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm team-card">
          <img src="IMAGES/person-m-12.webp" class="card-img-top" alt="Team Member">
          <div class="card-body">
            <h5 class="card-title fw-bold">Sarah James</h5>
            <p class="card-text text-muted mb-2">Project Manager</p>
            <p class="small text-secondary">
              Sarah ensures every project runs smoothly and meets client expectations on time and on budget.
            </p>
            <div class="social-links">
              <a href="#" class="text-dark mx-2"><i class="bi bi-twitter"></i></a>
              <a href="#" class="text-dark mx-2"><i class="bi bi-facebook"></i></a>
              <a href="#" class="text-dark mx-2"><i class="bi bi-linkedin"></i></a>
              <a href="#" class="text-dark mx-2"><i class="bi bi-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>

      <!-- Team Member 3 -->
      <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm team-card">
          <img src="IMAGES/person-f-3.webp" class="card-img-top" alt="Team Member">
          <div class="card-body">
            <h5 class="card-title fw-bold">Michael Lee</h5>
            <p class="card-text text-muted mb-2">Lead Developer</p>
            <p class="small text-secondary">
              Michael specializes in full-stack web development and leads our engineering team with creativity and precision.
            </p>
            <div class="social-links">
              <a href="#" class="text-dark mx-2"><i class="bi bi-twitter"></i></a>
              <a href="#" class="text-dark mx-2"><i class="bi bi-facebook"></i></a>
              <a href="#" class="text-dark mx-2"><i class="bi bi-linkedin"></i></a>
              <a href="#" class="text-dark mx-2"><i class="bi bi-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>

      <!-- Team Member 4 -->
      <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm team-card">
          <img src="IMAGES/person-m-7.webp" class="card-img-top" alt="Team Member">
          <div class="card-body">
            <h5 class="card-title fw-bold">Emily Brown</h5>
            <p class="card-text text-muted mb-2">UI/UX Designer</p>
            <p class="small text-secondary">
              Emily creates clean, engaging designs that improve user experience and make every product intuitive to use.
            </p>
            <div class="social-links">
              <a href="#" class="text-dark mx-2"><i class="bi bi-twitter"></i></a>
              <a href="#" class="text-dark mx-2"><i class="bi bi-facebook"></i></a>
              <a href="#" class="text-dark mx-2"><i class="bi bi-linkedin"></i></a>
              <a href="#" class="text-dark mx-2"><i class="bi bi-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="py-5 bg-light" data-aos="fade-up">
  <div class="container text-center">
    <h2 class="fw-bold mb-5">Our Pricing</h2>
    <div class="row g-4">
      
      <!-- Basic Plan -->
      <div class="col-lg-3 col-md-6">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body">
            <h5 class="fw-bold mb-3">Basic</h5>
            <h2 class="fw-bold mb-3">$19<span class="fs-6 text-muted">/mo</span></h2>
            <ul class="list-unstyled text-start mb-4">
              <li><i class="bi bi-check-circle text-success"></i> 5 Projects</li>
              <li><i class="bi bi-check-circle text-success"></i> Basic Support</li>
              <li><i class="bi bi-x-circle text-danger"></i> No Custom Domain</li>
              <li><i class="bi bi-x-circle text-danger"></i> Limited Access</li>
            </ul>
            <a href="#" class="btn btn-outline-primary w-100">Get Started</a>
          </div>
        </div>
      </div>

      <!-- Standard Plan -->
      <div class="col-lg-3 col-md-6">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body">
            <h5 class="fw-bold mb-3">Standard</h5>
            <h2 class="fw-bold mb-3">$39<span class="fs-6 text-muted">/mo</span></h2>
            <ul class="list-unstyled text-start mb-4">
              <li><i class="bi bi-check-circle text-success"></i> 15 Projects</li>
              <li><i class="bi bi-check-circle text-success"></i> Priority Support</li>
              <li><i class="bi bi-check-circle text-success"></i> Custom Domain</li>
              <li><i class="bi bi-x-circle text-danger"></i> No Analytics</li>
            </ul>
            <a href="#" class="btn btn-outline-primary w-100">Get Started</a>
          </div>
        </div>
      </div>

      <!-- Premium Plan (Highlighted) -->
      <div class="col-lg-3 col-md-6">
        <div class="card h-100 border-primary shadow-lg highlight-card">
          <div class="card-body bg-primary text-white rounded">
            <h5 class="fw-bold mb-3">Premium</h5>
            <h2 class="fw-bold mb-3">$69<span class="fs-6 text-light">/mo</span></h2>
            <ul class="list-unstyled text-start mb-4">
              <li><i class="bi bi-check-circle-fill"></i> Unlimited Projects</li>
              <li><i class="bi bi-check-circle-fill"></i> 24/7 Support</li>
              <li><i class="bi bi-check-circle-fill"></i> Custom Domain</li>
              <li><i class="bi bi-check-circle-fill"></i> Advanced Analytics</li>
            </ul>
            <a href="#" class="btn btn-light text-primary fw-bold w-100">Get Started</a>
          </div>
        </div>
      </div>

      <!-- Enterprise Plan -->
      <div class="col-lg-3 col-md-6">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body">
            <h5 class="fw-bold mb-3">Enterprise</h5>
            <h2 class="fw-bold mb-3">$99<span class="fs-6 text-muted">/mo</span></h2>
            <ul class="list-unstyled text-start mb-4">
              <li><i class="bi bi-check-circle text-success"></i> Everything in Premium</li>
              <li><i class="bi bi-check-circle text-success"></i> Dedicated Manager</li>
              <li><i class="bi bi-check-circle text-success"></i> Team Collaboration</li>
              <li><i class="bi bi-check-circle text-success"></i> Custom Integrations</li>
            </ul>
            <a href="#" class="btn btn-outline-primary w-100">Get Started</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="py-5 bg-light">
  <div class="container text-center">
    <h2 class="fw-bold mb-5">Testimonials</h2>

    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">

        <div class="carousel-item active">
          <div class="card shadow border-0 mx-auto" style="max-width:600px;">
            <div class="card-body">
              <img src="IMAGES/person-f-6.webp" alt="" class="rounded-circle mb-3" width="80" height="80">
              <p class="mb-3">“MyBiz helped boost our business to new heights — incredible service!”</p>
              <h5 class="fw-bold">Sarah Johnson</h5>
              <small>CEO, BrightCorp</small>
            </div>
          </div>
        </div>

        <div class="carousel-item">
          <div class="card shadow border-0 mx-auto" style="max-width:600px;">
            <div class="card-body">
              <img src="IMAGES/person-f-12.webp" alt="" class="rounded-circle mb-3" width="80" height="80">
              <p class="mb-3">“Excellent design and smooth functionality. Highly recommend!”</p>
              <h5 class="fw-bold">Michael Lee</h5>
              <small>Marketing Lead</small>
            </div>
          </div>
        </div>

        <div class="carousel-item">
          <div class="card shadow border-0 mx-auto" style="max-width:600px;">
            <div class="card-body">
              <img src="IMAGES/person-f-8.webp" alt="" class="rounded-circle mb-3" width="80" height="80">
              <p class="mb-3">“Top-notch support and a great experience all around.”</p>
              <h5 class="fw-bold">Emily Smith</h5>
              <small>Founder, CraftHub</small>
            </div>
          </div>
        </div>

      </div>

      <!-- Carousel controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </div>
</section>


<!-- Contact Us CTA Section -->
<section class="contact-cta py-5" style="background: linear-gradient(135deg, #4f46e5, #9333ea);" data-aos="fade-up">
  <div class="container">
    <div class="row align-items-center text-white">
      
      <!-- Text + Icons -->
      <div class="col-md-8 mb-4 mb-md-0">
        <h2 class="fw-bold mb-3">Get in Touch with Us</h2>
        <p class="mb-4">Have questions or want to start a project? Reach out to us anytime and we'll respond promptly.</p>
        <div class="d-flex flex-wrap gap-3">
          <div class="d-flex align-items-center">
            <i class="bi bi-envelope-fill fs-4 me-2"></i>
            <span>info@mybiz.com</span>
          </div>
          <div class="d-flex align-items-center">
            <i class="bi bi-telephone-fill fs-4 me-2"></i>
            <span>+1 234 567 890</span>
          </div>
          <div class="d-flex align-items-center">
            <i class="bi bi-geo-alt-fill fs-4 me-2"></i>
            <span>123 Business St, City, Country</span>
          </div>
        </div>
      </div>

      <!-- Contact Button -->
      <div class="col-md-4 text-md-end text-center">
        <a href="#contact" class="btn btn-light btn-lg text-primary fw-bold">Contact Us</a>
      </div>

    </div>
  </div>
</section>

<!-- Contact Form Section -->
<section id="contact" class="py-5" data-aos="fade-up">
  <div class="container">
    <div class="row align-items-center">
      
      <!-- Contact Form -->
      <div class="col-lg-6 mb-5 mb-lg-0">
        <h2 class="fw-bold mb-4">Send Us a Message</h2>
        <p class="mb-4 text-muted">Have questions or want to start a project? Fill out the form below and we’ll get back to you as soon as possible.</p>
        <form>
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Your Name" required>
          </div>
          <div class="mb-3">
            <input type="email" class="form-control" placeholder="Your Email" required>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Subject" required>
          </div>
          <div class="mb-3">
            <textarea class="form-control" rows="5" placeholder="Message" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
        </form>
      </div>

      <!-- Illustration -->
      <div class="col-lg-6 text-center">
        <img src="IMAGES/download.png" class="img-fluid" alt="Contact Illustration" loading="lazy">
      </div>

    </div>
  </div>
</section>



<!-- Optional Form Styles -->
<style>
#contact .form-control {
  border-radius: .5rem;
  padding: 1rem;
}
#contact .btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  transition: all 0.3s ease;
}
</style>


<!-- Optional Hover Effect -->
<style>
.contact-cta .btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  transition: all 0.3s ease;
}
</style>



<!-- Pricing Card Hover Styles -->
<style>
#pricing .card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
#pricing .card:hover {
  transform: translateY(-8px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
.highlight-card {
  transform: scale(1.05);
}
</style>


<!-- Team Card Hover Styles -->
<style>
.team-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.team-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}
.team-card img {
  border-top-left-radius: .5rem;
  border-top-right-radius: .5rem;
}
</style>

<!-- Team Card Hover Styles -->
<style>
.team-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.team-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}
.team-card img {
  border-top-left-radius: .5rem;
  border-top-right-radius: .5rem;
}
</style>


<!-- Hover Transition Styles -->
<style>
.transition-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.transition-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
</style>

<!-- Back-to-Top Button -->
<button id="backToTop" class="btn btn-primary btn-lg rounded-circle" title="Back to Top">
  <i class="bi bi-arrow-up"></i>
</button>

<!-- Styles -->
<style>
#backToTop {
  position: fixed;
  bottom: 30px;
  right: 30px;
  display: none;
  z-index: 1000;
  width: 50px;
  height: 50px;
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: center;
}
#backToTop:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  transition: all 0.3s ease;
}
</style>

<!-- JavaScript -->
<script>
  // Show button after scrolling 100px
  const backToTop = document.getElementById('backToTop');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 100) {
      backToTop.style.display = 'flex';
    } else {
      backToTop.style.display = 'none';
    }
  });

  // Smooth scroll to top
  backToTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
</script>


<!-- Footer Section -->
<footer class="bg-dark text-white pt-5" data-aos="fade-up">
  <div class="container">
    <div class="row">

      <!-- Brand & Description -->
      <div class="col-lg-4 mb-4">
        <h3 class="fw-bold">MyBiz</h3>
        <p>We provide modern solutions for your business needs, helping you grow and succeed in a digital world.</p>
        <div class="d-flex gap-3">
          <a href="#" class="text-white"><i class="bi bi-twitter fs-4"></i></a>
          <a href="#" class="text-white"><i class="bi bi-facebook fs-4"></i></a>
          <a href="#" class="text-white"><i class="bi bi-linkedin fs-4"></i></a>
          <a href="#" class="text-white"><i class="bi bi-instagram fs-4"></i></a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-lg-2 mb-4">
        <h5 class="fw-bold mb-3">Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="#home" class="text-white text-decoration-none">Home</a></li>
          <li><a href="#about" class="text-white text-decoration-none">About</a></li>
          <li><a href="#services" class="text-white text-decoration-none">Services</a></li>
          <li><a href="#portfolio" class="text-white text-decoration-none">Portfolio</a></li>
          <li><a href="#contact" class="text-white text-decoration-none">Contact</a></li>
        </ul>
      </div>

      <!-- Services Links -->
      <div class="col-lg-2 mb-4">
        <h5 class="fw-bold mb-3">Services</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-white text-decoration-none">Web Development</a></li>
          <li><a href="#" class="text-white text-decoration-none">UI/UX Design</a></li>
          <li><a href="#" class="text-white text-decoration-none">Marketing</a></li>
          <li><a href="#" class="text-white text-decoration-none">Consulting</a></li>
        </ul>
      </div>

      <!-- Contact Info -->
      <div class="col-lg-4 mb-4">
        <h5 class="fw-bold mb-3">Contact</h5>
        <p class="mb-1"><i class="bi bi-geo-alt-fill me-2"></i>123 Business St, City, Country</p>
        <p class="mb-1"><i class="bi bi-telephone-fill me-2"></i>+1 234 567 890</p>
        <p><i class="bi bi-envelope-fill me-2"></i>info@mybiz.com</p>
      </div>

    </div>

    <hr class="border-top border-secondary">

    <div class="text-center pb-3">
      &copy; 2025 MyBiz. All rights reserved.
    </div>
  </div>
</footer>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="loginModalLabel">Login to MyBiz</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="login_proc.php">
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter your password" name="pword">
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe">
            <input type="hidden" name="uid">
            <label class="form-check-label" for="rememberMe">Remember me</label>
          </div>
          <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
        </form>
      </div>
      <div class="modal-footer text-center">
        <p class="mb-0">Don't have an account? <a href="#signupModal" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal">Sign Up</a></p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="signupModalLabel">Create an Account</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="signup_proc.php">
          <div class="mb-3">
            <label for="signupName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="signupName" name="fname">
          </div>
          <div class="mb-3">
            <label for="signupEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="signupEmail" name="email">
          </div>
          <div class="mb-3">
            <label for="signupPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="signupPassword" name="pword">
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirmPassword" name="cword">
          </div>
          <input type="hidden" name="uid">
          <button type="submit" class="btn btn-success w-100" name="signup" >Sign Up</button>
        </form>
      </div>
      <div class="modal-footer text-center">
        <p class="mb-0">Already have an account? <a href="#loginModal" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Login</a></p>
      </div>
    </div>
  </div>
</div>  




<script>
    const filterButtons = document.querySelectorAll('[data-filter]');
const portfolioItems = document.querySelectorAll('.portfolio-item');

filterButtons.forEach(button => {
  button.addEventListener('click', () => {
    // Remove active class from all buttons
    filterButtons.forEach(btn => btn.classList.remove('active'));
    button.classList.add('active');

    const filter = button.getAttribute('data-filter');
    portfolioItems.forEach(item => {
      if (filter === 'all' || item.classList.contains(filter)) {
        item.style.display = 'block';
      } else {
        item.style.display = 'none';
      }
    });
  });
});
 


</script>


<!-- AOS CSS -->
 <!-- Bootstrap JS (include this before </body>) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  // Check if the URL contains ?showlogin=1
  if (window.location.search.indexOf('showlogin=1') !== -1) {
    var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
    loginModal.show();
  }
});

document.addEventListener("DOMContentLoaded", function() {
  // If URL contains ?showlogin=1, hide the signup button
  if (window.location.search.indexOf('showlogin=1') !== -1) {
    var signupBtn = document.getElementById('signupBtn');
    if(signupBtn) signupBtn.style.display = 'none';

    // Optionally, show the login modal automatically
    var loginModal = document.getElementById('loginModal');
    if(loginModal && typeof bootstrap !== "undefined") {
      var modal = new bootstrap.Modal(loginModal);
      modal.show();
    }
  }
});
document.addEventListener("DOMContentLoaded", function() {
  if (window.location.search.indexOf('showsignup=1') !== -1) {
    var signupModal = document.getElementById('signupModal');
    if(signupModal && typeof bootstrap !== "undefined") {
      var modal = new bootstrap.Modal(signupModal);
      modal.show();
    }
  }
});

</script>

<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000, // animation duration in ms
    once: true      // animation happens only once while scrolling
  });
</script>







  <script>
  window.addEventListener('load', () => {
    const preloader = document.getElementById('preloader');

    // Fade out
    preloader.style.opacity = '0';
    preloader.style.transition = 'opacity 0.5s ease';

    // Remove from DOM after fade
    setTimeout(() => {
      preloader.parentNode.removeChild(preloader); // remove completely
    }, 1000);
  });   





  const testimonialCarousel = document.querySelector('#testimonialCarousel');
  new bootstrap.Carousel(testimonialCarousel, {
    interval: 3000, // 3 seconds per slide
    ride: 'carousel'
  });





</script>

</body>
</html>
