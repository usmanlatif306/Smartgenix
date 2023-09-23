<div class="col-md-8">
    <ul class="nav d-flex justify-content-center">
        @foreach ($tabs as $tab)
            <li class="nav-item fs-14 @if ($selected === $tab) border-bottom-genix @endif"
                wire:click="changeTab('{{ $tab }}')">
                {{-- @if ($selected === $tab) text-genix @endif --}}
                <span class="curser-pointer nav-link text-capitalize">{{ trans('general.' . $tab) }}</span>
            </li>
        @endforeach
    </ul>
    @if ($selected === 'vision' || $selected === 'mission')
        <p class="pt-3">{!! __($page->content) !!}</p>
    @elseif ($selected === 'our-team')
        <div class="mt-4">
            <h5 class="mb-3 text-center">{{ trans('general.meet_team') }}
                <a href="{{ route('careers') }}" class="text-genix">{{ trans('general.career_page') }}</a> .
            </h5>
            <div class="row">
                @foreach ($page as $name => $teams)
                    @php
                        if ($name === 'admin') {
                            $order = 2;
                        } elseif ($name === 'executive') {
                            $order = 1;
                        } elseif ($name === 'developer') {
                            $order = 3;
                        } elseif ($name === 'Support') {
                            $order = 4;
                        } else {
                            $order = 5;
                        }
                        
                    @endphp
                    <div class="col-12 order-{{ $order }}">
                        <h5 class="text-capitalize mb-3 fw-semibold">
                            {{ $name === 'Support' ? trans('general.support_staff') : trans('general.' . $name) }}
                            {{-- {{ $name === 'Support' ? trans('general.support_staff') : ($name === 'executive' || $name === 'developer' ? trans('general.' . $name) : $name) }} --}}
                        </h5>
                        <div class="d-flex flex-wrap gap-4">
                            @foreach ($teams as $team)
                                <div class="text-center mb-2">
                                    <img src="{{ file_url($team->image) }}" alt="{{ $team->title }}"
                                        class="img-circle-md">
                                    <span class="d-block">{{ __($team->name) }}</span>
                                    <small class="d-block">{{ __($team->title) }}</small>
                                    @if ($team->facebook)
                                        <a href="{{ $team->facebook }}"
                                            class="fs-18 text-decoration-none me-2 text-genix"><i
                                                class="bi bi-facebook"></i></a>
                                    @endif
                                    @if ($team->twitter)
                                        <a href="{{ $team->twitter }}"
                                            class="fs-18 text-decoration-none me-2 text-genix"><i
                                                class="bi bi-twitter"></i></a>
                                    @endif
                                    @if ($team->linkedin)
                                        <a href="{{ $team->linkedin }}"
                                            class="fs-18 text-decoration-none text-genix"><i
                                                class="bi bi-linkedin"></i></a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    @else
        <!---- our history ---->
        <div class="main-timeline8 mt-5">
            @foreach (json_decode($page->content, true) as $history)
                <div class="timeline">
                    <span class="timeline-icon"></span>
                    <span class="year">{{ $history['year'] }}</span>
                    <div class="timeline-content">
                        <h3 class="title">{{ __($history['title']) }}</h3>
                        <p class="description">{{ __($history['description']) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
