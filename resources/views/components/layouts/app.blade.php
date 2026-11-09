@props(['title' => null, 'mode' => null])

@include('layouts.portal', [
    'title' => $title,
    'mode' => $mode,
    'slot' => $slot,
    'scripts' => $scripts ?? null,
    'styles' => $styles ?? null,
])
