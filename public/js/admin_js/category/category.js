var Category = {
    appendCategoryOptions: function (options) {
        var html = '';
        $.each(options.categories, function (key, value) { 
            html += "<option value='" + value.id + "'>" + value.category_name + "</option>";

             $.each(value.sub_categories, function(subKey, subValue) {
                html += "<option value='" + subValue.id + "'> -> " + subValue.category_name + "</option>";
             });
        });

        $("#section-category option:not(:first)").remove()
        $("#section-category").append(html);
    }
}
