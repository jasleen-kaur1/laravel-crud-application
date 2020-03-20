@extends('base')

@section('main')
<div class="col-sm-12">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
  
  <div class="row">
    <div class="col-sm-12">
        <div class = "row">
          <div class = "col-sm-10 offset-sm-0">
            <h2>List Of Users</h2>
          </div>
          <div class="col-sm-2">
            <a style="margin: 19px;" href="{{ route('users.create')}}" class="btn btn-primary"> ADD NEW USER</a>
          </div>
        </div>    
      <table class="table table-striped">
        <thead>
            <tr>
              <td>ID</td>
              <td>Name</td>
              <td>Email</td>
              <td>Age</td>
              <td>Job Title</td>
              <td>City</td>
              <td colspan = 2>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->age}}</td>
                <td>{{$user->job_title}}</td>
                <td>{{$user->city}}</td>
                <td>
                    <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                  <!-- For delete method use a form instead, found this piece of code on StackOverflow -->
                    <form action="{{ route('users.destroy', $user->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    
      <div class = "col-sm-12 text-center">
        <hr><h2>User Data</h2>
      </div>
      <div class="col-sm-6">
        {!! $user_age_chart->container() !!}
      </div>
      <div class="col-sm-6">
        {!! $group_by_age_chart->container() !!}
      </div>
      <div class="col-sm-12" style="margin: 19px;">
        {!! $group_by_city_chart->container() !!}  
      </div>

      
  </div>
</div>

{!! $user_age_chart->script() !!}
{!! $group_by_age_chart->script() !!}
{!! $group_by_city_chart->script() !!}

@endsection

