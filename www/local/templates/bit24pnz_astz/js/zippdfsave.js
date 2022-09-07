/**
 * Скачивание файлов архивом
 */
 fileUrls = function(params) { // вроде можно тоже в BX.ready
	this.params = params; // получаем массив из php
}; // что будет если убрать params в скобках?


// BX.ready(function () {

// 	/*function urlToPromise(url) { // генерация файла
// 		return new Promise(function(resolve, reject) {
// 			JSZipUtils.getBinaryContent(url, function (err, data) {
// 				if(err) {
// 					reject(err);
// 				} else {
// 					resolve(data);
// 				}
// 			});
// 		});
// 	}*/

// 	/**
// 	 * Генерируем архив силами js
// 	 */
// 	// let zip = new JSZip();
// 	// console.log(jsFileUrls.params);
// 	$('#jsZip .btn').on('click', function (e) {
// 		// e.preventDefault();
// 		$inputs = $($(this).data('target')).find('input:checkbox:checked');
// 		$inputs.each(function () {
// 			let fileID = $(this).attr('id').replace('download-docs-', '');
// 			/**
// 			 * Генерируем zip архив
// 			 */
// 			// console.log(urlToPromise(filesObj.params[fileID]["SRC"]));
			
// 			// console.log( filesObj );
// 			/*JSZipUtils.getBinaryContent(filesObj.params[fileID]["SRC"], function (err, data) {
// 				if (err) {
// 					throw err; // or handle the error
// 				}
// 				zip.file(filename, data, { binary: true });
// 			});*/
// 			// zip.file( filesObj.params[fileID]["NAME"], filesObj.params[fileID]["SRC"] );

// 			/**
// 			 * Просто отдаем ссылки на загрузку
// 			 */
// 			// window.open(filesObj.params[fileID]["SRC"]);

// 			/**
// 			 * Пробую через консоль
// 			 */
// 			/*let fileContent = $.ajax({
// 				let reader = new FileReader();
// 				// dataType: 'text',
// 				type: "GET",
// 				contentType: "application/pdf",
// 				url: filesObj.params[fileID]["SRC"],
// 				// success: function (data) {
// 					// document.writeln("check");
// 					// zip.file(filesObj.params[fileID]["NAME"], data, { binary: true });
// 				// }
// 			});*/
// 			// showFile(filesObj.params[fileID]["SRC"]); // showFile
// 			// zip.file(filesObj.params[fileID]["NAME"], fileContent, { binary: true })
// 			// console.log(zip);
// 		});
// 		/*zip.generateAsync({type:"blob"}).then(function (blob) { // 1) generate the zip file
// 			saveAs(blob, "hello.zip");                          // 2) trigger the download
// 			// location.href="data:application/zip;base64," + base64;                          // 2) trigger the download
// 			console.log("work");
// 		}, function (err) {
// 			console.log("err");

// 			$(this).text(err);
// 		});*/
// 	});
// });

/**
 * Генерируем архив силами ajax
 */
/*BX.ready(function () {
	$('#jsZip .btn').on('click', function (e) {
		let urls = new Array(
			"/upload/iblock/006/4vz7607a7g2etjvxeredemouw2q3zf9i.ies",
			"/upload/iblock/72f/2gnzfeidrf53k4qj7rjqrjenp69418au.pdf",
		);
		$ajax = $.ajax({
			url: "/local/check.php",
			method: "POST",
			data: { data: urls },
			success: function (data) {
				alert(data);
			}
		});
	});
});*/

/**
 * Генерируем файлы через ajax blob и интегрируем с JSZip
 */
// BX.ready(function () {
// 	let zip = new JSZip();
// 	$('#jsZip .btn').on('click', function (e) {

// 		// let files = new Array(); // напрямую из Blob

