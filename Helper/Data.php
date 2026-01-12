<?php
declare(strict_types=1);

namespace Santi\HomeSeoText\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    public const XML_ENABLED         = 'santi_home_seo_text/home/enabled';
    public const XML_TITLE           = 'santi_home_seo_text/home/title';
    public const XML_HTML            = 'santi_home_seo_text/home/html';
    public const XML_COLLAPSED_LINES = 'santi_home_seo_text/home/collapsed_lines';
    public const XML_LABEL_MORE      = 'santi_home_seo_text/home/label_more';
    public const XML_LABEL_LESS      = 'santi_home_seo_text/home/label_less';

    public function isEnabled(?int $storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_ENABLED, ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function getTitle(?int $storeId = null): string
    {
        return (string) $this->scopeConfig->getValue(self::XML_TITLE, ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function getHtmlRaw(?int $storeId = null): string
    {
        return (string) $this->scopeConfig->getValue(self::XML_HTML, ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function getCollapsedLines(?int $storeId = null): int
    {
        $val = (int) $this->scopeConfig->getValue(self::XML_COLLAPSED_LINES, ScopeInterface::SCOPE_STORE, $storeId);
        return $val > 0 ? $val : 2;
    }

    public function getLabelMore(?int $storeId = null): string
    {
        $val = (string) $this->scopeConfig->getValue(self::XML_LABEL_MORE, ScopeInterface::SCOPE_STORE, $storeId);
        return $val !== '' ? $val : 'Ver más';
    }

    public function getLabelLess(?int $storeId = null): string
    {
        $val = (string) $this->scopeConfig->getValue(self::XML_LABEL_LESS, ScopeInterface::SCOPE_STORE, $storeId);
        return $val !== '' ? $val : 'Ver menos';
    }
}
