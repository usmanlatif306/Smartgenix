<!-- Modal -->
<div class="modal fade" id="enterpriseModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="enterpriseLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="enterpriseLabel">{{ trans('general.tell_about') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('package.quote') }}" method="POST">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="name">{{ trans('general.first_name') }}</label>
                        <input class="form-control" type="text" name="first_name"
                            placeholder="{{ trans('general.first_name') }}" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="name">{{ trans('general.last_name') }}</label>
                        <input class="form-control" type="text" name="last_name"
                            placeholder="{{ trans('general.last_name') }}" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="email">{{ trans('general.email_address') }}</label>
                        <input class="form-control" type="email" name="email"
                            placeholder="{{ trans('general.email_address') }}" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="mobile">{{ trans('general.mobile_number') }}</label>
                        <input class="form-control" type="tel" name="mobile"
                            placeholder="{{ trans('general.mobile_number') }}" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="role">{{ trans('general.your_role') }}</label>
                        <input class="form-control" type="text" name="role"
                            placeholder="{{ trans('general.your_role') }}" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="role">{{ trans('general.number_of_garages') }}</label>
                        <input class="form-control" type="number" name="garages" placeholder="Number of Garages"
                            required>
                    </div>

                    <div class="text-center mt-3">
                        <button class="btn btn-genix">{{ trans('general.send_details') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
