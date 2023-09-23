@extends('layouts.app')

@section('content')
    <div class="container page-container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-genix">{{ trans('general.hello') }} {{ auth()->user()->name }}</h4>
                <hr />
            </div>
        </div>
        @include('partials.message')

        {{-- dashboard --}}
        <div class="card mb-2 border-0">
            <div class="card-body">
                <!-- package and ticket details start -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-3 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <span>{{ trans('general.name') }}:&nbsp&nbsp&nbsp</span>
                                    <span>{{ auth()->user()->name }}</span>
                                </div>
                                <div class="mb-3">
                                    <span>{{ trans('general.email') }}:&nbsp&nbsp&nbsp&nbsp</span>
                                    <span>{{ auth()->user()->email }}</span>
                                </div>
                                <div class="mb-3">
                                    <span>{{ trans('general.mobile') }}:&nbsp&nbsp</span>
                                    <span>{{ auth()->user()->mobile }}</span>
                                </div>
                                @if (auth()->user()->company)
                                    <div class="mb-3">
                                        <span>{{ trans('general.address') }}:&nbsp&nbsp</span>
                                        <span>{{ auth()->user()->company->address }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span>{{ trans('general.post_code') }}:&nbsp&nbsp</span>
                                        <span>{{ auth()->user()->company->postcode }}</span>
                                    </div>
                                @endif

                                <div class="text-center">
                                    <a href="{{ route('company.account') }}"
                                        class="btn btn-sm btn-genix">{{ trans('general.update', ['type' => '']) }}</a>
                                    <a class="btn btn-sm btn-genix" href="javascript:void(0)"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('general.logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $subscription = request()
                            ->user()
                            ->active_subscription();
                        $is_garage_by_enterprise = is_garage_by_enterprise();
                    @endphp
                    <div class="col-12 col-sm-6 col-md-7 col-lg-8 col-xl-9 mb-3">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="row">
                                    {{-- start old --}}
                                    <div class="col-md-6 col-lg-5 mb-3">
                                        <div
                                            class="card @if ($subscription) bg-{{ $subscription?->package?->name }} @else bg-genix @endif text-white rounded border-0 d-flex h-100">
                                            <div class="card-body text-center">
                                                <h5>{{ trans('general.your_package') }}</h5>
                                                @if ($subscription)
                                                    <h3 class="my-4 text-capitalize">
                                                        {{ $subscription?->package?->name }}
                                                    </h3>
                                                    <h5>{{ trans('general.renewal') }}:
                                                        {{ $subscription?->expired_at->format('d-m-Y') }}
                                                    </h5>
                                                @else
                                                    @if ($is_garage_by_enterprise)
                                                        <h3 class="my-4 text-capitalize">
                                                            {{ individual_package(['name'])->name }}
                                                        </h3>
                                                    @else
                                                        <h3 class="mt-4 mb-5">{{ trans('general.no_subscription') }}</h3>
                                                    @endif
                                                @endif
                                                @if ($subscription)
                                                    <a href="{{ route('company.payment.index', ['package' => 'renewal']) }}"
                                                        class="btn btn-sm btn-outline-dark text-white ">{{ trans('general.renew_now') }}</a>
                                                @else
                                                    {{-- @if (!$is_garage_by_enterprise)
                                                        <a href="{{ route('company.payment.index') }}"
                                                            class="btn btn-sm btn-outline-dark text-white me-1">{{ trans('general.buy_package') }}</a>
                                                    @endif --}}
                                                    @if (!is_enterprise())
                                                        <a href="{{ route('company.payment.index', ['package' => 'renewal']) }}"
                                                            class="btn btn-sm btn-outline-dark text-white  me-1">{{ trans('general.renew_now') }}</a>
                                                    @endif
                                                    <a href="{{ route('company.billing.index') }}"
                                                        class="btn btn-sm btn-outline-dark text-white">{{ trans('general.pay_a_bill') }}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if ($data['subscription'])
                                        <div class="col-md-6 col-lg-5 mb-3">
                                            <div class="card bg-genix text-white rounded border-0 d-flex h-100">
                                                <div class="card-body text-center">
                                                    <h5>{{ trans('general.your_support_tickets') }}</h5>
                                                    <h1 class="my-4">{{ $data['ticket_count'] }}</h1>
                                                    @if ($data['ticket_count'] != 0)
                                                        <a href="{{ route('company.supports.index') }}"
                                                            class="btn btn-sm btn-outline-dark text-white">{{ trans('general.view_tickets') }}</a>
                                                    @else
                                                        <a href="{{ route('company.supports.create') }}"
                                                            class="btn btn-sm btn-outline-dark text-white">{{ trans('general.create_ticket') }}</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- end old --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- package and ticket details end -->
            </div>
        </div>
        @if ($data['subscription'])
            <!-- middle section start -->
            <div class="card mb-2 border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-2 ">
                            <h5>{{ trans('general.shortcuts') }}</h5>
                            <div class="card border">
                                <div class="card-body">
                                    @if (strtolower($data['subscription_name']) === strtolower('Individual garage'))
                                        <a href="http://dashboard.smartgenix.co.uk/"
                                            class="text-decoration-none text-genix d-flex justify-content-between align-items-center mb-2 d-block"
                                            target="_blank">
                                            {{ trans('general.view_bookings') }}
                                            <i class="bi bi-arrow-right-short fs-20"></i>
                                        </a>
                                    @endif
                                    @if (strtolower($data['subscription_name']) === strtolower('recovery'))
                                        <a href="http://recovery.smartgenix.co.uk/"
                                            class="text-decoration-none text-genix d-flex justify-content-between align-items-center mb-2 d-block"
                                            target="_blank">
                                            {{ trans('general.visit_recovery') }}
                                            <i class="bi bi-arrow-right-short fs-20"></i>
                                        </a>
                                    @endif
                                    @if (strtolower($data['subscription_name']) === strtolower('enterprise'))
                                        <a href="http://enterprise.smartgenix.co.uk/"
                                            class="text-decoration-none text-genix d-flex justify-content-between align-items-center mb-2 d-block"
                                            target="_blank">
                                            {{ trans('general.visit_enterprise') }}
                                            <i class="bi bi-arrow-right-short fs-20"></i>
                                        </a>
                                    @endif
                                    <a href="http://users.smartgenix.co.uk/"
                                        class="text-decoration-none text-genix d-flex justify-content-between align-items-center mb-2 d-block"
                                        target="_blank">
                                        {{ trans('general.visit_user') }}
                                        <i class="bi bi-arrow-right-short fs-20"></i>
                                    </a>


                                    @if (auth()->user()->links)
                                        @foreach (auth()->user()->company->links as $link)
                                            <a href="{{ $link['url'] }}"
                                                class="text-decoration-none text-genix d-flex justify-content-between align-items-center mb-2 d-block"
                                                target="_blank">
                                                {{ $link['title'] }}
                                                <i class="bi bi-arrow-right-short fs-20"></i>
                                            </a>
                                        @endforeach
                                        {{-- @else
                                        <span class="text-genix">{{ trans('general.no_shortcuts') }}</span> --}}
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <h5>{{ trans('general.service_notices') }}</h5>
                            <div class="card border">
                                <div class="card-body">
                                    @forelse ($data['service_notices'] as $notice)
                                        <span
                                            class="d-block curser-pointer text-genix d-flex align-items-center justify-content-between"
                                            data-bs-toggle="modal"
                                            data-bs-target="#noticeModal{{ $notice->id }}">{{ $notice->title }} <i
                                                class="bi bi-arrow-right-short fs-20"></i></span>
                                        <small
                                            class="fs-12 d-block text-genix">{{ $notice->created_at->format('d-m-Y h:i A') }}</small>
                                        <!-- Modal -->
                                        <div class="modal fade" id="noticeModal{{ $notice->id }}" tabindex="-1"
                                            aria-labelledby="noticeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        {{-- <h5 class="modal-title m-0 p-0">Service Notice</h5> --}}
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>{{ __($notice->title) }}</h5>
                                                        <p>{{ __($notice->notice) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <span>{{ trans('general.no_message') }}</span>
                                    @endforelse
                                </div>
                            </div>
                            <hr>
                            <h5>{{ trans('general.company_notices') }}</h5>
                            <div class="card border">
                                <div class="card-body">
                                    @forelse ($data['company_notices'] as $news)
                                        <span
                                            class="d-block curser-pointer text-genix d-flex align-items-center justify-content-between"data-bs-toggle="modal"
                                            data-bs-target="#newsModal{{ $news->id }}">{{ __($news->title) }}<i
                                                class="bi bi-arrow-right-short fs-20"></i></span>
                                        <small
                                            class="fs-12 d-block text-genix">{{ $news->created_at->format('d-m-Y h:i A') }}</small>
                                        <!-- Modal -->
                                        <div class="modal fade" id="newsModal{{ $news->id }}" tabindex="-1"
                                            aria-labelledby="newsModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>{{ __($news->title) }}</h5>
                                                        <p>{{ __($news->description) }}</p>
                                                        @if ($news->image)
                                                            <img src="{{ $news->photo }}" alt="{{ $news->title }}"
                                                                class="img-fluid rounded">
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <span>{{ trans('general.no_message') }}</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            {{-- package name and status --}}
                            @if ($data['subscriptions']->count() > 0)
                                <h5>{{ trans('general.your_package') }}</h5>
                                <div class="card border mb-4">
                                    <div class="card-body d-flex justify-content-between p-2">
                                        <h5 class="p-0 m-0 text-genix text-capitalize">{{ $data['subscription_name'] }}
                                        </h5>
                                        <h5
                                            class="p-0 m-0 @if ($data['subscription_status'] === 'Live') text-success animate-charcter @else text-danger @endif">
                                            {{ $data['subscription_status'] }}</h5>
                                    </div>
                                </div>
                                <hr>
                            @endif

                            {{-- package name and status --}}
                            <h5>{{ trans('general.recent_support_tickets') }}</h5>
                            <div class="card border">
                                <div class="card-body">
                                    @forelse ($data['tickets'] as $ticket)
                                        <div class="text-genix text-xs mb-2 border-bottom">
                                            <a href="{{ route('company.supports.show', $ticket) }}"
                                                class="text-decoration-none text-genix text-capitalize">
                                                <span>{{ $ticket->subject }}</span>
                                                <div class="d-flex justify-content-between">
                                                    <span>{{ trans('general.status') }}: {{ $ticket->status }}</span>
                                                    <span class="text-genix">{{ trans('general.last_updated') }}:
                                                        {{ $ticket->updated_at->format('d/m/Y') }}</span>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <span>{{ trans('general.no_support_ticket') }} <a
                                                href="{{ route('company.supports.create') }}"
                                                class="text-genix text-decoration-none">{{ trans('general.create_support_ticket') }}</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- middle section start -->
        @endif


    </div>
@endsection
