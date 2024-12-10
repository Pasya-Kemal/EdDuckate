@props(['id' => 'datetimepicker_' . $name])

<input type="text" id="{{ $id }}" name="{{ $name }}" class="border rounded border-gray-500 px-2 focus:border-blue-300">

@section('scripts')
    @parent

    <script>
        $(document).ready(function () {
            $("#{{ $id }}").datetimepicker();
        });
    </script>
@endsection
