<head>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="material/js/pages/chartist/chartist-init.css" rel="stylesheet">
    <link href="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    
</head>
    <!-- <link href="assets/libs/c3/c3.min.css" rel="stylesheet"> -->
    <!-- Custom CSS -->
    <!-- <link href="dist/css/style.min.css" rel="stylesheet"> -->
<!-- <div class="page-wrapper"> -->
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Dashboard </h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard </li>
                    </ol>
                </div>
                </div>
                <div class="container-fluid">
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div
                                        class="round round-lg text-white d-inline-block text-center rounded-circle bg-info">
                                        <i class="ti-wallet"></i>
                                    </div>
                                    <div class="ml-2 align-self-center">
                                        <h3 class="mb-0 font-weight-light">$3249</h3>
                                        <h5 class="text-muted mb-0">Total Revenue</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div
                                        class="round round-lg text-white d-inline-block text-center rounded-circle bg-warning">
                                        <i class="mdi mdi-cellphone-link"></i></div>
                                    <div class="ml-2 align-self-center">
                                        <h3 class="mb-0 font-weight-light">$2376</h3>
                                        <h5 class="text-muted mb-0">Online Revenue</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div
                                        class="round round-lg text-white d-inline-block text-center rounded-circle bg-primary">
                                        <i class="mdi mdi-cart-outline"></i></div>
                                    <div class="ml-2 align-self-center">
                                        <h3 class="mb-0 font-weight-light">$1795</h3>
                                        <h5 class="text-muted mb-0">Offline Revenue</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div  class="round round-lg text-white d-inline-block text-center rounded-circle bg-danger">
                                        <i class="mdi mdi-bullseye"></i></div>
                                    <div class="ml-2 align-self-center">
                                        <h3 class="mb-0 font-weight-light">$687</h3>
                                        <h5 class="text-muted mb-0">Ad. Expense</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
           
           
<div class="container-fluid">
    <div class="row">
    
        <div class="col-lg-3 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Graph 1</h4>
                    
<canvas id="li-chart" ></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ourchart1 = document.getElementById('li-chart');

