@extends('layouts.app')

@props(['title' => $title, 'id' => null])

@section('content')
<x-kanban :tasks="$tasks" />
@endsection