var X = XLS;
var XW = {
	/* worker message */
	msg : 'xls',
	/* worker scripts */
	rABS : '../packages/js/xlsworker2.js',
	norABS : '../packages/js/xlsworker1.js',
	noxfer : '../packages/js/xlsworker.js'
};

var rABS = typeof FileReader !== "undefined"
		&& typeof FileReader.prototype !== "undefined"
		&& typeof FileReader.prototype.readAsBinaryString !== "undefined";

var use_worker = typeof Worker !== 'undefined';

var transferable = use_worker;

var wtf_mode = false;

function fixdata(data) {
	var o = "", l = 0, w = 10240;
	for (; l < data.byteLength / w; ++l)
		o += String.fromCharCode.apply(null, new Uint8Array(data.slice(l * w, l
				* w + w)));
	o += String.fromCharCode.apply(null, new Uint8Array(data.slice(l * w)));
	return o;
}

function ab2str(data) {
	var o = "", l = 0, w = 10240;
	for (; l < data.byteLength / w; ++l)
		o += String.fromCharCode.apply(null, new Uint16Array(data.slice(l * w,
				l * w + w)));
	o += String.fromCharCode.apply(null, new Uint16Array(data.slice(l * w)));
	return o;
}

function s2ab(s) {
	var b = new ArrayBuffer(s.length * 2), v = new Uint16Array(b);
	for (var i = 0; i != s.length; ++i)
		v[i] = s.charCodeAt(i);
	return [ v, b ];
}

function xw_noxfer(data, cb) {
	var worker = new Worker(XW.noxfer);
	worker.onmessage = function(e) {
		switch (e.data.t) {
		case 'ready':
			break;
		case 'e':
			console.error(e.data.d);
			break;
		case XW.msg:
			cb(JSON.parse(e.data.d));
			break;
		}
	};
	var arr = rABS ? data : btoa(fixdata(data));
	worker.postMessage({
		d : arr,
		b : rABS
	});
}

function xw_xfer(data, cb) {
	var worker = new Worker(rABS ? XW.rABS : XW.norABS);
	worker.onmessage = function(e) {
		switch (e.data.t) {
		case 'ready':
			break;
		case 'e':
			console.error(e.data.d);
			break;
		default:
			xx = ab2str(e.data).replace(/\n/g, "\\n").replace(/\r/g, "\\r");
			console.log("done");
			cb(JSON.parse(xx));
			break;
		}
	};
	if (rABS) {
		var val = s2ab(data);
		worker.postMessage(val[1], [ val[1] ]);
	} else {
		worker.postMessage(data, [ data ]);
	}
}

function xw(data, cb) {
	if (transferable)
		xw_xfer(data, cb);
	else
		xw_noxfer(data, cb);
}

function get_radio_value(radioName) {
	var radios = document.getElementsByName(radioName);
	for (var i = 0; i < radios.length; i++) {
		if (radios[i].checked || radios.length === 1) {
			return radios[i].value;
		}
	}
}

function to_json(workbook) {
	var result = {};
	workbook.SheetNames
			.forEach(function(sheetName) {
				var roa = X.utils
						.sheet_to_row_object_array(workbook.Sheets[sheetName]);
				if (roa.length > 0) {
					result[sheetName] = roa;
				}
			});
	return result;
}

function to_csv(workbook) {
	var result = [];
	workbook.SheetNames.forEach(function(sheetName) {
		var csv = X.utils.sheet_to_csv(workbook.Sheets[sheetName]);
		if (csv.length > 0) {
			result.push("SHEET: " + sheetName);
			result.push("");
			result.push(csv);
		}
	});
	return result.join("\n");
}

function to_formulae(workbook) {
	var result = [];
	workbook.SheetNames.forEach(function(sheetName) {
		var formulae = X.utils.get_formulae(workbook.Sheets[sheetName]);
		if (formulae.length > 0) {
			result.push("SHEET: " + sheetName);
			result.push("");
			result.push(formulae.join("\n"));
		}
	});
	return result.join("\n");
}

var tarea = document.getElementById('b64data');
function b64it() {
	if (typeof console !== 'undefined')
		console.log("onload", new Date());
	var wb = X.read(tarea.value, {
		type : 'base64',
		WTF : wtf_mode
	});
	process_wb(wb);
}
var token = $("input[name=_token]").val();
function process_wb(wb) {


	if (use_worker)
		XLS.SSF.load_table(wb.SSF);
	var output = to_json(wb);

	// console.log(output['Sheet1']);
	var obj = output['Sheet1'];
	var tc_details = [];
	for ( var i in obj) {
		var sch = [];
		sch[0] = obj[i].tc_time;
		sch[1] = obj[i].ad_id;
		tc_details.push(sch);
	}
	//tc_details.serializeObject();
	var schedule_date = $('#schedule_date').val();

	$
			.ajax({
				url : '/adlog/savetelecasttime',
				type : 'POST',
				dataType : 'JSON',
				data : {
					'tc_details' : tc_details,
					'tc_date' : schedule_date,
					'_token' : token
				},
				success : function(data) {
					$('#tc_time_table').empty();
					// console.log(data);
					for ( var i in data) {
						var adlog = '<tr class="danger">'
								+ '<td class="ad_id">AT'
								+ pad(data[i].id, 4)
								+ '</td>'
								+ '<td>'
								+ data[i].caption
								+ '</td>'
								+ '<td>'
								+ data[i].client_name
								+ '</td>'
								+ '<td>'
								+ data[i].brand_name
								+ '</td>'
								+ '<td>'
								+ data[i].duration
								+ '</td>'
								+ '<td class="time_slot">' + data[i].tc_time
								+ '</td>';

						$('#tc_time_table').append(adlog);
					}
				}
			});
}

var xlf = document.getElementById('xlf');

function handleFile(e) {
	//alert(1);
	var files = e.target.files;
	var f = files[0];
	{
		var reader = new FileReader();
		var name = f.name;
		reader.onload = function(e) {
			if (typeof console !== 'undefined')
				console.log("onload", new Date(), rABS, use_worker);
			var data = e.target.result;
			if (use_worker) {
				xw(data, process_wb);
			} else {
				var wb;
				if (rABS) {
					wb = X.read(data, {
						type : 'binary'
					});
				} else {
					var arr = fixdata(data);
					wb = X.read(btoa(arr), {
						type : 'base64'
					});
				}
				process_wb(wb);
			}
		};
		if (rABS)
			reader.readAsBinaryString(f);
		else
			reader.readAsArrayBuffer(f);
	}
}

if (xlf.addEventListener)
	xlf.addEventListener('change', handleFile, false);
	
