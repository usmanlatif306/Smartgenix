<section class="bg-white p-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <!-- General-->
                <h2 class="text-center mb-3">{{ trans('general.general') }}</h2>
                @forelse ($generals as $blog)
                    <div class="px-4 mb-2">
                        <div class="card">
                            <img src="{{ $blog->photo }}" style="max-height: 8rem;" class="card-img-top" alt="blog image"
                                loading="lazy">
                            <div class="card-body text-genix text-start">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>{{ $blog->created_at->format('d/m/Y') }}</span>
                                    <span>{{ $blog->user->name }}</span>
                                </div>
                                <h5 class="card-title curser-pointer" data-bs-toggle="modal"
                                    data-bs-target="#blogModel{{ $blog->id }}">
                                    {{ __(str()->limit($blog->title, 100)) }}</h5>
                                {{-- <p class="card-text">{{ $blog->description }}</p> --}}
                                {{-- <div class="text-center">
                                    <button class="btn btn-sm btn-genix" data-bs-toggle="modal"
                                        data-bs-target="#blogModel{{ $blog->id }}">View Story</button>
                                </div> --}}
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
                                        <span class="model-date">{{ $blog->created_at->format('d/m/Y') }}</span>
                                        <span class="model-author">{{ $blog->user->name }}</span>
                                    </div>
                                    <h3 class="model-title text-genix">{{ $blog->title }}</h3>
                                    <p class="model-description">
                                        {{ $blog->description }}
                                    </p>
                                    {!! $blog->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal end -->
                @empty
                    <p class="text-center">{{ trans('general.no_story') }}</p>
                @endforelse
                @if ($generals->count() < $general_total)
                    <div class="text-center">
                        <button class="btn btn-sm btn-genix"
                            wire:click="loadMore('general')">{{ trans('general.load_more') }}</button>
                    </div>
                @endif
                <!-- General end-->
            </div>
            <div class="col-md-4 mb-3">
                <!-- Staff-->
                <h2 class="text-center mb-3">{{ trans('general.account') }}</h2>
                @forelse ($staffs as $blog)
                    <div class="px-4 mb-2">
                        <div class="card">
                            <img src="{{ $blog->photo }}" style="max-height: 8rem;" class="card-img-top"
                                alt="blog image" loading="lazy">
                            <div class="card-body text-genix text-start">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>{{ $blog->created_at->format('d/m/Y') }}</span>
                                    <span>{{ $blog->user->name }}</span>
                                </div>
                                <h5 class="card-title curser-pointer" data-bs-toggle="modal"
                                    data-bs-target="#blogModel{{ $blog->id }}">{{ $blog->title }}</h5>
                                {{-- <p class="card-text">{{ $blog->description }}</p> --}}
                                {{-- <div class="text-center">
                                    <button class="btn btn-sm btn-genix" data-bs-toggle="modal"
                                        data-bs-target="#blogModel{{ $blog->id }}">View Story</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="blogModel{{ $blog->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="blogModelLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start text-black">
                                    <img src="{{ $blog->photo }}" class="img-fluid rounded model-image"
                                        alt="blog image" loading="lazy">
                                    <div class="d-flex justify-content-between my-2 text-genix">
                                        <span class="model-date">{{ $blog->created_at->format('d/m/Y') }}</span>
                                        <span class="model-author">{{ $blog->user->name }}</span>
                                    </div>
                                    <h3 class="model-title text-genix">{{ $blog->title }}</h3>
                                    <p class="model-description">
                                        {{ $blog->description }}
                                    </p>
                                    {!! $blog->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal end -->
                @empty
                    <p class="text-center">{{ trans('general.no_story') }}</p>
                @endforelse
                @if ($staffs->count() < $staff_total)
                    <div class="text-center">
                        <button class="btn btn-sm btn-genix"
                            wire:click="loadMore('staff')">{{ trans('general.load_more') }}</button>
                    </div>
                @endif
                <!-- Staff end-->
            </div>
            <div class="col-md-4 mb-3">
                <!-- Support-->
                <h2 class="text-center mb-3">{{ trans('general.support') }}</h2>
                @forelse ($supports as $blog)
                    <div class="px-4 mb-2">
                        <div class="card">
                            <img src="{{ $blog->photo }}" style="max-height: 8rem;" class="card-img-top"
                                alt="blog image" loading="lazy">
                            <div class="card-body text-genix text-start">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>{{ $blog->created_at->format('d/m/Y') }}</span>
                                    <span>{{ $blog->user->name }}</span>
                                </div>
                                <h5 class="card-title curser-pointer" data-bs-toggle="modal"
                                    data-bs-target="#blogModel{{ $blog->id }}">{{ $blog->title }}</h5>
                                {{-- <p class="card-text">{{ $blog->description }}</p> --}}
                                {{-- <div class="text-center">
                                    <button class="btn btn-sm btn-genix" data-bs-toggle="modal"
                                        data-bs-target="#blogModel{{ $blog->id }}">View Story</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="blogModel{{ $blog->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="blogModelLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start text-black">
                                    <img src="{{ $blog->photo }}" class="img-fluid rounded model-image"
                                        alt="blog image" loading="lazy">
                                    <div class="d-flex justify-content-between my-2 text-genix">
                                        <span class="model-date">{{ $blog->created_at->format('d/m/Y') }}</span>
                                        <span class="model-author">{{ $blog->user->name }}</span>
                                    </div>
                                    <h3 class="model-title text-genix">{{ $blog->title }}</h3>
                                    <p class="model-description">
                                        {{ $blog->description }}
                                    </p>
                                    {!! $blog->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal end -->
                @empty
                    <p class="text-center">{{ trans('general.no_story') }}</p>
                @endforelse
                @if ($supports->count() < $support_total)
                    <div class="text-center">
                        <button class="btn btn-sm btn-genix"
                            wire:click="loadMore('support')">{{ trans('general.load_more') }}</button>
                    </div>
                @endif
                <!-- Support end-->
            </div>
        </div>
    </div>
</section>
