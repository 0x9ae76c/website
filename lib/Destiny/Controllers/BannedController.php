<?php
namespace Destiny\Controllers;

use Destiny\Common\ViewModel;
use Destiny\Common\Annotation\Controller;
use Destiny\Common\Annotation\Route;
use Destiny\Common\Annotation\Secure;
use Destiny\Common\Session;
use Destiny\Common\User\UserService;
use Destiny\Common\Request;

/**
 * @Controller
 */
class BannedController {

    /**
     * @Route ("/banned")
     * @Secure ({"USER"})
     *
     * @param ViewModel $model
     * @param Request $request
     * @return string
     */
    public function banned(ViewModel $model, Request $request) {
        $userService = UserService::instance ();
        $creds = Session::getCredentials ();
        $model->ban = $userService->getUserActiveBan ( $creds->getUserId (), $request->ipAddress() );
        $model->banType = 'none';
        if (! empty ( $model->ban )) {
            if (! $model->ban ['endtimestamp']) {
                $model->banType = 'permanent';
            } else {
                $model->banType = 'temporary';
            }
        }
        $model->user = $creds->getData ();
        $model->title = 'Banned';
        return 'banned';
    }
}
