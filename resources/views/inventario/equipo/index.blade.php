@extends('layout')
@section('style')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/style.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('script')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            tabla_subtipos();
        });
        var tabla_subtipos =() =>  {
            ajaxRequest(
                "{{ route('inventario.equipo.dashboard') }}",
                'GET',
                {},
                function(data){

                    $("#dash").html(data.html);


                }
            );
        }
    </script>
    @endsection


@section('content')
<div class="row" id="dash" name="dash">

</div>
@endsection
