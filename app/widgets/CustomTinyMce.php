<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-18
 * Time: 上午1:52
 */

namespace app\widgets;


use app\assets\EmojiOneAreaAsset;
use dosamigos\tinymce\TinyMce;
use yii\bootstrap\Modal;
use yii\web\JsExpression;
use yii\web\View;

/**
 * Class CustomTinyMce
 * @package app\widgets
 */
class CustomTinyMce extends TinyMce
{
    public $emojiModalId = "emojione-modal";

    public $language = 'zh_CN';

    public function init()
    {
        parent::init();
        $this->initClientOptions();
    }

    public function initClientOptions()
    {
        $emojiModalId = $this->emojiModalId;
        $js_setup = <<<JS
function setup(editor) {
    editor.on('init', function(e) { 
        
    });
    
    editor.addButton('emojione', {
      image: 'https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f604.png',  // :smile:
      onclick: function () {
          $('#$emojiModalId').modal('toggle');
      }
    });
    
    editor.addMenuItem('myitem', {
      text: 'My menu item',
      context: 'tools',
      onclick: function() {
        // editor.insertContent('&nbsp;Here\'s some content!&nbsp;');
        editor.windowManager.open({
            title: 'example plugin',
            body: [
              { type: 'textbox', name: 'title', label: 'Title' }
            ],
            onsubmit: function(e) {
              // Insert content when the window form is submitted
              // const kebabbyString = _.kebabCase(e.data.title);
              editor.insertContent(e.data.title);
            }
          });
      }
    });
}  /* end of setup */
JS;
        $js_file_picker_callback = <<<JS
function file_picker_callback(callback, value, meta) {
    tinymce.activeEditor.windowManager.open({
        file: '/resources/elfinder/elfinder.html',  // use an absolute path
        title: 'elFinder 2.1',
        width: 900,  
        height: 450,
        resizable: 'yes'
    }, {
        oninsert: function (file, fm) {
          var url, reg, info;
    
          // URL normalization
          url = fm.convAbsUrl(file.url);
          
          // Make file info
          info = file.name + ' (' + fm.formatSize(file.size) + ')';
    
          // Provide file and text for the link dialog
          if (meta.filetype == 'file') {
            callback(url, {text: info, title: info});
          }
    
          // Provide image and alt text for the image dialog
          if (meta.filetype == 'image') {
            callback(url, {alt: info});
          }
    
          // Provide alternative source and posted for the media dialog
          if (meta.filetype == 'media') {
            callback(url);
          }
        }
    });
    return false;
}  /* end of file_picker_callback */
JS;

        $this->clientOptions = [
            'height' => '320',
            'plugins' => [
                "advlist autolink lists link image emoticons charmap print preview anchor wordcount",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | 
                bullist numlist outdent indent | image link media | emojione",
            'menubar' => true,
            'setup' => new JsExpression($js_setup),
            'file_picker_callback' => new JsExpression($js_file_picker_callback),
            'file_picker_types' => 'file image media',
        ];
    }

    /**
     * @inheritdoc
     */
    protected function registerClientScript()
    {
        parent::registerClientScript();
        $view  = $this->view;
        EmojiOneAreaAsset::register($view);

        $emojiModalId = $this->emojiModalId;
        $js = <<<JS
        $("#$emojiModalId").removeClass('fade');  // remove fade effect, it's too slow.
        $("#$emojiModalId").on('shown.bs.modal', function(e) {
            var els = $("#{$emojiModalId}-input").emojioneArea({
                standalone: true,
                pickerPosition: 'right',
                hidePickerOnBlur: false,
                autocomplete: false,
            });
            els[0].emojioneArea.off("emojibtn.click");
            els[0].emojioneArea.on("emojibtn.click", function(button, event) {
                // console.log('event:emojibtn.click', button.data('name')); 
                var emojiCode = button.data('name');
                if(emojiCode) {
                    tinymce.activeEditor.insertContent(emojione.toImage(emojiCode));
                }
                $('#$emojiModalId').modal('toggle');
            });
            // wait for init
            setTimeout(function() {
              els[0].emojioneArea.showPicker();
            }, 500);
        });
        
JS;
        $view->registerJs($js);
    }

    public function run()
    {
        parent::run();

        $emojiModalId = $this->emojiModalId;
        Modal::begin([
            'id' => $this->emojiModalId,
            'header' => '<h4>Choose Emoji</h4>',
        ]);
        echo "<div style='height: 270px;margin-left: 10px;'>";
        echo "<textarea type='text' id='{$emojiModalId}-input'></textarea>";
        echo "</div>";
        Modal::end();
    }
}