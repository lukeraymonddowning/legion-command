@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @card()
                @slot('title')
                    {{__("Available units")}}
                @endslot

                <div class="row">
                    @forelse ($factions as $faction)
                        @unless(count($faction->units) == 0)
                            <div class="col-12 border-bottom pb-2 mb-3 mt-3 mt-lg-0">
                                <h5 class="m-0 font-weight-bold text-center">
                                    {{ $faction->name }}
                                </h5>
                            </div>
                        @endunless
                        @foreach ($faction->unitsOrdered() as $unit)
                            <div class="col-12 col-xl-4 col-md-6 mb-4 d-flex flex-column flex-md-column-reverse">
                                <div class="d-flex flex-row flex-md-column-reverse align-items-center mt-md-3">
                                    <span class="flex-grow-1 mt-md-2 d-lg-none">{{ $unit->name }}</span>
                                    <add-to-inventory-button v-bind:unit-id="{{ $unit->id }}"></add-to-inventory-button>
                                </div>
                                <img class="img-fluid mt-2 w-100" src="{{ $unit->unit_card_image_asset_url }}" alt="{{ __("Unit card for") }} {{ $unit->name }}">
                            </div>
                        @endforeach
                    @empty
                        <li class="list-group-item">
                            <div class="d-flex flex-column align-items-center">
                                <div class="alert alert-warning">
                                    Something went wrong. Try again later
                                </div>
                                <a href="{{ route('home') }}">
                                    <button class="btn btn-outline-primary">Return to dashboard</button>
                                </a>
                            </div>
                        </li>
                    @endforelse
                </div>

                @endcard
            </div>
            <div class="col-md-6">
                @card()
                @slot('title')
                    {{__("Your inventory")}}
                @endslot

                <inventory-list-component v-bind:factions="{{ json_encode($factions, JSON_FORCE_OBJECT) }}"></inventory-list-component>

                @endcard
            </div>
        </div>
    </div>

@endsection