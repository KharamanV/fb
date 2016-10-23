@extends('layouts.app')

@section('content')
	@if (isset($lastCatPosts))
		<section class="latest-category-articles">
			<div class="container">
				<h2 class="title-section">
					<span class="heading-line">Последние в категории</span>
					<form action="{{ route('posts.search') }}" class="search-form pull-xs-right" role="search">
						<input autocomplete="off" type="search" class="search-input" id="search" name="search" placeholder="SEARCH HERE" value="{{ old('search') }}">
						<button type="submit" class="search-btn" id="search-submit"><i class="fa fa-search"></i></button>
					</form>
				</h2>
				<div id="owl-demo" class="owl-carousel owl-theme">
				@foreach ($lastCatPosts as $lastCatPost)
					<div class="item latest">
						<div class="post-block" style="background-image: url({{ asset('uploads/800/' . $lastCatPost->img) }});">
							<div class="post-caption">
								@if (isset($lastCatPost->category->name))
									<a class="card-category" href="{{ route('category.show', $lastCatPost->category->slug) }}" style="background-color: {{ $lastCatPost->category->color }}">
										{{ $lastCatPost->category->name }}
									</a>
								@else
									<a class="card-category" href="{{ route('category.show', 'others') }}">
										others
									</a>
								@endif
								<h4 class="post-title">
									<a href="{{ route('posts.show', $lastCatPost->slug) }}">{{ $lastCatPost->title }}</a>
								</h4>
								<ul class="post-info">
									<li>
										<i class="fa fa-clock-o"></i>
										{{ date('d M Y', $lastCatPost->created_at->getTimestamp()) }}
									</li>
									<li>
										<a href="{{ route('posts.show', $lastCatPost->slug) }}#comments">
											<i class="fa fa-comments-o"></i>
											<span>{{ $lastCatPost->comments->count() }}</span>
										</a>
									</li>
									<li>
										<i class="fa fa-bar-chart"></i>
										{{ $lastCatPost->rating }}
									</li>
								</ul>
							</div>
						</div>
					</div>
				@endforeach
				</div>
			</div>
		</section>
	@endif
	<div class="container">
		<div class="row">
			<div class="col-xl-9">
				<section class="latest-articles" id="latest-articles">
					<h2 class="title-section"><span class="heading-line">Последние статьи</span></h2>
					<div class="row">
						@foreach ($posts as $post)
							<div class="col-md-4 col-sm-6 post-container">
								<div class="post-item">
									<div class="post-img" style="background-image: url({{ asset('uploads/800/' . $post->img) }});">
										@if (isset($post->category->name))
											<a class="card-category" href="{{ route('category.show', $post->category->slug) }}" style="background-color: {{ $post->category->color }}">
												{{ $post->category->name }}
											</a>
										@else
											<a class="card-category" href="{{ route('category.show', 'others') }}">
												others
											</a>
										@endif
									</div>
									<div class="post-content">
										<h4 class="post-title">
											<a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
										</h4>
										<ul class="post-info">
											<li>
												<i class="fa fa-clock-o"></i>
												{{ date('d M Y', $post->created_at->getTimestamp()) }}
											</li>
											<li>
												<a href="{{ route('posts.show', $post->slug) }}#comments">
													<i class="fa fa-comments-o"></i>
													<span>{{ $post->comments->count() }}</span>
												</a>
											</li>
											<li>
												<i class="fa fa-bar-chart"></i>
												{{ $post->rating }}
											</li>
										</ul>
									</div>
								</div>
							</div>
						@endforeach
						<div class="col-xs-12">
							<div class="text-xs-center">
								{{ (isset($path)) ? $posts->setPath($path)->fragment('latest-articles')->links() : $posts->links() }}
							</div>
						</div>
					</div>
				</section>
			</div>
			<div class="col-xl-3">
				<h2 class="title-section"><span class="heading-line">Топ в категории</span></h2>
				@if (isset($topCatPosts))
					<section class="top-categories">
					<div id="owl-demo2" class="owl-carousel owl-theme">
						@foreach ($topCatPosts as $topCatPost)
							<div class="item latest">
								<div class="post-block" style="background-image: url({{ asset('uploads/800/' . $topCatPost->img) }});">
									<div class="post-caption">
										@if (isset($topCatPost->category->name))
											<a class="card-category" href="{{ route('category.show', $topCatPost->category->slug) }}" style="background-color: {{ $topCatPost->category->color }}">
												{{ $topCatPost->category->name }}
											</a>
										@else
											<a class="card-category" href="{{ route('category.show', 'others') }}">
												others
											</a>
										@endif
										<h4 class="post-title">
											<a href="{{ route('posts.show', $topCatPost->slug) }}">{{ $topCatPost->title }}</a>
										</h4>
										<ul class="post-info">
											<li>
												<i class="fa fa-clock-o"></i>
												{{ date('d M Y', $topCatPost->created_at->getTimestamp()) }}
											</li>
											<li>
												<a href="{{ route('posts.show', $topCatPost->slug) }}#comments">
													<i class="fa fa-comments-o"></i>
													<span>{{ $topCatPost->comments->count() }}</span>
												</a>
											</li>
											<li>
												<i class="fa fa-bar-chart"></i>
												{{ $topCatPost->rating }}
											</li>
										</ul>
									</div>
								</div>
							</div>
						@endforeach
					</div>
					</section>
				@endif
			</div>
		</div>
	</div>
    <footer class="page-footer">
        <div class="container">
            <div class="widget social-widget">
                <h2 class="page-footer-heading">Наши контакты</h2>
                <ul class="social-icons">
                    <li><a target="_blank" href="https://vk.com/frontend_and_backend" class="vk"><i class="fa fa-vk"></i></a></li>
                    <li><a target="_blank" href="https://www.youtube.com/channel/UC-ntPRQLq246E5dqifBhfkw" class="youtube"><i class="fa fa-youtube"></i></a></li>
                    <li><a target="_blank" href="https://twitter.com/front_and_back" class="twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a target="_blank" href="https://telegram.me/frontend_and_backend" class="telegram"><i class="fa fa-paper-plane"></i></a></li>
                </ul>
            </div>
        </div>
    </footer>
@endsection