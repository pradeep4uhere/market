@extends('layouts.appticket')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                    <h1>Real-time notifications in Laravel using Pusher</h1>
 
                    <!-- Incldue Pusher Js Client via CDN -->
                    <script src="https://js.pusher.com/4.2/pusher.min.js"></script>
                    <!-- Alert whenever a new notification is pusher to our Pusher Channel -->
                 
                    <script>
                    //Remember to replace key and cluster with your credentials.
                    var pusher = new Pusher('key', {
                      cluster: 'ap2',
                      encrypted: true
                    });
                 
                    //Also remember to change channel and event name if your's are different.
                    var channel = pusher.subscribe('notify');
                    channel.bind('notify-event', function(message) {
                        alert(message);
                    });
                 
                    </script>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
