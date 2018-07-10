<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-5
 * Time: 下午3:59
 */

namespace app\base;


use yii\data\ArrayDataProvider;

class TreeArrayDataProvider extends ArrayDataProvider
{
    public $label_field = 'label';

    protected function prepareModels()
    {
        if (($models = $this->allModels) === null) {
            return [];
        }

        $walker = new MenuGridWalker();
        $walker->label_field = $this->label_field;
        if (($sort = $this->getSort()) !== false) {
            $models = $this->sortModels($models, $sort);
        }

        if (($pagination = $this->getPagination()) !== false) {
            $pagination->totalCount = $walker->get_number_of_root_elements($models);
            $walker->paged_walk($models, 0, $pagination->page+1, $pagination->pageSize);

            if ($pagination->getPageSize() > 0) {
//                $models = array_slice($models, $pagination->getOffset(), $pagination->getLimit(), true);
                $models = $walker->items;
            }
        }

        return $models;
    }
}