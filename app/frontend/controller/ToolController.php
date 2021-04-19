<?php
namespace app\frontend\controller;

use app\frontend\logic\navigator\CategoryLogic;

class ToolController extends Controller
{
    public function index()
    {
        $categoryLogic = new CategoryLogic();
        $quickSearch = $categoryLogic->getToolQuickSearch();
        return view()->assign(compact('quickSearch'));
    }
}