// 		$inputs = $($(this).data('target')).find('input:checkbox:checked');
// 		$inputs.each(function () {
// 			let fileID = $(this).attr('id').replace('download-docs-', '');
// 			$ajax = $.ajax({
// 				url: filesObj.params[fileID]["SRC"],
// 				type: 'GET',
// 				xhrFields: { responseType: 'blob' },
// 				success: function(data, status, xhr) {
// 					var blob = new Blob([data], { type: xhr.getResponseHeader('Content-Type') });
// 					console.log(blob);
// 					/**
// 					 * Последовательное скачивание
// 					 */
// 					var link = document.createElement('a');
// 					link.href = window.URL.createObjectURL(blob);
// 					link.download = filesObj.params[fileID]["SRC"];
// 					link.click();

// 					/**
// 					 * Пытаюсь загрузить информацию в архив
// 					 */
// 					/*let link = document.createElement('a');
// 					link.download = 'hello.txt';*/
// 					// let reader = new FileReader();
// 					// reader.readAsDataURL(blob); // конвертирует Blob в base64 и вызывает onload
// 					// // console.log(reader);
// 					// reader.onload = function() { // получаем base64 ссылку
// 					// 	// link.href = reader.result; // url с данными
// 					// 	// console.log(reader.result);

// 					// 	// link.click();
// 					// 	zip.file(filesObj.params[fileID]["NAME"], reader.result, {base64: true});
// 					// };

// 					// /**пытаюсь записать напрямую blob */
// 					// files.push(blob);
// 					// zip.file(filesObj.params[fileID]["NAME"], blob);

// 					/*reader.readAsArrayBuffer(blob);

// 					reader.onload = function(event) {
// 						let arrayBuffer = reader.result;
// 						zip.file(filesObj.params[fileID]["NAME"], 'check', {binary: true});
// 					};*/

// 					/*reader.readAsText(blob)
// 					reader.onload = function () {
// 						// console.log(reader.result);
// 						zip.file(filesObj.params[fileID]["NAME"], reader.result);
// 					};*/
// 				}
// 			});
// 		});

// 		// /**пытаюсь записать напрямую blob */
// 		// files = evt.target.files;
// 		// for (let i = 0; i < files.length; i++) {
// 		// 	let f = files[i];
// 		// 	zip.file(f.name, f);
// 		// }

// 		// zip.generateAsync({ type: "blob" }).then(function (blob) {
// 		// 	// window.location = "data:application/zip;base64," + data;
// 		// 	saveAs(blob, "hello.zip");  
// 		//   }, function (err) {
// 		// 	$(this).text(err);
// 		// });
// 	});
// });

/**
 * Скачивание нескольких файлов посредством iFrame скачивает только первый файл
 */
/*BX.ready(function () {
	function downloadURL(fileID, url) {
		let iframe = document.createElement('iframe');
		iframe.id = 'downloadfile_' + fileID;
		// iframe.style.display = 'none';
		document.body.appendChild(iframe);
		iframe.src = url;
		console.log(fileID);
	};
	$('#jsZip .btn').on('click', function (e) {
		$inputs = $($(this).data('target')).find('input:checkbox:checked');
		$inputs.each(function () {
			let fileID = $(this).attr('id').replace('download-docs-', '');
			downloadURL(fileID, filesObj.params[fileID]["SRC"]);
			// window.location.href = filesObj.params[fileID]["SRC"];
		});
	});
});*/


// /**
//  * Получаем файлы через .get и записываем в архив
//  */
// BX.ready(function () {
// 	let zip = new JSZip();
// 	// let filesObj = new Object();

// 	/*function addZip(fileName, fileContent) {
// 		console.log(fileContent);
// 		// zip.file(fileName, fileContent);
// 	};*/

// 	$('#jsZip .btn').on('click', function (e) {
// 		$inputs = $($(this).data('target')).find('input:checkbox:checked');
// 		$inputs.each(function (i) {
// 			let fileID = $(this).attr('id').replace('download-docs-', '');

