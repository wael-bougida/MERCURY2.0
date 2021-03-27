<?php  
  include("./config/db_connect.php")
?>

<?php include 'templates/header.php'?>  


<section id="introduction">
  <h1>Feel at home</h1>
  <h1>Away from home!</h1>
  <h3>Living on Campus</h3>
  </div>
  <div class="container-fluid">
    <p>
      Do you want to live in a student residence, in a shared or single room??
      Of course, only you decide where and how you want to live: You have plenty of choices with Saturn Housing!
    </p>
    <p>
      In the immediate vicinity of the campus, we offer 4 colleges to live in: Krupp, Mercator, College III,
      Nordmetall.
      Often the housing question boils down to your preferences, special needs etc.
    </p>
    <p>
      Login to our Housing Portal to register and get the best accomodation in Bremen!
    </p>
  </div>
</section>

<h2 style="text-align:center">Our Colleges</h2>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <img src="./img/krupp.jpeg" alt="Krupp" style="width:100%">
        <div class="container">
          <h2>Krupp College</h2>
          <p class="title">Who's on fire?</p>
          <p>As the oldest college we value our traditions and connections!.</p>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card">
        <img src="./img/mercator.jpeg" alt="Mercator" style="width:100%">
        <div class="container">
          <h2>Mercator College</h2>
          <p class="title">Awasawasa!</p>
          <p>Artistic we are!</p>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card">
        <img src="./img/college3.jpeg" alt="College III" style="width:100%">
        <div class="container">
          <h2>College 3</h2>
          <p class="title">Oh yeah, C3 yeah!</p>
          <p>We are the most fun college!</p>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card">
        <img src="./img/nordmetall.jpg" alt="Nordmetall" style="width:100%">
        <div class="container">
          <h2>Nord College</h2>
          <p class="title">Ice! Ice! Ice!</p>
          <p>We are the biggest and newest college!</p>
        </div>
      </div>
    </div>
  </div>
</div>

<section class="colored-section" id="testimonials">
  <div id="testimonial-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active container-fluid">
        <p class="testimonial-text">
          The residential support team in Krupp College has a collective vision to make Krupp feel as homely as possible.
          We believe in the development of the whole student, and therefore what happens within their living space is as important as what happens in the classroom.
        </p>
        <img class="testimonial-image" src="./img/krupp_rm.jpg" alt="dog-profile">
        <em>Laura Smith, Krupp College Resident Mentor</em>
      </div>
      <div class="carousel-item container-fluid">
        <p class="testimonial-text">
          Being a Mercatorian (or having ‘blue blood’) is a very special thing. The Mercator community is a very inviting, accepting and tolerant one where everyone can feel at home. I also look forward to using my experiences, expertise and passion to mentor and assist students navigate their time here at Jacobs University.
        </p>
        <img class="testimonial-image" src="./img/mercator_rm.jpg" alt="lady-profile">
        <em>Dr. Adilah Ponnuragam, Mercator College Resident Mentor</em>
      </div>
      <div class="carousel-item container-fluid">
        <p class="testimonial-text">
          The most rewarding part of the Resident Mentor position is being able to give our young adults the best advice I would have wanted to receive when I was in their situation and seeing how our support really effects the development of our students and plays a part in their success here.
        </p>
        <img class="testimonial-image" src="./img/college3_rm.jpg" alt="lady-profile">
        <em>Robert Rennie, Resident Mentor</em>
      </div>
      <div class="carousel-item container-fluid">
        <p class="testimonial-text">My residential support team works hard to make Nord home for everyone who lives here, through events, comforting spaces, and resources. Research shows that college students learn and grow just as much, if not more, outside the classroom. Their residential living and extra-curricular activities play a large role in that, especially in the multi-cultural environment here at Jacobs.
        </p>
        <img class="testimonial-image" src="./img/nord_rm.jpg" alt="lady-profile">
        <em>Catherine Paro, Resident Mentor</em>
      </div>
    </div>
    <a class="carousel-control-prev" href="#testimonial-carousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#testimonial-carousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

</section>

<?php include 'templates/footer.php' ?>

</body>
</html>