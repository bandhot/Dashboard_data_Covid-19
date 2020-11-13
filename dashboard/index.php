<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL ,'https://api.covid19api.com/summary');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($curl);
curl_close($curl);

$result = json_decode($result, true);


$country = $result['Countries'];


$global = $result['Global'];
$TotalConfirmed = (string)$global['TotalConfirmed'];
$NewConfirmed = (string)$global['NewConfirmed'];
$NewDeaths = (string)$global['NewDeaths'];
$TotalDeaths = (string)$global['TotalDeaths'];
$NewRecovered = (string)$global['NewRecovered'];
$TotalRecovered = (string)$global['TotalRecovered'];

$countries = $result['Countries'];

$persent_temp = $TotalDeaths/$TotalConfirmed*100;
$persent = $TotalRecovered/$TotalConfirmed*100;
?>
<!doctype html>
<html lang="en">
<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coronaboard</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
  integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
  crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    body{
      background-color: black;
    }
  </style>
</head>
<body>
  
  <nav class="navbar navbar-secondary bg-secondary">
    <a class="navbar-brand" href="#">
      <i class="fas fa-virus d-inline-block align-top text-light" alt="" loading="lazy" style="font-size: 35px;"></i>
      <small class="font-weight-bold text-light text-monospace">Data Covid-19</small>
      <h6 style="color: blanchedalmond;"class="font-weight-bold text-monospace">Date : <?php echo date('d F Y'); ?></h6>
    </a>
  </nav>
  
  <div class="container-fluid">
    <div class="row d-flex justify-content-center">
      <div class="col-sm-12 col-md-3 col-lg-3 d-flex justify-content-center">    
        <div class="card mb-2 mt-3" style="width: 18rem;">
          <div class="card-header border border-info text-info">
            <i class="fas fa-virus d-inline-block align-top " alt="" loading="lazy" style="font-size: 35px;"></i>
            <small class="font-weight-bold  text-monospace" style="font-size: 20px;">Total Confirmed</small>
            <h6 style="text-align: center;"><?= number_format($TotalConfirmed);?>  Jiwa</h6> <div class="card-footer mb-2 text-muted" style="height: 10px; text-align:center">
              <p class="text-info"><?= number_format($NewConfirmed);?>  New Cases</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-3 col-lg-3 d-flex justify-content-center">  
        <div class="card border border-danger mb-2 mt-3" style="width: 18rem;">
          <div class="card-header " style="color: orange;">
            <i class="fas fa-skull-crossbones d-inline-block align-top " alt="" loading="lazy" style="font-size: 35px;"></i>
            <small class="font-weight-bold  text-monospace" style="font-size: 20px;">Total Death</small>
            <h6 style="text-align: center;"><?= number_format($TotalDeaths);?>  Jiwa</h6><div class="card-footer mb-2 text-muted" style="height: 10px; text-align:center">
              <p style="color: orange;"><?= number_format($NewDeaths);?>  New Death</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-3 col-lg-3 d-flex justify-content-center">     
        <div class="card mb-2 mt-3" style="width: 18rem;">
          <div class="card-header border border-success text-success">
            <i class="fas fa-virus-slash d-inline-block align-top " alt="" loading="lazy" style="font-size: 35px;"></i>
            <small class="font-weight-bold  text-monospace" style="font-size: 20px;">Total Recovered</small>
            <h6 style="text-align: center;"><?= number_format($TotalRecovered); ?>  Jiwa</h6><div class="card-footer mb-2 text-muted" style="height: 10px; text-align:center">
              <p class="text-success"><?= number_format($NewRecovered);?>  New Yoku naru</p>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-3 col-lg-3">
        <div style="width:320px; height:440px; overflow:auto;">
          <table class="table-responsive-sm" >
            <tbody>
              <tr>
                <th scope="row"> 
                  <?php foreach ($country as $key):?>
                  <h4 style="text-align: center;" class="text-monospace text-light"> <?php echo($key['Country'])."<br>";?></h4>
                  <hr width="75%"  style="background-color: black;" >
                  <p class="ml-3 text-monospace" style="font-size: 75%; color:blanchedalmond;">Confirmed : <?php echo($key['TotalConfirmed'])."<br>";?></p>
                  <p class="ml-3 text-monospace" style="font-size: 75%; color:blanchedalmond;">Deaths &emsp; : <?php echo($key['TotalDeaths'])."<br>";?></p>
                  <p class="ml-3 text-monospace" style="font-size: 75%; color:blanchedalmond">Recovered : <?php echo($key['TotalRecovered'])."<br>";?></p>
                  <?php endforeach; ?>
                </th>                 
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-9">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4 ml-5">
              <div class="card card-header border border-secondary">
                <h4 style="text-align: center; font-size: 1.4vw;" class="text-monospace text-light">Percent Recovered</h4>
                <center><h5 class="text-light"><?php echo substr($persent, 0, 2); ?> %</h5></center>
              </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 ml-5">
              <div class="card card-header border border-secondary mt-1">
                <h4 style="text-align: center; font-size: 1.4vw;" class="text-monospace text-light">Percent Deaths</h4>
                <center><h5 class="text-light"><?php echo substr($persent_temp, 0, 4); ?> %</h5></center>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-2 col-sm-12">
          <h4 class="mt-2 mb-2 text-monospace text-light">Confirmed</h4>
          <canvas id="myChart" width="100px" height="33px"></canvas>
        </div>
      </div>
    </div>
  </div>  
  
  <script>
    var ctx = document.getElementById('myChart').getContext('2d')
    
    var covid = $.ajax({
      url: "https://api.covid19api.com/summary",
      cache : false
    })
    
    .done(function (canvas) {
      
      
      function getContries(canvas) {
        var show_country=[];
        
        canvas.Countries.forEach(function(el) {
          show_country.push(el.Country);
        })
        return show_country;
      }
      
      function getConfirmed(canvas) {
        var Confirmed=[];
        
        canvas.Countries.forEach(function(el) {
          Confirmed.push(el.TotalConfirmed)
        })
        return Confirmed;
      }    
      var colors = [];
      function getRandomColor(){
        var r = Math.floor(Math.random() * 225);
        var g = Math.floor(Math.random() * 225);
        var b = Math.floor(Math.random() * 225);
        return "rgb(" + r + "," + g + "," + b + ")";
      }
      for (var i in canvas.Countries){
        colors.push(getRandomColor());
      }
      
      var myChart = new Chart(ctx,{
        type: 'bar',
        options: {
          responsive: true,
          legend: {
            position: 'left',
          }
        },
        data: {
          labels: getContries(canvas),
          datasets : [{
            label: 'TotalConfirmed',
            data: getConfirmed(canvas),
            backgroundColor:colors,
            borderColor:colors,
            borderWidth: 0.2,
            
          }]
        },
        options:{
          // responsive:true,
          legend:{
            display:false
          }
        }
      })
    });
  </script>
  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>