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

	element = document.getElementById('iframe');
	// element = iframe.find(".printToPDF"); // попробовать каждую строчку сохранять, чтобы перенос осуществлялся
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
 * Генерация и Скачивание архива по совету из Toster
 */
BX.ready(function () {
	$('div[id^=downloadButtons] button').on('click', function () {

  
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
		  
						var src = $(element).val();
						var fileName = src.replace(/.*\/(.*\..+)$/, '$1');
		  
						$.ajax({
							url: src,
							type: 'GET',
							xhrFields: { responseType: 'blob' },
							dataType: 'binary',
							success: function (blob) {
								blob.name = fileName;
								zip.file(fileName, blob);
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