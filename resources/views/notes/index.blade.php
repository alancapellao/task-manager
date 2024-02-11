@extends('layouts.app')

@props(['title' => __('pagination.sticky_notes'), 'id' => null])

@section('content')
<div class="wall">

        @foreach (array_slice($notes, 0, 6) as $note)
        <div class="note" data-note-id="{{ $note['id'] }}">
                <div class="note-header">
                        {{ $note['title'] }}
                </div>
                <div class="note-body">
                        {!! $note['content'] !!}
                </div>
        </div>
        @endforeach

        @if (count($notes) < 6) 
        <div class="note note-add" id="note-add">
                <i class="icon-add"></i>
        </div>
        @endif
</div>

<script src="{{ asset('js/pages/notes.js') }}"></script>
@endsection