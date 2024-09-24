@extends('layouts.front')

@section('content')

<section class="detail section py-12 px-4 sm:px-6 lg:px-8" id="detail">
    <div class="detail-container grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="detail-data-left lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            @if (isset($isRestricted) && $isRestricted)
                <div class="alert alert-warning p-4 mb-6 rounded bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200">
                    <strong>Accès restreint !</strong> Votre accès à ce cours est limité. Veuillez contacter l'administrateur via votre espace de chat.
                </div>
            @else
                <h3 class="text-4xl font-bold mb-4 text-title-color dark:text-white">{{ $course->title }}</h3>
                <img src="{{ Storage::url($course->course_image) }}" alt="{{ $course->title }}" class="w-full h-64 object-cover rounded-md shadow-md transition-transform duration-300 transform hover:scale-105" />
                <div class="p-6">
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $course->description }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="detail-data-right bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 flex flex-col">
            @if (!isset($isRestricted) || !$isRestricted)
                <h4 class="text-2xl font-semibold mb-4 text-title-color dark:text-white">Les Leçons</h4>
                <ul class="space-y-4">
                    @foreach ($course->publishedLessons->take(2) as $lesson)
                        <li>
                            @if ($lesson->free_lesson)
                                <a class="lesson-title flex items-center text-blue-600 hover:underline transition duration-300" 
                                   href="{{ route('lessons.show', [$lesson->course_id, $lesson->slug]) }}">
                                    <i class="bx bx-play-circle mr-2"></i>{{ $lesson->title }}
                                </a>
                            @else
                                @if (!$purchased_course)
                                    <span class="lesson-title flex items-center text-gray-500 cursor-not-allowed">
                                        <i class='bx bx-lock mr-2'></i>{{ $lesson->title }}
                                    </span>
                                @else
                                    <a class="lesson-title flex items-center text-blue-600 hover:underline transition duration-300" 
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
                            <button class="button detail-button w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 transition duration-300 shadow-md hover:shadow-lg">
                                Acheter le cours
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('register') }}?redirect_url={{ route('courses.show', [$course->slug]) }}"
                       class="button detail-button w-full text-center bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 mt-6 transition duration-300 shadow-md hover:shadow-lg">
                        Acheter le cours (${{ $course->price }})
                    </a>
                @endif
            @endif
        </div>
    </div>
</section>

@endsection

<style>
    .alert {
        font-size: 1rem;
        border-left: 4px solid #f59e0b; /* Alert border color */
    }

    .alert-warning {
        background-color: #fffbeb; /* Alert background color */
        color: #b45321; /* Alert text color */
    }

    .lesson-title.disabled {
        color: #6b7280; /* Color for inaccessible lessons */
        cursor: not-allowed;
    }
    
    /* Additional Styles for Dark Mode */
    body.dark-theme .detail-data-left,
    body.dark-theme .detail-data-right {
        background-color: var(--container-color); /* Your dark container color */
        border: 1px solid var(--border-color);
    }

    body.dark-theme .alert-warning {
        background-color: #3b3b3b; /* Dark mode alert background */
        color: #fbbf24; /* Dark mode alert text color */
    }

    body.dark-theme .text-title-color {
        color: var(--dark-text-color); /* Title color in dark mode */
    }
    
    /* Smooth transition for background and text colors */
    body {
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Responsive design adjustments */
    @media (max-width: 768px) {
        .detail-container {
            grid-template-columns: 1fr; /* Stack columns on smaller screens */
        }
    }
</style>
