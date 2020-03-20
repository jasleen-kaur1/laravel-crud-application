<!-- base template that can be extended by all other templates -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
  <title>User Information</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="{{ asset('hBarChart-master/hBarChart.js') }}"></script>
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>  
</head>

<body>
  <div class="container"> 
    <div class="row justify-content-center"> 
      @yield('main')
	   </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
</body>
</html>