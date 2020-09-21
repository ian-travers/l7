@php  /** @var App\Entities\News\News $news */ @endphp

<x-frontend-layout :title="__('misc.news')">
    <all-news inline-template>
        <div class="container text-info mt-n3">
            @forelse($allNews as $news)
                <table class="table table-bordered table-bordered-info mb-3 text-info">
                    <tr>
                        <td>
                            <span class="fas fa-calendar-alt mr-2"></span>
                            {{ $news->createdAtHtml() }}:
                            <a href="{{ route('news.show', $news->slug) }}"><strong>{{ $news->title }}</strong></a>
                            <like-dislike
                                :model="{{ $news }}"
                                uri-suffix="news"
                            ></like-dislike>
                        </td>
                    </tr>
                    <tr>
                        <td>{!! $news->body !!}</td>

                    </tr>
                    <tr>
                        <td class="text-right">
                            <a href="{{ route('news.show', $news->slug) }}"><span class="fas fa-comments mr-2"></span>{{ $news->commentsCount() }}</a>
                        </td>
                    </tr>
                </table>
            @empty
                {{ __('backend.news-not-found') }}
            @endforelse
            <div class="text-center">
                {{ $allNews->links() }}
            </div>
        </div>
    </all-news>
</x-frontend-layout>
