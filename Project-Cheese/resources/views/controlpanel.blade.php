<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cheese - Dashboard</title>

    <!-- Bootstrap core CSS-->
    <link href="/Web-Assets/ControlPanelAssets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="/Web-Assets/ControlPanelAssets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="/Web-Assets/ControlPanelAssets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/Web-Assets/ControlPanelAssets/css/sb-admin.css" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Scripts -->

    <script>
        function load() {
          document.getElementById("lists").style.display = 'none';
        }
        function sub() {
          document.getElementById("lists").style.display = 'none';
          document.getElementById("submits").style.display = 'block';
        }
        function lis() {
          document.getElementById("lists").style.display = 'block';
          document.getElementById("submits").style.display = 'none';
        }
    </script>


  </head>

  <body id="page-top" onload="load()">

    <nav class="navbar navbar-expand static-top" id="top_navigation">

      <a class="navbar-brand mr-1" href="/"><font color="black">Project-Cheese</font></a>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav" id="dashbord-shield">
        <li class="nav-item active">
          <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Login Screens:</h6>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
               @csrf
            </form>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Other Pages:</h6>
            <a class="dropdown-item" href="/">Home</a>
            <a class="dropdown-item" href="/docs">Documentation</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-database"></i>
            <span>Panels</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" onclick="sub()">Submits</a>
            <a class="dropdown-item" onclick="lis()">Lists</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-terminal"></i>
            <span>Comands</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="/runcmd">Cheese</a>
            <a class="dropdown-item" href="/runcmd1">CheeseDownload</a>
            <a class="dropdown-item" href="/runcmd2">CheckForCheese</a>
            <a class="dropdown-item" href="/runcmd3">ResetDatabases</a>
          </div>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">


          <!-- ControlShield-->


          <!-- Submits -->

          <div id="submits">
            <ul>
                @foreach($cheesedata as $slice)
                  
                  @if (!($slice->is_chosen))
                    <li class="shield-item">
                      <a class="DTitle">Title: </a>
                      <a class="DText">{{$slice->name}}</a>
                      <form class="DSubmit" role="form" method="POST" action="{{ route('milk.submit') }}" enctype="multipart/form-data">
                        
                        {{ csrf_field() }}

                        <select class="HiddenData" name="submilk">
                          <option value= "{{$slice->id}}"></option>
                        </select>

                        <button type="submit" class="Dsub" class="">Submit</button>
                      </form>
                    </li>
                  @endif
                  
                @endforeach
              </ul> 
          </div>

          
          <!-- Lists -->

          <div id="lists">
            <ul>
                @foreach($cheesedata as $slice)
                  @if ($slice->is_chosen)
                    <li class="shield-item2">
                      <a class="DTitle">{{$slice->name}}</a>

                        <form class="DSubmit" role="form" method="POST" action="{{ route('milk.remove') }}" enctype="multipart/form-data">
                          
                          {{ csrf_field() }}

                          <select class="HiddenData" name="submilk">
                            <option value= "{{$slice->id}}"></option>
                          </select>

                          <button type="submit" class="Dsub2" class=""><i class="fas fa-times"></i></button>
                        </form>

                    </li>
                  @endif
                @endforeach
            </ul> 
          </div>


        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Take your time to enjoy the cheese</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    

    <!-- Bootstrap core JavaScript-->
    <script src="/Web-Assets/ControlPanelAssets/vendor/jquery/jquery.min.js"></script>
    <script src="/Web-Assets/ControlPanelAssets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/Web-Assets/ControlPanelAssets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="/Web-Assets/ControlPanelAssets/vendor/chart.js/Chart.min.js"></script>
    <script src="/Web-Assets/ControlPanelAssets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="/Web-Assets/ControlPanelAssets/vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/Web-Assets/ControlPanelAssets/js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="/Web-Assets/ControlPanelAssets/js/demo/datatables-demo.js"></script>
    <script src="/Web-Assets/ControlPanelAssets/js/demo/chart-area-demo.js"></script>

  </body>

</html>
