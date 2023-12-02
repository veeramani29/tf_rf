function importowners_kigo()
{
    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/import_owners_kigo",
        async: true,
        dataType: 'json',
        beforeSend: function() {
            $('#loading_layer').css('display', 'block');
            $("#loading_layer").addClass("loading_layer");
            $("#result_owners").addClass("loading_back");
        },
        success: function(data) {
            $('#loading_layer').css('display', 'none');
            $("#loading_layer").removeClass("loading_layer");
            $("#result_owners").removeClass("loading_back");
            location.reload();
        }
    });
}

function importproperties_kigo()
{
    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/import_properties_kigo",
        async: true,
        dataType: 'json',
        beforeSend: function() {
            $('#loading_layer').css('display', 'block');
            $("#loading_layer").addClass("loading_layer");
            $("#result_properties").addClass("loading_back");
        },
        success: function(data) {
            $('#loading_layer').css('display', 'none');
            $("#loading_layer").removeClass("loading_layer");
            $("#result_properties").removeClass("loading_back");
            location.reload();
        }
    });
}

function push_owners_to_kigo()
{
    if ($(".case:checked").length == false)
    {
        alert("Please select atleast one Owner's notification");
        return false;
    }
    else if ($(".case:checked").length > 5)
    {
        alert("Only 5 Owners notifications can be pushed at one time");
        return false;
    }
    else
    {
        $('#loading_layer').css('display', 'block');
        $("#loading_layer").addClass("loading_layer");
        $("#result_owners").addClass("loading_back");
        var data = [];
        var data1 = [];

        $('.case:checked').each(function() {
            var res = $(this).val().split(',');
            data.push(res[0]);
            data1.push(res[1]);
        });

        var data_post = {};
        data_post['onwer_id'] = data;
        data_post['notification_id'] = data1;

        $.ajax({
            type: 'POST',
            url: api_url + "apartment_kigo/update_owner_kigo",
            async: true,
            dataType: 'json',
            data: data_post,
            success: function(data) {
                location.reload();
            }
        });
    }
}
function push_new_owners_to_kigo()
{
    if ($(".case_new:checked").length == false)
    {
        alert("Please select atleast one Owner's notification");
        return false;
    }
    else if ($(".case_new:checked").length > 5)
    {
        alert("Only 5 Owners notifications can be pushed at one time");
        return false;
    }
    else
    {
        $('#loading_layer_new').css('display', 'block');
        $("#loading_layer_new").addClass("loading_layer");
        $("#result_owners_new").addClass("loading_back");

        var data = [];
        var data1 = [];

        $('.case_new:checked').each(function() {
            var res = $(this).val().split(',');
            data.push(res[0]);
            data1.push(res[1]);
        });

        var data_post = {};
        data_post['onwer_id'] = data;
        data_post['notification_id'] = data1;
        $.ajax({
            type: 'POST',
            url: api_url + "apartment_kigo/add_owner_kigo",
            async: true,
            dataType: 'json',
            data: data_post,
            success: function(data) {
                location.reload();
            }
        });

    }
}

function import_udpa_kigo()
{
    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/import_property_udpa_kigo",
        async: true,
        dataType: 'json',
        beforeSend: function() {
            $('#loading_layer').css('display', 'block');
            $("#loading_layer").addClass("loading_layer");
            $("#result_udpa").addClass("loading_back");
        },
        success: function(data) {
            $('#loading_layer').css('display', 'none');
            $("#loading_layer").removeClass("loading_layer");
            $("#result_udpa").removeClass("loading_back");
            location.reload();
        }
    });
}

function import_countires_kigo()
{
    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/import_countires_kigo",
        async: true,
        dataType: 'json',
        beforeSend: function() {
            $('#loading_layer').css('display', 'block');
            $("#loading_layer").addClass("loading_layer");
            $("#result_countires").addClass("loading_back");
        },
        success: function(data) {
            $('#loading_layer').css('display', 'none');
            $("#loading_layer").removeClass("loading_layer");
            $("#result_countires").removeClass("loading_back");
            location.reload();
        }
    });
}

function import_pdtp_kigo()
{
    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/import_pdtp_kigo",
        async: true,
        dataType: 'json',
        beforeSend: function() {
            $('#loading_layer').css('display', 'block');
            $("#loading_layer").addClass("loading_layer");
            $("#result_pdtp").addClass("loading_back");
        },
        success: function(data) {
            $('#loading_layer').css('display', 'none');
            $("#loading_layer").removeClass("loading_layer");
            $("#result_pdtp").removeClass("loading_back");
            location.reload();
        }
    });
}

function import_amenties_kigo()
{
    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/import_amenties_kigo",
        async: true,
        dataType: 'json',
        beforeSend: function() {
            $('#loading_layer').css('display', 'block');
            $("#loading_layer").addClass("loading_layer");
            $("#result_amenties").addClass("loading_back");
        },
        success: function(data) {
            $('#loading_layer').css('display', 'none');
            $("#loading_layer").removeClass("loading_layer");
            $("#result_amenties").removeClass("loading_back");
            location.reload();
        }
    });
}

