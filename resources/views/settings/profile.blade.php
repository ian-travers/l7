@php /** @var \App\User $user */ @endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">{{ __('account.personal-settings') }}</div>
                    <ul class="nav flex-column">
                        <li class="nav-item border-bottom position-relative">
                            <a class="nav-link active-vertical-menu"
                               href="{{ route('settings.profile') }}">{{ __('account.profile') }}</a>
                        </li>
                        <li class="nav-item border-bottom position-relative">
                            <a class="nav-link" href="{{ route('settings.account') }}">{{ __('account.account') }}</a>
                        </li>
                        <li class="nav-item position-relative">
                            <a class="nav-link" href="{{ route('settings.team') }}">{{ __('account.team') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h3>{{ __('account.public-profile') }}</h3>
                        {{ $user->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

