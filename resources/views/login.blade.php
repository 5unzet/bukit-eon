@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center items-center">
    <div class="w-full max-w-sm bg-white rounded-lg shadow p-6">
        <div class="flex justify-center mb-4">
            <img src="/assets/logo.png" alt="Logo" class="h-16 w-16 object-contain rounded-full">
        </div>
        <h1 class="text-2xl font-bold mb-6 text-center">Login Management</h1>
        <form method="POST" action="/login">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="username">Username</label>
                <input type="text" id="username" name="username" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 mb-2" for="password">Password</label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Login</button>
        </form>
    </div>
</div>
@endsection
