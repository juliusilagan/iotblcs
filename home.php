<?php
   require 'dbconnect.php';
   $sql="SELECT * FROM `roomlogs`";
   $query=mysqli_query($conn,$sql);
   
   if (isset($_GET['clearRoomLogs'])) {
       if ($_GET['clearRoomLogs']=="true") {
           echo "<script>alert('Record cleared');</script>";
       }
   }
   ?>
<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
      <title>Home</title>
      <link href="style.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="node_modules/datatables.net-dt/css/jquery.dataTables.css">

      <script src="jquery.js"></script>
      <style></style>
   </head>
   <body id="myFrame" class="app">
      <div>
         <div class="sidebar">
            <div class="sidebar-inner">
               <div class="sidebar-logo" style="background: -webkit-linear-gradient(left, rgba(249,252,247,1) 0%,rgba(245,249,240,1) 100%);">
                  <div class="peers ai-c fxw-nw">
                     <div class="peer peer-greed">
                        <a class="sidebar-link td-n" href="index.html">
                           <div class="peers ai-c fxw-nw">
                              <div class="peer">
                                 <div class="logo"><img src="assets/static/images/pup.PNG" height="60" alt=""></div>
                              </div>
                              <div class="peer peer-greed">
                                 <h5 class="lh-1 mB-0 logo-text" style="color: black;">IoT Based Light Control System</h5>
                              </div>
                           </div>
                        </a>
                     </div>
                     <div class="peer">
                        <div class="mobile-toggle sidebar-toggle"><a href="" class="td-n"><i class="ti-arrow-circle-left"></i></a></div>
                     </div>
                  </div>
               </div>
               <ul class="sidebar-menu scrollable pos-r" style="background: -webkit-linear-gradient(left, rgba(249,252,247,1) 0%,rgba(245,249,240,1) 100%);">
                  <li class="nav-item"><a class="sidebar-link" href="<?php echo $_SERVER['PHP_SELF']; ?>"><span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Home</span></a></li>
                  <li class="nav-item mT-30 active"><a class="sidebar-link" href="index.php"><span class="icon-holder"><i class="c-red-500 ti-dashboard"></i> </span><span class="title">Dashboard</span></a></li>
                  <li class="nav-item"><a class="sidebar-link" href="monthlyusage.php"><span class="icon-holder"><i class="c-green-500 ti-bar-chart"></i> </span><span class="title">Monthly usage</span></a></li>
               </ul>
            </div>
         </div>
         <div class="page-container">
            <div>
               <div class="header navbar">
                  <div class="header-container" style="background-image: linear-gradient(to top, #c80303, #be0606, #b40809, #ab0b0b, #a10d0d);">
                     <ul class="nav-left">
                        <li><a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i class="ti-menu" style="color: gold;"></i></a></li>
                        
                     </ul>
                     <ul class="nav-right">
                       <li>
                         <h2 id="clockbox" style="color: white;"></h2>
                       </li>
                     </ul>
                  </div>
               </div>
            </div>
            <main class="main-content" style="background-image: linear-gradient(to right top, #051937, #001b2c, #001a1c, #071611, #10110f);">

               <style type="text/css"></style>
               <br><div class="wpb_wrapper">
                  <center><h1 style="color: gold; font-family: helvetica">IoT-Based Light Monitoring System</h1></center></div>
                  <div class="d-flex justify-content-center">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-wrap="true" data-interval="3000" style="width:700px;height:360px" >
               <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="8"></li>
               </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                     <img src="assets\static\images\homepage\carousel.jpg" alt="First slide" style="width:700px;height:360px">
                  </div>
                  <div class="carousel-item">
                     <img src="assets\static\images\homepage\carousel1.png" alt="First slide" style="width:700px;height:360px">
                  </div>
                  <div class="carousel-item">
                     <img src="assets\static\images\homepage\carousel2.png" alt="First slide" style="width:700px;height:360px">
                  </div>
                  <div class="carousel-item">
                     <img src="assets\static\images\homepage\carousel3.png" alt="First slide" style="width:700px;height:360px">
                  </div>
                  <div class="carousel-item">
                     <img src="assets\static\images\homepage\carousel4.png" alt="First slide" style="width:700px;height:360px">
                  </div>
                  <div class="carousel-item">
                     <img src="assets\static\images\homepage\carousel5.png" alt="First slide" style="width:700px;height:360px">
                  </div>
                  <div class="carousel-item">
                     <img src="assets\static\images\homepage\carousel6.png" alt="First slide" style="width:700px;height:360px">
                  </div>
                  <div class="carousel-item">
                     <img src="assets\static\images\homepage\carousel7.png" alt="First slide" style="width:700px;height:360px">
                  </div>
                  <div class="carousel-item">
                     <img src="assets\static\images\homepage\carousel8.png" alt="First slide" style="width:700px;height:360px">
                  </div>
                   </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" >
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
 </div>