// 			// /** with promises **/
// 			// instead of
// 			// $.get(filesObj.params[fileID]["SRC"]) // jQuery v3 returns promises
// 			// 	.then(function (content) {
// 			// 		console.log(content);
// 			// 		zip.file(filesObj.params[fileID]["NAME"], content);
// 			// 	});
			
// 			// you can do
// 			// var promise = $.get(filesObj.params[fileID]["SRC"], );

// 			/** with callbacks **/
// 			// /** instead of */
// 			// $.get(filesObj.params[fileID]["SRC"], function (error, response, body) {
// 			// 	zip.file(filesObj.params[fileID]["NAME"], body);
// 			// });

// 			/** you can do */
// 			// var promise = new Promise(function (resolve, reject) {
// 			// 	$.get(filesObj.params[fileID]["SRC"], function (error, response, body) {
// 			// 		if (error) {
// 			// 			reject(error);
// 			// 		} else {
// 			// 			resolve(body);
// 			// 		}
// 			// 	});
// 			// });

// 			/** ajax async false */
// 			/** пытаюсь через promise */
// 			// let promise = $.ajax({
// 			// 	url: filesObj.params[fileID]["SRC"],
// 			// 	contentType: 'blob',
// 			// 	async: false,
// 			// }).done(function (content) {
// 			// 	// console.log();
// 			// 	// zip.file(filesObj.params[fileID]["NAME"], content, {base64: true});
// 			// });
// 			// zip.file(filesObj.params[fileID]["NAME"], promise, {binary: true});
// 			// console.log(promise);

// 			/** пытаюсь через Blob */
// 			let reader = new FileReader();
// 			let blob = new Blob();
// 			$ajax = $.ajax({
// 				url: filesObj.params[fileID]["SRC"],
// 				type: 'GET',
// 				// async: false,
// 				xhrFields: { responseType: 'blob' },
// 				success: function (data, status, xhr) {
// 					console.log(xhr);
// 					blob = new Blob([data], { type: xhr.getResponseHeader('Content-Type') });
// 					console.log(blob);
// 					reader.readAsText(blob, "base64");
// 					reader.onload = function () {
// 						console.log(reader.result);
// 					};
// 				}
// 			/*}).done(function (data, status, xhr) {
// 				blob = new Blob([data], { type: xhr.getResponseHeader('Content-Type') });
// 				console.log(blob);
// 				reader.readAsText(blob);
// 				reader.onload = function() {
// 					console.log(reader.result);
// 				};*/
// 			});
			

// 			// console.log(promise);
// 			// zip.file(filesObj.params[fileID]["NAME"], promise);

// 		});
		
// 		zip.generateAsync({ type: "blob" }).then(function (blob) {
// 			// window.location = "data:application/zip;base64," + base64;
// 			saveAs(blob, "hello.zip");  
// 			}, function (err) {
// 			$(this).text(err);
// 		});
// 	});
// });

/**
 * Генерируем архив стредствами Битрикс
 */
// BX.ready(function () {
// 	$('#jsZip .btn').on('click', function (e) {
// 		let files = new Array();
// 		$inputs = $($(this).data('target')).find('input:checkbox:checked');
// 		$inputs.each(function () {
// 			let fileID = $(this).attr('id').replace('download-docs-', '');
// 			files.push(filesObj.params[fileID]["SRC"]);

// 		});
// 			console.log(JSON.stringify(files));
// 		$.ajax({
// 			type: "POST",
// 			url: '/local/archive.php',
// 			data: JSON.stringify(files)
// 		}).done(function (data) {
// 			data = data.replace(/\\\//g, '/');
// 			data = data.replace(/"/g, '');
// 			window.open(data);
// 		});
// 	});
// });

/**
 * Генерация PDF из страницы с помощью html2pdf - рабочий вариант, но не разбивает
 */
