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
\app\assets\NumberInputAsset::register($this);
\app\assets\FaIconPickerAsset::register($this);
\app\assets\NestableAsset::register($this);

/* @var $mainMenuService \app\services\MainMenuService */
$mainMenuService = Yii::$app->get('mainMenuService');
$tree = $mainMenuService->getTree();
$treeJson = json_encode($tree);

$css = <<<CSS

CSS;
$this->registerCss($css);

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
 
$('#after').bootstrapNumber({    // must with bootstrap
	upClass: 'primary',
	downClass: 'primary',
	center: true,
});

$('.icp').iconpicker({});

$('.dd').nestable({ /* config options */ });

$('.dd').on('change', function() {
    /* on change event */
    console.log('nestable', $('.dd').nestable('serialize'));
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
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">After:</label>
            <input id="after" class="form-control" type="number" value="5" min="1" max="10" />
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="input-group">
            <input data-placement="bottomRight" class="form-control icp icp-auto" value="fas fa-archive"
                   type="text"/>
            <span class="input-group-addon"></span>
        </div>
    </div>
</div>

<!-- dd:container(div) dd-list:list(ol/ul) dd-item:item(li) dd-handle:event(div) -->
<div class="row">
    <div class="col-md-6">
        <div class="dd">
            <ol class="dd-list">
                <li class="dd-item" data-id="1">
                    <div class="dd-handle">Item 1</div>
                </li>
                <li class="dd-item" data-id="2">
                    <div class="dd-handle">Item 2</div>
                    <ol class="dd-list">
                        <li class="dd-item" data-id="6">
                            <div class="dd-handle">Item 6</div>
                        </li>
                    </ol>
                </li>
                <li class="dd-item" data-id="3">
                    <div class="dd-handle">Item 3</div>
                    <ol class="dd-list">
                        <li class="dd-item" data-id="4">
                            <div class="dd-handle">Item 4</div>
                        </li>
                        <li class="dd-item" data-id="5">
                            <div class="dd-handle">Item 5</div>
                        </li>
                    </ol>
                </li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-5">
        <div class="dd" id="nestable3">
            <ol class="dd-list">
                <li class="dd-item dd3-item" data-id="13">
                    <div class="dd-handle dd3-handle"></div><div class="dd3-content">Item 13
                        <a data-toggle="collapse" href="#dd3-collapse" class="pull-right">toggle</a>
                    </div>
                    <div class="collapse" id="dd3-collapse">
                        <p>aaa</p>
                        <p>bbb</p>
                        <p>ccc</p>
                    </div>
                </li>
                <li class="dd-item dd3-item" data-id="14">
                    <div class="dd-handle dd3-handle"></div><div class="dd3-content">Item 14</div>
                </li>
                <li class="dd-item dd3-item" data-id="15">
                    <div class="dd-handle dd3-handle"></div><div class="dd3-content">Item 15</div>
                    <ol class="dd-list">
                        <li class="dd-item dd3-item" data-id="16">
                            <div class="dd-handle dd3-handle"></div><div class="dd3-content">Item 16</div>
                        </li>
                        <li class="dd-item dd3-item" data-id="17">
                            <div class="dd-handle dd3-handle"></div><div class="dd3-content">Item 17</div>
                        </li>
                        <li class="dd-item dd3-item" data-id="18">
                            <div class="dd-handle dd3-handle"></div><div class="dd3-content">Item 18</div>
                        </li>
                    </ol>
                </li>
            </ol>
        </div>
    </div>
</div>
