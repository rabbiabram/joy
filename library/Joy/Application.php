<?php
/**
 * Joy Web Framework
 *
 * Copyright (c) 2008-2009 Netology Foundation (http://www.netology.org)
 * All rights reserved.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL.
 */

/**
 * @package     Joy
 * @author      Hasan Ozgan <meddah@netology.org>
 * @copyright   2008-2009 Netology Foundation (http://www.netology.org)
 * @license     http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @version     $Id: $
 * @link        http://joy.netology.org
 * @since       0.5
 */
class Joy_Application extends Joy_Object
{
    public function __construct($app_dir, $app_env)
    {
        parent::__construct();

        $this->config->application->set("folders/root", $app_dir);

        $this->config->application->loadConfig($app_env);

        // set library include path
        $this->setIncludePath($this->config->application->get("folders/library"));

        // set controller include path
        $this->setIncludePath($this->config->application->get("folders/controller"));

        $this->router = Joy_Router::getInstance();
    }

    public function setIncludePath($path)
    {
        set_include_path($path.PATH_SEPARATOR.get_include_path());
    }

    public function run()
    {
        var_dump("Starting Joy Application...");

        $item = $this->router->match($_SERVER["REQUEST_URI"]);

        if ($item instanceof Joy_Router_Item) {
            // Instance Context
            $context = Joy_Context::getInstance();
            $context->request->setAction($item->getController(), $item->getAction(), $item->getArguments());
            $context->request->setParameters($item->getParameters());
            $context->request->setMethod($item->getMethod());

            // Render Factory
            $render = $item->getRender();

            // Set Theme To Render
            $theme = $item->getTheme();
            $render->setTheme($theme);

            // Set Layout To Render
            $layout = $item->getLayout();
            $render->setLayout($layout);

            // Injection Render In The Response Object
            $context->response->setRender($render);

            // Page Factory
            $page = Joy_Page::factory($item->getPage());

            // Page is building
            $page->build();
        }
        else {
            throw new Joy_Exception_NotFound_Class("Joy_Router_Item class not found");
        }
    }
}
