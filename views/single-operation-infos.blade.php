@extends('templates.single')

@section('article.title.after')

@if($status == 'live')
    @notice([
        'type' => 'warning',
        'message' => [
            'text' => 'Pågående',
            'size' => 'sm'
        ],
        'icon' => [
            'name' => 'warning',
            'size' => 'md',
            'color' => 'white'
        ]
    ])
    @endnotice
    <p class="u-color__bg--default u-padding__x--2 u-padding__y--1">{{ $operation['operation_start'] }} - pågår...</p> 
@elseif($status == 'planned')
    @notice([
        'type' => 'info',
        'message' => [
            'text' => 'Planerad',
            'size' => 'sm'
        ],
        'icon' => [
            'name' => 'info',
            'size' => 'md',
            'color' => 'white'
        ]
    ])
    @endnotice
    
    <p class="u-color__bg--default u-padding__x--2 u-padding__y--1">Planerad: {{ $operation['operation_start'] }} - {{ $operation['operation_end'] }}</p> 

@else
    @notice([
        'type' => 'success',
        'message' => [
            'text' => 'Avslutad',
            'size' => 'sm'
        ],
        'icon' => [
            'name' => 'check',
            'size' => 'md',
            'color' => 'white'
        ]
    ])
    @endnotice
    <p class="u-color__bg--default u-padding__x--2 u-padding__y--1">Avslutad: {{ $operation['operation_start'] }} - {{ $operation['operation_end'] }}</p> 
@endif
@stop
