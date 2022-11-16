@include('Blog::components/sidebar')


    <div class="col-10">
      <div class="container col-11">
      <h2 class="p-1">Blog List</h2>
        <table class="table table-hover table-bordered" >
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Title</th>
              <th scope="col">Slug</th>
              <th scope="col">Content</th>
              <th scope="col">Author</th>
              <th scope="col">Category</th>
              <th scope="col">Publish</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($blog as $b)
            <tr>
              <td>{{$b->id}}</td>
              <td>{{$b->title}}</td>
              <td>{{$b->slug}}</td>
              <td>{!! $b->content !!}</td>
              <td>{{$b->author}}</td>
              <?php $category=unserialize($b->category);?>
              @foreach($category as $c)
              <td>{{$c}}</td>
              @endforeach
              <?php $date = date('d-m-Y', strtotime($b->publish_date)); ?>
              <td>{{$date}}</td>
              <td>{{$b->status}}</td>
              <td>
                <a href="{{ route('blogs.edit',$b->id) }}"><button type="button" class="btn btn-primary m-1">Edit</button></a>
                <a data-toggle="modal" data-target="#delete" class="delete"><button type="button" class="btn btn-danger m-1">Delete</button></a>
              </td>
              @endforeach

            </tr>
          </tbody>
        </table>
      </div>
    </div>
              <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="text-center mt-3">Are You Want To Delete This Blog?</h5>
                        </div>
                        <form action="/delete" method="post" class="form-group">
                            {{csrf_field()}}
                            <div class="modal-body">
                                <input type="hidden" name="delete_id" id="delete_dbID">
                            </div>
                            <div class="">
                                <div class="row justify-content-end">
                                    <button class="btn btn-danger col-2 mr-4" type="submit">Delete    
                                    </button>
                                    <button type="button" class="btn btn-primary col-2 mr-4" data-dismiss="modal">
                                    Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    <script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>

    <script>

    $(".delete").on('click',function(){
      var currentRow=$(this).closest("tr");
      var col1=currentRow.find("td:eq(0)").text();
      $("#delete_dbID").val(col1);

    });
    </script>



  </body>
</html>