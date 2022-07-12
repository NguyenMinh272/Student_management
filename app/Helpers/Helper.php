<?php
function indexPagination($per_page, $current_page) {
    return $index = $per_page * ($current_page - 1);
}
