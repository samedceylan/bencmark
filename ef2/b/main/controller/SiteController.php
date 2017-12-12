<?php

use EF2\Core\Controller;

class SiteController extends Controller
{

    public function actionIndex()
    {
        $this->render("site.index");
    }
}