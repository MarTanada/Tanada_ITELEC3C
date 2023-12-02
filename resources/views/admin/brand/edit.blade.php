<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Brand') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                Edit {{$brands->brand_name}}
                            </div>
                            <div class="card-body">
                                <form action="{{url('brand/update/'.$brands->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="BrandName" class="form-label">Update Brand Name</label>
                                        <input type="text" class="form-control" name="brand_name" value="{{$brands->brand_name}}">
                                        @error('brand_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="brandImage" class="form-label">Current Brand Image</label>
                                        <br>
                                        <img src="{{ asset($brands->brand_image) }}" alt="Brand Image" style="max-width: 200px;">
                                        <br>
                                        <label for="brandImage" class="form-label">Update Brand Image</label>
                                        <input type="file" class="form-control" name="brand_image" accept="image/*">
                                        @error('brand_image')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
