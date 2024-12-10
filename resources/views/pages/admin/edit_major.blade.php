@extends('pages.admin.base')

@section('header', 'Edit Major')

@section('container')
    <form method="post" action="{{ url('/admin/major/update/' . $major->id) }}" class="max-w-[400px] w-full">
        @csrf

        @include('components.message')

        <div class="mb-1 font-semibold">
            Major Name
        </div>
        <div class="mb-4">
            <x-text-input name="name" placeholder="Major Name" value="{{ $major->name }}" with-error/>
        </div>

        <x-button type="submit" left-icon="edit">Edit</x-button>
    </form>
@endsection
