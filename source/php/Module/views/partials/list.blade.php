<div class="operation-information" role="tablist" js-expand-container>
    <div class="c-tabs__header">
        @if($showActive)
            <button role="tab" class="c-tabs__button" aria-controls="active_panel" aria-expanded="true" js-expand-button>
                <span class="c-tabs__button-wrapper" tabindex="-1">
                    {{$activeLabel}} <span class="c-tag c-tag--default">{{$totalActiveOperations}}</span>
                </span>
            </button>
        @endif
        @if($showPlaned)
            <button role="tab" class="c-tabs__button" aria-controls="planed_panel" aria-expanded="false" js-expand-button>
                <span class="c-tabs__button-wrapper" tabindex="-1">
                    {{$planedLabel}} <span class="c-tag c-tag--default">{{$totalPlanedOperations}}</span>
 
                </span>
            </button>
        @endif
        @if($showFinished)
            <button role="tab" class="c-tabs__button" aria-controls="finished_panel" aria-expanded="false" js-expand-button>
                <span class="c-tabs__button-wrapper" tabindex="-1">
                    {{$finishedLabel}} <span class="c-tag c-tag--default">{{$totalFinishedOperations}}</span>

                </span>
            </button>
        @endif
    </div>
    @if($showActive)
        <div class="c-tabs__content" role="tabpanel" id="active_panel" aria-hidden="false">
            @if($totalActiveOperations != 0)
                @collection([])
                    @foreach($activeOperations as $operationinfo)
                        @collection__item([
                            'link' => $operationinfo->link,
                            'icon' => 'warning_amber',
                            'classList' => ['u-margin__bottom--1']
                        ])
                        
                            @include('partials.cardcontent')
                        @endcollection__item
                    @endforeach
                @endcollection
            @else
                @typography(['variant' => 'meta', 'element' => 'p', 'classList' => ['u-margin--0 no-operations-text']])
                    {{ $lang->noActive }}
                @endtypography
            @endif
        </div>
    @endif
    @if($showPlaned) 
        <div class="c-tabs__content" role="tabpanel" id="planed_panel" aria-hidden="true">
            @if($totalPlanedOperations != 0)
                @collection([])
                    @foreach($planedOperations as $operationinfo)
                        @collection__item([
                            'link' => $operationinfo->link,
                            'icon' => 'schedule',
                            'classList' => ['u-margin__bottom--1']

                        ])
                            @include('partials.cardcontent')
                                    
                        @endcollection__item
                    @endforeach
                @endcollection
            @else
                @typography(['variant' => 'meta', 'element' => 'p', 'classList' => ['u-margin--0 no-operations-text']])
                    {{ $lang->noPlaned }}
                @endtypography
            @endif
        </div>
    @endif
    @if($showFinished) 
        <div class="c-tabs__content" role="tabpanel" id="finished_panel" aria-hidden="true">
            @if($totalFinishedOperations != 0)
                @collection([])
                    @foreach($finishedOperations as $operationinfo)
                        @collection__item([
                            'link' => $operationinfo->link,
                            'icon' => 'check_circle_outline',
                            'classList' => ['u-margin__bottom--1']
                        ])
                            @include('partials.cardcontent')
                        
                        @endcollection__item
                    @endforeach
                @endcollection
            @else
                @typography(['variant' => 'meta', 'element' => 'p', 'classList' => ['u-margin--0 no-operations-text']])
                    {{ $lang->noFinished }}
                @endtypography
            @endif
        </div>
    @endif
</div>
