@include('Blog::components/sidebar')

	@if(isset($blog))
		<div class="col-10">
			<div class="container col-11">
			<h2 class="p-1">Update Blog</h2>
			<form class="form-group p-2" method="post" action='{{ url("/update/$blog->id") }}' enctype="multipart/form-data">
				{{csrf_field()}}

				<div class="form-group">
					<div class="form-group col-md-12">
				    	<label class="font-weight-bold">Title</label>
				        <input type="text" name="title" value="{{$blog->title}}" class="form-control" id="inputEmail4" placeholder="Enter Title">
				    </div>

				    <div class="form-group col-md-12">
				    	<label class="font-weight-bold">Slug</label>
						<input type="text" name="slug" value="{{$blog->slug}}" class="form-control" id="inputPassword4" placeholder="Enter Slug">
				    </div>

				    <div class="form-group col-md-12 row">
				    	<div class="col-10">				    		
					        <label class="font-weight-bold">Image</label>
					        <input type="file" name="image" value="{{$blog->image}}" class="form-control p-1" placeholder="Upload Image">
				    	</div>
				    	<div class="col-2">				    		
				        	<img src='{{asset("root/blog/image/$blog->image")}}' height="100" width="150">
				    	</div>
				    </div>
				    <div class="form-group col-md-12 row">
				    	<div class="col-10">
					        <label class="font-weight-bold">Video</label>				        
					        <input type="file" name="video" value="{{$blog->video}}" class="form-control p-1" placeholder="Upload Video">
					    </div>
					    <div class="col-2">
				        	<video controls height="100" width="150">
				        		<source  src='{{asset("root/blog/video/$blog->video")}}' type="">
				        	</video>		    	
					    </div>
				    </div>
				    <div class="form-group col-md-12">
				        <label class="font-weight-bold">Content</label>				        
				        <textarea class="form-control" name="content" cols="37" rows="2" id="summary-ckeditor" name="summary-ckeditor">{!! $blog->content !!}</textarea>
				        @if(isset($errors['content']))
				        	{{ $errors['content'] }}
				        @endif
				    </div>

					<div class="form-group col-12 p-4">
				    	<label class="font-weight-bold">Category</label><br>
				    	<?php $category = unserialize($blog->category);?>
				    	@foreach($model as $cat)
				    	@foreach($category as $c)
				    		@if($cat->title == $c)
				        		<input type="checkbox" checked class="m-1 text" value="{{$cat->title}}" name="category[]">{{$cat->title}}
				        	@else
				        		<input type="checkbox"  class="m-1 text" value="{{$cat->title}}" name="category[]">{{$cat->title}}		        		

				        	@endif
				        @endforeach
				        @endforeach
					    <div class="display ml-5"></div>
				        </div>
				    </span>
				    </div>

				    <div class="form-group col-md-12">
				    	<label class="font-weight-bold">Meta Title</label>
				        <input type="teext" value="{{$blog->title}}" name="meta_tilte" class="form-control" id="inputEmail4" placeholder="Enter Title">
				    </div>

				    <div class="form-group col-md-12">
				    	<label class="font-weight-bold">Meta Discription</label>
				    	<textarea name="meta_disc" value="{{$blog->title}}" rows="5" class="form-control" id="inputEmail4" placeholder="Enter Discription"></textarea>
				    </div>

				    <div class="form-group col-md-12">
				    	<label class="font-weight-bold">Meta Keyword</label>
				        <input type="teext" value="{{$blog->title}}" name="meta_keyword" class="form-control" id="inputEmail4" placeholder="Enter Keyword">
				    </div>
				    <div class="form-group col-md-12">
				    	<label class="font-weight-bold">Author</label>
				        <select name="author" id="inputState" class="form-control">
					        <option selected>Select Author</option>
				        	@foreach($author as $auth)
					        	@if($auth->author_name == $blog->author)
						        	<option selected value="{{$auth->author_name}}">{{$auth->author_name}} </option>
						        @else
						       		<option value="{{$auth->author_name}}">{{$auth->author_name}} </option>
						        @endif
					        @endforeach
				        </select>
				    </div>
				    <div class="form-group col-md-12">
				    	@if($blog->status == 'Draft')
							<button type="submit" class="btn btn-primary mr-3">Update</button>
							<a href="{{ url('/publish/$blog->id') }}"><button type="button" class="btn btn-primary">Publish</button></a>
						@else
							<button type="submit" class="btn btn-primary">Update</button>
						@endif
					</div>
				</div>
			</form>
		</div>
	@else
		<div class="col-10">
			<div class="container col-11">
			<h2 class="p-1">Add New Blog</h2>
			<form class="form-group p-2" method="post" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
				{{csrf_field()}}

				<div class="form-group">
					<div class="form-group col-md-12">
				    	<label class="font-weight-bold">Title</label>
				        <input type="text" name="title" class="form-control" id="inputEmail4" placeholder="Enter Title">
				        @if(isset($errors))
				        {{$errors}}
					        @if($errors->has('title'))
	                            @foreach($errors->get('title') as $error)
	                                {{$error}}
	                            @endforeach
	                        @endif
                        @endif
				    </div>

				    <div class="form-group col-md-12">
				    	<label class="font-weight-bold">Slug</label>
						<input type="text" name="slug" class="form-control" id="inputPassword4" placeholder="Enter Slug">
				    </div>

				    <div class="form-group col-md-12">
				        <label class="font-weight-bold">Image</label>
				        <input type="file" name="image" class="form-control p-1" placeholder="Upload Image">
				    </div>
				    <div class="form-group col-md-12">
				        <label class="font-weight-bold">Video</label>				        
				        <input type="file" name="video" class="form-control p-1" placeholder="Upload Video">

				    </div>
				    <div class="form-group col-md-12">
				        <label class="font-weight-bold">Content</label>				        
				        <textarea class="form-control" name="content" cols="37" rows="2" id="summary-ckeditor" name="summary-ckeditor"></textarea>
				        @if(isset($errors['content']))
				        	{{ $errors['content'] }}
				        @endif
				    </div>

					<div class="form-group col-12 p-4">
				    	<label class="font-weight-bold">Category</label><br>
				    	@foreach($model as $cat)
				        	<input type="checkbox" class="m-1 text" value="{{$cat->title}}" name="category[]">{{$cat->title}}
				        @endforeach
					    <div class="display ml-5"></div>
				        </div>
				    </span>
				    </div>

				    <div class="form-group col-md-12">
				    	<label class="font-weight-bold">Meta Title</label>
				        <input type="teext" name="meta_tilte" class="form-control" id="inputEmail4" placeholder="Enter Title">
				    </div>

				    <div class="form-group col-md-12">
				    	<label class="font-weight-bold">Meta Discription</label>
				    	<textarea name="meta_disc" rows="5" class="form-control" id="inputEmail4" placeholder="Enter Discription"></textarea>
				    </div>

				    <div class="form-group col-md-12">
				    	<label class="font-weight-bold">Meta Keyword</label>
				        <input type="teext" name="meta_keyword" class="form-control" id="inputEmail4" placeholder="Enter Keyword">
				    </div>
				    <div class="form-group col-md-12">
				    	<label class="font-weight-bold">Author</label>
				        <select name="author" id="inputState" class="form-control">
					        <option selected>Select Author</option>
				        	@foreach($author as $auth)
					        <option value="{{$auth->author_name}}">{{$auth->author_name}} </option>
					        @endforeach
					        @if(isset($errors['author']))
				        	{{ $errors['author'] }}
				        @endif
				        </select>
				    </div>
				    <div class="form-group col-md-12">

						<input type="submit" class="btn btn-primary mr-5" name="Publish" value="Publish">
						<a href="draft"><button type="button" class="btn btn-primary">Save As Draft</button></a>
					</div>
				</div>
			</form>
		</div>
		@endif

	</div>
