<?php

use Symfony\Component\Finder\Finder;

if (! function_exists('module_providers')) {
    function module_providers(){
        // initialize json finder
        $providers = [];
        $files = Finder::create()->in(base_path('modules'))->name('module.json')->followLinks();

        // start looping trought each finder result
        foreach ($files as $file) {
            $json = json_decode( file_get_contents($file), true );

            // skip if not an array or not active
            if (!json || !is_array($json) || !array_key_exists('active', $json) || !$json['active']) {
                continue;
            }

            // skip if providers is empty
            if (!array_key_exists('providers', $json)) {
                continue;
            }

            if (is_array($json['providers'])) {
                foreach ($json['providers'] as $provider) {
                    if (!class_exists($provider) || in_array($provider, $providers)) {
                        continue;
                    }
                    array_push($providers, $provider);
                }
            }
            continue;
        }

        return $providers;
    }
}

if (! function_exists('module_aliases')) {
    function module_aliases(){
        // initialize json finder
        $aliases = [];
        $files = Finder::create()->in(base_path('modules'))->name('module.json')->followLinks();

        // start looping trought each finder result
        foreach ($files as $file) {
            $json = json_decode( file_get_contents($file), true );

            // skip if not an array or not active
            if (!json || !is_array($json) || !array_key_exists('active', $json) || !$json['active']) {
                continue;
            }

            // skip if providers is empty
            if (!array_key_exists('aliases', $json)) {
                continue;
            }

            if (is_array($json['aliases'])) {
                foreach ($json['aliases'] as $aliasKey => $aliasVal) {
                    if (!class_exists($aliasVal) || array_key_exists($aliasKey, $aliases) || in_array($aliasVal, $aliases)) {
                        continue;
                    }
                    $aliases[$aliasKey] = $aliasVal;
                }
            }
            continue;
        }

        return $aliases;
    }
}