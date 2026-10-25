@extends('layouts.app')

@section('title', 'About')

@section('content')
    <div class="eyebrow">THE PROJECT</div>
    <h1>About this app<span class="accent">.</span></h1>
    <p class="lead">Tasks for Today is a simple Laravel task management system developed by John Xavier Tumbokon for IT0049 Technical Summative Assessment 3.</p>
    <div class="about-grid">
        <section class="info-card"><span class="card-number">01</span><h2>Today first</h2><p>The Welcome page shows only tasks scheduled for the current day.</p></section>
        <section class="info-card"><span class="card-number">02</span><h2>See every task</h2><p>The Task List displays all database records in date order.</p></section>
        <section class="info-card"><span class="card-number">03</span><h2>Built with Laravel</h2><p>Migrations create the tables, seeders add sample records, and Eloquent loads the records into Blade views.</p></section>
    </div>
    <p class="note">This coursework version shows task records and a profile. It is a read-only demo.</p>
@endsection