</div>

	<!-- <form>
			<div class="container">
				<div class="row">
				<div class="col-6">
					<h3>hello</h3>
				</div>
				<div col="6">
					<div class="container-fluid col-8">










						<div class="form-row">
							<div class="form-group col-md-6">
						    	<label for="inputEmail4">Email</label>
						        <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
						    </div>
						    <div class="form-group col-md-6">
						       <label for="inputPassword4">Password</label>
						       <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
						    </div>
				    	</div>
					    <div class="form-group">
					        <label for="inputAddress">Address</label>
					        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
					    </div>
					    <div class="form-group">
					        <label for="inputAddress2">Address 2</label>
					        <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
					    </div>
				  <div class="form-row">
				    <div class="form-group col-md-6">
				      <label for="inputCity">City</label>
				      <input type="text" class="form-control" id="inputCity">
				    </div>
				    <div class="form-group col-md-4">
				      <label for="inputState">State</label>
				      <select id="inputState" class="form-control">
				        <option selected>Choose...</option>
				        <option>...</option>
				      </select>
				    </div>
				    <div class="form-group col-md-2">
				      <label for="inputZip">Zip</label>
				      <input type="text" class="form-control" id="inputZip">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="form-check">
				      <input class="form-check-input" type="checkbox" id="gridCheck">
				      <label class="form-check-label" for="gridCheck">
				        Check me out
				      </label>
				    </div>
				  </div>
				  <button type="submit" class="btn btn-primary">Sign in</button>
				</div>
					</div>
				</div>
			</div>
	</form> -->


<script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script>
CKEDITOR.replace( 'summary-ckeditor' );
</script>


<script>
	$('.sub_cate').click(function(){
	    var cat_id = $(this).val();
	    console.log(cat_id);
	    var cat_id =1;
        $.ajax({
            url : "{{ url('category')}}",
            type : "get",
            data : {cat_id:cat_id},
            success : function(html){
                $(".display").html(html);
            }
            
        });
	});
</script>



</body>
</html>