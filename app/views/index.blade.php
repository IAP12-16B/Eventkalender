@extends('layouts.page')

@section('page.actions')
    <div class="filter">
        {{ Form::open(array('route' => Route::getCurrentRoute()->getName(), 'class' => 'filter-form forms', 'method' => 'get')) }}
            {{ Form::select('genre', array('' => '-- Please select --') + kije\Genre::lists('name', 'ID'), Input::get('genre')) }}
            {{ Form::button('Filter', array('type' => 'submit', 'class' => 'btn btn-red')) }}
        {{ Form::close() }}
    </div>
@endsection


@section('page.content')
    <?php $last_date = Carbon\Carbon::createFromTimestamp(0);  ?>
    @forelse($shows as $show)
        <?php $datetime = Carbon\Carbon::createFromFormat('Y-m-d H:i:s+|', $show->datum.' '.$show->zeit); ?>
        @if(!$last_date->isSameDay($datetime))
            <div class="list-container">
                <h2> {{ $datetime->format('d. F Y') }}</h2>
                <ol class="shows-list clearfix">
        @endif
                    <li class="clearfix">
                        <div class="show-image">
                            @if(!empty($show->event->bild))
                                <img
                                    src="{{ url($show->event->bild) }}"
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
                            </div>
                            <p>
                                {{ $show->event->beschreibung }}
                            </p>
                            <a class="detail-link" href="{{ action('show.show', array('id' => $show->ID)) }}">
                                Detail
                            </a>
                        </div>
                    </li>
        @if(!$last_date->isSameDay($datetime))
                </ol>
            </div>
        @endif
        <?php $last_date = $datetime; ?>
    @empty
        <p class="message">
            There are currently no events!
        </p>
    @endforelse

    <?php echo $shows->links(); ?>
@endsection