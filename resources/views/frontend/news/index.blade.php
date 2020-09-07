@php  /** @var App\Entities\News\News $new */ @endphp

<x-frontend-layout :title="__('misc.news')">
    <div class="container text-info mt-n3">
        @forelse($news as $new)
            <table class="table table-bordered table-bordered-info mb-3 text-info">
                <tr>
                    <td>
                        <span class="fas fa-calendar-alt mr-2"></span>
                        {{ $new->createdAtHtml() }}:
                        <a href="{{ route('news.show', $new->slug) }}"><strong>{{ $new->title }}</strong></a>
                    </td>
                </tr>
                <tr>
                    <td>{!! $new->body !!}</td>

                </tr>
                <tr>
                    <td class="text-right">
                        <a href="{{ route('news.show', $new->slug) }}"><span class="fas fa-comments mr-2"></span>{{ $new->commentsCount() }}</a>
                    </td>
                </tr>
            </table>
        @empty
            {{ __('backend.news-not-found') }}
        @endforelse
        <div class="text-center">
            {{ $news->links() }}
        </div>
    </div>
</x-frontend-layout>
