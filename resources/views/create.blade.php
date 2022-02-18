@extends('layout')
@section('content')
<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>
<div class="card push-top">
  <div class="card-header">
    Add Students
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('store') }}" enctype="multipart/form-data">
          <div class="form-group">
              @csrf
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          <div class="form-group">
              <label for="roll_no">Roll No</label>
              <input type="text" class="form-control" name="roll_no"/>
          </div>
          <div class="form-group">
              <label for="subjects">Subjects</label>
              <input type="text" class="form-control" name="subjects"/>
          </div>
          <div class="form-group">
              <label for="scores">Scores</label>
              <input type="text" class="form-control" name="subject_score"/>
          </div>
          <div class="form-group">
              <label for="images">Upload Image</label>
              <input type="file" class="form-control" name="image"/>
          </div>
          <div class="form-group">
              <label for="images">Class (1 to 12th)</label>
              <input type="number" class="form-control" name="class_no"/>
          </div>
          <button type="submit" class="btn btn-block btn-danger">Create Students</button>
      </form>
  </div>
</div>
@endsection