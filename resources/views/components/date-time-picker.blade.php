<input type="text" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" class="border rounded-lg border-gray-300 shadow px-2 py-1.5 focus:border-blue-300">

@section('scripts')
    @parent

    <script>
        $(document).ready(function () {
            $("#{{ $id }}").datetimepicker();
        });
    </script>
@endsection
