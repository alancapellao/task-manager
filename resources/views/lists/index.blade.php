@extends('layouts.app')

@props(['title' => $list->name, 'id' => $list->id])

@section('content')
<x-kanban :tasks="$tasks" />
@endsection