function import_activities_kigo()
{
    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/import_activities_kigo",
        async: true,
        dataType: 'json',
        beforeSend: function() {
            $('#loading_layer').css('display', 'block');
            $("#loading_layer").addClass("loading_layer");
            $("#result_activities").addClass("loading_back");
        },
        success: function(data) {
            $('#loading_layer').css('display', 'none');
            $("#loading_layer").removeClass("loading_layer");
            $("#result_activities").removeClass("loading_back");
            //location.reload();
        }
    });
}

function import_feestypes_kigo()
{
    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/import_feestypes_kigo",
        async: true,
        dataType: 'json',
        beforeSend: function() {
            $('#loading_layer').css('display', 'block');
            $("#loading_layer").addClass("loading_layer");
            $("#result_fees_types").addClass("loading_back");
        },
        success: function(data) {
            $('#loading_layer').css('display', 'none');
            $("#loading_layer").removeClass("loading_layer");
            $("#result_fees_types").removeClass("loading_back");
            location.reload();
        }
    });
}

function import_property_types_kigo()
{
    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/import_propertytypes_kigo",
        async: true,
        dataType: 'json',
        beforeSend: function() {
            $('#loading_layer').css('display', 'block');
            $("#loading_layer").addClass("loading_layer");
            $("#result_property_types").addClass("loading_back");
        },
        success: function(data) {
            $('#loading_layer').css('display', 'none');
            $("#loading_layer").removeClass("loading_layer");
            $("#result_property_types").removeClass("loading_back");
            location.reload();
        }
    });
}

function importpropertiesphotos_kigo()
{
    if ($(".case:checked").length == false)
    {
        alert("Please select atleast one Property");
        return false;
    }
    else if ($(".case:checked").length > 5)
    {
        alert("Only 5 Property Photos can be imported at one time");
        return false;
    }
    else
    {
        $('#loading_layer').css('display', 'block');
        $("#loading_layer").addClass("loading_layer");
        $("#result_properties").addClass("loading_back");
        var i = 1;
        var data = [];
        $('.case:checked').each(function() {
            data.push($(this).val());
        });

        var data_post = {};
        data_post['property_id'] = data;
        $.ajax({
            type: 'POST',
            url: api_url + "apartment_kigo/importPropertyPhotos",
            async: true,
            dataType: 'json',
            data: data_post,
            success: function(data) {
                $('#loading_layer').css('display', 'none');
                $("#loading_layer").removeClass("loading_layer");
                $("#result_properties").removeClass("loading_back");
                location.reload();
                i++;
            }
        });
    }
}

function importpropertiespricing_kigo()
{
    if ($(".case_new:checked").length == false)
    {
        alert("Please select atleast one Property");
        return false;
    }
    else if ($(".case_new:checked").length > 5)
    {
        alert("Only 5 Property Pricing can be imported at one time");
        return false;
    }
    else
    {
        $('#loading_layer').css('display', 'block');
        $("#loading_layer").addClass("loading_layer");
        $("#result_properties").addClass("loading_back");
        var i = 1;
        var data = [];
        $('.case_new:checked').each(function() {
            data.push($(this).val());
        });

        var data_post = {};
        data_post['property_id'] = data;
        $.ajax({
            type: 'POST',
            url: api_url + "apartment_kigo/importPropertyPricing",
            async: true,
            dataType: 'json',
            data: data_post,
            success: function(data) {
                $('#loading_layer').css('display', 'none');
                $("#loading_layer").removeClass("loading_layer");
                $("#result_properties").removeClass("loading_back");
                location.reload();
                i++;
            }
        });
    }
}

function get_property_bed_types(prop_id)
{
    var data = {};
    data['bed_type'] = $("#validation_property_beds").val();
    data['prop_id'] = prop_id;

    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/get_property_bed_types",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            $('#modal-content1').html(data.result);
        }
    });

}


function change_max_occupancy(value) {
    value++;
    var Html = '<select style="width: 50%;" name="perguest_sel_max_occupancy" id="perguest_sel_max_occupancy" class="select2 form-control">';
    for (i = value; i <= 30; i++)
    {
        Html += '<option value="' + i + '">' + i + '</option>';
    }
    Html += '</select>';
    $('#max_occu_dyn').html(Html);
}

function get_max_abc_info(value)
{
    var data = {};
    data['value'] = value;

    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/get_max_abc_info",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            $('#max_adults').html(data.adult_result);
            $('#max_child').html(data.child_html);
            $('#max_babies').html(data.baby_html);
        }
    });
}

function get_min_stay_value(value, select_id)
{
    var data = {};
    data['value'] = value;
    data['select_id'] = select_id;

    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/get_min_stay_value",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            $('#min_stay').html(data.result);
        }
    });
}

