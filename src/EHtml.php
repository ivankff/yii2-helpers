<?php

namespace ivankff\yii2Helpers;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class EHtml extends Html {


    /**
     * @param string $srcSmall
     * @param string $srcBig
     * @param string $group
     * @param array $options
     * @return string
     */
    public static function fancyBoxImage($srcSmall, $srcBig, $group = 'gallery', $options = []){
        $imgOptions = ArrayHelper::remove($options, 'imgOptions', []);
        $options['data']['fancybox'] = $group;
        return static::fancyBox(HtmlE::img($srcSmall, $imgOptions), $srcBig, 'image', $options);
    }


    /**
     * @param string $text
     * @param string $src
     * @param string|null $type
     * @param array $options
     * @return string
     */
    public static function fancyBox($text, $src, $type, $options = []){
        $tag = ArrayHelper::remove($options, 'tag', 'a');
        $data = ArrayHelper::remove($options, 'data', []);
        if ($type == 'image'){
            if ($tag == 'a' && !isset($options['href'])){
                $options['href'] = $src;
            } else {
                $data['src'] = $src;
            }
        } else {
            if ($tag == 'a' && !isset($options['href'])){
                $options['href'] = 'javascript:;';
            }
        }
        if (!isset($data['fancybox'])) $data['fancybox'] = uniqid();
        if (!isset($data['options']['focus'])) $data['options']['focus'] = false;
        if ($src) $data['src'] = $src;
        if ($type) $data['type'] = $type;
        $options['data'] = $data;
        return HtmlE::tag($tag, $text, $options);
    }


    /**
     * @param string|array|null $icon
     * @param string $text
     * @param array|string|null $url
     * @param array $options
     * @return string
     */
    public static function aIcon($icon, $text, $url = null, $options = [])
    {
        $iconOptions = ArrayHelper::remove($options, 'iconOptions', []);
        $template = ArrayHelper::remove($options, 'template');
        if ($template) $iconOptions['template'] = $template;
        if ($icon) $text = static::iconText($icon, $text, $iconOptions);
        return parent::a($text, $url, $options);
    }

    /**
     *
     * @param string|array|null $icon
     * @param string $content
     * @param array $options
     * @return string
     */
    public static function buttonIcon($icon, $content = 'Button', $options = [])
    {
        $iconOptions = ArrayHelper::remove($options, 'iconOptions', []);
        $template = ArrayHelper::remove($options, 'template');
        if ($template) $iconOptions['template'] = $template;
        if ($icon) $content = static::iconText($icon, $content, $iconOptions);
        return parent::button($content, $options); // TODO: Change the autogenerated stub
    }


    /**
     * @param string|array $iconCssClass
     * @param string $tag
     * @param array $options
     * @return string
     */
    public static function icon($iconCssClass, $tag = 'i', $options = []){
        $options['class'] = $iconCssClass;
        $content = ArrayHelper::remove($options, 'content', '');
        return static::tag($tag, $content, $options);
    }


    /**
     * @param array $icons Массив из $iconCssClass
     * @param string $tag
     * @param array $options
     * @return string
     */
    public static function iconStack($icons, $tag = 'i', $options = []){
        $ics = [];
        $stackTag = ArrayHelper::remove($options, 'stackTag', 'span');
        $stackOptions = ArrayHelper::remove($options, 'stackOptions', ['class' => 'fa-stack']);
        foreach ($icons as $iconCss) $ics[] = static::icon($iconCss, $tag, $options);
        return static::tag($stackTag, implode('', $ics), $stackOptions);
    }


    public static function iconText($icon, $text, $options = []){
        $iconTag = ArrayHelper::remove($iconOptions, 'tag', 'i');
        $isStack = ArrayHelper::remove($iconOptions, 'stack', false);
        $template = ArrayHelper::remove($options, 'template', $text ? '{icon}&nbsp; {text}' : '{icon}');
        return strtr($template, [
            '{icon}' => $isStack ? static::iconStack($icon, $iconTag, $iconOptions) : static::icon($icon, $iconTag, $iconOptions),
            '{text}' => $text,
        ]);
    }

}