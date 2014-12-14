@extends('layouts.page')

@section('page.content')
    <?php $last_date = Carbon\Carbon::createFromTimestamp(0);  ?>
    @forelse($shows as $show)
        @if(!$last_date->isSameDay($show->datum))
            <div class="list-container">
                <h2> {{ $show->datum->format('d. F Y') }}</h2>
                <ol class="shows-list clearfix">
        @endif
                    <li class="clearfix">
                        <div class="show-image">
                            @if(!empty($show->event->bild))
                                <img
                                    src="{{ $show->event->bild }}"
                                    alt="{{ $show->event->bildbeschreibung }}"
                                    title="{{ $show->event->bildbeschreibung }}"
                                >
                            @endif
                        </div>
                        <div class="show-info">
                            <h4>{{ $show->event->name }}</h4>
                            <div class="show-data">
                                <time class="show-time">
                                    {{ $show->datum }}, at {{ $show->zeit }}
                                </time>
                                <p>
                                    {{ $show->event->beschreibung }}
                                </p>
                                <a class="detail-link" href="{{ action('show.show', array('id' => $show->ID)) }}">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </li>
        @if(!$last_date->isSameDay($show->datum))
                </ol>
            </div>
        @endif
        <?php $last_date = $show->datum; ?>
    @empty
        <p class="message">
            There are currently no events!
        </p>
    @endforelse
@endsection