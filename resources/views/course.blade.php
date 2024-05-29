@extends('layouts.front')

@section('content')

<section class="detail section py-12 px-4 sm:px-6 lg:px-8" id="detail">
    <div class="detail-container grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="detail-data-left lg:col-span-2 bg-white rounded-lg shadow-lg overflow-hidden">
            <h3 class="text-4xl font-bold mb-4">{{ $course->title }}</h3>
            <br>
            <img src="{{ Storage::url($course->course_image) }}" alt="{{ $course->title }}" class="w-full h-64 object-cover"/>
            <div class="p-6">
                <div class="bg-gray-100 p-4 rounded-lg">
                    <p class="text-gray-700 leading-relaxed">{{ $course->description }}</p>
                </div>
            </div>
        </div>
        <div class="detail-data-right bg-white rounded-lg shadow-lg p-6 flex flex-col">
            <h4 class="text-2xl font-semibold mb-4">Les Leçons</h4>
            <br>
            <ul class="space-y-4">
                @foreach ($course->publishedLessons->take(2) as $lesson)
                    <li>
                        @if ($lesson->free_lesson)
                            <a class="lesson-title flex items-center text-blue-600 hover:underline" 
                               href="{{ route('lessons.show', [$lesson->course_id, $lesson->slug]) }}">
                                <i class="bx bx-play-circle mr-2"></i>{{ $lesson->title }}
                            </a>
                        @else
                            @if (!$purchased_course)
                                <span class="lesson-title flex items-center text-gray-500 cursor-not-allowed">
                                    <i class='bx bx-lock mr-2'></i>{{ $lesson->title }}
                                </span>
                            @else
                                <a class="lesson-title flex items-center text-blue-600 hover:underline" 
                                   href="{{ route('lessons.show', [$lesson->course_id, $lesson->slug]) }}">
                                    <i class="bx bx-play-circle mr-2"></i>{{ $lesson->title }}
                                </a>
                            @endif
                        @endif
                    </li>
                @endforeach
            </ul>
            @if (auth()->check())
                @if ($course->students()->where('user_id', auth()->id())->count() == 0)
                    <form action="{{ route('courses.payment') }}" method="POST" class="mt-6">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}" />
                        <input type="hidden" name="amount" value="{{ $course->price }}" />
                        <input type="hidden" name="lesson_id" value="{{ $course->publishedLessons[0]->slug }}" />
                        <button class="button detail-button w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700">
                            Acheter le cours
                        </button>
                    </form>
                @endif
            @else
                <a href="{{ route('register') }}?redirect_url={{ route('courses.show', [$course->slug]) }}"
                   class="button detail-button w-full text-center bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 mt-6">
                    Buy course (${{ $course->price }})
                </a>
            @endif
        </div>
    </div>
</section>

@endsection
