@extends('pages.admin.base')

@section('header', 'Admin')

@section('container')
    <div class="max-w-[200px] mb-4">
        <form action="{{ url('admin/admin/create') }}">
            <x-button type="submit">Create Admin</x-button>
        </form>
    </div>
    <div class="rounded-lg border shadow-lg py-3 px-5 w-[900px]">
        <div style="max-width: 900px; overflow-x: auto;">
            <table id="adminTable" class="row-border max-w-[900px]">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (\App\Models\User::query()->where('role', '=', \App\Models\User::ROLE_ADMIN)->get() as $admin)
                        <tr class="cursor-pointer hover:bg-blue-100">
                            <td>{{ $admin->name }}</td>
                            <td>
                                <div class="flex flex-row items-center gap-x-2 text-xs">
                                    <x-modal-open id="delete_admin_{{ $admin->user_id  }}">
                                        <button
                                            class="flex items-center gap-x-1 px-2 py-0.5 rounded-lg bg-red-900 hover:bg-red-800 text-gray-50">
                                            <span class="material-symbols-outlined">
                                                delete
                                            </span>
                                        </button>
                                    </x-modal-open>
                                    <x-modal id="delete_admin_{{ $admin->user_id  }}">
                                        <h1 class="mb-4 text-center">Are you sure?</h1>
                                        <hr>
                                        <div class="flex mt-5">
                                            <form method="POST" action="{{ url('admin/admin/delete/' . $admin->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-5 w-60 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                                                    <span>Yes</span>
                                                </button>
                                            </form>
                                            <button class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-900 rounded-md hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 w-60 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                                                <span>Cancel</span>
                                            </button>
                                        </div>
                                    </x-modal>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    @parent

    <script>
        $(document).ready(function() {
            new DataTable('#adminTable', {
                autoWidth: true,
                columnDefs: [{
                    width: '10px',
                    targets: 1
                }]
            });
        });
    </script>
@endsection
