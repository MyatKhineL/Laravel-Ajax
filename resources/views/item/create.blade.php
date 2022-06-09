<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>Laravel</title>
    <link href="{{ asset('css/app.css')}}" rel="stylesheet">
    <script src="{{ asset('js/app.js')}}"></script>
    <script src="{{ asset('js/jquery.min.js')}}"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Action</th>
                            <th>Time</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Item Name</label>
                        <input type="text" class="form-control" id="title">
                        <span class="text-danger" id="titleError"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label>Item Price</label>
                        <input type="number" class="form-control" id="price">
                        <span class="text-danger" id="priceError"></span>
                    </div>
                    <button type="submit" onclick="addData()" id="addBtn" class="btn btn-primary">Add</button>
{{--                    <button type="submit" id="updateBtn" class="btn btn-primary">Update</button>--}}

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    // clear all data
    function clearData(){
        $('#title').val('');
        $('#price').val('');
        $('#titleError').text('');
        $('#priceError').text('');
    }

    // get all data
    function allData(){
        $.ajax({
            type:"GET",
            dataType:'json',
            url:"/item/all",
            success:function (res){
               var data = "" ;
               $.each(res,function (key,value){
                   data = data + "<tr>"
                   data = data +"<td>"+value.id+"</td>"
                   data = data +"<td>"+value.title+"</td>"
                   data = data +"<td>"+value.price+"</td>"
                   data = data + "<td class='d-flex justify-content-around'>"
                   data = data + "<button class='btn btn-warning ml-2'>Edit</button>"
                   data = data + "<button class='btn btn-danger'>Delete</button>"
                   data = data + "</td>"
                   data = data + "</tr>"
               })
                $('tbody').html(data);
            }

        })
    }
    allData();

    //store data
    function addData(){
        // take value of input
        var title = $('#title').val();
        var price = $('#price').val();


        $.ajax({
            url:"/item/store/",
            type:"POST",
            dataType:"json",
            data:{title:title,price:price},
            success:function (data){
                clearData();
                allData();
                console.log('successfuly data added');
            },
            // show Error responseJson from readyState
            error:function (error){
                  $('#titleError').text(error.responseJSON.errors.title);
                  $('#priceError').text(error.responseJSON.errors.price);

            }
        });

    }


</script>
</body>
</html>
