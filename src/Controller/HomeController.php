<?php

namespace Sthom\App\Controller;

use Sthom\App\Model\User;
use Sthom\Kernel\Utils\AbstractController;
use Sthom\Kernel\Utils\Repository;

class HomeController extends AbstractController
{
    final public function index(): void
    {
        $userRepo = new Repository(User::class);
        $user = $userRepo->getById(1);
        $this->render('home/index.php', [
            'title' => "Page d'accueil",
            'user' => $user,
        ]);
    }


}

