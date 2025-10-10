<?php
namespace App\Core;

class View {
  protected string $basePath;
  protected array $sections = [];
  protected array $sectionStack = [];
  protected $layout;
  protected array $layoutData = [];

  public function __construct(string $basePath){ $this->basePath = rtrim($basePath,'/'); }

  public function render(string $view, array $data=[]): string {
    $viewFile = $this->basePath.'/'.$view.'.php';
    if (!is_file($viewFile)) throw new \RuntimeException("View not found: $viewFile");
    
    // Make $this available in the view
    $that = $this;
    extract($data, EXTR_SKIP);
    
    ob_start();
    include $viewFile;
    $content = ob_get_clean();

    if ($this->layout) {
      $layoutFile = $this->basePath.'/'.$this->layout.'.php';
      $this->layout = null;
      $data = array_merge($this->layoutData, ['content'=>$content]);
      return $this->renderPath($layoutFile, $data);
    }
    return $content;
  }

  public function layout(string $layout, array $data=[]): void { $this->layout = $layout; $this->layoutData = $data; }

  public function partial(string $partial, array $data=[]): string {
    $file = $this->basePath.'/'.$partial.'.php';
    return $this->renderPath($file, $data);
  }

  private function renderPath(string $file, array $data=[]): string {
    if (!is_file($file)) throw new \RuntimeException("Partial/Layout not found: $file");
    extract($data, EXTR_SKIP);
    ob_start(); include $file; return ob_get_clean();
  }
}