<div class="col-md-8 text-center">
    <ul class="nav d-flex justify-content-center">
        @foreach ($tabs as $tab)
            <li class="nav-item @if ($selected === $tab) border-bottom-genix @endif"
                wire:click="changeTab('{{ $tab }}')">
                <span
                    class="curser-pointer nav-link text-uppercase @if ($selected === $tab) text-genix @endif">{{ trans('general.' . $tab) }}</span>
            </li>
        @endforeach
    </ul>
    <div class="mt-5">
        <div class="row">
            @forelse ($jobs as $job)
                <div class="col-md-4 mb-3">
                    <div class="card"> {{-- d-flex h-100 --}}
                        <div class="card-body text-genix">
                            {{-- <div data-bs-toggle="modal" data-bs-target="#confirmModal{{ $job->id }}"
                                onclick="jobSelect({{ $job->id }})"> --}}
                            <h4>{{ $job->name }}</h4>
                            @if ($job->salary && $job->salary_show)
                                <span class="d-block fs-5">{{ trans('general.salary') }}:
                                    {{ setting('currency_symbol') }}{{ $job->salary }}</span>
                            @endif

                            <span class="d-block">{{ trans('general.working_days') }}:
                                &nbsp&nbsp&nbsp{{ $job->working_days }}</span>
                            <span class=" d-block">{{ trans('general.working_hours') }}:
                                &nbsp{{ $job->working_hours }}</span>
                            <span class=" text-capitalize d-block">{{ trans('general.closing_date') }}:
                                {{ $job->closing_date->format('d/m/Y') }}</span>
                            <ul id="des{{ $job->id }}" class="collapse">
                                @foreach ($job->roles as $req)
                                    <li>{{ $req }}</li>
                                @endforeach
                            </ul>
                            {{-- </div> --}}
                            <div class="d-flex justify-content-between mt-2">
                                <span class="text-muted">{{ $job->release_date->diffForHumans() }}</span>
                                <span class="text-decoration-underline text-genix curser-pointer" data-bs-toggle="modal"
                                    data-bs-target="#confirmModal{{ $job->id }}"
                                    onclick="jobSelect({{ $job->id }})">{{ trans('general.more') }}...</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Job Confirm Modal -->
                <div class="modal fade" id="confirmModal{{ $job->id }}" tabindex="-1"
                    aria-labelledby="confirmModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="text-genix">{{ $job->name }}</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-genix">
                                @if ($job->salary_show)
                                    <p class="fw-semibold">{{ trans('general.salary') }}:
                                        {{ setting('currency_symbol') }}{{ $job->salary }}</p>
                                @endif
                                <p class="fw-semibold text-capitalize">{{ trans('general.job_type') }}:
                                    {{ str_replace('_', ' ', $job->type) }}</p>
                                <p class="fw-semibold text-capitalize">{{ trans('general.job_length') }}:
                                    {{ $job->length }}</p>
                                <p class="fw-semibold">{{ trans('general.working_days') }}: {{ $job->working_days }}
                                </p>
                                <p class="fw-semibold">{{ trans('general.working_hours') }}: {{ $job->working_hours }}
                                </p>
                                <p class="fw-semibold">{{ $job->typical_day }}</p>
                                <p class="fw-semibold">{{ trans('general.qualification') }}:
                                    {{ $job->qualifications }}</p>
                                <span class="fw-semibold d-block">{{ trans('general.job_description') }}: </span>
                                <p>{{ $job->description }}</p>
                                <span class="fw-semibold d-block">{{ trans('general.about_smartgenix') }}: </span>
                                <p>{{ $job->about_company }}</p>
                                <p class="fw-semibold">{{ trans('general.typical_days') }}:</p>
                                <ul class="ms-3">
                                    @foreach (explode(',', $job->typical_day) as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                                <p class="fw-semibold">{{ trans('general.responsibilities') }}:</p>
                                <ul class="ms-3">
                                    @foreach ($job->roles as $item)
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
            @empty
                <div class="col-md-12">
                    <h5 class="mx-4">{{ trans('general.no_job') }}</h5>
                </div>
            @endforelse
        </div>
    </div>
</div>
