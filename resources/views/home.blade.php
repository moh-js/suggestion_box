@extends('layouts.app')

@section('content')
		<div id="colorlib-main">
			<section class="ftco-section ftco-no-pt ftco-no-pb">
	    	<div class="container">
				<div class="row d-flex">
					<div class="col-xl-8 py-5 px-md-5">
						@if (!(count($posts??[])))
						<center>No topics yet</center>
						@endif
	    				<div class="row pt-md-4">
			    			<div class="col-md-12">
								@foreach ($posts as $post)
								<div class="blog-entry ftco-animate d-md-flex">
									<a href="{{ route('post.show', $post->id) }}" class="img img-2" style="background-image: url({{ asset('images/user.png') }});"></a>
									<div class="text text-2 pl-md-4">
										<h3 class="mb-2"><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></h3>
										<div class="meta-wrap">
															<p class="meta">
												<span><i class="icon-calendar mr-2"></i>{{ $post->created_at->format('M d, Y') }}</span>
												<span><a href="{{ route('post.show', $post->id) }}"><i class="icon-folder-o mr-2"></i>{{ $post->category->name }}</a></span>
												<span><i class="icon-comment2 mr-2"></i>{{ $post->comments()->count() }} Comment</span>
											</p>
										</div>
										<p class="mb-4">{!! str_limit($post->description, 100, '...') !!}</p>
										<p><a href="{{ route('post.show', $post->id) }}" class="btn-custom">Read More <span class="ion-ios-arrow-forward"></span></a></p>
									</div>
								</div>
								@endforeach
							</div>
			    		</div><!-- END-->
			    	
			    	</div>
			<div class="col-xl-4 sidebar ftco-animate bg-light pt-5">
	            <div class="sidebar-box pt-md-4">
	              <form action="#" class="search-form">
	                <div class="form-group">
	                  <span class="icon icon-search"></span>
	                  <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
	                </div>
	              </form>
	            </div>
	            <div class="sidebar-box ftco-animate">
	            	<h3 class="sidebar-heading">Categories</h3>
	              <ul class="categories">
					@foreach (\App\Category::query()->orderBy('name')->get() as $category)
						<li><a href="#">{{ $category->name }} <span>({{ $category->posts()->count() }})</span></a></li>
					@endforeach
				  </ul>
	            </div>

	            <div class="sidebar-box ftco-animate">
	              <h3 class="sidebar-heading">Popular Topics</h3>
	              @foreach (App\Post::where('visibility', 0)->has('comments', '>=', '5')->limit(3)->get() as $post)
				  <div class="block-21 mb-4 d-flex">
	                <a class="blog-img mr-4" style="background-image: url({{ asset('images/user.png') }});"></a>
	                <div class="text">
	                  <h3 class="heading"><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></h3>
	                  <div class="meta">
	                    <div><a href="#"><span class="icon-calendar"></span> {{ $post->created_at->format('M d, Y') }}</a></div>
	                    <div><a href="#"><span class="icon-person"></span> {{ $post->user->name }} </a></div>
	                    <div><a href="#"><span class="icon-chat"></span> {{ $post->comments()->count() }} </a></div>
	                  </div>
	                </div>
	              </div>
				  @endforeach
	            </div>

	          </div><!-- END COL -->
	    		</div>
	    	</div>
	    </section>
		</div><!-- END COLORLIB-MAIN -->
@endsection
