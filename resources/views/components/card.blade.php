<div class="card mb-3">
    <div class="card-header d-flex flex-row align-items-center">
        <h5 class="flex-grow-1 m-0">
            {{ $title }}
        </h5>
        @isset($actions)
            <div>
                {{ $actions }}
            </div>
        @endisset
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
</div>