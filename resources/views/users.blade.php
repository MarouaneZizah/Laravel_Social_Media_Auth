@extends('layouts.master')

@section('title')
Users
@endsection

@section('content')

    <div>
        <table>
            <thead>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Type</th>
                <th>Email</th>
                <th>Provider</th>
                <th>Creation Date</th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->firstName}}</td>
                        <td>{{$user->lastName}}</td>
                        <td class="capitelize">{{$user->type}}</td>
                        <td>{{$user->email}}</td>
                        <td class="capitelize">{{$user->provider}}</td>
                        <td>{{$user->created_at->format('d/m/Y')}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  
   
@endsection
           