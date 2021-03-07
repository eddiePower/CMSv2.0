<!-- Equivalent for @csrf directive -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">

@if($errors->has('title'))
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="title">Name</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ $model->name }}" />
</div>
<div class="form-group">
    <label for="url">Email</label>
    <input type="text" class="form-control" id="url" name="url" value="{{ $model->email }}" />
</div>
<div class="form-group">
    <label for="content">Role</label>
    <textarea class="form-control" id="content" name="content">{{ $model->role }}</textarea>
</div>

<div class="form-group">
    <input type="submit" class="btn btn-default" value="Submit" />
    <input type="reset" class="btn btn-accent" value="Reset" />
</div>