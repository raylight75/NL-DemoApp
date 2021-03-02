@extends('layouts.main')
@section('content')
<div class="container">
    <br></br>
    <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
    <li><a href="{{ url('messages') }}">Messages</a></li> 
    <h2>NextLogistic Demo Example</h2>
    <h3>Registered Users</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection