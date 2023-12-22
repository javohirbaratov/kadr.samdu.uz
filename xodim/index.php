<?php
  include_once 'ximoya.php';
  $_SESSION['page'] = 1;  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once 'css.php'; ?>
  </head>
  <body class="app sidebar-mini">
  <?php include_once 'header.php'; ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Bosh sahifa</h1>
          <p>Qulay boshqaruv paneli endi yangicha ko'rinishda. Qo'llanma bilan tanishib chiqish tavsiya etiladi</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Bosh sahifa</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <a href="xodims-qabul.php" style="color:#000;">
              <h4>Xodimlar soni</h4>
              <?php
                $sql = mysqli_query($link,"SELECT COUNT(id) FROM `xodimlar`");
                $fetch = mysqli_fetch_row($sql);
              ?>
              <p><b><?=$fetch[0]?></b> ta</p>
              </a>              
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-briefcase fa-3x"></i>
            <div class="info">
              <a href="xodims-qabul.php?kadr_bulim_id=3" style="color:#000;">
              <h4>Qabul qilingan xo'jalik bo'limi</h4>             
              <?php                
                $sql = mysqli_query($link,"SELECT COUNT(id) FROM `qabul` WHERE kadr_bulim_id='3'");
                $fetch = mysqli_fetch_row($sql);
              ?>
              <p><b><?=$fetch[0]?></b> ta</p>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-briefcase fa-3x"></i>
            <div class="info">
              <a href="xodims-qabul.php?kadr_bulim_id=3" style="color: #000;">
              <h4>Boshqaruv xodimlari</h4>             
              <?php
                $sql = mysqli_query($link,"SELECT COUNT(id) FROM `qabul` WHERE kadr_bulim_id='2'");
                $fetch = mysqli_fetch_row($sql);
              ?>
              <p><b><?=$fetch[0]?></b> ta</p>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-briefcase fa-3x"></i>
            <div class="info">
              <a href="xodims-qabul.php?kadr_bulim_id=3" style="color: #000;">
              <h4>Profes o'qituvchilar</h4>             
              <?php
                $sql = mysqli_query($link,"SELECT COUNT(id) FROM `qabul` WHERE kadr_bulim_id='1'");
                $fetch = mysqli_fetch_row($sql);
              ?>
              <p><b><?=$fetch[0]?></b> ta</p>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-briefcase fa-3x"></i>
            <div class="info">
              <a href="xodims-qabul.php?kadr_bulim_id=3" style="color: #000;">
              <h4>Grand xodimlari</h4>             
              <?php
                $sql = mysqli_query($link,"SELECT COUNT(id) FROM `qabul` WHERE kadr_bulim_id='4'");
                $fetch = mysqli_fetch_row($sql);
              ?>
              <p><b><?=$fetch[0]?></b> ta</p>
              </a>
            </div>
          </div>
        </div>        
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <div class="ratio ratio-16x9">
              <canvas id="position"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="tile">
            <div class="ratio ratio-16x9">
              <canvas id="gender"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="tile">
            <div class="ratio ratio-16x9">
              <canvas id="citizenship"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="tile">
            <div class="ratio ratio-16x9">
              <canvas id="academic_degree"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="tile">
            <div class="ratio ratio-16x9">
              <canvas id="academic_rank"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="tile">
            <div class="ratio ratio-16x9">
              <canvas id="direction"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="tile">
            <div class="ratio ratio-16x9">
              <canvas id="academic"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="tile">
            <div class="ratio ratio-16x9">
              <canvas id="age"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="tile">
            <div class="ratio ratio-16x9">
              <canvas id="employment_form"></canvas>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php include_once 'js.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
      function position(date) {
        const xValues = Object.keys(date);
        const yValues = Object.values(date);
        const barColors = [
          "#b91d47",
          "#00aba9",
          "#2b5797",
          "#e8c3b9",
          "#1e7145"
        ];

        new Chart("position", {
          type: "doughnut",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "Statistika - xodimlar bo'yicha <?=date('Y')?>"
            }
          }
        });
      }

      function gender(date) {
        const xValues = Object.keys(date);
        const yValues = Object.values(date);
        const barColors = [
          "#b91d47",
          "#00aba9",
          "#2b5797",
          "#e8c3b9",
          "#1e7145"
        ];

        new Chart("gender", {
          type: "pie",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "Statistika - Jins bo'yicha <?=date('Y')?>"
            }
          }
        });
      }

      function citizenship(date) {
        const xValues = Object.keys(date);
        const yValues = Object.values(date);
        const barColors = [
          "#b91d47",
          "#00aba9",
          "#2b5797",
          "#e8c3b9",
          "#1e7145"
        ];

        new Chart("citizenship", {
          type: "doughnut",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "Statistika - Fuqorolik bo'yicha <?=date('Y')?>"
            }
          }
        });
      }

      function academic_degree(date) {
        var degreeNames = Object.keys(date);

        // Extract values for Erkak and Ayol separately
        var valuesErkak = degreeNames.map(function (degree) {
          return date[degree]["Erkak"];
        });

        var valuesAyol = degreeNames.map(function (degree) {
          return date[degree]["Ayol"];
        });

        // Create a radar chart
        var ctx = document.getElementById("academic_degree").getContext("2d");
        var academicDegreeChart = new Chart(ctx, {
          type: "radar",
          data: {
            labels: degreeNames,
            datasets: [
              {
                label: "Erkak",
                data: valuesErkak,
                backgroundColor: "rgba(75, 192, 192, 0.2)",
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 1
              },
              {
                label: "Ayol",
                data: valuesAyol,
                backgroundColor: "rgba(255, 99, 132, 0.2)",
                borderColor: "rgba(255, 99, 132, 1)",
                borderWidth: 1
              }
            ]
          },
          options: {
            scale: {
              ticks: {
                beginAtZero: true
              }
            }
          }
        });
      }

      function academic_rank(date) {
        // Extract keys (rank names)
        var rankNames = Object.keys(date);

        // Extract values for Erkak and Ayol separately
        var valuesErkak = rankNames.map(function (rank) {
          return date[rank]["Erkak"];
        });

        var valuesAyol = rankNames.map(function (rank) {
          return date[rank]["Ayol"];
        });

        // Create a radar chart
        var ctx = document.getElementById("academic_rank").getContext("2d");
        var academicRankChart = new Chart(ctx, {
          type: "radar",
          data: {
            labels: rankNames,
            datasets: [
              {
                label: "Erkak",
                data: valuesErkak,
                backgroundColor: "rgba(75, 192, 192, 0.2)",
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 1
              },
              {
                label: "Ayol",
                data: valuesAyol,
                backgroundColor: "rgba(255, 99, 132, 0.2)",
                borderColor: "rgba(255, 99, 132, 1)",
                borderWidth: 1
              }
            ]
          },
          options: {
            scale: {
              ticks: {
                beginAtZero: true
              }
            }
          }
        });
      }

      function direction(date) {
        const xValues = Object.keys(date);
        const yValues = Object.values(date);
        const barColors = [
          "#b91d47",
          "#00aba9",
          "#2b5797",
          "#e8c3b9",
          "#1e7145"
        ];

        new Chart("direction", {
          type: "doughnut",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "Statistika - Lavozim bo'yicha <?=date('Y')?>"
            }
          }
        });
      }

      function academic(date) {
        const xValues = Object.keys(date);
        const yValues = Object.values(date);
        const barColors = [
          "#b91d47",
          "#00aba9",
          "#2b5797",
          "#e8c3b9",
          "#1e7145"
        ];

        new Chart("academic", {
          type: "doughnut",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "Statistika - Academic bo'yicha <?=date('Y')?>"
            }
          }
        });
      }
      
      function age(date) {
        // Extract keys (age ranges)
        var ageRanges = Object.keys(date);

        // Extract values for Erkak and Ayol separately
        var valuesErkak = ageRanges.map(function (ageRange) {
          return date[ageRange]["Erkak"];
        });

        var valuesAyol = ageRanges.map(function (ageRange) {
          return date[ageRange]["Ayol"];
        });

        // Create a grouped bar chart
        var ctx = document.getElementById("age").getContext("2d");
        var ageDistributionChart = new Chart(ctx, {
          type: "bar",
          data: {
            labels: ageRanges,
            datasets: [
              {
                label: "Erkak",
                data: valuesErkak,
                backgroundColor: "rgba(75, 192, 192, 0.2)",
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 1
              },
              {
                label: "Ayol",
                data: valuesAyol,
                backgroundColor: "rgba(255, 99, 132, 0.2)",
                borderColor: "rgba(255, 99, 132, 1)",
                borderWidth: 1
              }
            ]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      }

      function employment_form(date) {
        const xValues = Object.keys(date);
        const yValues = Object.values(date);
        const barColors = [
          "#b91d47",
          "#00aba9",
          "#2b5797",
          "#e8c3b9",
          "#1e7145"
        ];

        new Chart("employment_form", {
          type: "pie",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "Statistika - Ishga qabul qilish shakli bo'yicha <?=date('Y')?>"
            }
          }
        });
      }

      $.ajax({
        url: "https://student.hemis.uz/rest/v1/public/stat-employee",
        method: "GET",
        dataType: "json",
        success: function (data) {
          position(data.data.position)
          gender(data.data.gender)
          citizenship(data.data.citizenship)
          academic_degree(data.data.academic_degree)
          academic_rank(data.data.academic_rank)
          direction(data.data.direction)
          academic(data.data.academic)
          age(data.data.age)
          employment_form(data.data.employment_form)

        },
        error: function (error) {
          console.error("Xatolik:", error);
        }
      });
    </script>
  </body>
</html>