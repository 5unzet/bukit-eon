@extends('layouts.app')

@section('content')
@php $sessionUser = session('user'); @endphp
@include('components.navbar')
<main class="bg-light py-5 min-vh-100">
    <div class="container">
        <h1 class="text-center fw-bold mb-5">Edit Profil</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" action="/profil" class="card shadow-sm p-4 bg-white">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $isCustomer ? $user->nama_cust : $user->nama_user }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $isCustomer ? $user->email_cust : $user->email_user }}" {{ $isCustomer ? '' : 'required' }}>
                    </div>
                    @if($isCustomer)
                    <div class="mb-3">
                        <label class="form-label">No HP</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ $user->no_hp_cust }}" required>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Password (kosongkan jika tidak diubah)</label>
                        <input type="password" name="pass" class="form-control" autocomplete="new-password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection