@extends('layouts.app')

@section('content')

    <form method="post" action="{{ route('save-army', ['army_id' => $army->id, 'faction_id' => $faction->id]) }}">
        @csrf
        <div class="container">

            <div class="mb-5">
                <label for="army_name">{{ __("Name") }}</label>
                <div class="d-flex flex-row align-items-center mb-3">
                    <div class="form-group flex-grow-1 mr-3 mb-0">
                        <input type="text" class="form-control" id="army_name" name="name"
                               value="{{ $army->name }}">
                    </div>
                    <div>
                        <button type="submit" name="save_army" value="true"
                                class="btn btn-success">{{__("Save")}}</button>
                        <button type="submit" name="save_army_exit" value="true"
                                class="btn btn-success">{{__("Save and exit")}}</button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="army_description">{{ __("Description") }}</label>
                    <textarea class="form-control" id="army_description" name="description"
                              rows="3">{{ $army->description }}</textarea>
                </div>
                <label for="points_limit">Army size</label>
                <select id="points_limit" name="points_limit" class="custom-select">
                    @foreach([800 => 'Standard', 1600 => 'Grand army', 1200 => '2v2', 600 => 'Small', 500 => 'Extra small'] as $value => $name)
                        <option value="{{ $value }}" @if ($army->points_limit === $value) {{ "selected" }} @endif>{{ $name }} ({{ $value }})</option>
                    @endforeach
                </select>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    @card()
                    @slot('title')
                        {{__("Available units")}}
                    @endslot

                    <inventory-list-component v-bind:type="'army'"
                                              v-bind:army-id="{{ $army->id }}"
                                              v-bind:factions="{{ json_encode([$faction], JSON_FORCE_OBJECT) }}"></inventory-list-component>

                    @endcard
                </div>

                <div class="col-md-6">
                    @card()
                    @slot('title')
                        {{__("Selected units")}}
                    @endslot

                    <army-list-component v-bind:faction="{{ json_encode($faction) }}"
                                         v-bind:army-id="{{ $army->id }}"
                    ></army-list-component>

                    @endcard
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-danger" name="delete_army" value="true">Delete this army</button>
            </div>
        </div>
    </form>

@endsection