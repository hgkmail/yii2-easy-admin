<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-12
 * Time: 下午9:50
 */

namespace app\widgets;


use app\assets\FancyTreeAsset;
use app\models\form\MenuTreeNode;
use Yii;
use yii\base\Widget;

/**
 * Class MenuTreeWidget
 * One page can only have one.
 * @package app\widgets
 */
class MenuTreeWidget extends Widget
{
    public $id = 'menu-tree';

    public $checkbox = true;

    public $buttons = true;

    public $selectMode = 3;

    public $paramSelected = 'tree-selected';

    public $paramPartsel = 'tree-partsel';

    public $paramRootsel = 'tree-rootsel';

    public $menuList;

    public $selectedMenuList;

    public function run()
    {
        $this->registerClientScript();
        $buttonsHidden = $this->buttons?'':'hidden';

        $html = <<<HTML
<p>
    <a href="#" id="btnSelectAll" class="btn btn-primary btn-flat $buttonsHidden">Select all</a>
    <a href="#" id="btnDeselectAll" class="btn btn-danger btn-flat $buttonsHidden">Deselect all</a>
    <a href="#" id="btnExpandAll" class="btn btn-info btn-flat">Expand all</a>
</p>
<div id="$this->id"></div>
<input type="hidden" id="echoSelection" name="$this->paramSelected">
<input type="hidden" id="echoPartSelectionKeys" name="$this->paramPartsel">
<input type="hidden" id="echoSelectionRootKeys" name="$this->paramRootsel">
HTML;

        echo $html;
    }

    public function registerClientScript()
    {
        $view = $this->view;
        $checkbox = $this->checkbox?'true':'false';
        $nodeList = MenuTreeNode::toNodeList($this->menuList);
        FancyTreeAsset::register($view);

        // check selected
        if(!empty($this->selectedMenuList)) {
            $selectedMenuMap = [];
            foreach ($this->selectedMenuList as $selected) {
                $selectedMenuMap[$selected->id] = 1;
            }
            foreach ($nodeList as $n) {
                if(array_key_exists($n->key, $selectedMenuMap)) {
                    $n->isSelect = true;
                }
            }
        }

        /* @var $mainMenuService \app\services\MainMenuService */
        $mainMenuService = Yii::$app->get('mainMenuService');
        $tree = $mainMenuService->convertTree($nodeList);
        $treeJson = json_encode($tree);

        $js = <<<JS
    
var expandAll = false;    
$("#btnDeselectAll").click(function(){
    $("#$this->id").fancytree("getTree").visit(function(node){
      node.setSelected(false);
    });
    return false;
});

$("#btnSelectAll").click(function(){
    $("#$this->id").fancytree("getTree").visit(function(node){
      node.setSelected(true);
    });
    return false;
});

$("#btnExpandAll").click(function() {
    expandAll = !expandAll;
    $("#$this->id").fancytree("getTree").visit(function(node){
        node.setExpanded(expandAll);
    });
    return false;
});

 $("#$this->id").fancytree({
      checkbox: $checkbox,
      selectMode: $this->selectMode,
      source: $treeJson,
      init: function(event, data) {
          // add connector line
          $(".fancytree-container").addClass("fancytree-connectors");  
          // check selected
          data.tree.visit(function(n) {
              if(n.data.isSelect===true) {
                  n.setSelected(true);
              }
          });
      },
      lazyLoad: function(event, ctx) {
      },
      loadChildren: function(event, ctx) {
          if($this->selectMode==3) {
             ctx.node.fixSelection3AfterClick(); 
          }
      },
      select: function(event, data) {
          // selected nodes
          var selKeys = $.map(data.tree.getSelectedNodes(), function(node){
              return node.key;
          });
          $("#echoSelection").val(selKeys.join(","));
          // top nodes
          var selRootNodes = data.tree.getSelectedNodes(true);
          var selRootKeys = $.map(selRootNodes, function(node){
            return node.key;
          });
          $("#echoSelectionRootKeys").val(selRootKeys.join(","));
          // part selected nodes
          var partsel = [];
          data.tree.visit(function(n) {
              if(n.isPartsel()) {
                  partsel.push(n.key);
              }
          });
          $("#echoPartSelectionKeys").val(partsel.join(","));
          // console.log(data.tree.toDict());
      },
      // The following options are only required, if we have more than one tree on one page:
      cookieId: "fancytree-Cb1",
      idPrefix: "fancytree-Cb1-"
});
 
JS;
        $view->registerJs($js);
    }
}