function generatePDF(target, save) {
	$('body').append('<div id="iframe" class="mx-40" style="font-size: 14px;"></div>');
	var iframe = $('#iframe');
	var element = $(target);
	var logo = $('.header__logo');
	logo = iframe.append(logo);
	iframe.find('.header__logo').addClass('p-10').css({ 'background-color': '#171E32' }).append(' <div class="text-white">АО "Ардатовский<br>светотехнический завод"</div> <div class="text-white">Россия, 431890, Республика Мордовия, Ардатовский р-он, п. Тургенево<br>ул. Заводская, д. 73, тел/факс: 8 (83431) 21 356, 21 009<br><a href="www.astz.ru">www.astz.ru</a><br></div></div>');
	// console.log(element);
	element.each(function () {
		// console.log($(this).parent().html());
		iframe.append($(this).html());
	});
	var img = iframe.find('.product-slider img:first');
	img.addClass('img-fluid');
	iframe.find('.product-slider').replaceWith(img);
	iframe.find('.removePDF').remove();
	iframe.find('.fz-20').removeClass('fz-20').addClass('fz-14');
	iframe.find('.fz-18').removeClass('fz-18').addClass('fz-14').parent().addClass('fz-12');
	iframe.find('.pb-20').removeClass('pb-20');
	iframe.find('.mb-40').removeClass('mb-40');
	iframe.find('.mb-xl-80').removeClass('mb-xl-80');
	iframe.find('.product-feature-param').addClass('fz-12 py-1')
	iframe.find('.pdfBreakAfter, .pdfBreakBefore').addClass('pt-30 pt-lg-50');
	iframe.find('.pdfBreakAfter:last-child').removeClass('pdfBreakAfter');
	iframe.find('input.form-control')
		.css({
			"height": "25px",
			"padding": "0",
			"text-align": "right",
			"border": "0",
			"overflow": "visible",
		});
	var opt = {
		image: {type: 'jpeg', quality: 0.98},
		html2canvas: { scale: 3, letterRendering: true},
		jsPDF: { unit: 'mm', format: 'a4', orientation: 'p' },
		pagebreak: { after: '.pdfBreakAfter', before: '.pdfBreakBefore' },
	};
	// element = document.getElementById(target);
	// html2pdf() // здесь можно преобразовать в контейнере, без создания своего контейнера
	// 	.from(element)
	// 	.set(opt)
	// 	.toContainer().then(function () {
	// 		container = _window.document.querySelector('.html2pdf__container');
	// 		console.log(container);
	// 	})
	// .save();
	element = document.getElementById('iframe');
	// element = iframe.find(".printToPDF");
	const blob = html2pdf()
		.from(element)
		.set(opt)
		.toContainer()
		.toCanvas().then(function () {
			// iframe.remove();
		})
		.output('blob', 'testPDF.pdf');
	
	if ( save ) {
		blob.save();
	}
	
	return blob;
	
}; // работает но иногда может не умещаться.

/**
 * Генерация PDF из страницы с помощью jsPDF - работает но иероглифы
 */
// BX.ready(function () {
// 	window.jsPDF = window.jspdf.jsPDF;
// 	let srcwidth = document.getElementById('printToPDF').scrollWidth;
// 	let pdf = new jsPDF('p', 'pt', 'a4');
// 	$('#pdf-check').on('click', function () {
// 		pdf.addFont("/local/templates/bit24pnz_astz/fonts/DINPro/DINPro-Bold.woff", "DINPro", "bold"); // попытка распознать шрифт
// 		pdf.setFont("DINPro");
// 		pdf.setFontSize(10)
// 		pdf.html(document.getElementById('printToPDF'), {
// 			html2canvas: {
// 				scale: 600 / srcwidth
// 			},
// 			callback: function () {
// 				pdf.save();
// 			}
// 		}); // работает но иероглифы
		
