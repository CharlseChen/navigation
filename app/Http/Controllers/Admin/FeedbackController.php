<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Feedback;

class FeedbackController extends AdminController {

    public function index() {
        $data=Feedback::query()->all()->orderBy('created_at','desc')->paginate(config('website.admin.page_size'));
        return view('admin.feedback.feedback');
    }

}
