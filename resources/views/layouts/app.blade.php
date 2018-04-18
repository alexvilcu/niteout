<html>

  @include('includes.header')

  <body>

    @include('includes.navbar')

      @yield('content')

    @include('includes.footer')
    
    {{-- Javascript plugins for Bootstrap --}}
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="{{ asset('jquery/select2.js') }}"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
    

    <script>
        $('#flash-overlay-modal').modal();
    </script>

    <script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>

    {{-- <script>
      $('div.alert').not('.alert-important').delay(2).fadeOut(3);
    </script> --}}

    {{-- <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHoSEv07-ffKnlYnfaCxjILKOV6x-Mcfg&callback=initMap">
    </script> --}}

  </body>

</html>
