<?php

namespace App\Helpers;

use Request;

use App\Models\ActivityLog as Log;

class ActivityLog {
	public static function create($subject) {
		$log = [];
		$log['subject'] = $subject;
		$log['url'] = Request::fullUrl();
		$log['ip_address'] = Request::ip();
		$log['method'] = Request::method();
		$log['user_agent'] = Request::header('user-agent');
		$log['user_id'] = auth()->check() ? auth()->user()->id : null;
		Log::create($log);
	}

	public static function latestLog($user) {
		$data = [];
		if (auth()->check()) {
			$data = Log::where('user_id', $user)
			->where('subject', 'Login')
			->orderByDesc('created_at')
			->take(1)
			->offset(1)
			->latest()->first();
		}
		return $data;
	}
}