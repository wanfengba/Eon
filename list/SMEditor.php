<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
class SMEditor
{
  public static $isDev = false;
  public static $version = '1.3.2';

  /**
   * 静态资源URL
   * 
   */
  public static function _getAssetsUrl($echo = true)
  {
    $localUrl = Helper::options()->pluginUrl . '/SMEditor';
    $remoteUrl = '//fastly.jsdelivr.net/npm/typecho-editor@' . self::$version;
    if ($echo) echo self::$isDev ? $localUrl : $remoteUrl;
    else return self::$isDev ? $localUrl : $remoteUrl;
  }

  /**
   * 解析表情
   * 
   */
  public static function _parseEmotion($text)
  {
    return preg_replace_callback(
      '/\[\/([A-Z]{1}):([^\]]+)\]/',
      function ($match) {
        $emotionAssetsURL = self::_getAssetsUrl(false) . '/assets/img';
        return "<img class='sm-emotion' src='{$emotionAssetsURL}/{$match[1]}/{$match[2]}.png' no-view />";
      },
      $text
    );
  }

  /**
   * 解析短代码
   * 
   */
  public static function _parseCode($text)
  {
    if (strpos($text, '{×}') || strpos($text, '{√}')) {
      $text = strtr($text, array(
        "{×}" => '<span class="sm-task"></span>',
        "{√}" => '<span class="sm-task checked"></span>'
      ));
    }
    return $text;
  }
  /**
   * 解析文章
   * 
   */
  public static function SMContent($text, $context)
  {
    $text = self::_parseEmotion($text);
    $text = $context->isMarkdown ? $context->markdown($text) : $context->autoP($text);
    return self::_parseCode($text);
  }

  /**
   * 注入函数
   * 
   */
  public static function SMPreview()
  {
    $assetsUrl = self::_getAssetsUrl(false);
    echo <<<EOF
      <link rel="stylesheet" href="$assetsUrl/other/css/SMPreview.bundle.css" />
      <script src="$assetsUrl/other/js/SMPreview.bundle.min.js"></script>
EOF;
  }

  /**
   * 注入函数
   * 
   */
  public static function SMEdit()
  {
?>
    <link rel="stylesheet" href="<?php self::_getAssetsUrl(); ?>/assets/plugin/Prism/Prism.min.css">
    <link rel="stylesheet" href="<?php self::_getAssetsUrl(); ?>/assets/css/SMEditor.bundle.css" />
    <script>
      window.SMEditor = {
        // 是否开启粘贴上传
        pasteUpload: true,
        // 是否开启自动保存
        autoSave: <?php Helper::options()->autoSave(); ?>,
        // 上传地址
        uploadUrl: '<?php Helper::security()->index('/action/upload'); ?>',
        // 静态资源
        assetsURL: '<?php self::_getAssetsUrl(); ?>',
      }
    </script>
    <script src="<?php self::_getAssetsUrl(); ?>/assets/plugin/Prism/Prism.min.js"></script>
    <script src="<?php self::_getAssetsUrl(); ?>/assets/plugin/Parser/Parser.min.js"></script>
    <script src="<?php self::_getAssetsUrl(); ?>/assets/js/SMEditor.bundle.js"></script>
<?php
  }
}