@accordion([])
    @if($showActive)
        @accordion__item([
            'heading' => $activeLabel
        ])
            @collection([])
                @foreach($activeOperations as $operationinfo)
                    @collection__item([
                        'link' => '{{ $operationinfo->link }}',
                        'icon' => 'warning'
                    ])
                        @typography(['element' => 'h4'])
                            {!! $operationinfo->post_title !!}
                        @endtypography
                                
                        @typography(['variant' => 'meta', 'element' => 'p'])
                            {{ $operationinfo->startDateFormatted }}
                        @endtypography
                    @endcollection__item
                @endforeach
            @endcollection
        @endaccordion__item
    @endif
    @if($showPlaned)
        @accordion__item([
            'heading' => $planedLabel
        ])
            @collection([])
                @foreach($planedOperations as $operationinfo)
                    @collection__item([
                        'link' => '{{ $operationinfo->link }}',
                        'icon' => 'warning'
                    ])
                        @typography(['element' => 'h4'])
                            {!! $operationinfo->post_title !!}
                        @endtypography
                                
                        @typography(['variant' => 'meta', 'element' => 'p'])
                            {{ $operationinfo->startDateFormatted }}
                        @endtypography
                    @endcollection__item
                @endforeach
            @endcollection
        @endaccordion__item
    @endif
@endaccordion
