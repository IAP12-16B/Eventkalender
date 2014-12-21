@extends('layouts.page')

@section('page.content')
    <div class="show-detail">
       <div class="show-info">
           <h2>{{ $show->event->name }}</h2>
           <p>
              {{ $show->event->beschreibung }}
          </p>
          <div class="lightbox-images">
            <a href="{{ url($show->event->bild) }}">
                <figure>
                    <img src="{{ url($show->event->bild) }}" width="100" alt="{{ $show->event->bildbeschreibung }}" title="{{ $show->event->bildbeschreibung }}">
                    <figcaption>{{ $show->event->bildbeschreibung }}</figcaption>
                </figure>
            </a>
          </div>
          <div class="width-35">
                     <table class="table-bordered data-table">
                          <thead>
                              <tr>
                                  <th colspan="2">Inforamtions</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>Date</td>
                                  <td>{{ $show->datum }}</td>
                              </tr>
                              <tr>
                                  <td>Time</td>
                                  <td>{{ $show->zeit }}</td>
                              </tr>
                              <tr>
                                  <td>Genre</td>
                                  <td>{{ $show->event->genre->name }}</td>
                              </tr>
                              <tr>
                                <td>Line-up</td>
                                <td>{{ $show->event->besetzung }}</td>
                              </tr>
                              <tr>
                                  <td>Pricegroups</td>
                                  <td>
                                      <ul class="forms-list">
                                          @foreach($show->event->pricegroups as $pricegroup)
                                              <li>{{ $pricegroup->name }} ({{ formatCurrency($pricegroup->preis) }} CHF)</li>
                                          @endforeach
                                      </ul>
                                  </td>
                              </tr>
                          </tbody>
                     </table>
                     </div>
                     @if(!$show->event->links->isEmpty())
                     <div class="links">
                     <ul>
                     @foreach($show->event->links as $link)
                        <li><a href="{{ $link->link }}">{{ $link->name or $link->link }}</a></li>
                     @endforeach
                     </ul>

                     </div>
                     @endif
       </div>
    </div>
@endsection