function get_min_price_stay_value(value, id, select_id)
{
    var data = {};
    data['value'] = value;
    data['select_id'] = select_id;

    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/get_price_min_stay_value",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            $('#price_min_stay_' + id).html(data.result);
        }
    });
}

function get_unit_stay_value(value, select_id)
{
    var data = {};
    data['value'] = value;
    data['select_id'] = select_id;

    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/get_min_stay_value",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            $('#stay_unit_value').html(data.result);
        }
    });
}

function get_period_range_value(value)
{
    var data = {};
    data['value'] = value;

    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/get_period_range_value",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            $('#period_range_unit_content').html(data.result);
        }
    });
}


function get_max_stay_value(value)
{
    var data = {};
    data['value'] = value;

    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/get_max_stay_value",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            $('#max_stay').html(data.result);
        }
    });
}

function ac_de_discounts(id)
{
    if ($("#" + id + ":checked").length == false)
    {
        $("#" + id + "_content").css('display', 'none');
    }
    else
    {
        $("#" + id + "_content").css('display', 'block');
    }
}

function delete_lmd(value)
{
    $('#lmd_' + value).remove();
    var value = $('#lmd_no').val();
    value--;

    $('#lmd_no').val(value);
    if (value == 0)
    {
        $('#lastminute_discounts').prop('checked', false);
    }
}

function delete_spd(value)
{
    $('#spd_' + value).remove();
    var value = $('#spd_no').val();
    value--;

    $('#spd_no').val(value);
    if (value == 0)
    {
        $('#special_discounts').prop('checked', false);
    }
}

function add_lmd()
{
    var value = $('#lmd_no').val();
    value++;

    if (value > 0)
    {
        $('#lastminute_discounts').prop('checked', true);
    }

    var data = {};
    data['value'] = value;

    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/get_lmd",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            $(data.result).insertAfter(".lmd");
            $('#lmd_no').val(value);
        }
    });
}

function add_spd()
{
    var value = $('#spd_no').val();
    value++;

    if (value > 0)
    {
        $('#special_discounts').prop('checked', true);
    }

    var data = {};
    data['value'] = value;

    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/get_spd",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            $(data.result).insertAfter(".spd");
            $('#spd_no').val(value);
        }
    });
}

function delete_photo(id)
{
    $('#' + id).remove();
}


function get_property_pgc()
{
    var data = {};
    data['perguest_type'] = $('#perguest_type').val();
    data['perguest_standard_occupancy'] = $('#perguest_standard_occupancy').val();
    data['perguest_max_occupancy'] = $('#perguest_max_occupancy').val();

    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/get_property_perguest",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            $('#modal-content2').html(data.result);
        }
    });

}

function change_property_pgc() {
    
    $(".weekly_rental").each(function() {
        $(this).prop("checked", false);
    });
    
    var perguest_type = $('#perguest_sel_type').val();
    var perguest_standard_occupancy = $('#perguest_sel_standard_occupancy').val();
    var perguest_max_occupancy = $('#perguest_sel_max_occupancy').val();

    $('#perguest_type').val(perguest_type);
    $('#perguest_standard_occupancy').val(perguest_standard_occupancy);
    $('#perguest_max_occupancy').val(perguest_max_occupancy);

    var period_range_count = $('.period_range_count').val();

    var data = {};
    data['perguest_standard_occupancy'] = perguest_standard_occupancy;
    data['perguest_max_occupancy'] = perguest_max_occupancy;
    data['period_range_count'] = period_range_count;
    data['period_range_json_value'] = JSON.parse(atob($('.period_range_json_value').val()));
    data['period_total_count'] = parseInt($('#period_total_count').val());

    if ($('#enable_now').prop("checked"))
    {
        data['enable_now'] = 1;
    }
    else
    {
        data['enable_now'] = 0;
    }
    if ($('#enable_pgc').prop("checked"))
    {
        data['enable_pgc'] = 1;
    }
    else
    {
        data['enable_pgc'] = 0;
    }

    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/get_changed_property_now_epc",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {

            for (var i = 0; i <= data.result.length; i++)
            {
                $("#property_pricing_display_" + i + " > tbody").html("");
                $("#property_pricing_display_" + i + " > tbody").html(data.result[i]);
            }
            var i = 0;
            $(".add_new_now_class").each(function() {
                $(this).attr('onclick', 'add_new_now("1","add_new_now_' + i + '")');
                i++;
            });
        }
    });

    $('#modal-example2').modal('hide');
}

