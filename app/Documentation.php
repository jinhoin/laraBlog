<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Documentation extends Model
{
    public function get($file = 'documentation.md'){
        $content = File::get($this->path($file));
        
        return $this->replaceLinks($content);
    }


    protected function path($file){
        $file = ends_with($file, '.md') ? $file : $file . '.md';
        // 문자 확장가 md 파일로 끝나는지 체크 없을경우 확장자를 덭붙여주는역활
        $path = base_path('docs' . DIRECTORY_SEPARATOR . $file);
                            //  라라벨 루트 경로를 역슬래쉬 디렉터리 구분자로 치환시켜줌
        if (! File::exists($path)) {
            abort(403, '요청하신 파일이 없습니다');
        }
        return $path;
    }

    protected function replaceLinks($content){
        return str_replace('/docs/{{ version }}', '/docs', $content);
        // 버전이 붙을경우 삭제한다
    }
}
