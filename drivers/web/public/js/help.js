/* Показать 1*/
let btn =  document.querySelectorAll('.btn')
let text = document.querySelectorAll('.text-help')
let show = document.querySelectorAll('#show-hide-btn')
console.log(btn)
for(let i = 0; i<btn.length; i++)
    {
        console.log(btn[i]) 
        btn[i].addEventListener('click', function() {
            console.log(text[i].classList.contains('hidden'));
            console.log(text[i]);
            // let textDiv = document.querySelector('.text-help');
            if (text[i].classList.contains('hidden')) {
                text[i].classList.remove('hidden');
                show[i].textContent = 'Убрать';
            } else {
                text[i].classList.add('hidden');
                show[i].textContent = 'Показать';
            }
        });
    }
// document.querySelectorAll('.btn').addEventListener('click', function() {
//     var textDiv = document.querySelector('.text-help');
//     if (textDiv.classList.contains('hidden')) {
//         textDiv.classList.remove('hidden');
//         document.getElementById('show-hide-btn').textContent = 'Убрать';
//     } else {
//         textDiv.classList.add('hidden');
//         document.getElementById('show-hide-btn').textContent = 'Показать';
//     }
// });

/* Показать 2 */
// document.getElementById('show-hide-btn2').addEventListener('click', function() {
//     var textDiv = document.querySelector('.text-help2');
//     if (textDiv.classList.contains('hidden')) {
//         textDiv.classList.remove('hidden');
//         document.getElementById('show-hide-btn2').textContent = 'Убрать';
//     } else {
//         textDiv.classList.add('hidden');
//         document.getElementById('show-hide-btn2').textContent = 'Показать';
//     }
// });