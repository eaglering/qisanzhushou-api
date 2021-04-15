<?php
declare(strict_types=1);

namespace app\frontend\controller;

use think\facade\App;
use think\facade\Filesystem;
use think\File;

class TestController extends Controller
{
    public function upload() {
        $file = new File(App::getRootPath() . 'public/uploads/20210311/ic-reactjs.png');
        $disk = Filesystem::disk('upload');
        $filename = $disk->putFile('', $file);
        echo $filename, '<br/>';
        echo $disk->getConfig()->get('url') . $filename . '<br/>';
//        $filename = $disk->($filename);
//        echo $filename, '<br/>';
        echo $disk->path($filename);
    }
}
