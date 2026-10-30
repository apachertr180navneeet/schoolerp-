<x-app-layout>
    <x-slot name="header">
        <h5 class="mb-0 fw-semibold">
            {{ __('Dashboard') }}
        </h5>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <x-jet-welcome />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
