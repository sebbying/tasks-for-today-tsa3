@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="eyebrow">THE PERSON BEHIND THE PLAN</div>
    <h1>My profile<span class="accent">.</span></h1>
    <p class="lead">The single user record stored in this application.</p>
    <section class="profile-card" aria-labelledby="profile-heading">
        <div class="profile-avatar" aria-hidden="true">{{ strtoupper(substr($user->full_name, 0, 1)) }}</div>
        <div><div class="small-label">PROFILE</div><h2 id="profile-heading">{{ $user->full_name }}</h2><span class="handle">{{ '@'.$user->username }}</span></div>
        <dl class="profile-details"><div><dt>Full name</dt><dd>{{ $user->full_name }}</dd></div><div><dt>Username</dt><dd>{{ $user->username }}</dd></div><div><dt>Email</dt><dd>{{ $user->email }}</dd></div></dl>
    </section>
    <p class="note">The email is a sample placeholder. You can change it in <code>database/seeders/UserSeeder.php</code> and seed again.</p>
@endsection
