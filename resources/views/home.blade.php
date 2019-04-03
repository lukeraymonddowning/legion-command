@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @card()
                @slot('title')
                    {{__("Your armies")}}
                @endslot

                @isset($armies)
                    @slot('actions')
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                    id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{__("Create an army")}}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @isset($factions)
                                    @foreach($factions as $faction)
                                        <a class="dropdown-item"
                                           href="{{ route('edit-army', ['faction_id' => $faction->id, 'army_id' => null]) }}">{{__($faction->name)}}</a>
                                    @endforeach
                                @endisset
                            </div>
                        </div>
                    @endslot
                @endisset

                @if (empty($armies))
                    <div class="d-flex flex-column align-items-center">
                        <p class="lead text-center">Looks like you haven't created any armies yet</p>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                    id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{__("Create an army")}}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @isset($factions)
                                    @foreach($factions as $faction)
                                        <a class="dropdown-item"
                                           href="{{ route('edit-army', ['faction_id' => $faction->id, 'army_id' => null]) }}">{{__($faction->name)}}</a>
                                    @endforeach
                                @endisset
                            </div>
                        </div>
                    </div>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($armies as $army)
                            <li class="list-group-item">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="flex-grow-1 mr-3">
                                        <b><span class="h5">{{ empty($army->name) ? __("Nameless army") : $army->name }}</span></b>
                                        <br>
                                        <span><army-points-cost v-bind:army-id="{{ $army->id }}"></army-points-cost> points</span>
                                        <br>
                                        <span><i>{{ $army->faction->name }}</i></span>
                                        <br>
                                        <span>{{ substr($army->description, 0, 60) }}</span>
                                    </div>
                                    <div class="">
                                        <a href="{{ route('edit-army', ['army_id' => $army->id, 'faction_id' => $army->faction->id]) }}">
                                            <button class="btn btn-outline-primary">Edit army</button>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif

                @endcard
            </div>
            <div class="col-md-6">
                @card()
                @slot('title')
                    {{__("Your inventory")}}
                @endslot

                @slot('actions')
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{__("Edit inventory")}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('edit-inventory') }}">{{__("All factions")}}</a>
                            @isset($factions)
                                @foreach($factions as $faction)
                                    <a class="dropdown-item"
                                       href="{{ route('edit-inventory', ['faction_id' => $faction->id]) }}">{{__($faction->name)}}</a>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                @endslot

                <inventory-list-component v-bind:show-actions="false"></inventory-list-component>

                @endcard
            </div>
        </div>
    </div>
@endsection
