<?php

namespace inCMS\Platform\Foundation;

use Illuminate\Foundation\Application as LaravelApps;

class Application extends LaravelApps
{
	public function platformPath() {
		return $this->basePath.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'platform';
	}

	public function path()
    {
        return $this->platformPath();
    }

    public function resourcePath()
    {
        return $this->platformPath().DIRECTORY_SEPARATOR.'resources';
    }
}