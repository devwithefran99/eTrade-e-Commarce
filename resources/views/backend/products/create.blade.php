@extends('backend.dashboard')
@section('title','New Product')
@section('backend_content')
    <div class="card">
        <div class="card-header text-center fw-bold"><h4>Add Products Infornation</h4></div>
        <div class="card-body">
            <form action="{{route('backend.products.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row ">
                <div class="col-lg-8">
                   <div class="form-group">
                        <label for="">Product Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="row my-3">
                        <div class="form-group col-lg-4">
                        <label for="">Product Price<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="price" required>
                    </div>
                         <div class="form-group col-lg-4">
                        <label for="">Discount Price</label>
                        <input type="number" class="form-control" name="selling_price">
                    </div>
                    </div>
                      <div class="row my-3">
                         <div class="form-group col-lg-4">
                        <label for="">Brand</label>
                        <input type="Text" class="form-control" name="brand">
                    </div>
                     <div class="form-group col-lg-8">
                        <label for="">SKU</label>
                        <input type="text" class="form-control" name="sku">
                    </div>
                    </div>
                    <textarea name="short_details" class="form-control my-3" placeholder="Short Details..." ></textarea>
                    <textarea name="features" class="form-control my-3" placeholder="Features..." ></textarea>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                       <label for="">Feature image</label>
                        <input type="file" name="featured_img" class="form-control">
                    </div>
                    <div class="form-group my-3">
                       <label for="">Gallery Images</label>
                        <input type="file" name="gallery_imgs[]" class="form-control" multiple>
                    </div>
                     <div class="form-group my-3">
                       <label for="">Select a category<span class="text-danger">*</span></label>
                       <select name="category" class="form-control" required>
                        @foreach ($categories as $category )
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                       </select>
                    </div>
                    <button class="btn btn-primary">Submit</button>
                </div>
              </div>

            </form>
        </div>
    </div>
@endsection