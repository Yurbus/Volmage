"use script"

const isMobile = {
    Android: function () {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function () {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function () {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function () {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function () {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function () {
        return (
            isMobile.Android() ||
            isMobile.BlackBerry() ||
            isMobile.iOS() ||
            isMobile.Opera() ||
            isMobile.Windows());
    }
};

document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.format__btn');
    const modal = document.getElementById('formatModal');
    const modalClose = document.getElementById('modalClose');
    const formatInput = document.getElementById('selectedFormat');
    const formatDisplay = document.getElementById('formatDisplay');

    buttons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const format = this.getAttribute('data-format');
            formatInput.value = format;
            formatDisplay.textContent = format;
            modal.style.display = 'block';
        });
    });

    modalClose.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    // Закрытие по клику вне окна
    window.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
});


// ------- Section about прокрутка чисел ---------------------------------------
// document.addEventListener('DOMContentLoaded', () => {
//     const statsBlock = document.getElementById('stats');
//     const stats = document.querySelectorAll('.stat');
//     const observer = new IntersectionObserver(entries => {
//         entries.forEach(entry => {
//             if (entry.isIntersecting) {
//                 stats.forEach(stat => {
//                     const line = stat.querySelector('.line');
//                     const number = stat.querySelector('.number');
//                     const target = +number.getAttribute('data-target');
//                     stat.classList.add('visible');
//                     line.classList.add('visible');
//                     scrollToTarget(number, target);
//                 });
//                 observer.disconnect();
//             }
//         });
//     }, { threshold: 0.5 });

//     observer.observe(statsBlock);

//     function scrollToTarget(element, target) {
//         let start = 0;
//         const increment = target / 100;
//         const duration = 2000;
//         const stepTime = duration / 100;
//         const timer = setInterval(() => {
//             start += increment;
//             element.textContent = Math.round(start);
//             if (start >= target) {
//                 clearInterval(timer);
//                 element.textContent = target;
//             }
//         }, stepTime);
//     }
// });

// if (isMobile.any()) {
//     document.body.classList.add('_touch');
	
// 			let menuArrows = document.querySelectorAll('.menu-item-has-children');
// 			if (menuArrows.length > 0) {
// 				for (let index = 0; index < menuArrows.length; index++) {
// 					const menuArrow = menuArrows[index];
// 					menuArrow.addEventListener("click", function (e) {
// 						menuArrow.parentElement.classList.toggle('_active');
// 					});
// 				}
// 			}

// } else {
//     document.body.classList.add('_pc');
// }


// Меню бурнер
// const iconMenu = document.querySelector('.menu__icon');
// const menuBody = document.querySelector('.menu__body');

// if (iconMenu) {
// 	iconMenu.addEventListener("click", function (e) {
// 		document.body.classList.add('_lock');
// 		iconMenu.classList.add('_active');
// 		menuBody.classList.add('_active');
// 	});
// }
// const IconClose = document.querySelector('.burger');
// if (IconClose) {
// 	IconClose.addEventListener("click", function (e) {
// 		document.body.classList.remove('_lock');
// 		iconMenu.classList.remove('_active');
// 		menuBody.classList.remove('_active');
// 	});
// }

// -------- Accordion -----------------------------------------
// var acc = document.getElementsByClassName("accordion");
// var i;

//     for (i = 0; i < acc.length; i++) {
//     acc[i].addEventListener("click", function() {
//         this.classList.toggle("active");
//         var panel = this.nextElementSibling;
//         if (panel.style.maxHeight) {
//         panel.style.maxHeight = null;
//         } else {
//         panel.style.maxHeight = panel.scrollHeight + "px";
//         }
//     });
// }


// --------- header------------------------------------------------

// window.addEventListener('scroll', function () {
//     const header = document.getElementById('header');
//     if (window.scrollY > 50) {  
//         header.style.top = '0px'; 
//         header.style.backgroundColor = 'white'; 
//     } else {
//         header.style.top = '52px'; 
//         header.style.backgroundColor = 'transparent'; 
//     }
// });





