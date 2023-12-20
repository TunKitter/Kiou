<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'mentor/upload-id-card',
        'mentor/face-verify',
        'mentor/profile',
        'mentor/save-id-card-data',
        'profile',
        'course/*/learn/bookmark/*',
        'course/list/*/*',
        'course/list/*/*/*',
        'course/*/*/learn/update',
        'course/list/update/course/interactive',
        'admin/users/update/*',
        'revision/bookmark/revise/update',
        'revision/test/*/update',
        'revision/code/list/*',
        'revision/code/explore/list/',
        'revision/code/explore/list/save',
        '/admin/users/list/*/*',
        '/admin/users/delete',
        '/admin/users/update',
        '/admin/users/add',
        '/admin/category/list/delete',
        '/admin/category/update',
        '/admin/category/add',
        '/admin/notification',
        '/course/add/upload',
        'mentor/cp/update',
        'mentor/create/cp',
        'mentor/delete/cp',
        '/course/mentor/name',
        'lessons/get',
        'course/roadmap/detail',
        'mentor/roadmap/delete',
        '/mentor/roadmap/create/new',
        'course/add/upload/video',
        '/mentor/my-course/*/edit',
        '/mentor/my-course/*/update-image',
        '/mentor/my-course/*/update-chapter',
        '/mentor/my-course/*/update-lesson',
        '/mentor/my-course/*/delete-lesson',
        '/mentor/my-course/*/update-lesson-path',
        '/mentor/my-course/*/add-lesson',
        'course/plain-data',
        '/course/update/interactive',
        '/get-infor/*',
        'cart/delete/*',
        'admin/dashboard/getInfor/*',
    ];
}
