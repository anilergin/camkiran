(function($){
    "use strict";
    var G5Plus_Widget = {
        init: function(){
            this.event();
            this.widget_select2();
        },
        event: function(){
            $(document).on('widget-added', G5Plus_Widget.widget_select2);
            $(document).on('widget-updated', G5Plus_Widget.widget_select2);
        },
        widget_select2: function(event, widget){
            if (typeof (widget) == "undefined") {
                $('#widgets-right select.widget-select2:not(.select2-ready)').each(function(){
                    G5Plus_Widget.widget_select2_item(this);
                });
            }
            else {
                $('select.widget-select2:not(.select2-ready)', widget).each(function(){
                    G5Plus_Widget.widget_select2_item(this);
                });
            }
        },
        widget_select2_item: function(target){
            $(target).addClass('select2-ready');
            $(target).select2({width : '100%'});
            var $multiple = $(target).attr('multiple');
            if (typeof($multiple) != 'undefined') {

                var data_value = $(target).attr('data-value').split(',');

                var is_version_4 = $(target).hasClass('select2-hidden-accessible');
                if (is_version_4) {
                    for (var i = 0; i < data_value.length; i++) {
                        var $element = $(target).find('option[value="'+ data_value[i] +'"]');
                        $element.detach();
                        $(target).append($element);
                    }
                    $(target).val(data_value).trigger('change');
                    $(target).on('select2:selecting',function(e){
                        var ids = $('input',$(this).parent()).val();
                        if (ids != "") {
                            ids +=",";
                        }
                        ids += e.params.args.data.id;
                        $('input',$(this).parent()).val(ids);
                    }).on('select2:unselecting',function(e){
                        var ids = $('input',$(this).parent()).val();
                        var arr_ids = ids.split(",");
                        var newIds = "";
                        for(var i = 0 ; i < arr_ids.length; i++) {
                            if (arr_ids[i] != e.params.args.data.id){
                                if (newIds != "") {
                                    newIds +=",";
                                }
                                newIds += arr_ids[i];
                            }
                        }
                        $('input',$(this).parent()).val(newIds);
                    }).on('select2:select',function(e){
                        var element = e.params.data.element;
                        var $element = $(element);

                        $element.detach();
                        $(this).append($element);
                        $(this).trigger("change");
                    });
                } else {
                    var choices = [];
                    if (data_value.length > 0) {
                        for (var j = 0; j < data_value.length; j++) {
                            if (data_value[j] == '') continue;
                            var option = $('option[value="'+ data_value[j]  + '"]', $(target));
                            choices[j] = { 'id':data_value[j], 'text':option.text()};
                        }
                        $(target).select2('data', choices);
                    }

                    $(target).on('select2-selecting',function(e){
                        var ids = $('input',$(this).parent()).val();
                        if (ids != "") {
                            ids +=",";
                        }
                        ids += e.val;
                        $('input',$(this).parent()).val(ids);
                    }).on('select2-removed',function(e){
                        var ids = $('input',$(this).parent()).val();
                        var arr_ids = ids.split(",");
                        var newIds = "";
                        for(var i = 0 ; i < arr_ids.length; i++) {
                            if (arr_ids[i] != e.val){
                                if (newIds != "") {
                                    newIds +=",";
                                }
                                newIds += arr_ids[i];
                            }
                        }
                        $('input',$(this).parent()).val(newIds);
                    });
                }
            }
        }
    };

    $(document).ready(function(){
        G5Plus_Widget.init();
    });
})(jQuery);