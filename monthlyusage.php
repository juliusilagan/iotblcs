<?php
   require 'dbconnect.php';
   
   ?>
<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
      <title>Monthly usage</title>
      <link href="style.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="node_modules/datatables.net-dt/css/jquery.dataTables.css">

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
                  <li class="nav-item"><a class="sidebar-link" href="home.php"><span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Home</span></a></li>
                  <li class="nav-item mT-30 active"><a class="sidebar-link" href="index.php"><span class="icon-holder"><i class="c-red-500 ti-dashboard"></i> </span><span class="title">Dashboard</span></a></li>
                  <li class="nav-item"><a class="sidebar-link" href="<?php echo $_SERVER['PHP_SELF']; ?>"><span class="icon-holder"><i class="c-green-500 ti-bar-chart"></i> </span><span class="title">Monthly usage</span></a></li>
                  
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
                         <h4 id="clockbox" style="color: white;"></h4>

                       </li>
                     </ul>
                  </div>
               </div>
            </div>
            <main class="main-content" style="background-image: linear-gradient(to right top, #051937, #001b2c, #001a1c, #071611, #10110f);">
              <div class="card-deck">
  <div class="card">
   <div class="card-header">
    Monthly consumption
  </div>
      <div class="card-body">
      
      <canvas id="myChart1"></canvas>
      <div class="d-flex justify-content-center">
      <a class="btn btn-warning" href="cron/cron.php" role="button"><span class="ti-reload"></span>Refresh</a>  
      </div>
      
    </div>
  </div>
  <div class="card">
   
    <div class="card-body">
      <div class="row">
         <div class="card border-dark mb-3 col-6">
            <h5 id="monthof" class="card-title"></h5>

         </div>
         <div class="card border-dark mb-3 col-6">
            <h5 class="card-title">Average consumption per month</h5>
         </div>
      </div>
    </div>
  </div>
</div>
            </main>
            <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600"><span>Copyright © 2017 Designed by <a href="https://colorlib.com" target="_blank" title="Colorlib">Colorlib</a>. All rights reserved.</span></footer>
         </div>
      </div>
      <script type="text/javascript" src="vendor.js"></script>
      <script type="text/javascript" src="bundle.js"></script>
      <script src="jquery.js"></script>
      <script src="Chart.bundle.js"></script>
      <script src="jquery.easing.min.js"></script>
      
      <script>
         $(document).ready(function() {
           $.get("getmonthlyusage.php", function(data){
            var res = JSON.parse(data);
            var ctx0 = document.getElementById("myChart1");
                                       var myChart0 = new Chart(ctx0, {
                                           type: 'line',
                                           data: {
                                               labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                               datasets: [{
                                                   label: 'consumption',
                                                   backgroundColor: 'rgb(255,140,0,.5)',
            borderColor: 'rgb(255,140,0)',
            data: res
                                               }]
                                           },options: {                                    
                                               
                                               title: {
                                                   display: true,
                                                   text: 'kwh Graph'
                                               }
                                           }
                                       }); 
           });
           

           var ctx = document.getElementById("myChart2");
                                       var myChart = new Chart(ctx, {
                                           type: 'doughnut',
                                           data: {
                                               labels: ["201", "202", "203"],
                                               datasets: [{
                                                   label: '# of Votes',
                                                   data: [1,2,3],
                                                   backgroundColor: [
                                                       'rgb(255,0,0,0.5)',
                                                       'rgba(54, 162, 235, 0.5)',
                                                       'rgba(255, 206, 86, 0.5)'
                                                   ],
                                                   borderColor: [
                                                       '#FF0000',
                                                       'rgba(54, 162, 235, 1)',
                                                       'rgba(255, 206, 86, 1)'
                                                   ],
                                                   borderWidth: 0.5
                                               }]
                                           },
                                           options: {                                    
                                               responsive: true,
                                               legend: {
                                                   position: 'bottom',
                                               },
                                               animation: {
                                                   animateRotate: true,
                                                   animateScale: false
                                               },
                                               title: {
                                                   display: true,
                                                   text: 'Usage breakdown kwh'
                                               }
                                           }
                                       });   
         });
      </script>

      <script>
var tday=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
var tmonth=["January","February","March","April","May","June","July","August","September","October","November","December"];

function GetClock(){
var d=new Date();
var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getFullYear();
var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

if(nhour==0){ap=" AM";nhour=12;}
else if(nhour<12){ap=" AM";}
else if(nhour==12){ap=" PM";}
else if(nhour>12){ap=" PM";nhour-=12;}

if(nmin<=9) nmin="0"+nmin;
if(nsec<=9) nsec="0"+nsec;

var clocktext=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"";
document.getElementById('clockbox').innerHTML=clocktext;
var ko= "Month of " + tmonth[nmonth];
document.getElementById('monthof').innerHTML=ko;
}

GetClock();
setInterval(GetClock,1000);
</script>
   </body>
</html>