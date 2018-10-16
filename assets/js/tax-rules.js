$(document).ready(function () {
    $(".item-add").on("click", function () {

        var sTable = $(".task-items");
        var RowAppend = ['<tr class="item-row">',

            '<td><input type="text" name="salary_from[]" class="form-control description salary_from"></td>' +
            '<td><input type="text" name="salary_to[]" class="form-control description"></td>' +
            '<td><input type="text" name="tax_percentage[]" class="form-control description"></td>' +
            '<td><input type="text" name="additional_tax_amount[]" class="form-control description"></td>' +
            '<td><select name="gender[]" class="form-control selectpicker" data-live-search="true">' +
            '<option value="Both">Both</option>' +
            '<option value="Male">Male</option>' +
            '<option value="Female">Female</option>' +
            '</select>' +
            '</td>' +

            '<td><button class="btn btn-danger bnt-sm" id="RemoveITEM" type="button"><i class="fa fa-trash-o"></i> Remove</button></td>'


            , "</tr>"].join("");
        var sLookup = $(RowAppend);

        var description = sLookup.find(".description");

        sLookup.find(".selectpicker").selectpicker();


        $(".item-row:last", sTable).after(sLookup);
        $('.salary_from').focus();

        sLookup.find("#RemoveITEM").on("click", function () {

            $(this).parents(".item-row").remove();

            if ($(".item-row").length < 2) $("#deleteRow").hide();
            var e = $(this).closest("tr");

        });

        return false
    });


});

