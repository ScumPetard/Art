@if(Session::has('notify_message'))
    <script src="https://cdn.bootcss.com/layer/3.0.1/layer.min.js"></script>
    <script>
        layer.msg('{{  session('notify_message') }}');
    </script>
@endif