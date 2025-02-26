plugin.tx_seo {
    config {
        xmlSitemap {
            sitemaps {
                content {
                    provider = TYPO3\CMS\Seo\XmlSitemap\RecordsXmlSitemapDataProvider
                    config {
                        table = tt_content
                        sortField = sorting
                        lastModifiedField = tstamp
                        changeFreqField = rowDescription
                        priorityField = bodytext
                        pid = 22
                        url {
                            pageId = 1
                            fieldToParameterMap {
                                uid = tx_example_content[id]
                            }
                            useCacheHash = 1
                        }
                    }
                }
            }
        }
    }
}
-----
plugin.tx_seo {
    config {
        xmlSitemap {
            sitemaps {
                content {
                    provider = TYPO3\CMS\Seo\XmlSitemap\RecordsXmlSitemapDataProvider
                    config {
                        table = tt_content
                        sortField = sorting
                        lastModifiedField = tstamp
                        changeFreqField = rowDescription
                        priorityField = bodytext
                        pid = 22
                        url {
                            pageId = 1
                            fieldToParameterMap {
                                uid = tx_example_content[id]
                            }
                        }
                    }
                }
            }
        }
    }
}
