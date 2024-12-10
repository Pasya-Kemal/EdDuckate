@extends('pages.admin.base')

@section('header', 'Edit Classroom')

@section('container')
    <form method="post" action="{{ url('/admin/classroom/update/' . $classroom->id) }}" class="max-w-[400px] w-full">
        @csrf

        @include('components.message')

        <div class="mb-1 font-semibold">
            Classroom Name
        </div>
        <div class="mb-4">
            <x-text-input name="name" placeholder="Classroom Name" value="{{ $classroom->name }}" with-error/>
        </div>

        <div class="mb-1 font-semibold">
            Major
        </div>
        <div class="mb-4">
            <select name="major_id" class="shadow-md border border-gray-300 text-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                <option value="">Select Major</option>
                @foreach(\App\Models\Major::query()->get() as $major)
                    <option value="{{ $major->id }}"{{ $major->id === $classroom->major_id ? ' selected' : '' }}>{{ $major->name }}</option>
                @endforeach
            </select>
            <x-form-error field="major_id"/>
        </div>

        <x-button type="submit" left-icon="edit">Edit</x-button>
    </form>
@endsection
