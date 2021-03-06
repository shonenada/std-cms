<?php

class Slimx extends \Slim\Slim {

    protected function camel2underline($camel) {
        return strtolower(preg_replace('/((?<=[a-z])(?=[A-Z]))/', '_', $camel));
    }

    protected function mapRoute($args) {
        $pattern = array_shift($args);
        $callable = array_pop($args);
        $route = new Routex($pattern, $callable, $this->settings['routes.case_sensitive']);
        $this->router->map($route);
        if (count($args) > 0) {
            $route->setMiddleware($args);
        }

        return $route;
    }

    protected function registerController($controller) {
        $cls = sprintf("\Controller\\%s", str_replace('.', '\\', $controller));
        $vars = get_class_vars($cls);

        if (array_key_exists('url', $vars))
            $url = $vars['url'];
        else
            $url = '/' . strtolower(str_replace('.', '/', $controller));

        $name = $this->camel2underline(str_replace('.', '_', $controller));

        if (method_exists($cls, 'get'))
            $handler = $this->get($url, "$cls::_get")->name("{$name}_get");

        if (method_exists($cls, 'post'))
            $handler = $this->post($url, "$cls::_post")->name("{$name}_post");

        if (method_exists($cls, 'put'))
            $handler = $this->put($url, "$cls::_put")->name("{$name}_put");

        if (method_exists($cls, 'delete'))
            $handler = $this->delete($url, "$cls::_delete")->name("{$name}_delete");

        if (array_key_exists('conditions', $vars))
            $handler->conditions($vars['conditions']);
    }

    public function loadControllers($controllers) {
        foreach($controllers as $name => $path) {
            $this->registerController($path);
        }
    }

}
