"use strict";

jQuery(document).ready(function ($) {
    // анимация на сайте
    // Добавить anim-items класс вручную ко всем элементам которые анимированы
    var animItems = $('.anim-items');

    if (animItems.length > 0) {
        window.addEventListener('scroll', animOnScroll)

        function animOnScroll() {
            for (let index = 0; index < animItems.length; index++) {
                const animItem = animItems[index];
                const animItemHeight = animItem.offsetHeight; //получ высоту элементов
                const animItemOffset = offset(animItem).top; // получаем позицию обьекта относительно верха
                const animStart = 4; //коефициент

                let animItemPoint = window.innerHeight - animItemHeight / animStart;

                // если элемент выше окна браузера
                if (animItemHeight > window.innerHeight) {
                    animItemPoint = window.innerHeight - window.innerHeight / animStart;
                }

                if ((pageYOffset > animItemOffset - animItemPoint) && pageYOffset < (animItemOffset + animItemHeight)) {
                    animItem.classList.add('active');
                }
                /* если нужно чтобы анимация снова прятала элемент
                else {
                    animItem.classList.remove('active');
                }*/

            }
        }
        // функция определения положения элемента с верху экрана и слева экрана
        function offset(el) {
            const rect = el.getBoundingClientRect(),
                scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
                scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            return {
                top: rect.top + scrollTop,
                left: rect.left + scrollLeft
            }
        }
        // вызываем функцию которая выведет анимацию при загрузке страницы если элемент попадает в поле зрения с задержкой
        setTimeout(() => {
            animOnScroll();
        }, 300);

    }
});
