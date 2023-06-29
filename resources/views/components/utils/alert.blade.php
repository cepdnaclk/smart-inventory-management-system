@props(['dismissable' => true, 'type' => 'success', 'ariaLabel' => __('Close')])

<div {{ $attributes->merge(['class' => 'alert alert-' . $type]) }} role="alert">
    <div class="row">
        <div class="col">{{ $slot }}</div>
        @if ($dismissable)
            <div class="col-1">
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>
