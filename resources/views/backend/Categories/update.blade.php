@extends('backend.layouts.admin')
@section('style')
<style>

.image{
    margin-left:24rem;

}
</style>

@endsection

@section('content')



<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Edit Category
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form method="post" action="{{route('admin.category.update',[ 'id' => $Category->id ])}}" enctype="multipart/form-data" class="kt-form kt-form--label-right">
    @method('PUT')
    @csrf
        <div class="kt-portlet__body">
            <div class="form-group row">
                <label class="col-form-label col-lg-3 col-sm-12">Name:</label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                    <input type="text" id="name" name="name" class="form-control" value="{{$Category->name}}" placeholder="Enter Category name">
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-lg-3 col-sm-12">Description:</label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                    <textarea class="form-control summernote" id="description" name="description" placeholder="Enter a description" rows="8">{{$Category->description}}</textarea>
                    @error('description')
                    <p class="text-danger">{{$message}}</p>
                    @enderror                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-lg-3 col-sm-12">Image Browser</label>
                <div class=" custom-file col-lg-4 col-md-9 col-sm-12">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label text-left" for="customFile">Choose image</label>
                    @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror

                </div>
            </div>
            <div class="row form-group ">

                        <img class="image " src="{{ asset('public/storage/' . $Category->image) }}" height="100"  >
                    </div>

            <div class="form-group row">
                <label class="col-form-label col-lg-3 col-sm-12">Main Category</label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                    <select class="custom-select form-control" id="category_id" name="category_id">
                        <option selected="">Select Category</option>
                        @if($Category->parent_id==0)
                        <option value="0" selected="selected"> Main Category </option>
                        @foreach(App\Categories::all() as $item)
                        @if ($item->id == $Category->id)
                          @continue
                          @endif

                            <option value="{{$item->id}}"> {{ $item-> name}}</option>
                        @endforeach
                          @else
                          <option value="0"  > Main Category </option>
                        @foreach(App\Categories::all() as $item)
                        @if ($item->id == $Category->id)
                          @continue
                          @endif
                            <option value="{{$item->id}}"   {{  old('category_id', $Category->parent_id) == $item->id ? ' selected' : '' }}> {{ $item-> name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-8 ml-lg-auto">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{route('admin.category')}}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>

<!--end::Portlet-->



@endsection
