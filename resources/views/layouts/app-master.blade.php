<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Public Sector Investment Program Web Application</title>

    <!-- Bootstrap core CSS -->
    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <!-- Tutorial overlay css -->
    <link href="{!! url('css/tutorial.overlay.css') !!}" rel="stylesheet">

    <style>
        body{
            /*background-image: url('/img/vector.jpg'); background-size: cover; not in use. works on local only*/
            /*background-image: url("{{ asset('img/vector.jpg') }}");*/
            background-color: #f1f1f1;
            padding-top: 56px;
        }


        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        .text-decoration-dull {
            color: #777; /* Default text color similar to BookStack's */
            transition: color 0.3s ease; /* Smooth transition effect */
        }

        .text-decoration-dull:hover {
            color: #444; /* Darker color on hover */
        }



        .text-decoration-dull-blue {
            color: #0078b9;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }

        .float-right {
            float: right;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1030; /* Bootstrap's default z-index for navbar */

        }
        /* If the navbar has a specific class for styling */
        .bg-dark {
            background-color: rgba(0, 0, 0, 0.8) !important; /* Adjust the alpha value as needed, here it's set to 50% transparency */
        }
        .bg-bookstack-blue {
            background-color: rgba(0, 120, 185) !important;
        }

        .bg-dull-blue {
            background-color: #0078b9;  /* Bootstrap's default active color #007bff; change as needed */
            color: #ffffff; /* White text for active pill */
        }
        .shaded{
            background-color: #ede9e8;
        }
        .uppercase-text {
            text-transform: uppercase;
        }
    </style>


    <!-- Custom styles for this template -->
    <!-- <link href="{!! url('css/app.css') !!}" rel="stylesheet"> -->


    <!-- Additional per-page css -->
      @yield('css')
</head>
<body>

    @include('layouts.partials.navbar')

    <main class="container-fluid mt-5 px-3" >
        @yield('content')
    </main>
    <script src="{!! url('assets/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!--add some JavaScript and jQuery code to enable the AJAX search autocomplete functionality.
     Add this script to the app-master blade file (or in a separate JavaScript file included in the layout).-->
    <script>
        $(document).ready(function () {
            $('#search').keyup(function () {
                let query = $(this).val();
                if (query.length >=2) {
                    $.ajax({
                        url: "{{ route('search.autocomplete') }}",
                        type: 'GET',
                        data: {
                            'query': query
                        },
                        success: function (data) {
                            $('#autocomplete-list').empty();
                            if (data.length > 0) {
                                data.forEach(function (item) {
                                    $('#autocomplete-list').append(
                                        `<li class="list-group-item" ><a href="${item.link}" class="text-decoration-dull-blue" style="text-decoration: none">${item.name ? item.code+' - '+item.name : item.code}</a></li>`
                                    );
                                });
                            } else {
                                $('#autocomplete-list').append(
                                    `<li class="list-group-item">No results found</li>`
                                );
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', status, error);
                        }
                    });
                } else {
                    $('#autocomplete-list').empty();
                }
            });
        });
    </script>

   <script>
// Check for service worker support
if ('serviceWorker' in navigator && 'PushManager' in window) {
  console.log('Service Worker and Push is supported');

  // First, request permission to send notifications
  if ('Notification' in window) {
    Notification.requestPermission().then(permission => {
      if (permission === 'granted') {
        console.log('Notification permission granted.');

        // Then, register the service worker
        navigator.serviceWorker.register('/js/service-worker.js').then(function(swReg) {
          console.log('Service Worker is registered', swReg);

          // Next, subscribe the user to push notifications (you might want to call this from a user action like a button click)
          subscribeUserToPush(swReg);
        }).catch(function(error) {
          console.error('Service Worker Error', error);
        });
      } else {
        console.error('User denied notifications.');
        // Optionally, handle the denial of notification permissions (e.g., disable notification-related features)
      }
    });
  }
} else {
  console.warn('Push messaging is not supported');
}

function subscribeUserToPush(swReg) {
  const applicationServerKey = urlBase64ToUint8Array('BC2A00PRsWELPeRsB-b8x88WHL8rq06yJdOFHj7i8IU3Wo7Co9HaPemYYhRk7_QZmgv1E5goApzp4W3XQTV_ba0');
  swReg.pushManager.subscribe({
    userVisibleOnly: true,
    applicationServerKey: applicationServerKey
  })
  .then(function(subscription) {
    console.log('User is subscribed:', subscription);

    // TODO: Send the subscription object to your server
    // Use an AJAX request or Fetch API to send this to your server
    updateSubscriptionOnServer(subscription);
  })
  .catch(function(err) {
    console.log('Failed to subscribe the user: ', err);
  });
}

function urlBase64ToUint8Array(base64String) {
  const padding = '='.repeat((4 - base64String.length % 4) % 4);
  const base64 = (base64String + padding)
    .replace(/\-/g, '+')
    .replace(/_/g, '/');

  const rawData = window.atob(base64);
  const outputArray = new Uint8Array(rawData.length);

  for (let i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i);
  }
  return outputArray;
}


function updateSubscriptionOnServer(subscription) {
   var url = "{{route('notification.subscribe')}}";
  $.ajax({
    url: url, // Your server endpoint to handle subscriptions
    type: 'POST',
    contentType: 'application/json',
    data: JSON.stringify(subscription),
    success: function(response) {
      console.log('Subscription successfully sent to server:', response);
      // Handle success scenario (e.g., show a message to the user)
    },
    error: function(xhr, status, error) {
      console.error('Failed to send subscription to server:', error);
      // Handle error scenario
    }
  });
}



</script>
<!-- Script to make the advanced options dropdowns in the navbar work -->
<script>
// Ensure Bootstrap bundle (with Popper) is loaded before this script.
document.addEventListener('DOMContentLoaded', function () {
  // Keep parent dropdown open when interacting inside
  document.querySelectorAll('.dropdown-menu').forEach(function (menu) {
    menu.addEventListener('click', function (e) { e.stopPropagation(); });
  });

  // Handle submenu toggles on click
  const submenuToggles = document.querySelectorAll('.dropdown-menu .dropdown-toggle');
  submenuToggles.forEach(function (toggle) {
    toggle.addEventListener('click', function (e) {
      const submenu = this.nextElementSibling;
      if (submenu && submenu.classList.contains('dropdown-menu')) {
        e.preventDefault();
        e.stopPropagation();

        // Close any other open submenus at this level
        const parentMenu = this.closest('.dropdown-menu');
        parentMenu.querySelectorAll('.dropdown-menu.show').forEach(function (open) {
          if (open !== submenu) open.classList.remove('show');
        });

        submenu.classList.toggle('show');
      }
    });
  });

  // When the top-level dropdown hides, close any open submenus
  document.querySelectorAll('.nav-item.dropdown').forEach(function (dd) {
    dd.addEventListener('hide.bs.dropdown', function () {
      this.querySelectorAll('.dropdown-menu.show').forEach(function (submenu) {
        submenu.classList.remove('show');
      });
    });
  });
});
</script>

    @section("scripts")
    <!-- Include per-page JS -->
      @yield('scripts')


    @show
  </body>
</html>
