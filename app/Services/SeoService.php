<?php

namespace App\Services;

use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

class SeoService
{

    public function load($page)
    {
        $tags = ['title', 'description', 'keywords'];
        $fields = [];
        foreach ($tags as $tag) {
            $fields[] = 'seo_' . $tag . '_' . $page;
        }
        $meta = Setting::whereIn('key', $fields)->pluck('value', 'key');

        if ($meta->count() > 0) {

            // $title = $meta['seo_title_' . $page] . ' - ' . setting('app_name');
            $title = $meta['seo_title_' . $page];

            SEOTools::setTitle($title, false);
            SEOMeta::setDescription($meta['seo_description_' . $page], false);
            SEOTools::opengraph()->addProperty('type', 'product');
            SEOTools::opengraph()->setUrl(url()->current());
            SEOTools::setDescription($meta['seo_description_' . $page], false);
            $keyword = $meta['seo_keywords_' . $page];

            if ($keyword) {
                SEOMeta::addKeyword(explode(',', $keyword));
            }

            request()->session()->flash('seo_was_set', TRUE);
        }
    }
}
