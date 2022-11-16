<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Blog 
    </title>
    <style type="text/css">
        .container{
            margin-top: 45px;
            margin-left: 45px;
            box-shadow: 0px 3px 10px 0px #999;
        }
        .sidebar{
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container-fluid">   
        <div class="row sidebar">
        <div class="col-2">
            <a href="blogs"><h4>Add Blog</h4></a>
            <hr>
            <a data-toggle="modal" data-target="#category"><h4>Add Category</h4></a>
            <hr>
            <a href="{{ url('blog_list') }}"><h4>Blog List</h4></a>
            <hr>
        </div>
            <div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <center>
                            <div class="modal-header" style="border-bottom: 1px dashed #e0e6ed;">
                                <div class="media-body">
                                    <h5><b>Add New Category</b></h5>
                                </div>
                                <div class="media-body">
                                    <a data-toggle="modal" data-target="#sub_cat"><button type="button" class="btn btn-primary">Add SubCategory</button></a>

                                </div>

                            </div>
                        </center>

                        <div class="modal-body">
                            <form class="form-group" method="post" action="add_category" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Category</label>
                                    <input type="text" name="category" class="form-control" placeholder="Enter Title">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Image</label>
                                    <input type="file" name="image" class="form-control" placeholder="Enter Image">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Discription</label>
                                    <textarea cols="40" rows="4"  name="disc" style="resize: none;" class="form-control"></textarea>
                                </div> <br>
                                <div class="row float-right">
                                    <div class="col-6">
                                        <input type="submit" name="wish" value="Save" class="btn btn-primary">
                                    </div>
                                    <div class="col-6">
                                        <input type="button" name="wish" data-dismiss="modal" value="Close" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="sub_cat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <center>
                            <div class="modal-header" style="border-bottom: 1px dashed #e0e6ed;">
                                <div class="media-body">
                                    <h5><b>Add Sub Category</b></h5>
                                </div>
                            </div>
                        </center>

                        <div class="modal-body">
                            <form class="form-group" method="post" action="add_sub_cat" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Sub Category</label>
                                    <input type="text" name="category" class="form-control" placeholder="Enter Title">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Parent Category</label>
                                    <select name="parent_cat" class="form-control">
                                        <option selected>Select Parent Category</option>
                                        @foreach($model as $model)
                                        <option value="{{$model->id}}">{{$model->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Image</label>
                                    <input type="file" name="image" class="form-control" placeholder="Enter Image">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Discription</label>
                                    <textarea cols="40" rows="4"  name="disc" style="resize: none;" class="form-control"></textarea>
                                </div> <br>
                                <div class="row float-right">
                                    <div class="col-6">
                                        <input type="submit" name="wish" value="Save" class="btn btn-primary">
                                    </div>
                                    <div class="col-6">
                                        <input type="button" name="wish" data-dismiss="modal" value="Close" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>