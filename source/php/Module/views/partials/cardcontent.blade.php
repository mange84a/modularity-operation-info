@typography(['variant' => 'h4', 'element' => 'h4'])
    {!! $operationinfo->post_title !!}
@endtypography

@typography(['variant' => 'meta', 'element' => 'p', 'classList' => ['u-margin__bottom--1']])
    {{ $operationinfo->startDateFormatted }}
@endtypography        


@typography(['variant' => 'p', 'element' => 'p'])
    {{ $operationinfo->description }}
@endtypography