new Chart(ourchart1, {
  type: 'line',
  data: {
    labels: ['MNFR','STKS','DSTR', 'DLER','RETR'],
    datasets: [{
      label: 'Chart',
      data: [110,450,250,530,370],
    borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
</script>
                            </div>
                        </div>
                    </div>
                  
                    <div class="col-lg-3 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Graph 2</h4>
                                <canvas id="bar-chart" ></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ourchart = document.getElementById('bar-chart');

new Chart(ourchart, {
  type: 'bar',
  data: {
    labels: ['MNFR','STKS','DSTR', 'DLER','RETR'],
    datasets: [{
      label: 'Chart',
      data: [100,550,250,430,370],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
</script>
                            </div>
                        </div>
                    </div>
                  
                    <div class="col-lg-3 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Graph 3</h4>
                                <canvas id="chart" ></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ourchart3 = document.getElementById('chart');

new Chart(ourchart3, {
  type: 'line',
  data: {
    labels: ['MNFR','STKS','DSTR', 'DLER','RETR'],
    datasets: [{
      label: 'Chart',
      data: [100,550,250,430,370],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
</script>
                            </div>
                        </div>
                    </div>
                   

                    <div class="col-lg-3 col-md-12">
                        <div class="card" style="width: inherit;">
                            <div class="card-body">
                                <h4 class="card-title">Graph 4</h4>
                                <canvas id="scatter-chart" ></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ourchart2 = document.getElementById('scatter-chart');

new Chart(ourchart2, {
  type: 'bar',
  data: {
    labels: ['MNFR','STKS','DSTR', 'DLER','RETR'],
    datasets: [{
      label: 'Chart',
      data: [110,450,250,530,370],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
</script>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    <div class="row">
                    <div class="col-lg-8">
                        <div class="card" style="height: 400px;">
                            <div class="card-body">
                                <h4 class="card-title">Map</h4>
                                <div id="visitfromworld" style="width:100%!important; height:290px"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Our Visitors </h3>
                                <h6 class="card-subtitle">Different Devices Used to Visit</h6>
                                <div id="Visitor-chart" style="height:290px; width:100%; margin-left: 25px;">  
                                <canvas id="visitor" ></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ourchart4 = document.getElementById('visitor');

new Chart(ourchart4, {
  type: 'doughnut',
  data: {
    labels: ['Mobile','Desktop','Tablet'],
    datasets: [{
      label: 'Chart',
      data: [350,550,170],
      borderWidth: 1
    }]
  }
});
</script>
                            </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex no-block align-items-center">
                                    <h4 class="card-title">List</h4>
                                    
                                </div>
                                <div class="total-sales" style="height: 365px;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Sales Prediction</h4>
                                        <div class="d-flex flex-row">
                                            <div class="align-self-center">
                                                <span class="display-6 text-primary">$3528</span>
                                                <h6 class="text-muted">10% Increased</h6>
                                                <h5 class="text-nowrap">(150-165 Sales)</h5>
                                            </div>
                                            <div class="ml-auto">
                        <div id="chart" style=" width:130px; height:130px;"></div>
                       
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Sales Difference</h4>
                                        <div class="d-flex flex-row">
                                            <div class="align-self-center">
                                                <span class="display-6 text-success">$4316</span>
                                                <h6 class="text-muted">10% Increased</h6>
                                                <h5  class="text-nowrap">(150-165 Sales)</h5>
                                            </div>
                                            <div class="ml-auto">
                                                <div class="ct-chart" style="width:120px; height: 120px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
    <aside class="customizer">
        <a href="javascript:void(0)" class="service-panel-toggle"><i class="fa fa-spin fa-cog"></i></a>
        <div class="customizer-body">
            <ul class="nav customizer-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true"><i class="mdi mdi-wrench font-20"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#chat" role="tab"
                        aria-controls="chat" aria-selected="false"><i class="mdi mdi-message-reply font-20"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                        aria-controls="pills-contact" aria-selected="false"><i
                            class="mdi mdi-star-circle font-20"></i></a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- Tab 1 -->
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="p-3 border-bottom">
                        <!-- Sidebar -->
                        <h5 class="font-medium mb-2 mt-2">Layout Settings</h5>
                        <div class="checkbox checkbox-info mt-3">
                            <input type="checkbox" name="theme-view" class="material-inputs" id="theme-view">
                            <label for="theme-view"> <span>Dark Theme</span> </label>
                        </div>
                        <div class="checkbox checkbox-info mt-2">
                            <input type="checkbox" class="sidebartoggler material-inputs" name="collapssidebar" id="collapssidebar">
                            <label for="collapssidebar"> <span>Collapse Sidebar</span> </label>
                        </div>
                        <div class="checkbox checkbox-info mt-2">
                            <input type="checkbox" name="sidebar-position" class="material-inputs" id="sidebar-position">
                            <label for="sidebar-position"> <span>Fixed Sidebar</span> </label>
                        </div>
                        <div class="checkbox checkbox-info mt-2">
                            <input type="checkbox" name="header-position" class="material-inputs" id="header-position">
                            <label for="header-position"> <span>Fixed Header</span> </label>
                        </div>
                        <div class="checkbox checkbox-info mt-2">
                            <input type="checkbox" name="boxed-layout" class="material-inputs" id="boxed-layout">
                            <label for="boxed-layout"> <span>Boxed Layout</span> </label>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </aside>
    
    <script src="material/js/pages/chartist/chartist.min.js"></script>
    <script src="material/js/pages/chartist/chartist-plugin-tooltip.min.js"></script>
    <!--c3 JavaScript -->
    <script src="assets/libs/d3/dist/d3.min.js"></script>
    <script src="assets/libs/c3/c3.min.js"></script>
    <!-- Chart JS -->
    <script src="material/js/pages/dashboards/dashboard6.js"></script>

