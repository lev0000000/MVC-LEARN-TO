<?php

namespace PHPFramework;

class Pagination
{

    protected int $countPage; //Количетство страниц

    protected int $currentPage; //Текущая страница

    protected string $uri; //

    public function __construct(
        protected int $totalRecords = 1, //Общее количество записей в таблице 
        protected int $perPage = PAGINATION_SETTINGS['perPage'], //Количество items на странице
        protected int $midSize = PAGINATION_SETTINGS['midSize'], //Соседняя выборка из двух соседних ссылок 
        protected int $maxPages = PAGINATION_SETTINGS['maxPages'], // Максимальное количство страниц
        protected string $tpl = PAGINATION_SETTINGS['tpl'], //Шаблон пагинации
    ) {
        $this->countPage = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage();
        $this->uri = $this->getParams();
        $this->midSize = $this->getMidSize();
        dump($this->midSize);
    }

    protected function getCountPages(): int
    {
        return ceil($this->totalRecords / $this->perPage) ?: 1;
    }

    protected function getCurrentPage(): int
    {
        $page = (int)request()->get('page', 1);

        if ($page < 1 || $page > $this->countPage) {
            abort(404);
        }

        return $page;
    }

    protected function getParams()
    {


        $url = request()->uri;
        $url = parse_url($url);

        $uri = $url['path'];

        if (
            !empty($url['query'])
            && !in_array($url['query'], ['&'])
        ) {
            parse_str($url['query'], $params);
            if (isset($params['page'])) {
                unset($params['page']);
            }

            if (!empty($params)) {
                $uri .= '?' . http_build_query($params);
            }
        }

        return $uri;
    }

    protected function getMidSize(): int
    {
        return ($this->countPage <= $this->maxPages) ? $this->countPage : $this->midSize;
    }

    public function getOffset(): int
    {
        return ($this->currentPage - 1) * $this->perPage;
    }

    public function getHtml()
    {
        $back = '';
        $forward = '';
        $start_page = '';
        $last_page = '';
        $pages_left = [];
        $pages_right = [];
        $current_page = $this->currentPage;

        if ($this->currentPage > 1) {
            $back = $this->getLink($this->currentPage - 1);
        }

        if ($this->currentPage < $this->countPage) {
            $forward = $this->getLink($this->currentPage + 1);
        }

        if ($this->currentPage > $this->midSize + 1) {
            $start_page = $this->getLink(1);
        }

        if ($this->currentPage < ($this->countPage - $this->midSize)) {
            $last_page = $this->getLink($this->countPage);
        }

        for ($i = $this->midSize; $i > 0; $i--) {
            if ($this->currentPage - $i > 0) {
                $pages_left[] = [
                    'link' => $this->getLink($this->currentPage - $i),
                    'number' => $this->currentPage - $i
                ];
            };
        };

        for ($i = 1; $i < $this->midSize; $i++) {
            if ($this->currentPage + $i <= $this->countPage) {
                $pages_right[] = [
                    'link' => $this->getLink($this->currentPage + $i),
                    'number' => $this->currentPage + $i
                ];
            };
        };

        // dump($back, $forward, $last_page, $start_page, $pages_right);


        return view()->renderPartial($this->tpl, compact('back', 'forward', 'start_page', 'last_page', 'pages_left', 'pages_right', 'current_page'));
    }

    protected function getLink($page): string
    {
        // if($page == 1){
        //     return rtrim($this->uri, '?&');
        // }
        if (str_contains($this->uri, '&' || str_contains($this->uri, '?'))) {
            return "/{$this->uri}&page={$page}/";
        } else {
            return "/{$this->uri}?page={$page}/";
        }
    }

    public function __toString()
    {
        return $this->getHtml();
    }
}
