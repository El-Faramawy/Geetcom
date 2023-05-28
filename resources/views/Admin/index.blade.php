@extends('layouts.admin.app')
@section('page_title') الرئيسية @endsection

@section('content')

@endsection
@push('admin_js')

    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    <script>
        // $(document).ready(function() {
        //    alert('1')
        // });
        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;

        // Initiate the Pusher JS library
        var pusher = new Pusher('5ac2116eb21b831cc1d9', {
            encrypted: true,
            cluster: 'eu'
        });

        // Subscribe to the channel we specified in our Laravel Event
        var channel = pusher.subscribe('ttest');

        // Bind a function to a Event (the full Laravel class)
        channel.bind('testt', function(data) {
            // this is called when the event notification is received...
            console.log(data);
        });
    </script>
@endpush
