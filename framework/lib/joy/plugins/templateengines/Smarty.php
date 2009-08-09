<?php

/* (C) 2009 Netology Joy Web Framework, All rights reserved.
 *
 * Author(s):
 *   Hasan Ozgan (meddah@netology.org)
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import("joy.Object");
import("joy.plugins.ITemplateEngine");
import("joy.web.ui.RenderFactory");
import("joy.vendor.Loader");

class joy_plugins_templateengines_Smarty extends joy_Object implements joy_plugins_ITemplateEngine
{
    private $smarty;

    function __construct()
    {
        parent::__construct();

        // Prepare Smarty Folders..
        $framework_root = rtrim($this->Config->Get("joy.root"), "/");
        $app_root = rtrim($this->Config->Get("app.root"), "/");

        $cache = (bool)$this->Config->Get("joy.vendors.smarty.settings.cache");
        $compile_dir = sprintf("%s/%s", $app_root, $this->Config->Get("joy.vendors.smarty.settings.compile_dir"));
        $plugin_dirs[] = sprintf("%s/%s", $framework_root, $this->Config->Get("joy.vendors.smarty.settings.joy_plugins_dir"));
        $plugin_dirs[] = sprintf("%s/%s", $app_root, $this->Config->Get("joy.vendors.smarty.settings.app_plugins_dir"));

        $smartyLoader = new joy_vendor_Loader("smarty");
        $smartyLoader->Import("Smarty.class.php");

        // Set smarty parameters app.vendors.smarty.settings section in config.ini file
        $this->smarty = new Smarty();

        $this->smarty->left_delimiter = "{%";
        $this->smarty->right_delimiter = "%}";
        $this->smarty->compile_dir = $compile_dir;
        $this->smarty->plugins_dir = array_merge((array)$this->smarty->plugins_dir, $plugin_dirs);
    }

    public function Fetch($path)
    {
        return $this->smarty->fetch($path);
    }

    public function Display($path)
    {
        return $this->smarty->display($path);
    }

    public function Assign($key, $value)
    {
        $this->smarty->assign($key, $value);
    }
}


?>