function ed_property_pgc() {
    
    $(".weekly_rental").each(function() {
        $(this).prop("checked", false);
    });
    
    if ($('#enable_pgc').prop("checked"))
    {
        if ($('#settings_pgc').lenght > 0)
        {
            $('#settings_pgc').css('display', 'block');
        }
        else
        {
            var settings_pgc_content = '<a  id="settings_pgc" style="padding-top: 4px; float: left;font-size: 10px;font-weight: bold;padding-left: 10px;text-decoration: underline;"  title="Change Settings" data-placement="top" href="#modal-example2" data-toggle="modal" onclick="get_property_pgc();">Change Settings</a>';
            $('#settings_pgc_content').html(settings_pgc_content);
        }

        $('#perguest_type').val('ADULT');
        $('#perguest_standard_occupancy').val('1');
        $('#perguest_max_occupancy').val('2');

        var data = {};
        data['perguest_standard_occupancy'] = $('#perguest_standard_occupancy').val();
        data['perguest_max_occupancy'] = $('#perguest_max_occupancy').val();
        data['period_range_count'] = $('.period_range_count').val();
        if ($('#enable_now').prop("checked"))
        {
            data['enable_now'] = 1;
        }
        else
        {
            data['enable_now'] = 0;
        }
        data['enable_pgc'] = 1;
        data['period_range_json_value'] = JSON.parse(atob($('.period_range_json_value').val()));
        data['period_total_count'] = parseInt($('#period_total_count').val());

        $.ajax({
            type: 'POST',
            url: api_url + "apartment_kigo/get_changed_property_now_epc",
            async: true,
            dataType: 'json',
            data: data,
            success: function(data) {
                for (var i = 0; i <= data.result.length; i++)
                {
                    $("#property_pricing_display_" + i + " > tbody").html("");
                    $("#property_pricing_display_" + i + " > tbody").html(data.result[i]);
                }

                var i = 0;
                $(".add_new_now_class").each(function() {
                    $(this).attr('onclick', 'add_new_now("1","add_new_now_' + i + '")');
                    i++;
                });

            }
        });
    }
    else
    {
        $('#settings_pgc').css('display', 'none');
        var data = {};
        data['perguest_standard_occupancy'] = 0;
        data['perguest_max_occupancy'] = 0;

        $('#perguest_standard_occupancy').val(data['perguest_standard_occupancy']);
        $('#perguest_max_occupancy').val(data['perguest_max_occupancy']);

        var period_range_count = $('.period_range_count').val();
        data['period_range_count'] = period_range_count;

        if ($('#enable_now').prop("checked"))
        {
            data['enable_now'] = 1;
        }
        else
        {
            data['enable_now'] = 0;
        }
        data['enable_pgc'] = 0;
        data['period_range_json_value'] = JSON.parse(atob($('.period_range_json_value').val()));
        data['period_total_count'] = parseInt($('#period_total_count').val());

        $.ajax({
            type: 'POST',
            url: api_url + "apartment_kigo/get_changed_property_now_epc",
            async: true,
            dataType: 'json',
            data: data,
            success: function(data) {
                for (var i = 0; i <= data.result.length; i++)
                {
                    $("#property_pricing_display_" + i + " > tbody").html("");
                    $("#property_pricing_display_" + i + " > tbody").html(data.result[i]);
                }
                var i = 0;
                $(".add_new_now_class").each(function() {
                    $(this).attr('onclick', 'add_new_now("1","add_new_now_' + i + '")');
                    i++;
                });
            }
        });
    }
}

function ed_property_now()
{
    $(".weekly_rental").each(function() {
        $(this).prop("checked",false);
    });
    
    if ($('#enable_now').prop("checked"))
    {
        var data = {};
        data['perguest_standard_occupancy'] = $('#perguest_standard_occupancy').val();
        data['perguest_max_occupancy'] = $('#perguest_max_occupancy').val();
        data['period_range_count'] = $('.period_range_count').val();
        data['enable_now'] = 1;
        if ($('#enable_pgc').prop("checked"))
        {
            data['enable_pgc'] = 1;
        }
        else
        {
            data['enable_pgc'] = 0;
        }
        data['period_range_json_value'] = JSON.parse(atob($('.period_range_json_value').val()));
        data['period_total_count'] = parseInt($('#period_total_count').val());

        $.ajax({
            type: 'POST',
            url: api_url + "apartment_kigo/get_changed_property_now_epc",
            async: true,
            dataType: 'json',
            data: data,
            success: function(data) {
                for (var i = 0; i <= data.result.length; i++)
                {
                    $("#property_pricing_display_" + i + " > tbody").html("");
                    $("#property_pricing_display_" + i + " > tbody").html(data.result[i]);
                }

                var sHtml = '<tr><td><a onclick="add_new_now("1", this.id);" id="add_new_now_1" class="add_new_now_class" href="javascript:void(0);">Add a new night-of-week group</a></td></tr>';
                $(".add_new_now > tbody").html(sHtml);
                var i = 0;
                $(".add_new_now_class").each(function() {
                    $(this).attr('id', 'add_new_now_' + i);
                    $(this).attr('onclick', 'add_new_now("1","add_new_now_' + i + '")');
                    i++;
                });
            }
        });
    }
    else
    {
        var data = {};
        data['perguest_standard_occupancy'] = $('#perguest_standard_occupancy').val();
        data['perguest_max_occupancy'] = $('#perguest_max_occupancy').val();
        data['period_range_count'] = $('.period_range_count').val();
        data['enable_now'] = 0;
        if ($('#enable_pgc').prop("checked"))
        {
            data['enable_pgc'] = 1;
        }
        else
        {
            data['enable_pgc'] = 0;
        }
        data['period_range_json_value'] = JSON.parse(atob($('.period_range_json_value').val()));
        data['period_total_count'] = parseInt($('#period_total_count').val());

        $.ajax({
            type: 'POST',
            url: api_url + "apartment_kigo/get_changed_property_now_epc",
            async: true,
            dataType: 'json',
            data: data,
            success: function(data) {

                for (var i = 0; i <= data.result.length; i++)
                {
                    $("#property_pricing_display_" + i + " > tbody").html("");
                    $("#property_pricing_display_" + i + " > tbody").html(data.result[i]);
                }
                $(".add_new_now > tbody").html("");

                var i = 0;
                $(".add_new_now_class").each(function() {
                    $(this).attr('onclick', 'add_new_now("1","add_new_now_' + i + '")');
                    i++;
                });
            }
        });
    }
}

