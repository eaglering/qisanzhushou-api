<?php
namespace app\frontend\controller;

use app\frontend\logic\navigator\CategoryLogic;

class ProjectController extends Controller
{
    public function index()
    {
        $categoryLogic = new CategoryLogic();
        $quickSearch = $categoryLogic->getProjectQuickSearch();
        return view()->assign(compact('quickSearch'));
    }
}
