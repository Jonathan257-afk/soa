@if($errors->any())
    @foreach($errors->all() as $error)
        <script>
            errorNotify("{{$error}}");
        </script>
    @endforeach
@endif

@if(Session::has('success'))
    <script>
        succesNotify("{{Session::get('success')}}");
    </script>
@endif

@if(Session::has('error'))
    <script>
        errorNotify("{{Session::get('error')}}");
    </script>
@endif