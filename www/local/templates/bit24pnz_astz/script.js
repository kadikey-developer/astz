(function ($) {
    $(function () {

        /*move search form depending on screen size*/
        const width = $(window).width();
        migrateByWindowWidth();
        $(window).resize(function () {
            if ($(window).width() == width) {
                return false;
            }
            migrateByWindowWidth();
        });

        function migrateByWindowWidth() {
            if ($(window).width() >= 1275) {
                $("#js-migrate-search-desctop").append(
                    $("#js-migrate-search-target").show()
                );
            } else {
                $("#js-migrate-search-mobile").append(
                    $("#js-migrate-search-target").show()
                );
            }
        }

        /*site header search expand/collapse*/
        $("#js-header-search-action").click(function () {
            var wrapper = $(this).closest("#js-header-search-wrapper");
            var target = wrapper.find("#js-header-search-target");
            target.animate(
                {
                    width: "toggle",
                },
                350
            );
            var width = Math.ceil(parseFloat(target.css("width")));
            if (width == 460) {
                wrapper.find("#js-header-search-open").show();
                wrapper.find("#js-header-search-close").hide();
            } else {
                wrapper.find("#js-header-search-open").hide();
                wrapper.find("#js-header-search-close").show();
            }
        });

        
        /*sliders*/
        let simpleSlider = new Swiper(".js-simple-slider", {
            loop: true,
            autoplay: {
                delay: 4000,
            },
            lazy: {
                loadPrevNext: true,
                loadPrevNextAmount: 2,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
        let threeColumnsSlider = new Swiper(".js-three-columns-slider", {
            slidesPerView: 3,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 4000,
            },
            lazy: {
                loadPrevNext: true,
                loadPrevNextAmount: 2,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                1024: {
                    slidesPerView: 2,
                },
                1275: {
                    slidesPerView: 3,
                },
            },
            on: {
                beforeInit: function () {
                    let countOfSlides = this.el.getElementsByClassName('swiper-slide').length;
                    if (this.params.slidesPerView > countOfSlides){
                        this.params.loop = false;

                        let navs = this.el.closest('.slider').getElementsByClassName('slider__navigation');
                        for (let index = 0; index < navs.length; index++) {
                            let nav = navs[index];
                            nav.style.display = 'none';
                        }

                    }
                },
            },
        });
        let fiveColumnsSlider = new Swiper(".js-five-columns-slider", {
            slidesPerView: 5,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 4000,
            },
            lazy: {
                loadPrevNext: true,
                loadPrevNextAmount: 2,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                1024: {
                    slidesPerView: 3,
                },
                1275: {
                    slidesPerView: 3,
                },
                1919: {
                    slidesPerView: 5,
                },
            },
            on: {
                beforeInit: function () {
                    let countOfSlides = this.el.getElementsByClassName('swiper-slide').length;
                    if (this.params.slidesPerView > countOfSlides){
                        this.params.loop = false;

                        let navs = this.el.closest('.slider').getElementsByClassName('slider__navigation');
                        for (let index = 0; index < navs.length; index++) {
                            let nav = navs[index];
                            nav.style.display = 'none';
                        }

                    }
                },
            },
        });



        let navigationsPrev = document.getElementsByClassName("js-slider-navigation-prev");
        if (navigationsPrev.length > 0) {
            for (let index = 0; index < navigationsPrev.length; index++) {
                let elm = navigationsPrev[index];
                elm.addEventListener("click", function(e){
                    let slider = e.target.closest(".slider");
                    slider.getElementsByClassName('swiper-button-prev')[0].click();
                })
            }
        }
        let navigationsNext = document.getElementsByClassName("js-slider-navigation-next");
        if (navigationsNext.length > 0) {
            for (let index = 0; index < navigationsNext.length; index++) {
                let elm = navigationsNext[index];
                elm.addEventListener("click", function(e){
                    let slider = e.target.closest(".slider");
                    slider.getElementsByClassName('swiper-button-next')[0].click();
                })
            }
        }



        const productSlider = document.getElementsByClassName('product-slider');
        if (productSlider.length > 0){
            let productSliderCnt = document.getElementsByClassName("js-product-slider-top")[0].getElementsByClassName('swiper-slide').length;
            let productSliderTop = new Swiper(".js-product-slider-top", {
                spaceBetween: 10,
                loop: true,
                centeredSlides: true,
                loopedSlides: 5,
            });
            let productSliderThumbs = new Swiper(".js-product-slider-thumbs", {
                spaceBetween: 17,
                centeredSlides: true,
                slidesPerView: "auto",
                touchRatio: 0.2,
                slideToClickedSlide: true,
                loop: true,
                loopedSlides: 5,
                navigation: {
                    nextEl: ".js-thumbs-next",
                    prevEl: ".js-thumbs-prev",
                },
                breakpoints: {
                    0: {
                        spaceBetween: 5,
                    },
                    576: {
                        spaceBetween: 17,
                    },
                },
                on: {
                    beforeInit: function () {
                        if (this.params.loopedSlides > productSliderCnt){
                            this.params.loop = false;
    
                            let navs = this.el.closest('.slider').getElementsByClassName('slider__navigation');
                            for (let index = 0; index < navs.length; index++) {
                                let nav = navs[index];
                                nav.style.display = 'none';
                            }
    
                        }
                    },
                },
            });
            let productSliderModal = new Swiper(".js-product-slider-modal", {
                loopedSlides: 5,
                loop: true,
                lazy: {
                    loadPrevNext: true,
                    loadPrevNextAmount: 2,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".js-modal-next",
                    prevEl: ".js-modal-prev",
                },
                on: {
                    beforeInit: function () {
                        if (this.params.loopedSlides > productSliderCnt){
                            this.params.loop = false;
    
                            let navs = this.el.closest('.slider').getElementsByClassName('slider__navigation');
                            for (let index = 0; index < navs.length; index++) {
                                let nav = navs[index];
                                nav.style.display = 'none';
                            }
    
                        }
                    },
                },
            });
            //by issue https://github.com/nolimits4web/swiper/issues/1322
            productSliderTop.controller.control = productSliderThumbs;
            productSliderThumbs.controller.control = productSliderTop;
            $('#modal-product-slider').on('shown.bs.modal', function (event) {
                productSliderModal.slideTo(productSliderTop.activeIndex, 0);
            });
            $('#modal-product-slider').on('hidden.bs.modal', function (event) {
                productSliderThumbs.slideTo(productSliderModal.activeIndex, 0);
                productSliderTop.slideTo(productSliderModal.activeIndex, 0);
            });
        }

        const animItems = document.querySelectorAll(".animation-fade-up");
        if (animItems.length > 0) {
            window.addEventListener("scroll", animOnScroll);
            function animOnScroll() {
                for (let index = 0; index < animItems.length; index++) {
                    const animItem = animItems[index];
                    const animItemOffset = offset(animItem).top;
                    let animItemPoint = window.innerHeight + window.scrollY + 100;
        
                    if (animItemOffset < animItemPoint) {
                        animItem.classList.add("active");
                    }
                }
            }
            function offset(el) {
                const rect = el.getBoundingClientRect();
                const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                return {
                    top: rect.top + scrollTop,
                    left: rect.left + scrollLeft,
                };
            }
            animOnScroll();
        }


        /*range slider https://slawomir-zaziablo.github.io/range-slider/ */
        let RangeSliders = document.getElementsByClassName("js-range-slider");
        if (RangeSliders.length > 0) {
            for (let index = 0; index < RangeSliders.length; index++) {
                const element = RangeSliders[index];
                const wrap = element.closest(".range-slider");
                const inputFrom = wrap.getElementsByClassName("js-range-slider-from")[0];
                const inputTo = wrap.getElementsByClassName("js-range-slider-to")[0];
                // settings by default
                let values = { min: 1, max: 10 };
                let set = [2, 9];
                // settings by data attributes
                if (element.hasAttribute("data-min") && element.hasAttribute("data-max")) {
                    values = {
                        min: parseInt(element.getAttribute("data-min")),
                        max: parseInt(element.getAttribute("data-max"))
                    };
                }
                if (element.hasAttribute("data-from") && element.hasAttribute("data-to")) {
                    set = [
                        parseInt(element.getAttribute("data-from")),
                        parseInt(element.getAttribute("data-to"))
                    ];
                }
                let RangeSlider = new rSlider({
                    target: element,
                    step: 1,
                    values: values,
                    set: set,
                    range: true,
                    tooltip: false,
                    scale: false,
                    labels: false,
                    onChange: function (val) { //provide data from lib to custom inputs
                        val = val.split(",");
                        inputFrom.value = parseInt(val[0]).toLocaleString(); //formatting values
                        inputTo.value = parseInt(val[1]).toLocaleString(); //formatting values
                    },
                });
                function setValuesFromInputs(from, to){ 
                    let clearFrom = parseInt(from.value.replace(/\s/g, '')); //unformatting values
                    let clearTo = parseInt(to.value.replace(/\s/g, '')); //unformatting values
                    RangeSlider.setValues(clearFrom, clearTo);
                }
                inputFrom.addEventListener('change', function(){ //provide data from custom inputs to lib
                    setValuesFromInputs(inputFrom, inputTo);
                });
                inputTo.addEventListener('change', function(){ //provide data from custom inputs to lib
                    setValuesFromInputs(inputFrom, inputTo);
                });
            }
        }


        /* custom select https://github.com/xi/select */
        const customSelect = document.getElementsByClassName("js-lib-select");
        if (customSelect.length > 0) {
            for (let index = 0; index < customSelect.length; index++) {
                new Select("myselect", customSelect[index]);
            }
        }
        $(".lib-select_multiple").on("click", function() {
            let wrap = $(this).find('.select');
            let select = $(this).find('.js-lib-select');
            if (wrap.attr("aria-expanded") === 'false') {
                console.log(select.val());
            }
        });

        /*tab of modification*/
        const modKeys = document.getElementsByClassName("js-mod-key");
        const modVals = document.getElementsByClassName("js-mod-val");
        if (modKeys.length > 0) {
            //draw lines
            drawModificationsLines();
            $('a#description-tab').on('shown.bs.tab', function (e) {
                drawModificationsLines();
            });
            $(window).resize(function(){
                drawModificationsLines();
            });
            function drawModificationsLines() {
                $('.modification__between').remove();
                for (let index = 0; index < modKeys.length; index++) {
                    const element = $(modKeys[index]);
                    const lineKey = element.find('.modification__line');
                    const lineVal = $(modVals[index]).find('.modification__line');
                    let lineKeyX = lineKey.offset().left;
                    let lineValX = lineVal.offset().left;
                    let between = $('<div class="modification__between"></div>');
                    let betweenWidth = lineValX - lineKeyX;
                    if (betweenWidth < 0) {
                        between.css({'left': 'auto', 'right': '0', })
                    }
                    lineKey.append(between);
                    between.css('width', Math.abs(betweenWidth));
                }
            }

            //active
            let arr = modKeys;
            addActive(arr, modKeys, modVals);
        
            arr = modVals;
            addActive(arr, modKeys, modVals);
        
            function addActive(arr, modKeys, modVals) {
                for (let index = 0; index < arr.length; index++) {
                    const item = arr[index];
                    const target = item.getAttribute("data-target");
        
                    item.addEventListener("mouseenter", function () {
                        clearActive(modKeys, modVals);
        
                        document.getElementById(target).classList.add("active");
                        item.classList.add("active");
                    });
                }
            }
        
            function clearActive(modKeys, modVals) {
                for (let index = 0; index < modVals.length; index++) {
                    const modVal = modVals[index];
                    modVal.classList.remove("active");
                }
                for (let index = 0; index < modKeys.length; index++) {
                    const modKey = modKeys[index];
                    modKey.classList.remove("active");
                }
            }

        }
        /*end tab of modification*/


        /*home accordion*/
        $('#home-accordion').on('show.bs.collapse', function (e) {
            let index = $(e.target).parent().index();
            $('.home-accordion-images__item').removeClass('fade-in');
            $('.home-accordion-images__item').eq(index).addClass('fade-in');
        });
        $(".js-collapse-lock-self").click(function (e) {
            let target = $(e.target).data("target");
            if ($(target).hasClass("show")) {
                return false;
            }
        });
        /*end home accordion*/
    });
})(jQuery);
