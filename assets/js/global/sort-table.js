import "tablesorter";
import "tablesorter/dist/css/theme.bootstrap.min.css"
import $ from "jquery";

$(() => {
    $('table.sortable').tablesorter({
        theme: 'bootstrap'
    });
});