// 		// pdf.html(document.getElementById('printToPDF'), {
// 		// 	callback: function (pdf) {
// 		// 		var iframe = document.createElement('iframe');
// 		// 		iframe.setAttribute('style', 'position:absolute;top:0;right:0;height:100%; width:600px');
// 		// 		document.body.appendChild(iframe);
// 		// 		iframe.src = pdf.output('datauristring');
// 		// 		pdf.save();
// 		// 	}
// 		// });
// 	});
// });
// Вариант с предварительном созданием iframe
// function generatePDF(target) {
// 	$('body').append('<div id="iframe" class="mx-20" style="font-size: 14px;"></div>');
// 	var iframe = $('#iframe');
// 	var element = $(target);
// 	// console.log(element);
// 	element.each(function () {
// 		iframe.append($(this).html());
// 	});
// 	var img = iframe.find('img:first');
// 	img.addClass('img-fluid');
// 	iframe.find('.product-slider').replaceWith(img);
// 	iframe.find('.removePDF').remove();
// 	iframe.find('.fz-18').removeClass('fz-18');
// 	iframe.find('input.form-control')
// 		.css({
// 			"height": "25px",
// 			"padding": "0",
// 			"text-align": "right",
// 			"border": "0",
// 			"overflow": "visible",
// 		});
// 	// window.jsPDF = window.jspdf.jsPDF;
// 	// let srcwidth = document.getElementById('iframe').scrollWidth;
// 	// let pdf = new jsPDF('p', 'pt', 'a4');
// 	// import { jsPDF } from "jspdf";

// 	const { jsPDF } = window.jspdf;
// 	const pdf = new jsPDF();
	
// 	pdf.html(document.getElementById('iframe'), {
// 		callback: function (pdf) {
// 			// var iframe = document.createElement('iframe');
// 			// iframe.setAttribute('style', 'position:absolute;top:0;right:0;height:100%; width:600px');
// 			// document.body.appendChild(iframe);
// 			// iframe.src = pdf.output('datauristring');
// 			pdf.save();
// 		}
// 	});
// }

/**
 * Скачивание архива по совету из Toster
 */
BX.ready(function () {
	$('#downloadButtons button').on('click', function () {

  
		var zip = new JSZip();
	
		var selector = $(this).data('target');

		if ($(this).find(':contains("Скачать все")').length > 0) {
			$(selector).find('input:checkbox').each(function () {
				$(this).prop('checked', true);
			});
		}
	
		var inputs = $(selector).find('input:checkbox:checked');
	
		if (inputs.length > 0) {
				  
			var deferreds = inputs.map(function (n, element) {

		
				return $.Deferred(function (deferred) {

					if ( $(element).attr('id') === 'generatePDF' ) {
						var target = $(element).data('targetpdf');
						
						if (inputs.length == 1) {
							blob = generatePDF(target, 1);	
						} else {
							blob = generatePDF(target);	
							zip.file('testpdf.pdf', blob);
							deferred.resolve(blob);
						}

					} else {
		  
						var fileID = $(element).attr('id').replace('download-docs-', '');
		  
						$.ajax({
							url: filesObj.params[fileID]['SRC'],
							type: 'GET',
							xhrFields: { responseType: 'blob' },
							dataType: 'binary',
							success: function (blob) {
								blob.name = filesObj.params[fileID]['NAME'];
								zip.file(filesObj.params[fileID]['NAME'], blob);
								deferred.resolve(blob);
							},
							error: function (jqxhr, status) {
								deferred.reject(jqxhr);
							}
						});
						
					}
		  
				});
		
			});
	  
			$.when.apply(this, deferreds).done(function (blobs) {
		
				zip.generateAsync({ type: 'blob' }).then(function (blob) {
					saveAs(blob, 'files.zip'); // закоментировать, чтобы не сохранялось
				}, function (err) {
					console.log('Не удалось создать архив:', err);
				});
		
			}).fail(function (jqxhr) {
		
				console.log('При скачивании файлов произошла ошибка, один из файлов не скачался:', jqxhr);
		
			});
	  
		}
  
	});
});