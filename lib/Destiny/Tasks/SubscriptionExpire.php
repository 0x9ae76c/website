<?php

namespace Destiny\Tasks;

use Destiny\Application;
use Destiny\Config;
use Destiny\Utils\Date;
use Psr\Log\LoggerInterface;
use Destiny\Service\SubscriptionsService;

class SubscriptionExpire {

	public function execute(LoggerInterface $log) {
		$expiredSubscriptionCount = SubscriptionsService::instance ()->expiredSubscriptions ();
		$log->info ( sprintf ( 'Expired (%s)', $expiredSubscriptionCount ) );
	}

}