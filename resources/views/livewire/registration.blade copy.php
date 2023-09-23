<div class="form-group mb-3">
    <label for="packages">Package</label>
    <div class="mt-2">
        @foreach ($packages as $item)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="package" id="{{ $item->name }}"
                    value="{{ $item->id }}" wire:model="package">
                <label class="form-check-label" for="{{ $item->name }}">{{ $item->name }}</label>
            </div>
        @endforeach
        {{-- package details --}}
        <div class="text-center mt-3">
            <span class="d-block fw-semibold text-genix">Payment Amount:
                {{ setting('currency_symbol') }}{{ $selected->price }}</span>
            <span class="d-block fw-semibold text-genix">Setup Fee:
                {{ setting('currency_symbol') }}{{ $selected->setup_fee }}</span>
            <span id="totalPrice" class="d-block fw-semibold text-genix"
                data-price="{{ $selected->price + $selected->setup_fee }}">Total Amount:
                {{ setting('currency_symbol') }}{{ $selected->price + $selected->setup_fee }}</span>
        </div>
    </div>

</div>

{{-- <script>
    let price = document.getElementById('totalPrice').dataset.price;
    document.getElementById("submitForm").dataset.amount = price;

    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('element.updated', (el, component) => {
            let price = document.getElementById('totalPrice').dataset.price;
            document.getElementById("submitForm").dataset.amount = price;
        });
    });
</script> --}}
