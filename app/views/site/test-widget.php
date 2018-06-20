<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-12
 * Time: 上午2:27
 */
/* @var $this yii\web\View */

$this->title = 'Test Widget';
$this->params['breadcrumbs'][] = $this->title;

\app\assets\FancyTreeAsset::register($this);

/* @var $mainMenuService \app\services\MainMenuService */
$mainMenuService = Yii::$app->get('mainMenuService');
$tree = $mainMenuService->getTree();
$treeJson = json_encode($tree);

$js = <<<JS

$("#btnDeselectAll3").click(function(){
  $("#tree3").fancytree("getTree").visit(function(node){
    node.setSelected(false);
  });
  return false;
});

$("#btnSelectAll3").click(function(){
  $("#tree3").fancytree("getTree").visit(function(node){
    node.setSelected(true);
  });
  return false;
});

 $("#tree3").fancytree({
      checkbox: true,
      selectMode: 3,
      source: $treeJson,
      init: function(event, data) { 
        // Set key from first part of title (just for this demo output)
        data.tree.visit(function(n) {
          // n.key = n.title.split(" ")[0];  // why do this???
          // n.expanded = true;
        });
        // add connector line
        $(".fancytree-container").addClass("fancytree-connectors");
      },
      lazyLoad: function(event, ctx) {
        // ctx.result = {url: "ajax-sub2.json", debugDelay: 1000};
      },
      loadChildren: function(event, ctx) {
        ctx.node.fixSelection3AfterClick();
      },
      select: function(event, data) {
          console.log(data.tree.getSelectedNodes());
          console.log(data.tree.getSelectedNodes(true));
        // Get a list of all selected nodes, and convert to a key array:
        var selKeys = $.map(data.tree.getSelectedNodes(), function(node){
          return node.key;
        });
        $("#echoSelection3").text(selKeys.join(", "));

        // Get a list of all selected TOP nodes
        var selRootNodes = data.tree.getSelectedNodes(true);
        // ... and convert to a key array:
        var selRootKeys = $.map(selRootNodes, function(node){
          return node.key;
        });
        $("#echoSelectionRootKeys3").text(selRootKeys.join(", "));
        // $("#echoSelectionRoots3").text(selRootNodes.join(", "));
      },
      // The following options are only required, if we have more than one tree on one page:
      cookieId: "fancytree-Cb3",
      idPrefix: "fancytree-Cb3-"
});

JS;
$this->registerJs($js);

?>

<p class="description">
    This tree has <b>checkoxes and selectMode 3 (hierarchical multi-selection)</b> enabled.<br>
    Node `n3` features different variations of the <code>unselectable</code> mode.
</p>
<p>
    <a href="#" id="btnSelectAll3">Select all</a> -
    <a href="#" id="btnDeselectAll3">Deselect all</a>
</p>
<div id="tree3"></div>
<div>Selected keys: <span id="echoSelection3">-</span></div>
<div>Selected root keys: <span id="echoSelectionRootKeys3">-</span></div>

<div class="row">
    <div class="col-md-6">

    </div>
</div>
