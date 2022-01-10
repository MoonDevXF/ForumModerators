<?php

namespace MDV\ForumModerators\XF\Pub\Controller;

use XF\Mvc\ParameterBag;

class Forum extends XFCP_Forum
{
    public function actionForum(ParameterBag $params)
    {
        $parent = parent::actionForum($params);
        $node_id = $params->node_id;

        $query = \XF::finder('XF:ModeratorContent')
            ->where([
                'content_type' => 'node',
                'content_id' => $node_id
            ])
            ->fetch();
        
        $parent->setParams([
            'moderators' => $query
        ]);

        return $parent;
    }
}