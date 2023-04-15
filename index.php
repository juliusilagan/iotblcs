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
      <title>Dashboard</title>
      <script src="jquery.js"></script>
      <script src="Chart.bundle.js"></script>
      <script src="jquery.easing.min.js"></script>
      <style>
         .chart {
         position: relative;
         display: inline-block;
         width: 110px;
         height: 110px;
         text-align: center;
         }
         .chart canvas {
         position: absolute;
         top: 0;
         left: 0;
         }
         .percent {
         display: inline-block;
         line-height: 110px;
         z-index: 2;
         }
         .percent:after {
         content: '%';
         margin-left: 0.1em;
         font-size: .8em;
         }
         .highlight {
         color (default: "#ffff99");
         }
         #loader {
         transition: all .3s ease-in-out;
         opacity: 1;
         visibility: visible;
         position: fixed;
         height: 50vh;
         width: 100%;
         background: #fff;
         z-index: 90000
         }
         #loader.fadeOut {
         opacity: 0;
         visibility: hidden
         }
         .spinner {
         width: 40px;
         height: 40px;
         position: absolute;
         top: calc(50% - 20px);
         left: calc(50% - 20px);
         background-color: #333;
         border-radius: 100%;
         -webkit-animation: sk-scaleout 1s infinite ease-in-out;
         animation: sk-scaleout 1s infinite ease-in-out
         }
         @-webkit-keyframes sk-scaleout {
         0% {
         -webkit-transform: scale(0)
         }
         100% {
         -webkit-transform: scale(1);
         opacity: 0
         }
         }
         @keyframes sk-scaleout {
         0% {
         -webkit-transform: scale(0);
         transform: scale(0)
         }
         100% {
         -webkit-transform: scale(1);
         transform: scale(1);
         opacity: 0
         }
         }
      </style>
      <script>
         $(document).ready(function() {
            /*$('.carousel').carousel();*/
            $("#Calculatetrigger").click(function(){
               var v= $("#enterwatts").val();
               var w= $("#kwhrate").val();
               $.ajax({url: "calculateusage.php?watts="+v+"&kwhrate="+w,dataType:"json", success: function(res){
                  var rs= res;
                  console.log(rs);
                  $('#usageDisp').text(rs[0]+" kwh");
                    if (rs[2] <= 1) {rs[2]=0.00;}
                  $('#l1').html("<b>Estimated cost:</b> ₱"+rs[2]);
                  $('#l2').html("<b>Total hours:</b> "+rs[1]+" hr(s)");
               }});
                $.ajax({url:"usagebreakdown.php?watts="+v, dataType: "json", success: function(res){
                                       var result=res;
                                       console.log(result);
                                       var ctx = document.getElementById("myChart2");
                                       var myChart = new Chart(ctx, {
                                           type: 'doughnut',
                                           data: {
                                               labels: ["201", "202", "203"],
                                               datasets: [{
                                                   label: '# of Votes',
                                                   data: result,
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
                                                   text: 'Usage breakdown Kwh'
                                               }
                                           }
                                       });    
                                    }});
            });
             $('#clearall').click(function(){
                 $('#clearall').toggle();
                 $('#hide1').toggle();
                 $('#hide2').toggle();
             });
             $('#panel1close').click(function(){
                 $('#clearall').toggle();
                 $('#hide1').toggle();
                 $('#hide2').toggle();
             });
            
             $.ajax({url:"chartdata.php", dataType: "json", success: function(res){
                var result=res;
                var ctx = document.getElementById("myChart");
                var myChart = new Chart(ctx, {
                  type: 'doughnut',
                  data: {
                  labels: ["201", "202", "203"],
                  datasets: [{
                  label: '# of Votes',
                  data: result,
                  backgroundColor: [
                    '#1c4380',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                    ],
                  borderColor: [
                    '#1c4380',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                    ],
                  borderWidth: 1.5
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
                    text: 'Room usasge'
                    }
                  }
                });    
              }});
             
             setInterval(function() {
                 $.get("ajaxPanel1.php", function(data) {
                     var res = JSON.parse(data);
                     $('#list1').html(res[0]);
                     $('#list2').html(res[1]);
                     $('#list3').html(res[2]);
                     $('#list4').html(res[3]);
                 });
                 
             }, 5000);
         
         });
      </script>
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
                  <li class="nav-item mT-30 active"><a class="sidebar-link" href="<?php echo $_SERVER['PHP_SELF']; ?>"><span class="icon-holder"><i class="c-red-500 ti-dashboard"></i> </span><span class="title">Dashboard</span></a></li>
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
                         <h4 id="clockbox" style="color: white;"></h4>
                       </li>
                     </ul>
                  </div>
               </div>
            </div>
            <main class="main-content" style="background-image: linear-gradient(to right top, #051937, #001b2c, #001a1c, #071611, #10110f);">
              
               <!-- modals1 -->
               <div class="modal fade" id="ajaxpanel1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Room logs</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <div class="modal-body">
                           <div class="d-flex flex-row">
                              <div class="p-2"><button class="btn btn-danger" id="clearall" type="button"><span><i class="ti-trash"></i>Clear all</span></button></div>
                              <div id="hide1" style="display: none;" class="p-5">Are you sure?</div>
                              <div id="hide2" style="display: none; class="p-2"><a href="clearRoomLogs.php" class="btn btn-success" id="panel1confirm"><i class="ti-check text-white"></i></a>
                                 <button class="btn btn-danger" id="panel1close" type="button"><i class="ti-close"></i></button>
                              </div>
                           </div>
                           <br>
                           <table id="dataTable2" class="display cell-border" style="width:100%">
                              <thead>
                                 <tr>
                                    <th>Room #</th>
                                    <th>Status</th>
                                    <th>Time</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    while ($res=mysqli_fetch_row($query)) {
                                       echo "<tr>";
                                       echo "<td>".$res[1]."</td>";
                                       echo "<td>".$res[2]."</td>";
                                       echo "<td>".$res[3]."</td>";
                                       echo "</tr>";
                                    }
                                    ?>
                              </tbody>
                           </table>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- modals1 -->
               <!-- modals2 -->
               <div class="modal fade" id="ajaxpanel2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel"></h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <div class="modal-body">
                           <h5 class="text-center text-black">Your estimated consumption for this month is:</h5>
                           <h5 class="text-center" id="usageDisp"></h5>
                           <ul style="list-style-type:disc">
                              <li id="l1">Estimated cost</li>
                              <li id="l2">Total lights-on time: </li>
                           </ul>
                           <hr>
                           <canvas id="myChart2"></canvas>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- modals2 -->
               <!-- modal3 -->
               <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel"></h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <div class="modal-body">
                           
                           <canvas id="myChart"></canvas>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- modal3 -->
               <div class="card-deck">
                  <div class="card">
                     <h5 class="card-header">Recent alerts</h5>

                     <div class="card-body">
                      <p class="text-center"><i class="ti-alert c-orange-500 display-3"></i></p>
                      <h2 class="text-center">Recent alerts</h2>
                        <div class="list-group">
                           <a href="#" id="list1" class="list-group-item list-group-item-action">Loading...</a>
                           <a href="#" id="list2" class="list-group-item list-group-item-action">Loading...</a>
                           <a href="#" id="list3" class="list-group-item list-group-item-action">Loading...</a>
                           <a href="#" id="list4" class="list-group-item list-group-item-action">Loading...</a>
                        </div>
                        <br>
                        <div class="text-center">
                           <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ajaxpanel1">See more</button>
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <h5 class="card-header">Usage Calculator</h5>
                     <div class="card-body">
                        <div class="text-center">
                           <!-- <img src="assets/static/images/power logo.jpg" width="70" class="img-thumbnail" alt="Responsive image"> -->
                           <p class="text-center"><i class="ti-plug c-green-500 display-3"></i></p>
                           <h2>Estimate usage</h2>
                           <div class="input-group mb-3">
                              <input type="number" id="enterwatts" class="form-control" value="15" placeholder="Power rating" aria-label="Power rating" aria-describedby="basic-addon1">
                              <div class="input-group-append">
                                 <span class="input-group-text" id="basic-addon2">Watts</span>
                              </div>
                           </div>
                           <div class="input-group mb-3">
                              <input type="number" id="kwhrate" class="form-control" placeholder="kwh rating" aria-label="Power rating" aria-describedby="basic-addon1">
                              <div class="input-group-append">
                                 <span class="input-group-text" id="basic-addon2">per kwh</span>
                              </div>
                           </div>
                        </div>
                        <div class="text-center">
                           <button type="button" id="Calculatetrigger" class="btn btn-outline-success float-center" data-toggle="modal" data-target="#ajaxpanel2">
                           Calculate
                           </button>  
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <h5 class="card-header">Room status</h5>
                     <div class="card-body">
                        <p class="text-center"><i class="ti-eye c-blue-500 display-3"></i></p>
                        <h2 class="text-center">Monitor status</h2>
                        <table id="dataTable" class="display" style="width:100%">
                           <thead>
                              <tr>
                                 <th>Room #</th>
                                 <th>Status</th>
                              </tr>
                           </thead>
                        </table>
                     </div>
                  </div>
               </div>
            </main>
            <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600"><span>Copyright © 2017 Designed by <a href="https://colorlib.com" target="_blank" title="Colorlib">Colorlib</a>. All rights reserved.</span></footer>
         </div>
      </div>
      <script type="text/javascript" src="vendor.js"></script>
      <script type="text/javascript" src="bundle.js"></script>
      <script src="jquery.easypiechart.min.js"></script>
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
}

GetClock();
setInterval(GetClock,1000);
</script>
   </body>
</html>