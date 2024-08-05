$(function(){
    let holder=$('.translationTel'),
    button=$('.btn-seller'),
    number=holder.text(),
    symbolsForHide=16,



    show=()=>{
        holder.text(number)
        button.removeClass('show').text('Скрыть')
    },
    hide=()=>{
        holder.text(number.replace(new RegExp('(.+).{'+symbolsForHide+'}$'),"$1"+'*'.repeat(symbolsForHide)))
        button.addClass('show').text('Показать')
    }
    button.click(function(){
        if($(this).hasClass('show')) show()
        else hide()
    })
    hide()
})