@extends('layouts.website')
@section('content')
    <!-- Hero Section start -->
    <section class="bg-genix p-5 text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 text-center">
                    <h2 class="text-lg text-white">{{ trans('general.latest_stories') }}</h2>
                    <div class="row mt-5">
                        @forelse ($latest_blogs as $blog)
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="card d-flex flex-col flex-wrap h-100 w-100">
                                    <img src="{{ $blog->photo }}" class="card-img-top blog-img" alt="blog image"
                                        loading="lazy">
                                    <div class="card-body text-genix text-start d-flex flex-column">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>{{ $blog->created_at->format('d/m') }}</span>
                                            <small class="">{{ $blog->user->name }}</small>
                                        </div>
                                        <h5 class="card-title">{{ __(str()->limit($blog->title, 100)) }}
                                        </h5>
                                        <p class="card-text text-black">{{ __(str()->limit($blog->description, 100)) }}</p>
                                        <div class="text-center mt-3 mt-auto">
                                            <button class="btn btn-sm btn-genix mt-auto" data-bs-toggle="modal"
                                                data-bs-target="#blogModel{{ $blog->id }}">{{ trans('general.view_story') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="blogModel{{ $blog->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="blogModelLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start text-black">
                                            <img src="{{ $blog->photo }}" class="img-fluid rounded model-image"
                                                alt="blog image" loading="lazy">
                                            <div class="d-flex justify-content-between my-2 text-genix">
                                                <span class="model-date">{{ $blog->created_at->format('Y/m/d') }}</span>
                                                <span class="model-author">{{ $blog->user->name }}</span>
                                            </div>
                                            <h3 class="model-title text-genix">{{ __($blog->title) }}</h3>
                                            <p class="model-description">
                                                {{ __($blog->description) }}
                                            </p>
                                            {!! __($blog->content) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal end -->
                        @empty
                            <p class="text-center">{{ trans('general.no_story') }}</p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section end -->

    <!-- blog section start-->
    @livewire('blog')
    {{-- <h2>Support</h2>
    <div class="row mt-4 mb-5">
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card">
                <a href="#">
                    <img src="{{ asset('images/blog.jpg') }}" class="card-img-top" alt="blog image">
                </a>
                <div class="card-body text-genix text-start">
                    <div class="d-flex justify-content-between mb-2">
                        <span>24/05/2025</span>
                        <span>Admin</span>
                    </div>
                    <h5 class="card-title"><a href="#" class="text-genix text-decoration-none">Story
                            Title</a></h5>
                    <p class="card-text">Some quick example text to build on the card title and make up
                        the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card">
                <a href="#">
                    <img src="{{ asset('images/blog.jpg') }}" class="card-img-top" alt="blog image">
                </a>
                <div class="card-body text-genix text-start">
                    <div class="d-flex justify-content-between mb-2">
                        <span>24/05/2025</span>
                        <span>Admin</span>
                    </div>
                    <h5 class="card-title"><a href="#" class="text-genix text-decoration-none">Story
                            Title</a></h5>
                    <p class="card-text">Some quick example text to build on the card title and make up
                        the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card">
                <a href="#">
                    <img src="{{ asset('images/blog.jpg') }}" class="card-img-top" alt="blog image">
                </a>
                <div class="card-body text-genix text-start">
                    <div class="d-flex justify-content-between mb-2">
                        <span>24/05/2025</span>
                        <span>Admin</span>
                    </div>
                    <h5 class="card-title"><a href="#" class="text-genix text-decoration-none">Story
                            Title</a></h5>
                    <p class="card-text">Some quick example text to build on the card title and make up
                        the bulk of the card's content.</p>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- blog section end -->
@endsection
@push('scripts')
    {{-- <script>
        $(document).ready(function() {
            $('.view-detail').on('click', function() {
                let blog = $(this).data('blog')
                console.log(blog);
                $('.model-image').attr('src', blog.photo);
                $('.model-date').text(blog.created_at);
                $('.model-author').text('Admin');
                $('.model-title').text(blog.title);
                $('.model-description').text(blog.content);
            });
        });
    </script> --}}
@endpush
