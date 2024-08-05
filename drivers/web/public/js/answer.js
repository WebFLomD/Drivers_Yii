let btn_questions = document.querySelectorAll('.questions-btn')
let info = document.querySelectorAll('.text-info-questions')
let show_questions = document.querySelectorAll('#show-hide-btn')

console.log(btn_questions)
for(let i = 0; i<btn_questions.length; i++)
    {
        console.log(btn_questions[i]) 
        btn_questions[i].addEventListener('click', function() {
            console.log(info[i].classList.contains('off'));
            console.log(info[i]);
            // let textDiv = document.querySelector('.text-help');
            if (info[i].classList.contains('off')) {
                info[i].classList.remove('off');
                // show_questions[i].textContent = 'Убрать';
                show_questions[i].innerHTML = '<i class="fa-solid fa-chevron-up"></i>';
            } else {
                info[i].classList.add('off');
                // show_questions[i].textContent = 'Показать';
                show_questions[i].innerHTML = '<i class="fa-solid fa-chevron-down"></i>';
            }
        });
    }