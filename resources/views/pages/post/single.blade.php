@extends('layouts.app')

@section('css')

@endsection

@section('content')
		<div id="colorlib-main">
			<section class="ftco-section ftco-no-pt ftco-no-pb">
	    	<div class="container">
				<div class="row d-flex">
					<div class="col-xl-8 py-5 px-md-5">
						<div class="row pt-md-4" style="white-space: pre-line;">
	    					<h1 style="white-space: pre-line;" class="mb-3">{{ $post->title }}</h1>
                            {!! $post->description !!}
                            
		            <div class="tag-widget post-tag-container mb-5 mt-5">
		              <div class="tagcloud">
		                <a href="#" class="tag-cloud-link">{{ $post->category->name }}</a>
		              </div>
		            </div>
		            
		            <div class="about-author d-flex p-4 bg-light">
		              <div class="bio mr-5">
		                <img src="{{ asset('images/user.png') }}" alt="Image placeholder" class="img-fluid mb-4">
		              </div>
		              <div class="desc">
		                <h3>{{ $post->user->name }}</h3>
		                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
		              </div>
		            </div>


		            <div class="pt-5 mt-5">
		              <h3 class="mb-5 font-weight-bold">{{ $post->comments()->count() }} Comments</h3>
		              <ul class="comment-list">
		                @foreach ($post->comments as $comment)
                        <li class="comment">
                            <div class="vcard bio">
                              <img src="{{ asset('images/user.png') }}" alt="Image placeholder">
                            </div>
                            <div class="comment-body">
                              <h3>{{ $comment->user->name }}</h3>
                              <div class="meta">{{ $comment->created_at->format('M d, Y \a\t H:s') }}</div>
                              {!! $comment->description !!}
                            </div>
                          </li>
                        @endforeach
		              </ul>
		              <!-- END comment-list -->
		              
		              <div class="comment-form-wrap pt-5">
		                <h3 class="">Leave a comment</h3>
                        <form action="{{ route('post.comment', $post->id) }}" method="POST">
                            @csrf

		                  <div class="form-group" style="">
		                    <label for="message">Message</label>
		                    <textarea name="description" id="message" cols="60" rows="10" class="form-control"></textarea>
		                  </div>
		                  <div class="form-group">
		                    <input type="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
		                  </div>

		                </form>
		              </div>
		            </div>
			    		</div><!-- END-->
			    	
			    	</div>
			<div class="col-xl-4 sidebar ftco-animate bg-light pt-5">
	            <div class="sidebar-box pt-md-4">
	              {{-- <form action="#" class="search-form">
	                <div class="form-group">
	                  <span class="icon icon-search"></span>
	                  <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
	                </div>
	              </form> --}}
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

@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
    <script>

        ClassicEditor
    .create( document.querySelector( '#message' ) )
    .then( editor => {
            console.log( editor );
    } )
    .catch( error => {
            console.error( error );
    } );
    </script>
@endsection
