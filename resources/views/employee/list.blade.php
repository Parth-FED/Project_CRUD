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
           <div class="h5">Employees</div>
           <div>
            <a href="{{route('employees.create')}}" class="btn btn-primary">Create</a>
           </div>
        </div>

        @if(Session::has('success'))
        <div class="alert alert-success">
           {{Session::get('success')}}
        </div>
        @endif

        <div class="card border-0 shadow-lg">
           <div class="card-body">
             <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                @if ($employee->isNotEmpty())
                @foreach ($employee as $employ)

                <tr valign="middle">
                    <td>{{$employ->id}}</td>
                    <td>
                        @if ($employ->image != '' && file_exists(public_path().'/uploads/employees/'.$employ->image))
                        <img src="{{ url('/uploads/employees/'.$employ->image)}}" alt="" width="40" height="40" class="rounded-cricle">
                        @else
                        <img src="{{ url('/assets/no image.png')}}" alt="" width="40" height="40">
                        @endif
                    </td>
                    <td>{{$employ->name}}</td>
                    <td>{{$employ->email}}</td>
                    <td>{{$employ->address}}</td>
                    <td>
                        <a href="{{route('employees.edit',$employ->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="#" onclick="deleteEmployee({{$employ->id}})" class="btn btn-danger btn-sm">Delete</a>
                          <form id="employ-edit-action-{{$employ->id}}" action="{{route('employess.destroy',$employ->id)}}" method="post">
                            @csrf
                            @method('delete')
                          </form>
                    </td>

                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="6">Record Not Found</td>
                </tr>

                @endif
            </table>
           </div>
        </div>
        <div class="mt-3">
            {{$employee->links()}}
        </div>
    </div>
    <script>
        function deleteEmployee(id){
            if(confirm("Are You Sure Want to Delete ?")){
                document.getElementById('employ-edit-action-'+id).submit();
            }

        }
    </script>
</body>
</html>
