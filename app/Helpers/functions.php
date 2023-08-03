<?php

use Illuminate\Support\Carbon;

function elapsed_date($date) {
	return Carbon::parse($date)->locale('id')->diffForHumans();
}