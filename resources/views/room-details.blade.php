@extends('layout')

<!DOCTYPE html>
<html lang="en">

<head>
    @section('head')
        @parent
    @endsection
</head>

<body>
    @section('topbar')
        @parent
    @endsection

    @section('topbarback')
        @parent
    @endsection

    @section('content')
        <header class="header">
            <p class="subtitle header__text__description">THE ULTIMATE LUXURY EXPERIENCE</p>
            <p class="title header__text__title">Ultimate Room</p>
            <div class="header__links">
                <a href="{{ url('/') }}">Home</a>
                <span>|</span>
                <a class="topbar__nav__anchor__a" href="{{ url('/rooms') }}">Rooms</a>
            </div>
        </header>

        <section class="room-details">
            <div class="room-details__container">
                <div class="room-details__properties__container">
                    <div class="room-details__properties">
                        <div class="room-details__properties__text">
                            <p class="subtitle">{{ $room->typeroom }}</p>
                            <p class="title room-details__properties__text__title">Luxury {{ $room->typeroom }}</p>
                        </div>
                        <div class="room-details__properties__price">
                            <p class="room-details__properties__price">${{ $room->price / 100 }}<span
                                    class="room-details__properties__price__night">/Night</span>
                            </p>
                        </div>
                    </div>
                    <div class="room-details__image__container">
                        <img class="room-details__image" src="{{ $room->photo }}">
                    </div>
                </div>

                <form class="room-details__availability" action="{{ url('/rooms/' . $room->idroom) }}" method="POST">
                    @csrf
                    <p class="room-details__availability__title">Check Availability</p>
                    <p class="room-details__availability__text">Check In</p>
                    <input class="input input__date--filled" type="date" name="checkin">
                    <p class="room-details__availability__text">Check Out</p>
                    <input class="input input__date--filled" type="date" name="checkout">
                    <input type="submit" class="button button-golden" value="CHECK AVAILABILITY"></button>

                    @if ($available)
                        @if ($available == 1)
                            <p class="room-details__availability__title room-details__availability__available">Room
                                available</p>
                        @else
                            <p class="room-details__availability__title room-details__availability__booked">Room booked</p>
                        @endif
                    @endif

                </form>
            </div>
            <p class="text-roboto text-roboto--grey room-details__text">
                {{ $room->cancellation }}
            </p>
        </section>

        @if ($room->amenities != '')
            <section class="room-amenities">
                <p class="title room-amenities__title">Amenities</p>
                <hr>
                <div class="room-amenities__services">
                    @foreach (explode(',', $room->amenities) as $amenitie)
                        @if ($amenitie)
                            <div class="room-amenities__service">
                                <img class="room-amenities__service__image"
                                    src="{{ asset('assets/bladeicons/' . str_replace(' ', '', strtolower($amenitie)) . '.svg') }}">
                                <p class="room-amenities__service__text">{{ $amenitie }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </section>
        @endif

        <section class="room-founder">
            <div class="room-founder__card">
                <div class="room-founder__card__image__container">
                    <img class="room-founder__card__image" src="{{ asset('assets/images/founder.png') }}">
                    <div class="room-founder__card__verification__container">
                        <div class="room-founder__card__verification">
                            <img class="room-founder__card__icon" src="{{ asset('assets/icons/checkmark.svg') }}">
                        </div>
                    </div>
                </div>
                <p class="title room-founder__card__name">J.F. Álvarez</p>
                <p class="subtitle room-founder__card__vocation">FOUNDER</p>
                <p class="text-archivo room-founder__card__description">Lorem ipsum dolor sit amet, consectetur adipisicing
                    elit, sed do
                    eiusmod tempor incididunt ut labore et dolore.</p>
            </div>
        </section>

        <section class="room-cancellation">
            <p class="title room-cancellation__title">Cancellation</p>
            <hr>
            <p class="text-roboto text-roboto--grey room-cancellation__description">Phasellus volutpat neque a tellus
                venenatis, a euismod augue facilisis.
                Fusce ut metus
                mattis, consequat
                metus nec, luctus lectus. Pellentesque orci quis hendrerit sed eu dolor. Cancel up to 14 days to get a full
                refund.</p>
        </section>

        <section class="room-related">

            <p class="title room-related__title">Related Rooms</p>
            <hr>

            <div class="swiper-room-related">
                <div class="swiper-wrapper">
                    @foreach ($related as $room)
                        <a href="{{ url('/rooms/' . $room->idroom) }}">
                            <div class="swiper-slide">
                                <div class="room room--grid">
                                    <div class="room__container room__container--grid">
                                        <div class="room__rules room__rules--grid">
                                            @foreach (explode(',', $room->amenities) as $amenitie)
                                                @if ($amenitie)
                                                    <img class="room__rules__icon"
                                                        src="{{ asset('assets/bladeicons/' . str_replace(' ', '', strtolower($amenitie)) . '.svg') }}">
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="room__img room__img--grid"
                                            style="background-image: url('{{ url($room->photo) }}')">
                                        </div>
                                    </div>
                                    <div class="room__data room__data--grid">
                                        <div class="room__data__text room__data__text--grid">
                                            <p class="room__data__text__title room__data__text__title--grid">
                                                {{ $room->typeroom }}
                                            </p>
                                            <p
                                                class="text-roboto text-roboto--grey
                                room__data__text__description room__data__text__description--grid">
                                                {{ $room->cancellation }}
                                            </p>
                                        </div>
                                        <div class="room__data__properties room__data__properties--grid">
                                            <p class="room__data__properties__price room__data__properties__price--grid">
                                                ${{ $room->price / 100 }}<span
                                                    class="room__data__properties__price__night room__data__properties__price__night--grid">/Night</span>
                                            </p>
                                            @if ($room->status)
                                                <p class="room__data__properties__availability">Actually Booked</p>
                                            @else
                                                <p class="room__data__properties__availability">Booking Now</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="room-related__swiper__prev-element">></div>
                <div class="room-related__swiper__next-element">></div>
            </div>

            <div class="room-related__list">
                @foreach ($related as $room)
                    <a href="{{ url('/rooms/' . $room->idroom) }}">
                        <div class="room room--grid room-related__room">
                            <div class="room__container room__container--grid">
                                @if ($room->amenities != '')
                                    <div class="room__rules room__rules--grid">
                                        @foreach (explode(',', $room->amenities) as $amenitie)
                                            @if ($amenitie)
                                                <img class="room__rules__icon"
                                                    src="{{ asset('assets/bladeicons/' . str_replace(' ', '', strtolower($amenitie)) . '.svg') }}">
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                                <div class="room__img room__img--grid"
                                    style="background-image: url('{{ url($room->photo) }}')">
                                </div>
                            </div>
                            <div class="room__data room__data--grid">
                                <div class="room__data__text room__data__text--grid">
                                    <p class="room__data__text__title room__data__text__title--grid">{{ $room->typeroom }}
                                    </p>
                                    <p
                                        class="text-roboto text-roboto--grey
                        room__data__text__description room__data__text__description--grid">
                                        {{ $room->cancellation }}</p>
                                </div>
                                <div class="room__data__properties room__data__properties--grid">
                                    <p class="room__data__properties__price room__data__properties__price--grid">
                                        ${{ $room->price / 100 }}<span
                                            class="room__data__properties__price__night room__data__properties__price__night--grid">/Night</span>
                                    </p>
                                    <p class="room__data__properties__availability">
                                        @if ($room->status)
                                            <p class="room__data__properties__availability">Actually Booked</p>
                                        @else
                                            <p class="room__data__properties__availability">Booking Now</p>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endsection

    @section('footer')
        @parent
    @endsection

    @section('scripts')
        <script src="{{ url('/https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js') }}"></script>
        <script type="module" src="{{asset("js/index.js")}}"></script>
        <script type="module" src="{{asset("js/slidersRoomDetails.js")}}"></script>
    @endsection
</body>

</html>