function add_new_now(now_count, id) {
    var data = {};

    data['period_range_count'] = $('.period_range_count').val();
    data['enable_now'] = 1;
    if ($('#enable_pgc').prop("checked"))
    {
        data['perguest_standard_occupancy'] = $('#perguest_standard_occupancy').val();
        data['perguest_max_occupancy'] = $('#perguest_max_occupancy').val();
        data['enable_pgc'] = 1;
    }
    else
    {
        data['perguest_standard_occupancy'] = 0;
        data['perguest_max_occupancy'] = 0;
        data['enable_pgc'] = 0;
    }
    data['period_range_json_value'] = JSON.parse(atob($('.period_range_json_value').val()));
    var lastItem = id.split("_").pop(-1);
    data['period_total_count'] = lastItem;
    data['now_count'] = now_count;
    data['id'] = id;

    if (now_count < 7)
    {
        now_count++;
        $('#' + id).attr('onclick', 'add_new_now("' + now_count + '","' + id + '")');
        $.ajax({
            type: 'POST',
            url: api_url + "apartment_kigo/add_new_now",
            async: true,
            dataType: 'json',
            data: data,
            success: function(data) {
                $("#property_pricing_display_" + lastItem + " tbody").append(data.result);
            }
        });
    }
    else
    {
        alert("You can not add more than 7 nights");
    }
}

function delete_period(id)
{
    $('#' + id).remove();
    var period_total_count = parseInt($('#period_total_count').val());
    period_total_count--;
    $('#period_total_count').val(period_total_count);
}

function add_new_period(returntype)
{
    var data = {};

    data['period_range_count'] = $('.period_range_count').val();
    data['period_total_count'] = parseInt($('#period_total_count').val());

    var period_total_count = data['period_total_count'];
    var temp = period_total_count + 1;
    $('#period_total_count').val(temp);

    data['period_range_value'] = $('.period_range_value').val();

    if ($('#enable_now').prop("checked"))
    {
        data['enable_now'] = 1;
    }
    else
    {
        data['enable_now'] = 0;
    }

    if ($('#enable_pgc').prop("checked"))
    {
        data['perguest_standard_occupancy'] = $('#perguest_standard_occupancy').val();
        data['perguest_max_occupancy'] = $('#perguest_max_occupancy').val();
        data['enable_pgc'] = 1;
    }
    else
    {
        data['perguest_standard_occupancy'] = 0;
        data['perguest_max_occupancy'] = 0;
        data['enable_pgc'] = 0;
    }
    data['period_range_json_value'] = JSON.parse(atob($('.period_range_json_value').val()));

    $.ajax({
        type: 'POST',
            url: api_url + "apartment_kigo/add_new_period",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            $('.main_container_content').last().after(data.result);
        }
    });

}

