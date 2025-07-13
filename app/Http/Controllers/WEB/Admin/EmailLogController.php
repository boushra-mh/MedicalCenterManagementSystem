<?php
namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailLog;

class EmailLogController extends Controller
{
    public function index()
    {
        $emails = EmailLog::latest()->paginate(10);
        return view('admin.email_logs.index', compact('emails'));
    }

    public function show($id)
    {
        $email = EmailLog::findOrFail($id);
        return view('admin.email_logs.show', compact('email'));
    }

}
