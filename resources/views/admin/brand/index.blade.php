<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Brand') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <div class = "container">
        <div class = "row">
            <div class = "col-md-8">
                <div class="card">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card-header">
                        All Brands
                    </div>
                <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Brand Name</th>
                            <th scope="col">Brand Image</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                            {{-- <th scope="col" colspan="2">Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>

                        @php ($i=1)

                        @foreach ($brands as $brand)
                            <tr>
                                <th scope="row">{{$i++}}</th>

                                <td>{{ $brand->brand_name }}</td>
                                <td><img src={{ asset($brand->brand_image)}} alt="" style="width: 60px; height: 40px"></td>
                                <td>{{ $brand->created_at->diffForHumans() }}</td>

                                <td>
                                    <a href="{{url('brand/edit/'.$brand->id)}}" class="btn btn-info">Update</a>
                                    <a href="{{url('brand/remove/'.$brand->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                {{$brands->links()}}
            </div>
        </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                    Add Brands
                </div>

                <div class="card-body">

            <form action="{{route('add.brand')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">

                  <label for="brandName" class="form-label">Brand Name</label>

                  <input type="text" class="form-control" name="brand_name" placeholder="Input your brand name">

                  @error('brand_name')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>


                <div class="form-group">

                    <label for="brandImage" class="form-label">Brand Image</label>

                    <input type="file" class="form-control" name="brand_image" placeholder="Input your brand image">

                    @error('brand_image')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>

                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
              </form>
                  <!-- Add file input for images -->
                                </div>
</div>
</div>
        </div>
    </div>


</div>

</x-app-layout>
