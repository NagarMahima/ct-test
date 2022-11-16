<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blog List</title>
</head>
<body>
	<h2></h2>
	<div class="container">
		<form class="form-group" action="/blog_category" method="post">
			<div class="row">
				<div class="col-4">
					<label>Category</label>
					<select class="form-control" name="category">
						<option>Select Category</option>
						@foreach($category as $cat)
						<option value="{{$cat->title}}">{{$cat->title}}</option>
						@endforeach											
					</select>
				</div>
				<div class="col" style="margin-top: 33px;">
					<button class="btn btn-primary">Search</button>
					<a href="/blog"><button class="btn btn-primary" type="button">Clear</button></a>

				</div>
			</div>
		</form>
		<div class="row mt-5">
			@foreach($data as $d)
			<div class="col-4">
				<div class="card" style="width: 18rem;">
					@if($d->image == '')
				  		<img class="card-img-top" src='{{asset("default.jpg")}}' >
				  	@else
				  		<img class="card-img-top" src='{{asset("root/blog/image/$d->image")}}'  alt="Card image cap">
				  	@endif
				  <div class="card-body">
				    <h5 class="card-title">{{$d->title}}</h5>
				    <p class="card-text">
				    	@php
				    		$datas = substr($d->content, 0,150);
				    	@endphp
				    		{!! $datas !!}
				    </p>
				    <p><strong>Category :</strong><?php $category=unserialize($d->category);?>
			            @foreach($category as $c)
			            {{$c}}
			        @endforeach
			        </p>
			        <strong>Publish Date :</strong> {{$d->publish_date}}
				    <a href="/blog/{{$d->slug}}" class="btn btn-primary float-right mt-3">Read More</a>
				  </div>
				</div>
			</div>
			@endforeach
		</div>
	</div>

</body>
</html>