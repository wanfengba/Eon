<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle([
            'category' => _t('分类 %s 下的文章'),
            'search'   => _t('包含关键字 %s 的文章'),
            'tag'      => _t('标签 %s 下的文章'),
            'author'   => _t('%s 发布的文章')
        ], '', ' - '); ?><?php $this->options->title(); ?></title>
        
    <!-- 使用url函数转换相关路径 -->
    <link rel="shortcut icon" href="<?php $this->options->favicon() ?>" />
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/k.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/style.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('font/css/font-awesome.min.css'); ?>"><!--https://fontawesome.com.cn/faicons/-->
    <!-- 复制提醒 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css" />
    
    <link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/lxgw-wenkai-webfont@1.1.0/style.css" />
     <!--Lite version -->
    <link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/lxgw-wenkai-lite-webfont@1.1.0/style.css" />
     <!--TC version -->
    <link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/lxgw-wenkai-tc-webfont@1.0.0/style.css" />
      <!--Screen version -->
    <link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/lxgw-wenkai-screen-webfont@1.1.0/style.css" />
    <style>
        body {
        font-family: "LXGW WenKai", sans-serif;
          /* Lite version */
        font-family: "LXGW WenKai Lite", sans-serif;
          /* TC version */
        font-family: "LXGW WenKai TC", sans-serif;
          /* Screen version */
        font-family: "LXGW WenKai Screen", sans-serif;
        }
    <?php $this->options->添加css() ?>
    </style>
    
    <script type='text/javascript' src='<?php $this->options ->themeUrl('js/jquery.min.js?ver=1.3'); ?>'></script>
    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
</head>

<body>
<div class="stars">
</div>
<header id="header" class="clearfix">

</header><!-- end #header -->