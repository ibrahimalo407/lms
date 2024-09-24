@extends('layouts.front')

@section('content')
<section class="detail section" id="detail">
    <div class="detail-container grid lg:grid-cols-2 gap-8" style="row-gap: 5rem;">
        <!-- Video and Navigation -->
        <div class="watch-data-left" id="watch-data-left">
            <div class="video-container">
                <iframe src="https://www.youtube.com/embed/{{ $lesson->embed_id }}" frameborder="0" allowfullscreen></iframe>
            </div>

            <div class="navigation-buttons">
                @if($purchased_course)
                    @if ($previous_lesson)
                        <a href="{{ route('lessons.show', [$previous_lesson->course_id, $previous_lesson->slug]) }}" class="nav-button prev-button">
                            <i class="bx bx-left-arrow-alt"></i> Previous Lesson
                        </a>
                    @endif
                    @if ($next_lesson)
                        <a href="{{ route('lessons.show', [$next_lesson->course_id, $next_lesson->slug]) }}" class="nav-button next-button">
                            <i class="bx bx-right-arrow-alt"></i> Next Lesson
                        </a>
                    @endif
                @endif
                <button class="nav-button" id="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>
        </div>

        <!-- Lesson List and Purchase Option -->
        <div class="watch-data-right" id="watch-data-right">
            <ul class="lesson-list">
                @foreach ($lesson->course->publishedLessons as $publishedLesson)
                    <li>
                        @if ($publishedLesson->free_lesson || $purchased_course)
                            <a href="{{ route('lessons.show', [$publishedLesson->course_id, $publishedLesson->slug]) }}">
                                <i class="bx bx-play-circle"></i> {{ $publishedLesson->title }}
                            </a>
                        @else
                            <span class="text-gray-500 cursor-not-allowed">
                                <i class='bx bx-lock'></i> {{ $publishedLesson->title }}
                            </span>
                        @endif
                    </li>
                @endforeach
            </ul>

            @if(!$purchased_course)
                @if (auth()->check())
                    @if ($lesson->course->students()->where('user_id', auth()->id())->count() == 0)
                        <form action="{{ route('courses.payment') }}" method="POST" class="purchase-form">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $lesson->course->id }}" />
                            <input type="hidden" name="amount" value="{{ $lesson->course->price }}" />
                            <input type="hidden" name="lesson_id" value="{{ $lesson->course->publishedLessons[0]->slug }}" />
                            <button class="button detail-button">Purchase Course</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('register') }}?redirect_url={{ route('courses.show', [$lesson->course->slug]) }}" class="button detail-button">
                        Purchase Course (${{ $lesson->course->price }})
                    </a>
                @endif
            @endif
        </div>
    </div>
</section>

<!-- Quiz Section -->
<section class="section question">
    <div class="question-data">
        @if ($purchased_course && $test_exists)
            @if (!is_null($test_result))
                <div class="alert alert-info">Your test score: {{ $test_result->test_result }}</div>
            @else
                <form action="{{ route('lessons.test', [$lesson->slug]) }}" method="post">
                    @csrf
                    @foreach ($lesson->test->questions as $question)
                        <h3>{{ $loop->iteration }}. {{ $question->question }}</h3>
                        @foreach ($question->options as $option)
                            <label>
                                <input type="radio" name="questions[{{ $question->id }}]" value="{{ $option->id }}" /> {{ $option->option_text }}
                            </label>
                        @endforeach
                    @endforeach
                    <button class="button submit-button">Submit Result</button>
                </form>
            @endif
        @endif
    </div>
</section>

@if ($purchased_course)
<!-- Rating Section -->
<section class="section rating">
    <div class="rating-data">
        <h4>Rating: {{ $lesson->course->rating }} / 5</h4>
        <small>Rate the course:</small>
        <form action="{{ route('courses.rating', [$lesson->course->id]) }}" method="post" class="rating-form">
            @csrf
            <select name="rating" class="rating-select">
                <option value="1">1 - Awful</option>
                <option value="2">2 - Not too good</option>
                <option value="3">3 - Average</option>
                <option value="4" selected>4 - Quite good</option>
                <option value="5">5 - Awesome!</option>
            </select>
            <button class="button submit-button">Submit</button>
        </form>
    </div>

    @if (session('success')) 
    <div class="alert alert-info" id="alert">
        {{ session('success') }} 
        <i class='bx bx-x' id="close-alert"></i>
    </div>
    @endif
</section>
@endif

@endsection

<style>
body {
    font-family: 'Poppins', sans-serif;
    background-color: #121212; /* Dark background */
    color: #ffffff; /* Text color */
    margin: 0;
    padding: 0;
}

.section-title {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: #60a5fa; /* Light blue */
    text-align: center;
}

.video-container {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
    height: 0;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
}

.video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none; /* Remove iframe border */
    border-radius: 10px; /* Match container rounding */
}

.navigation-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 1rem;
}

.swiper-button-prev, .swiper-button-next {
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 50%;
    padding: 0.75rem;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s, transform 0.3s;
}

.swiper-button-prev:hover, .swiper-button-next:hover {
    background-color: rgba(255, 255, 255, 1);
    transform: scale(1.1);
}

.lesson-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.lesson-list li {
    margin-bottom: 1rem;
}

.lesson-list a {
    display: flex;
    align-items: center;
    background: #f3f4f6; /* Gray-200 */
    padding: 10px;
    border-radius: 8px;
    color: #1e3a8a;
    text-decoration: none;
    font-weight: 500;
    transition: background 0.3s, transform 0.3s, color 0.3s;
}

.lesson-list a:hover {
    background: #e5e7eb; /* Gray-300 */
    transform: translateY(-2px);
    color: #3b82f6; /* Blue-500 */
}

.purchase-form, .rating-form {
    margin-top: 2rem;
}

.button.detail-button {
    background-color: #2563eb; /* Blue-600 */
    color: white;
    padding: 1rem;
    border-radius: 0.5rem;
    text-align: center;
    transition: background-color 0.3s, transform 0.3s;
    width: 100%;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.button.detail-button:hover {
    background-color: #1d4ed8; /* Blue-700 */
    transform: scale(1.05);
}

.submit-button {
    background-color: #4f46e5; /* Indigo-600 */
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    margin-top: 1rem;
    width: 100%;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
}

.submit-button:hover {
    background-color: #4338ca; /* Indigo-700 */
    transform: scale(1.05);
}

.rating-select {
    height: 40px;
    min-width: 30%;
    border: none;
    background-color: #e2e8f0; /* Gray-200 */
    border-radius: 0.5rem;
    outline: none;
    margin-right: 1rem;
}

.alert {
    margin-top: 1rem;
    padding: 1rem;
    background-color: #e0f2fe; /* Light blue */
    border: 1px solid #3b82f6; /* Blue-600 */
    border-radius: 0.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

#close-alert {
    cursor: pointer;
    margin-left: 10px;
    color: #3b82f6;
    transition: color 0.3s, transform 0.3s;
}

#close-alert:hover {
    color: #dc2626; /* Red-600 */
    transform: scale(1.1);
}

.question h3 {
    color: #60a5fa; /* Light blue */
}

.question-data {
    padding: 2rem;
    border-radius: 10px;
    background-color: #1e293b; /* Darker background */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
    color: #ffffff;
}

.rating h4 {
    color: #ffffff; /* Light blue */
}


</style>
