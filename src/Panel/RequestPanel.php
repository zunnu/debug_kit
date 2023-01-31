<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace DebugKit\Panel;

use Cake\Controller\Controller;
use Cake\Event\Event;
use DebugKit\DebugPanel;

/**
 * Provides debug information on the Current request params.
 *
 */
class RequestPanel extends DebugPanel
{
    /**
     * Data collection callback.
     *
     * @param \Cake\Event\Event $event The shutdown event.
     * @return void
     */
    public function shutdown(Event $event)
    {
        /* @var \Cake\Controller\Controller $controller */
        $controller = $event->getSubject();
        $request = $controller->getRequest();
        $this->_data = [
            'params' => $request->getAttribute("params"),
            'query' => $request->getQueryParams(),
            'data' => $request->getData(),
            'cookie' => $request->getCookieParams(),
            'get' => $_GET,
            'matchedRoute' => $request->getParam('_matchedRoute'),
            'headers' => ['response' => headers_sent($file, $line), 'file' => $file, 'line' => $line],
        ];
    }
}
