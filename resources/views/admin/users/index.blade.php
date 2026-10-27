<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800 text-sm">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-3 rounded bg-red-100 text-red-800 text-sm">{{ session('error') }}</div>
            @endif
            @error('role')
                <div class="mb-4 p-3 rounded bg-red-100 text-red-800 text-sm">{{ $message }}</div>
            @enderror

            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm text-gray-900">
                    <thead class="bg-gray-50 text-left">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Role</th>
                            <th class="px-4 py-3">Ubah Role</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-t">
                                <td class="px-4 py-3">{{ $user->id }}</td>
                                <td class="px-4 py-3">{{ $user->name }}</td>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3">{{ $user->role }}</td>
                                <td class="px-4 py-3">
                                    @if ($user->id !== auth()->id())
                                        <form method="POST" action="{{ route('admin.users.role', $user) }}" class="flex gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" class="border-gray-300 rounded-md text-sm">
                                                <option value="user" @selected($user->role === 'user')>user</option>
                                                <option value="admin" @selected($user->role === 'admin')>admin</option>
                                            </select>
                                            <button type="submit" class="px-3 py-1 bg-gray-800 text-white rounded-md text-xs">Simpan</button>
                                        </form>
                                    @else
                                        <span class="text-gray-400">(akun Anda)</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if ($user->id !== auth()->id())
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                              onsubmit="return confirm('Hapus user {{ $user->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-md text-xs">Hapus</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $users->links() }}</div>
        </div>
    </div>
</x-app-layout>