function add_new_night_period() {
    var period_range_json_value = JSON.parse(atob($('.period_range_json_value').val()));

    var period_range_length = $('#period_range_length').val();
    var period_range_unit = $('#period_range_unit').val();

    if (period_range_unit == 'NIGHT')
    {
        if (!(period_range_length in period_range_json_value.NIGHT))
        {
            period_range_json_value.NIGHT[period_range_length] = "";
        }
        else
        {
            alert("Please dont select the same night");
            return false;
        }
    }

    if (period_range_unit == 'MONTH')
    {
        if (!(period_range_length in period_range_json_value.MONTH))
        {
            period_range_json_value.MONTH[period_range_length] = "";
        }
        else
        {
            alert("Please dont select the same month");
            return false;
        }
    }

    if (period_range_unit == 'YEAR')
    {
        if ('YEAR' in period_range_json_value)
        {
            if (!(period_range_length in period_range_json_value.YEAR))
            {
                period_range_json_value.YEAR[period_range_length] = "";
            }
            else
            {
                alert("Please dont select the same year");
                return false;
            }
        }
        else
        {
            var temp = {};
            temp[period_range_length] = "";
            period_range_json_value.YEAR = temp;
        }
    }

    var night_keys = Object.keys(period_range_json_value.NIGHT);
    var month_keys = Object.keys(period_range_json_value.MONTH);

    var main_array = new Array();

    for (var i = 0; i < night_keys.length; i++)
    {
        if (typeof night_keys[i + 1] !== 'undefined')
        {
            main_array.push(night_keys[i] + ' night - ' + (night_keys[i + 1] - 1) + ' night');
        }
        else
        {
            main_array.push(night_keys[i] + ' night - < 1 month');
        }
    }

    for (var i = 0; i < month_keys.length; i++)
    {
        if (typeof month_keys[i + 1] !== 'undefined')
        {
            main_array.push(month_keys[i] + ' month - < ' + (month_keys[i + 1] - 1) + ' month');
        }
        else
        {
            main_array.push(month_keys[i] + ' month or longer');
        }
    }

    if ('YEAR' in period_range_json_value)
    {
        var year_keys = Object.keys(period_range_json_value.YEAR);
        for (var i = 0; i < year_keys.length; i++)
        {
            if (typeof year_keys[i + 1] !== 'undefined')
            {
                main_array.push(year_keys[i] + ' year - < ' + (year_keys[i + 1] - 1) + ' year');
            }
            else
            {
                main_array.push(year_keys[i] + ' year or longer');
            }
        }
    }

    var all_concat = JSON.stringify(period_range_json_value);
    var base64_data = btoa(all_concat);
    var period_range_count = parseInt($('.period_range_count').val());
    period_range_count++;
    $('.period_range_count').val(period_range_count);
    $('.period_range_json_value').val(base64_data);
    $('.period_range_value').val(main_array.join());

    var data = {};

    data['period_range_count'] = $('.period_range_count').val();
    data['period_total_count'] = parseInt($('#period_total_count').val());
    var period_total_count = data['period_total_count'];


    data['period_range_value'] = $('.period_range_value').val();

    if ($('#enable_now').prop("checked"))
    {
        data['enable_now'] = 1;
    }
    else
    {
        data['enable_now'] = 0;
    }

    if ($('#enable_pgc').prop("checked"))
    {
        data['perguest_standard_occupancy'] = $('#perguest_standard_occupancy').val();
        data['perguest_max_occupancy'] = $('#perguest_max_occupancy').val();
        data['enable_pgc'] = 1;
    }
    else
    {
        data['perguest_standard_occupancy'] = 0;
        data['perguest_max_occupancy'] = 0;
        data['enable_pgc'] = 0;
    }
    data['period_range_json_value'] = JSON.parse(atob($('.period_range_json_value').val()));

    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/add_new_night_period",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            for (var i = 0; i <= data.result.length; i++)
            {
                $("#property_pricing_display_" + i).html("");
                $("#property_pricing_display_" + i).html(data.result[i]);
            }
            $('#modal-example3').modal('hide');
        }
    });
}

function delete_now(id, now_count, now_id) {
    $('.' + id).remove();
    now_count--;
    $('#' + now_id).attr('onclick', 'add_new_now("' + now_count + '","' + now_id + '")');
}

function change_now_selction(period_id, now_count, week_id, this_ref)
{

    $('#property_pricing_display_' + period_id + ' input:checkbox').each(function() {
        var class_name = $(this).attr('class');
        if (class_name != "kon_" + period_id + "_" + now_count)
        {
            if ($(this).is(':checked'))
            {
                var value = $(this).val();
                if (value == week_id)
                {
                    $(this).prop('checked', false);
                }
            }
        }
    });

    var class_names_array = [];
    var internal_id = [];

    $('#property_pricing_display_' + period_id + ' input:checkbox').each(function() {
        class_names_array.push($(this).attr('class'));
        internal_id.push($(this).attr("data-id"));
    });

    $.unique(class_names_array);
    $.unique(internal_id);

    for (var i = 0; i < class_names_array.length; i++)
    {
        var checked_values = [];
        $('.' + class_names_array[i]).each(function() {
            if ($(this).is(':checked')) {
                checked_values.push($(this).val());
            }
        });
        var final_value = checked_values.toString();
        var res = class_names_array[i].split("_");
        $('.nightly_amount_' + res[1] + '_' + res[2]).each(function() {
            var name = $(this).attr('name');
            var temp = name.split("[");
            var temp1 = temp[2].replace(temp[2], final_value);
            temp[1] = "[" + temp[1];
            temp[2] = "[" + temp1 + "]";
            temp[3] = "[" + temp[3];
            temp[4] = "[" + temp[4];
            temp[5] = "[" + temp[5];

            var temp2 = temp.join('');
            $(this).attr('name', temp2);
        });

        if (final_value.length === 0)
        {
            var Html = '<tr class="' + internal_id[i] + '"><td><a onclick="delete_now(\'' + internal_id[i] + '\',\'' + res[1] + '\',\'add_new_now_' + res[2] + '\')" href="javascript:void(0);">Delete Week Group</a></td><td></td></tr>';
            $('.' + internal_id[i] + ':last').html(Html);
        }

    }
}

