@extends('layouts.front')

@section('content')
<section class="home" id="home">
    <div class="home-container container grid">
        <div class="home-img-bg">
            <!-- <img src="assets/images/bg-hero.jpg" alt="" class="home-img" /> -->
        </div>

        <div class="home-data">
            <h1 class="home-title">
                Nous vous enseignons <br />
                Tout ce que vous devez savoir
            </h1>
            <p class="home-description">
                Découvrez la façon dont vous apprenez et prenez le contrôle de votre vie en créant
                quelque chose d'utile pour les autres.
            </p>
            <div class="home-btns">
                <a href="{{ route('courses.index') }}" class="button btn-gray btn-small"> Mes cours </a>
                <a href="#course" class="button button-home">Découvrir les cours</a>
            </div>
        </div>
    </div>
</section>

<section class="story section container">
    <div class="story-container grid">
        <div class="story-data">
            <h2 class="section-title story-section-title">Nos objectifs</h2>
            <h1 class="story-title">Apprenez sans pression</h1>
            <p class="story-description">Vivez l'apprentissage à travers des projets concrets qui encouragent la créativité et l'innovation.</p>
            <a href="#course" class="btn btn-primary btn-lg">Découvrir les cours</a>
        </div>
        <div class="story-images">
            <img src="{{ asset('frontend/assets/images/e-learning-online-training-education-banner.jpg') }}" alt="Image d'apprentissage" class="story-img" />
            <div class="story-square"></div>
        </div>
    </div>
</section>

<section class="products section container" id="course">
    <h2 class="section-title">Tous les cours</h2>

    <div class="new-container">
        <div class="swiper new-swipper">
            <div class="swiper-wrapper">
                @foreach ($courses as $course)
                    <article class="products-card swiper-slide">
                        @guest
                            <a href="{{ route('register') }}" class="products-link" style="color: inherit;">
                        @else
                            <a href="{{ route('courses.show', [$course->slug]) }}" class="products-link" style="color: inherit;">
                        @endguest
                            <img src="{{ Storage::url($course->course_image) }}" class="products-img" alt="" />

                            <h3 class="products-title">{{ $course->title }}</h3>
                            <div class="products-star">
                                @for ($star = 1; $star <= 5; $star++)
                                    @if ($course->rating >= $star)
                                        <i class="bx bxs-star"></i>
                                    @else
                                        <i class='bx bx-star'></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="products-price">${{ $course->price }}</span>
                            @if ($course->students()->count() > 5)
                                <button class="products-button">
                                    Populaire
                                </button>
                            @endif
                            <span class="products-student">
                                {{ $course->students()->count() }} étudiants
                            </span>
                            </a>
                        </article>
                @endforeach
            </div>
            <div class="swiper-button-next"
                style="
                bottom: initial;
                top: 50%;
                right: 0;
                left: initial;
                border-radius: 50%;
              ">
                <i class="bx bx-right-arrow-alt"></i>
            </div>
            <div class="swiper-button-prev" style="bottom: initial; top: 50%; border-radius: 50%">
                <i class="bx bx-left-arrow-alt"></i>
            </div>
        </div>
    </div>
</section>

@endsection
