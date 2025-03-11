<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jac Automotriz</title>
    <link rel="stylesheet" href="{{ URL::asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }}" />
    <script src="{{ URL::asset('bootstrap-5.3.3-dist/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('DataTables/datatables.min.css') }}" />
    <script src="{{ URL::asset('DataTables/datatables.min.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('assets/styles.css') }}" />
</head>
<body>
    <div class="row">
        <div class="col-2">
            @component("components.sidebar")
            @endcomponent
        </div>
        <div class="col-10">
            <div class="container">
                @section("content")
                @show
            </div>
        </div>
    </div>
</body>
</html>