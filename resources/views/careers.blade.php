@extends('layouts.website')
@section('content')

    <!-- Hero Section start -->
    <section class="bg-genix p-5 text-white" id="session" data-success="{{ session('success') }}"
        data-error="{{ session('error') }}">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-8 mb-3 mb-md-0">
                    <p class="fs-5">{{ trans('general.part_of_family') }}</p>
                    <p class="fs-5">{{ trans('general.job_count', ['count' => $latests->count()]) }}</p>
                    @if (count($latests) > 0)
                        <h3>{{ trans('general.most_recent_jobs') }}</h3>
                        <div class="row mt-3">
                            @foreach ($latests as $latest)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body text-genix">
                                            {{-- <div data-bs-toggle="modal" data-bs-target="#confirmModal{{ $latest->id }}"
                                                onclick="jobSelect({{ $latest->id }})"> --}}
                                            <h4>{{ $latest->name }}</h4>
                                            @if ($latest->salary && $latest->salary_show)
                                                <span class="d-block fs-5">{{ trans('general.salary') }}:
                                                    {{ setting('currency_symbol') }}{{ $latest->salary }}</span>
                                            @endif
                                            <span class="text-capitalize d-block">{{ trans('general.type') }}:
                                                {{ str_replace('_', ' ', $latest->type) }}</span>
                                            <span class="text-capitalize d-block">{{ trans('general.length') }}:
                                                {{ $latest->length }}</span>
                                            <span class="text-capitalize d-block">{{ trans('general.qualification') }}:
                                                {{ $latest->qualifications }}</span>
                                            <span class="text-capitalize d-block">{{ trans('general.closing_date') }}:
                                                {{ $latest->closing_date->format('d/m/Y') }}</span>
                                            <div id="des{{ $latest->id }}{{ $latest->id }}" class="d-none">
                                                <span class="fw-semibold">{{ trans('general.typical_days') }}:
                                                    {{ $latest->typical_day }}</span>
                                                <span class="fw-semibold">{{ trans('general.working_days') }}:
                                                    {{ $latest->working_days }}</span>
                                                <span class="fw-semibold">{{ trans('general.working_hours') }}:
                                                    {{ $latest->working_hours }}</span>
                                            </div>
                                            {{-- </div> --}}
                                            <div class="d-flex justify-content-between mt-2">
                                                <span
                                                    class="text-muted">{{ $latest->release_date->diffForHumans() }}</span>
                                                <span class="text-decoration-underline text-genix curser-pointer"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmModal{{ $latest->id }}"
                                                    onclick="jobSelect({{ $latest->id }})">{{ trans('general.more') }}...</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Job Confirm Modal -->
                                <div class="modal fade" id="confirmModal{{ $latest->id }}" tabindex="-1"
                                    aria-labelledby="confirmModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="text-genix">{{ $latest->name }}</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-genix">
                                                @if ($latest->salary_show)
                                                    <p class="fw-semibold">{{ trans('general.salary') }}:
                                                        {{ setting('currency_symbol') }}{{ $latest->salary }}</p>
                                                @endif
                                                <p class="fw-semibold text-capitalize">{{ trans('general.job_type') }}:
                                                    {{ str_replace('_', ' ', $latest->type) }}</p>
                                                <p class="fw-semibold text-capitalize">{{ trans('general.job_length') }}:
                                                    {{ $latest->length }}
                                                </p>
                                                <p class="fw-semibold">{{ trans('general.working_days') }}:
                                                    {{ $latest->working_days }}</p>
                                                <p class="fw-semibold">{{ trans('general.working_hours') }}:
                                                    {{ $latest->working_hours }}</p>
                                                <p class="fw-semibold">{{ trans('general.qualification') }}:
                                                    {{ $latest->qualifications }}</p>
                                                <span class="fw-semibold d-block">{{ trans('general.job_description') }}:
                                                </span>
                                                <p>{{ $latest->description }}</p>
                                                <span class="fw-semibold d-block">{{ trans('general.about_smartgenix') }}:
                                                </span>
                                                <p>{{ $latest->about_company }}</p>
                                                <p class="fw-semibold">{{ trans('general.typical_days') }}:</p>
                                                <ul class="ms-3">
                                                    @foreach (explode(',', $latest->typical_day) as $item)
                                                        <li>{{ $item }}</li>
                                                    @endforeach
                                                </ul>
                                                <p class="fw-semibold">{{ trans('general.responsibilities') }}:
                                                </p>
                                                <ul class="ms-3">
                                                    @foreach ($latest->roles as $item)
                                                        <li>{{ $item }}</li>
                                                    @endforeach
                                                </ul>
                                                <button data-bs-toggle="modal" data-bs-target="#applyModal"
                                                    class="btn btn-sm btn-genix float-end">{{ trans('general.apply_job') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Job Confirm Modal end -->
                            @endforeach
                        </div>
                    @else
                        <button class="btn btn-sm btn-primary text-sm" data-bs-toggle="modal"
                            data-bs-target="#CVModal">{{ trans('general.send_cv') }}</button>
                        <div class="modal fade text-genix" id="CVModal" tabindex="-1" aria-labelledby="CVModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-genix" id="CVModalLabel">
                                            {{ trans('general.send_cv') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('careers.cv') }}" method="POST"
                                            enctype="multipart/form-data" onsubmit="uploadCV()">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="message-text"
                                                    class="col-form-label">{{ trans('general.information') }}:</label>
                                                <textarea name="information" class="form-control" id="message-text" required
                                                    placeholder="{{ trans('general.tell_yourself') }}"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="cv"
                                                    class="col-form-label">{{ trans('general.upload_cv') }}:</label>
                                                <input type="file" class="form-control" id="cv" name="file"
                                                    required>
                                            </div>
                                            <button type="submit" class="btn btn-genix"
                                                id="submitBtn">{{ trans('general.upload', ['type' => '']) }}</button>
                                            <button class="btn btn-genix d-none" type="button" disabled id="waitBtn">
                                                <span class="spinner-border spinner-border-sm" role="status"
                                                    aria-hidden="true"></span>
                                                {{ trans('general.please_wait') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
                <div class="col-md-4">
                    <h3>{{ trans('general.benefits_working') }} {{ setting('app_name') }}</h3>
                    <ul>
                        @foreach (explode(',', setting('career_benefits')) as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section end -->

    <!-- jobs start -->
    <section class="bg-white p-5">
        <div class="container">
            <div class="row justify-content-center">
                @include('partials.errors')
                @livewire('careers')
            </div>
        </div>
    </section>
    <!-- jobs end -->

    <!-- Job Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applyModalLabel">{{ trans('general.job_title') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('careers.apply') }}" method="POST" enctype="multipart/form-data"
                        onsubmit="uploadCV()">
                        @csrf
                        <input id="jobId" type="hidden" name="career_id">
                        <div class="form-group mb-2">
                            <label for="name">{{ trans('general.name') }}</label>
                            <input id="name" class="form-control" type="text" name="name"
                                placeholder="{{ trans('general.name') }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">{{ trans('general.email_address') }}</label>
                            <input id="email" class="form-control" type="email" name="email"
                                placeholder="{{ trans('general.email_address') }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="phone">{{ trans('general.mobile_number') }}</label>
                            <input id="phone" class="form-control" type="phone" name="mobile"
                                placeholder="{{ trans('general.mobile_number') }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="resume">{{ trans('general.upload_cv') }}</label>
                            <input id="resume" class="form-control" type="file" name="resume" required>
                        </div>
                        <button class="btn btn-genix" id="submitBtn">{{ trans('general.apply') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        function jobSelect(id) {
            document.getElementById('jobId').value = id;
        }

        function uploadCV() {
            document.getElementById("submitBtn").classList.add("d-none");
            document.getElementById("waitBtn").classList.remove("d-none");
            // document.getElementById("submitBtn").disabled = true;
        }

        // view more
        function viewMore(id) {
            let button = document.getElementById(`button${id}`);
            if (button.innerHTML === "{{ trans('general.less') }}...") {
                button.innerHTML = "{{ trans('general.less') }}"
            } else {
                button.innerHTML = "{{ trans('general.less') }}..."
            }
            document.getElementById(`des${id}`).classList.toggle("collapse")
        }
    </script>
@endpush
