@extends('base')

@section('main')
<div class="col-8">
  <div>
      <form class="userForm" method="post" action="{{ route('users.store') }}">
          @csrf
          <fieldset>
            <h2 id="formTitle"class = "text-center">User Information</h2>
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div><br />
            @endif
            <div class="form-group">
              <label for="name">Name: </label>
              <input type="text" name="name" class="form-control" placeholder="Please enter name" id="name"/>
            </div>
            <div class="form-group">
              <label for="email">Email: </label>
              <input type="email" name="email" class="form-control" placeholder="Please enter email"id="email" />
            </div>
            <div class="form-group">
              <label for="age">Age: </label>
              <input type="number" min="0" name="age" class="form-control" placeholder="Please enter age" id="age" />
            </div>
            <div class="form-group">
              <label for="job_title">Job Title: </label>
              <input type="text" name="job_title" class="form-control" placeholder="Please enter job title" id="job_title"/>
            </div>
            <div class="form-group">
              <label for="city">City: </label>
              <input type="text" name="city" class="form-control" placeholder="Please enter city" id="city"/>
            </div>                
            <button type="submit" class="btn btn-primary" id="but">ADD USER</button>
          </fieldset>  
      </form>
  </div>
  <br>
  <p> * To view list of all users and data</p>
  <a href="{{ route('users.index')}}" class="btn  btn-block btn-primary pull-right" >SEE ALL USERS</a>
</div>
@endsection