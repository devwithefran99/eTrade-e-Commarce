@extends('layouts.backend')
@section('title', "Categories")
@section('backend_content')

<div class="container">
    <div class="row">
        <div class="col-lg-4">
           <div class="card">
            <div class="card-body">
               <form 
                 action="{{ isset($category) ? route('backend.category.update', $category) : route('backend.category.store') }}" 
                 method="post" 
                 enctype="multipart/form-data">
                  @csrf
                 <div class="form-group">
                     <label for="title">Title <span class="text-danger">*</span></label>
                     <input type="text" 
                            required 
                            class="form-control" 
                            name="title" 
                            value="{{ isset($category) ? $category->title : old('title') }}"
                            placeholder="Example: Desktop | Fashion">
                     </div>

    <div class="form-group my-3">
        <label for="icon">Icon</label>
        <input type="file" class="form-control" name="icon">
        @isset($category)
            <img src="{{ asset('storage/'.$category->icon) }}" width="50" class="mt-2">
        @endisset
    </div>

    <button class="btn btn-primary">
        {{ isset($category) ? 'Update' : 'Submit' }}
    </button>
</form>

            </div>
           </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-responsive table-striped">
                        <tr>
                            <th>sl</th>
                            <th>Category</th>
                            <th>status</th>
                            <th></th>
                        </tr>
                        @forelse ($categories as $key=> $category)
                            <tr>
                            <td>{{++$key}}</td>
                            <td><img width="40px" src="{{asset('storage/' .$category->icon)}}" alt=""> {{$category->title}}</td>
                            <td>{{$category->status ? 'Active' : 'Deactive'}}</td>
                            <td>
                                <div class="btn">
                                    <a href="{{ route('backend.category.edit', $category) }}" class="btn btn-sm btn-primary">Edit</a>
                                    
                                    <a href="{{route('backend.category.delete', $category)}}" class="btn btn-sm btn-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4">No CAtegory Found!</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

