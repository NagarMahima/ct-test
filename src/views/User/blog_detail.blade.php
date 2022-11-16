<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@foreach($data as $d)
		<title>{{$d->title}}</title>
	@endforeach
</head>
<body>
	<h2></h2>
	<div class="container">
		<div class="row">
			@foreach($data as $d)
			<div class="col-12">
				<div class="">
					@if($d->video == '')
				  		<img class="card-img-top" src='{{asset("root/blog/image/$d->image")}}'  alt="Card image cap">
				  	@else
				  		<center><video controls height="300">
				  			<source src='{{asset("root/blog/video/$d->video")}}' type="">
				  		</video></center>
				  	@endif
				  <div class="card-body">
				    <h5 class="card-title">{{$d->title}}</h5>
				    <p class="card-text">
				    	{!!$d->content!!}
				    </p>
				    <p><strong>Category :</strong><?php $category=unserialize($d->category);?>
			            @foreach($category as $c)
			            {{$c}}
			        @endforeach
			        </p>
			        <strong>Publish Date :</strong> {{$d->publish_date}}
				  </div>
				</div>
			</div>
			@endforeach
		</div>
	</div>

</body>
</html>