@extends('template.template_admin')

@section('title', 'Welcome')

@section('content')
    <div style="background: white; padding: 24px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <h1 style="margin-bottom: 10px;">Halaman Welcome 👋</h1>
        <p>Ini adalah halaman percobaan untuk memastikan template sidebar sudah berfungsi dengan baik.</p>

        <hr style="margin: 20px 0;">

        <h3>Checklist:</h3>
        <ul style="margin-top: 10px; padding-left: 18px;">
            <li>✔ Sidebar muncul di kiri</li>
            <li>✔ Menu aktif (highlight) sesuai route</li>
            <li>✔ Content tampil di tengah</li>
            <li>✔ Panel histori muncul di kanan</li>
        </ul>

        <div style="margin-top: 20px;">
            <a href="{{ route('dashboard') }}" 
               style="display:inline-block;padding:10px 16px;background:#E07B00;color:white;border-radius:8px;text-decoration:none;">
                Ke Dashboard
            </a>
        </div>
    </div>
@endsection
