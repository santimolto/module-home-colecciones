<?php
declare(strict_types=1);

namespace Santi\HomeSeoText\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Store\Model\StoreManagerInterface;
use Santi\HomeSeoText\Helper\Data;

class HomeSeo implements ArgumentInterface
{
    public function __construct(
        private readonly Data $helper,
        private readonly FilterProvider $filterProvider,
        private readonly StoreManagerInterface $storeManager
    ) {}

    public function isEnabled(): bool
    {
        return $this->helper->isEnabled($this->getStoreId());
    }

    public function getTitle(): string
    {
        return $this->helper->getTitle($this->getStoreId());
    }

    public function getCollapsedLines(): int
    {
        return $this->helper->getCollapsedLines($this->getStoreId());
    }

    public function getLabelMore(): string
    {
        return $this->helper->getLabelMore($this->getStoreId());
    }

    public function getLabelLess(): string
    {
        return $this->helper->getLabelLess($this->getStoreId());
    }

    public function getHtml(): string
    {
        $raw = $this->helper->getHtmlRaw($this->getStoreId());
        if (trim($raw) === '') {
            return '';
        }
        return (string) $this->filterProvider->getPageFilter()->filter($raw);
    }

    private function getStoreId(): int
    {
        return (int) $this->storeManager->getStore()->getId();
    }
}
