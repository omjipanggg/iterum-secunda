<?php
public function moneyFormat($amount) {
	return number_format($amount, 0, ',', '.');
}