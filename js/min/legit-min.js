jQuery(document).ready(function(s){function e(){s(".js-open-site-search").addClass("site-search-open").removeClass("js-open-site-search").addClass("js-close-site-search"),s(".js-site-search").slideDown(),s(".js-site-search .search-field").focus()}function c(){s(".js-close-site-search").removeClass("site-search-open").removeClass("js-close-site-search").addClass("js-open-site-search"),s(".js-site-search").slideUp(),s(".menu .js-open-site-search button").focus()}
// Site Search Dropdown
s(".js-open-site-search").live("click",function(){e()}),s(".js-close-site-search").live("click",function(){c()})});