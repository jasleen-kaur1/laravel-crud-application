@extends('base') 

@section('main')
<div class="col-8">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <br /> 
    @endif
    <form class="userForm" method="post" action="{{ route('users.update', $user->id) }}">
        <fieldset>
            <h2 id="formTitle"class = "text-center">Update User</h2>
            @method('PATCH') 
            @csrf
            <div class="form-group">

                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value={{ $user->name }} />
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" value={{ $user->email }} />
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="text" class="form-control" name="age" value={{ $user->age }} />
            </div>
            <div class="form-group">
                <label for="job_title">Job Title:</label>
                <input type="text" class="form-control" name="job_title" value={{ $user->job_title }} />
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" name="city" value={{ $user->city }} />
            </div>
            <button type="submit" class="btn btn-primary">UPDATE</button>
            <a href="{{ route('users.index')}}" class="btn btn-primary">CANCEL</a>
        </fieldset>
    </form>
</div>
@endsection