</div>
  </a></br>
      <br><center><h2 style="color: red; font-family: helvetica"> About the System</h2></center>

      <style> 
.newspaper {
    -webkit-column-count: 3; /* Chrome, Safari, Opera */
    -moz-column-count: 3; /* Firefox */
    column-count: 3;
    -webkit-column-width: 90px; /* Chrome, Safari, Opera */
    -moz-column-width: 90px; /* Firefox */
    column-width: 90px;
    text-align: justify;
    .indented {
  padding-left: 150pt;
  padding-right: 150pt;
}
</style>

      <br><div class="newspaper" style= "color: white; font-family: helvetica; ">
<p class="indented">Nowadays we cannot imagine our daily life without electricity because it has become a necessity for all, without which day-to-day life chores & daily activities become stand still. In line with that, energy consumption growth has been a big issue in today’s generation. Major part of electricity is being wasted due to inadequate use. The Polytechnic University of the Philippines, Binan Campus is one of the numerous educational institution that are facing an electricity hike with its continued usage of different appliances especially the room lights. In today’s world, there is a continuous need for automatic devices. With the increase in standard of living, there is a sense of urgency for developing circuits that would ease the complexity of life.
The IoT-based Light Monitoring System is proposed with the objective of minimizing the wastage of electricity by the use of Gizduino (a clone of Arduino) and PIR sensors. When a student enters into the room, the PIR sensor gives the corresponding signal to the Gizduino. The Gizduino is programmed in such way that will detect the student’s motion by the reception of the signal from the PIR, and will turn on the lights inside the room. However, if there is no motion detected by the PIR sensor the room lights will automatically turn off after the corresponding time that was inputted in the Gizduino. With the system being monitored by the PUP administration, the energy consumption will be reduced and will create a huge impact in terms of energy-efficient lighting.
The system will convey the campus in the world of the IoT with its automation feature and modern structure system. The Internet of Things, or IoT refers to the billions of physical devices around the world that are now connected to the internet, collecting and sharing data. Any physical object can be transformed into an IoT device if it can be connected to the internet and controlled that way. Thanks to cheap processors and wireless networks, it's possible to turn anything, from a pill to an aero plane, into part of the IoT. IoT-based light monitoring system will give the PUP Binan Campus the ability to monitor group of lights from a single user interface device and will play an important role as a high-quality energy efficient lighting system to achieve a low energy consumption.
</div></br>
      <!--<center><p style="padding-left: 160px; padding-right: 160px; color: white; font-family: helvetica">     
</div>-->

      <br><center><h2 style="color: red; font-family: helvetica"> The Project Prototype </h2></center>
   <center><video width = "700" height = "500" controls>
         <source src = "assets\static\vid\PUPFINALAUTOCAD.mp4" type = "video/mp4">
      </video></center><br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>

              
            </main>
            <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600"><span>Copyright © 2017 Designed by <a href="https://colorlib.com" target="_blank" title="Colorlib">Colorlib</a>. All rights reserved.</span></footer>
         </div>
      </div>
      <script type="text/javascript" src="vendor.js"></script>
      <script type="text/javascript" src="bundle.js"></script>
      
      <script src="Chart.bundle.js"></script>
      <script src="jquery.easing.min.js"></script>
      
      <script>
         $(document).ready(function() {

            
           
         });
      </script>
   </body>
</html>