function enable_fees(id, thisref, fees_type_id) {
    var res = id.split("_");
    if ($(thisref).prop('checked') == true)
    {
        $('#include_' + res[1]).prop('disabled', false);
        $('#unit_' + res[1]).prop('disabled', false);
        $('#fees_value_' + res[1]).html("<input type='text' name='fees_value_" + fees_type_id + "' /> ");
    }
    else
    {
        $('#include_' + res[1]).prop('disabled', true);
        $('#unit_' + res[1]).prop('disabled', true);
        $('#fees_value_' + res[1]).html("");
    }
}

function get_fess_value(value, id, fees_id) {
    var res = id.split("_");
    if (value == 'AMOUNT')
    {
        var shtml = '<input type="text" style="width: 50%;" name="fees_value_' + fees_id + '" class="form-control" >';
        $('#fees_value_' + res[1]).html(shtml);
    }
    if (value == 'AMOUNT_PER_NIGHT')
    {
        var shtml = '<input type="text" style="width: 50%;" name="fees_value_' + fees_id + '" class="form-control" >';
        $('#fees_value_' + res[1]).html(shtml);
    }
    if (value == 'AMOUNT_PER_GUEST')
    {
        var shtml = '<label style="padding-left: 10px;">Per Adult :</label> <input type="text" style="width: 50%;" class="form-control" name="fees_value_adult_' + fees_id + '"><label style="padding-left: 10px;">Per Child :</label> <input type="text" style="width: 50%;" class="form-control" name="fees_value_child_' + fees_id + '"><label style="padding-left: 10px;">Per Baby :</label> <input style="width: 50%;" type="text" class="form-control" name="fees_value_baby_' + fees_id + '">';
        $('#fees_value_' + res[1]).html(shtml);
    }
    if (value == 'PERCENT_RENT')
    {
        var shtml = '<input type="text" style="width: 50%;" class="form-control" name="fees_value_' + fees_id + '">%';
        $('#fees_value_' + res[1]).html(shtml);
    }
    if (value == 'AMOUNT_PER_NIGHT_PER_GUEST')
    {
        var shtml = '<label style="padding-left:10px;">Per Adult :</label> <input type="text" style="width: 50%;" class="form-control" name="fees_value_adult_' + fees_id + '"><label style="padding-left: 10px;">Per Child :</label> <input type="text"  style="width: 50%;" class="form-control" name="fees_value_child_' + fees_id + '"><label style="padding-left: 10px;">Per Baby :</label> <input type="text" style="width: 50%;" class="form-control" name="fees_value_baby_' + fees_id + '">';
        $('#fees_value_' + res[1]).html(shtml);
    }

    if (value == 'STAYLENGTH')
    {
        var a = uniquid();
        var b = uniquid();

        var shtml = '<div class="responsive-table"><div class="scrollable-area"><table class="table table-bordered table-striped" style="margin-bottom:0;"><thead><tr><th>1 night - 6 night</th><th>7 night - < 1 month</th></tr>';
        shtml += '<tr><th><select onchange="get_staylength_value(this.value,\'' + a + '\',\'' + fees_id + '\',1,\'NIGHT\')" name="fees_value_staylength_unit_' + fees_id + '[]"><option value="AMOUNT">Amount</option><option value="PERCENT_RENT">% of rent</option><option  value="AMOUNT_PER_NIGHT_PER_GUEST">Amount per night, per guest</option> <option value="AMOUNT_PER_GUEST">Amount per guest</option></select></th>';
        shtml += '<th><select onchange="get_staylength_value(this.value,\'' + b + '\',\'' + fees_id + '\',7,\'NIGHT\')" name="fees_value_staylength_unit_' + fees_id + '[]"><option value="AMOUNT">Amount</option><option value="PERCENT_RENT">% of rent</option><option value="AMOUNT_PER_NIGHT_PER_GUEST">Amount per night, per guest</option> <option value="AMOUNT_PER_GUEST">Amount per guest</option></select></th></tr></thead>';
        shtml += '<tbody><tr><td class="staylength_value_' + a + '" ><input type="text" class="form-control" name="fees_value_staylength_value_amt_' + fees_id + '[1][NIGHT]"></td><td class="staylength_value_' + b + '"><input type="text" class="form-control" name="fees_value_staylength_value_amt_' + fees_id + '[7][NIGHT]"></td></tr></tbody></table></div></div>';
        $('#fees_value_' + res[1]).html(shtml);
    }
}

function uniquid() {
    var n = Math.floor(Math.random() * 11);
    var k = Math.floor(Math.random() * 1000000);
    var m = n + k;
    return m;
}

