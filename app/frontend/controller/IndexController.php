<?php
namespace app\frontend\controller;

use app\frontend\logic\navigator\CategoryLogic;
use app\frontend\logic\navigator\SiteLogic;

class IndexController extends Controller
{
    public function index()
    {
        $siteLogic = new SiteLogic();
        $categoryLogic = new CategoryLogic();
        $hot = $siteLogic->getHomeHot(14);
        $quickSearch = $categoryLogic->getHomeQuickSearch();
        $comprehensive = $categoryLogic->getHomeComprehensive();
        return view()->assign(compact('hot', 'quickSearch', 'comprehensive'));
    }
}
