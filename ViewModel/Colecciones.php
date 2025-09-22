<?php
declare(strict_types=1);

namespace Santi\HomeColecciones\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\UrlInterface;

class Colecciones implements ArgumentInterface
{
    public function __construct(
        private StoreManagerInterface $storeManager,
        private ScopeConfigInterface $scopeConfig
    ) {}

    public function getItems(): array
    {
        $store     = $this->storeManager->getStore();
        $mediaBase = rtrim($store->getBaseUrl(UrlInterface::URL_TYPE_MEDIA), '/');
        $base      = rtrim($store->getBaseUrl(), '/');

        $items = [];
        for ($i = 1; $i <= 3; $i++) {
            $p = "santi_home_colecciones/home/item{$i}/";
            $enabled = (string)($this->get($p . 'enabled', '0'));
            if ($enabled !== '1') continue;

            $image  = (string)$this->get($p . 'image', '');
            $alt    = (string)$this->get($p . 'image_alt', '');
            $label  = (string)$this->get($p . 'label', '');
            $url    = (string)$this->get($p . 'url', '');
            $order  = (int)$this->get($p . 'sort_order', 0);

            $imageUrl = $image ? $mediaBase . '/' . ltrim($image, '/') : null;

            if ($url && !preg_match('#^https?://#i', $url) && $url[0] !== '/') {
                $url = $base . '/' . ltrim($url, '/');
            }

            if (!$imageUrl && !$label && !$url) {
                continue;
            }

            $items[] = [
                'image_url'  => $imageUrl,
                'image_alt'  => $alt,
                'label'      => $label,
                'url'        => $url,
                'sort_order' => $order,
            ];
        }

        usort($items, fn($a,$b) => ($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0));
        return $items;
    }

    private function get(string $path, $default = null)
    {
        $v = $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE);
        return $v !== null ? $v : $default;
    }
}
