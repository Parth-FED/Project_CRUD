<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LARAVEL CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="bg-dark" py-3>
        <div class="container">
            <div  class="h4 text-white">LARAVEL CRUD</div>
        </div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-between py-3">
           <div class="h5">Edit Employee</div>
           <div>
            <a href="{{route('employees.index')}}" class="btn btn-primary">Back</a>
           </div>
        </div>

        <form action="{{route('employees.update',$employ->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card border-0 shadow-lg">
               <div class="card-body">
                  <div class="mb-3">
                    <label for="name" class="form-lable">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Your Name" class="form-control
                    @error('name') is-invalid @enderror" value="{{old('name',$employ->name)}}">
                    @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label for="email" class="form-leble">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter Your Email" class="form-control
                    @error('email') is-invalid @enderror" value="{{old('email',$employ->email)}}">
                    @error('email')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label for="address" class="form-lable">Address</label>
                    <textarea name="address" id="address" cols="30" rows="4" placeholder="Enter Your Address" class="form-control">{{ old('address',$employ->address) }}</textarea>
                  </div>

                  <div class="mb-3">
                    <label for="image" class="form-lable"></label>
                    <input type="file" name="image" class="
                    @error('email') is-invalid @enderror" >
                    @error('image')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror

                   <div class="pt-4">
                    @if ($employ->image != '' && file_exists(public_path().'/uploads/employees/'.$employ->image))
                        <img src="{{ url('/uploads/employees/'.$employ->image)}}" alt="" width="100" height="100" class="rounded-cricle">
                      @endif
                   </div>
                  </div>

            </div>
        </div>

         <button class="btn btn-primary my-3">Update Employee</button>
    </form>
    </div>
</body>
</html>
