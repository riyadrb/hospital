<!DOCTYPE html>
<html lang="en">

<head>
    <style type="text/css">
      label
        {
            display: inline-block;
            width: 100px;
        }
    </style>   
</head>
<body>


    <div class="container-fluid page-body-wrapper">
         <div class="mt-5 pt-5">

         @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
                </ul>
            </div>
        @endif



            <div class="container">
                
            @if(session()->has('message'))

            <div class="alert alert-success">
                <button type="button" class="close" data-dismis="alert">
                    x
                </button>
            {{session()->get('message')}}
            </div>

            @endif


                <form action="{{route('upload')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label for="">Doctor's Name :</label>
                        <input type="text" name="name" style="color: black" value="">
                    </div>
                    <br>
                    
                    <div>
                        <label for="">Mobile Number :</label>
                        <input type="number" name="number" style="color: black" value="">
                    </div>
                    <br>
                    
                    <div >
                        <label for="">Room No :</label>
                        <input type="number" name="room" style="color: black" value="">
                    </div>
                    <br>
                    <div>
                        <label>Speciality :</label>
                        <select name="speciality" style="color:black ; width: 200px " >
                            <option value="">--select--</option>
                            <option value="Cardiology">Cardiology</option>
                            <option value="Dental">Dental</option>
                            <option value="Neurology">Neurology</option>
                            <option value="Orthopaedics">Orthopaedics</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="">Image :</label>
                        <input type="file" name="image" value="">
                    </div>
                    <br>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
         </div>
    </div>
    
</body>
</html>