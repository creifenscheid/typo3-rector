special_page = PAGE
special_page {
    typeNum = 139
    config {
        disableAllHeaderCode = 1
        disablePrefixComment = 1
        xhtml_cleaning = 0
        admPanel = 0
        additionalHeaders.10.header = Content-type: text/html
        no_cache = 1
        debug = 0
    }
}

special_page2 = PAGE
special_page2 {
    typeNum = 139
    config {
        disableAllHeaderCode = 1
        disablePrefixComment = 1
        xhtml_cleaning = 0
        admPanel = 0
        additionalHeaders {
            # This is a comment
            10 {
                header = Content-type: text/html
            }
        }
        no_cache = 1
        debug = 0
    }
}
