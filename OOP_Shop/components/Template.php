<?php


namespace app\components;


use app\exceptions\NotFoundException;

class Template
{

    private string $viewsDir = '';
    private string $defaultLayout = '';
    private string $content = '';
    private array $params = [];


    /**
     * Template constructor.
     * @param string $viewsDir
     * @param string $defaultLayout
     */
    public function __construct(string $viewsDir, string $defaultLayout)
    {
        $this->viewsDir = $viewsDir;
        $this->defaultLayout = $defaultLayout;
    }

    /**
     * @param string $template
     * @param array $params
     * @param string|null $layout
     * @return string
     * @throws NotFoundException
     */
    public function render(string $template, array $params = [], ?string $layout = null)
    {
        $this->params = $params;
        $this->content = $this->getTemplate($template);
        return $this->getTemplate($layout ?: $this->defaultLayout);
    }

    /**
     * @param string $template
     * @return string
     * @throws NotFoundException
     */
    private function getTemplate(string $template) : string
    {
        $templateFile = "{$this->viewsDir}/{$template}.php";
        if(!file_exists($templateFile)){
            throw new NotFoundException("Current template was not found");
        }
        ob_start();
        require $templateFile;
        return ob_get_clean();
    }
}
