@extends('layouts.admin')
@section('title', 'Users')
@section('content')
<h1 class="text-3xl font-black mb-6">Users</h1>
<form method="POST" action="{{ route('admin.users.store') }}" class="bg-gray-900 rounded-xl border border-gray-800 p-5 flex flex-wrap gap-3 items-end mb-6">
    @csrf
    <div><label class="block text-sm text-gray-400 mb-1">Name *</label>
        <input type="text" name="name" required class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2"></div>
    <div><label class="block text-sm text-gray-400 mb-1">Email *</label>
        <input type="email" name="email" required class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2"></div>
    <div><label class="block text-sm text-gray-400 mb-1">Password *</label>
        <input type="password" name="password" required class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2"></div>
    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_admin" value="1"> Admin</label>
    <button class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded-lg font-semibold"><i class="fas fa-plus"></i> Add User</button>
</form>
<div class="bg-gray-900 rounded-xl border border-gray-800 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-black/60 text-gray-400 uppercase text-xs"><tr>
            <th class="px-4 py-3 text-left">Name</th><th class="px-4 py-3 text-left">Email</th>
            <th class="px-4 py-3 text-left">Purchases</th><th class="px-4 py-3 text-left">Admin</th>
            <th class="px-4 py-3 text-left">Joined</th><th class="px-4 py-3"></th>
        </tr></thead>
        <tbody class="divide-y divide-gray-800">
            @foreach($users as $user)
                <tr>
                    <td class="px-4 py-3 font-medium">
                        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="flex gap-2 items-center">
                            @csrf @method('PUT')
                            <input type="text" name="name" value="{{ $user->name }}" class="bg-gray-800 border border-gray-700 rounded px-2 py-1 w-36">
                            <input type="email" name="email" value="{{ $user->email }}" class="bg-gray-800 border border-gray-700 rounded px-2 py-1 w-52">
                            <input type="password" name="password" placeholder="New password (optional)" class="bg-gray-800 border border-gray-700 rounded px-2 py-1 w-44">
                            <input type="checkbox" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }}>
                            <button class="text-blue-400 hover:underline">Save</button>
                        </form>
                    </td>
                    <td class="px-4 py-3"></td>
                    <td class="px-4 py-3">{{ $user->purchases_count }}</td>
                    <td class="px-4 py-3">{{ $user->is_admin ? '✔' : '—' }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-3 text-right">
                        @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                                @csrf @method('DELETE')
                                <button class="text-red-400 hover:underline">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $users->links() }}</div>
@endsection
