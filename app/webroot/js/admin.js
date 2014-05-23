/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {
    $('#catalog_level1s_id').on('change', function() {
        var catalogLevel1sId = $(this).val();
        $.ajax({
            type: "POST",
            url: webroot + 'admin/ajaxGetCatalogs2',
            data: {
                'catalogs_level1s_id': catalogLevel1sId,
            },
            success: function(result) {
                var catalog2 = JSON.parse(result);
                if (catalog2.length > 0) {
                    var select = '<select name="catalog_level2s_id" class="catalog_level2s_id" id="catalog_level2s_id">';
                    for (var i = 0; i < catalog2.length; i++) {
                        select += '<option value="' + catalog2[i].id + '">' + catalog2[i].name + '</option>';
                    }
                    select += '</select>';
                    $('#catelogs2').html(select);
                    $.ajax({
                        type: "POST",
                        url: webroot + 'admin/ajaxGetCatalogs3',
                        data: {
                            'catalogs_level2s_id': catalog2[0].id,
                        },
                        success: function(result2) {
                            var catalog3 = JSON.parse(result2);
                            if (catalog3.length > 0) {
                                var select2 = '<select name="catalog_level3s_id" class="catalog_level3s_id" id="catalog_level3s_id">';
                                for (var i = 0; i < catalog3.length; i++) {
                                    select2 += '<option value="' + catalog3[i].id + '">' + catalog3[i].name + '</option>';
                                }
                                select2 += '</select>';
                                $('#catelogs3').html(select2);

                            } else {
                                $('#catelogs3').html('Catalog level 3 is empty!<br />Click <a href="' + webroot + 'admin/create/catalogs3/' + catalog2[0].id + '">here</a> to add');
                            }

                        },
                        error: function() {
                            alert('Cannot load. Please try again.');
                        }
                    });
                } else {
                    $('#catelogs2').html('Catalog level 2 is empty!<br />Click <a href="' + webroot + 'admin/create/catalogs2/' + catalogLevel1sId + '">here</a> to add');
                    $('#catelogs3').html('Catalog level 3 is empty!');
                }

            },
            error: function() {
                alert('Cannot load. Please try again.');
            }
        });
    });

    $('#catalog_level2s_id').on('change', function() {
        var catalogLevel2sId = $(this).val();
        $.ajax({
            type: "POST",
            url: webroot + 'admin/ajaxGetCatalogs3',
            data: {
                'catalogs_level2s_id': catalogLevel2sId,
            },
            success: function(result2) {
                var catalog3 = JSON.parse(result2);
                if (catalog3.length > 0) {
                    var select2 = '<select name="catalog_level3s_id" class="catalog_level3s_id" id="catalog_level3s_id">';
                    for (var i = 0; i < catalog3.length; i++) {
                        select2 += '<option value="' + catalog3[i].id + '">' + catalog3[i].name + '</option>';
                    }
                    select2 += '</select>';
                    $('#catelogs3').html(select2);

                } else {
                    $('#catelogs3').html('Catalog level 3 is empty!<br />Click <a href="' + webroot + 'admin/create/catalogs3/' + catalogLevel2sId + '">here</a> to add');
                }

            },
            error: function() {
                alert('Cannot load. Please try again.');
            }
        });
    });
});
