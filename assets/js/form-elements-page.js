/*
--------------------------------------
---------- Input Group File ----------
--------------------------------------
*/

$.fn.inputFile = function() {
	var $this = $(this);
	$this.find('input[type="file"]').on('change', function(){
		$this.find('input[type="text"]').val( $(this).val() );
	});
};

$('.input-group-file').inputFile();


function get_format($format) {

	switch($format) {
		case 'd/m/Y':
			return 'DD/MM/YYYY';
		    break;

        case 'd.m.Y':
            return 'DD.MM.YYYY';
            break;

        case 'd-m-Y':
            return 'DD-MM-YYYY';
            break;

        case 'm/d/Y':
            return 'MM/DD/YYYY';
            break;

        case 'Y/m/d':
            return 'YYYY/MM/DD';
            break;

        case 'Y-m-d':
            return 'YYYY-MM-DD';
            break;

        case 'M d Y':
            return 'MMMM DD YYYY';
            break;

        case 'd M Y':
            return 'DD MMMM YYYY';
            break;

        case 'jS M y':
            return 'Do MMMM YY';
            break;

        default:
            return 'YYYY-MM-DD';
            break;

	}

}

var dateFormat=$('#_DatePicker').val();


/*
--------------------------------------
---------- Date Time Picker ----------
--------------------------------------
*/
$('.datePicker').datetimepicker({
	keepOpen: true,
	format: get_format(dateFormat)
});

$('.monthPicker').datetimepicker({
	keepOpen: true,
	format: 'YYYY-MM'
});

$('.timePicker').datetimepicker({
	keepOpen: true,
	format: 'LT'
});

$('.dateTimePicker').datetimepicker({
	keepOpen: true
});
