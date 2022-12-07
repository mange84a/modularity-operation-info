@card([
    'heading' => $postTitle,
    'classList' => [$classes],
    'context' => 'module.operationinfo.list'
])
    @if (!$hideTitle && !empty($postTitle))
        <div class="c-card__header">
            @typography([
                'element' => "h4"
            ])
                {!! $postTitle !!}
            @endtypography
        </div>
    @endif

    @include('partials.list')

@endcard
