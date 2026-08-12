<?php

namespace PHPFramework;

class View
{

    public function __construct(
        public string $layout,
        public string $content = ''
    ) {
        $this->layout = $layout;
        $this->content = $content;
    }

    public function render($view, $data = [], $layout = ''): string
    {
        $views_file = VIEWS . "/{$view}.php";
        extract($data);
        if (is_file($views_file)) {
            ob_start();
            require $views_file;
            $this->content = ob_get_clean();
        } else {
            abort("View not found", 500);
        }

        if ($layout === false) {
            return $this->content;
        }

        $layout_file = $layout ?: $this->layout;

        $layout_file = VIEWS . "/layouts/{$layout_file}.php";

        if (is_file($layout_file)) {
            ob_start();
            require $layout_file;
            return ob_get_clean();
        } else {
            abort("Layout not found", 500);
        }
        return 'View rendered';
    }

    public function renderPartial($view, $data = []): string
    {
        $views_file = VIEWS . "/{$view}.php";
        extract($data);
        if (is_file($views_file)) {
            ob_start();
            require $views_file;
            return ob_get_clean();
        } else {
            return "View not found";
        }
    }
}
