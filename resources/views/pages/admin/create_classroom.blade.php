@extends('pages.admin.base')

@section('header', 'Create Classroom')

@section('container')
    <form method="post" action="{{ url('/admin/classroom/create') }}" class="max-w-[400px] w-full">
        @csrf

        @include('components.message')

        <div class="mb-1 font-semibold">
            Classroom Name
        </div>
        <div class="mb-4">
            <x-text-input name="name" placeholder="Classroom Name" with-error value="{{ old('name') }}"/>
        </div>

        <div class="mb-1 font-semibold">
            Major
        </div>
        <div class="mb-4">
            <select id="selectMajor" name="major_id" class="shadow-md border border-gray-300 text-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                <option value="">Select Major</option>
                @foreach(\App\Models\Major::all() as $major)
                    <option value="{{ $major->id }}">{{ $major->name }}</option>
                @endforeach
            </select>
            <x-form-error field="major_id"/>
        </div>

        <x-button type="submit">Create</x-button>
    </form>
@endsection
