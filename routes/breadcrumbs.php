<?php

use App\Entities\Blog\Post\Post;
use App\Entities\News\News;
use App\Entities\Page\Page;
use App\Entities\Test\TestQuestion;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;

Breadcrumbs::for('root', function (BreadcrumbsGenerator $trail) {
    $trail->push(__('misc.main'), route('root'));
});

// Backend Tests
Breadcrumbs::for('admin.dashboard', function (BreadcrumbsGenerator $trail) {
    $trail->parent('root');
    $trail->push(__('backend.dashboard'), route('admin.dashboard'));
});

Breadcrumbs::for('admin.tests.questions', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend.tests.questions'), route('admin.tests.questions'));
});

Breadcrumbs::for('admin.tests.questions.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.tests.questions');
    $trail->push(__('backend.new-question'));
});

Breadcrumbs::for('admin.tests.questions.show', function (BreadcrumbsGenerator $trail, TestQuestion $question) {
    $trail->parent('admin.tests.questions');
    $trail->push(__('backend.show-question'), route('admin.tests.questions.show', $question));
});

Breadcrumbs::for('admin.tests.questions.edit', function (BreadcrumbsGenerator $trail, TestQuestion $question) {
    $trail->parent('admin.tests.questions.show', $question);
    $trail->push(__('backend.edit-question'), route('admin.tests.questions.edit', $question));
});

Breadcrumbs::for('admin.tests.answers.create', function (BreadcrumbsGenerator $trail, TestQuestion $question) {
    $trail->parent('admin.tests.questions.show', $question);
    $trail->push(__('backend.new-answer'));
});

Breadcrumbs::for('admin.tests.answers.edit', function (BreadcrumbsGenerator $trail, TestQuestion $question) {
    $trail->parent('admin.tests.questions.show', $question);
    $trail->push(__('backend.edit-answer'));
});

// Backend Pages
Breadcrumbs::for('admin.pages', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend.pages'), route('admin.pages'));
});

Breadcrumbs::for('admin.pages.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.pages');
    $trail->push(__('backend.new-page'));
});

Breadcrumbs::for('admin.pages.show', function (BreadcrumbsGenerator $trail, Page $page) {
    $trail->parent('admin.pages');
    $trail->push(__('backend.show-page'), route('admin.pages.show', $page));
});

Breadcrumbs::for('admin.pages.edit', function (BreadcrumbsGenerator $trail, Page $page) {
    $trail->parent('admin.pages.show', $page);
    $trail->push(__('backend.edit-page'), route('admin.pages.edit', $page));
});

// Backend Posts
Breadcrumbs::for('admin.posts', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('user.posts'), route('admin.posts'));
});

Breadcrumbs::for('admin.posts.edit', function (BreadcrumbsGenerator $trail, string $id) {
    $trail->parent('admin.posts');
    $trail->push(__('user.edit-post'), route('admin.posts.edit', $id));
});

// User Posts
Breadcrumbs::for('user.posts', function (BreadcrumbsGenerator $trail) {
    $trail->parent('root');
    $trail->push(__('user.posts'), route('user.posts'));
});

Breadcrumbs::for('user.posts.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('user.posts');
    $trail->push(__('user.create-post'));
});

Breadcrumbs::for('user.posts.edit', function (BreadcrumbsGenerator $trail, Post $post) {
    $trail->parent('user.posts');
    $trail->push(__('user.edit-post'), route('user.posts.edit', $post));
});

// Backend News
Breadcrumbs::for('admin.news', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend.news'), route('admin.news'));
});

Breadcrumbs::for('admin.news.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.news');
    $trail->push(__('backend.new-news'));
});

Breadcrumbs::for('admin.news.edit', function (BreadcrumbsGenerator $trail, News $news) {
    $trail->parent('admin.news');
    $trail->push(__('backend.edit-news'), route('admin.news.edit', $news));
});