function get_staylength_value(value, id, fees_id, nights, unit) {

    if (value == 'AMOUNT') {
        var shtml = '<input type="text" style="width: 100%;" name="fees_value_staylength_value_amt_' + fees_id + '[' + nights + '][' + unit + ']" class="form-control" ></td>';

        $('.staylength_value_' + id).html(shtml);
    }
    if (value == 'PERCENT_RENT') {
        var shtml = '<input type="text" style="width: 100%;" name="fees_value_staylength_value_pct_' + fees_id + '[' + nights + '][' + unit + ']" class="form-control" ></td>';
        $('.staylength_value_' + id).html(shtml);
    }
    if (value == 'AMOUNT_PER_NIGHT_PER_GUEST') {
        var shtml = '<input name="fees_value_staylength_value_adult_' + fees_id + '[' + nights + '][' + unit + ']" class="form-control" type="text"><input name="fees_value_staylength_value_child_' + fees_id + '[' + nights + '][' + unit + ']" class="form-control" type="text"><input name="fees_value_staylength_value_baby_' + fees_id + '[' + nights + '][' + unit + ']" class="form-control" type="text">';
        $('.staylength_value_' + id).html(shtml);
    }
    if (value == 'AMOUNT_PER_GUEST') {
        var shtml = '<input name="fees_value_staylength_value_adult_apg' + fees_id + '[' + nights + '][' + unit + ']" class="form-control" type="text"><input name="fees_value_staylength_value_child_apg' + fees_id + '[' + nights + '][' + unit + ']" class="form-control" type="text"><input name="fees_value_staylength_value_baby_apg' + fees_id + '[' + nights + '][' + unit + ']" class="form-control" type="text">';
        $('.staylength_value_' + id).html(shtml);
    }
}

function toggle_weekly_rental(c_period_count) {

    if ($('#toggle_weekly_rental_' + c_period_count).prop("checked"))
    {
        var data = {};
        data['c_period_count'] = c_period_count;

        data['perguest_standard_occupancy'] = $('#perguest_standard_occupancy').val();
        data['perguest_max_occupancy'] = $('#perguest_max_occupancy').val();
        data['enable_pgc'] = 1;

        $.ajax({
            type: 'POST',
            url: api_url + "apartment_kigo/ed_week_rental",
            async: true,
            dataType: 'json',
            data: data,
            success: function(data) {
                $('#property_pricing_display_' + c_period_count+' > tbody' ).html("");
                $('#property_pricing_display_' + c_period_count+' > tbody' ).html(data.result);
            }
        });
    }
    else
    {
        ed_property_pgc();
    }
}

function push_properties_to_kigo()
{
    if ($(".case_editied:checked").length == false)
    {
        alert("Please select atleast one Properties notification");
        return false;
    }
    else if ($(".case_editied:checked").length > 5)
    {
        alert("Only 5 Properties notifications can be pushed at one time");
        return false;
    }
    else
    {
        $('#loading_layer').css('display', 'block');
        $("#loading_layer").addClass("loading_layer");
        $("#result_owners").addClass("loading_back");
        var data = [];
        var data1 = [];

        $('.case_editied:checked').each(function() {
            var res = $(this).val().split(',');
            data.push(res[0]);
            data1.push(res[1]);
        });

        var data_post = {};
        data_post['property_id'] = data;
        data_post['notification_id'] = data1;

        $.ajax({
            type: 'POST',
            url: api_url + "apartment_kigo/update_property_kigo",
            async: true,
            dataType: 'json',
            data: data_post,
            success: function(data) {
                //location.reload();
            }
        });
    }
}    


function get_add_property_bed_types()
{
    var data = {};
    data['bed_type'] = $("#validation_property_beds").val();

    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/get_add_property_bed_types",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            $('#modal-content1').html(data.result);
        }
    });

}

function updateInstantBooking(id){
	var data = {};
    var status = $("#"+id).val();

    $.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/updateInstantBooking/"+id+"/"+status,
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            $('#modal-content1').html(data.result);
        }
    });
}

function importnewproperties(){
	$.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/import_new_properties_kigo",
        async: true,
        dataType: 'json',
        beforeSend: function() {
            $('#loading_layer').css('display', 'block');
            $("#loading_layer").addClass("loading_layer");
            $("#result_properties").addClass("loading_back");
        },
        success: function(data) {
            $('#loading_layer').css('display', 'none');
            $("#loading_layer").removeClass("loading_layer");
            $("#result_properties").removeClass("loading_back");
            //location.reload();
        }
    });
}

function importnewreservation(){	
	$.ajax({
        type: 'POST',
        url: api_url + "apartment_kigo/importnewreservation",
        async: true,
        dataType: 'json',
        beforeSend: function() {
            $('#loading_layer').css('display', 'block');
			$("#loading_layer").addClass("loading_layer");
			$("#result_properties").addClass("loading_back");
        },
        success: function(data) {
            $('#loading_layer').css('display', 'none');
			$("#loading_layer").removeClass("loading_layer");
			$("#result_properties").removeClass("loading_back");
        }
    });
}
